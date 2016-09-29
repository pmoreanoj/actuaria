<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Admin_Containers_Default {

    public function action_index() {
        $this->template->title = 'Usuarios - Admin';
        $users = ORM::factory('Users')->order_by('username')->find_all();
        $view = view::factory('controllers/admin/users/index');
        $view->users = $users;
        $view->user_types = $this->_getUserTypes();
        $this->view = $view;
    }

    public function action_create() {

        if (!empty($_POST)) {

            $newUser = ORM::factory('Users');
            $newUser->name = strip_tags($this->request->post('name'));
            $newUser->username = strip_tags($this->request->post('username'));
            $newUser->password = md5(strip_tags($this->request->post('password')));
            $newUser->type = strip_tags($this->request->post('type'));
            $newUser->email = strip_tags($this->request->post('email'));
            $newUser->company_id = strip_tags($this->request->post('company'));
            $newUser->campaign_id = strip_tags($this->request->post('campaign'));
            $newUser->save();

            $this->redirect("admin/users");
        } else {
            $this->template->title = 'New User - Admin';
            $view = view::factory('controllers/admin/users/create');
            $view->user_types = $this->_getUserTypes();
            $this->view = $view;
        }
    }

    public function action_edit() {

        $this->auto_render = false;

        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $user = ORM::factory('Users', $id);
            $view = view::factory('controllers/admin/users/edit');
            $view->user = $user;
            $view->user_types = $this->_getUserTypes();
            $status = "OK";
            $response = array('view' => $view->render(), 'status' => $status);
            echo json_encode($response);
        }
    }

    public function action_update() {

        $this->auto_render = false;

        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $name = $this->request->post('name');
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            $email = $this->request->post('email');
            $type = $this->request->post('type');
            $company = $this->request->post('company');
            $campaign = $this->request->post('campaign');
            $user = ORM::factory('Users', $id);

            $user->name = $name;
            $user->username = $username;
            $user->password = $password;
            $user->email = $email;
            $user->type = $type;
            $user->company_id = $company;
            $user->campaign_id = $campaign;
            $user->save();

//            $view = view::factory('controllers/admin/users/edit');
//            $view->user = $user;
            $users = ORM::factory('Users')->order_by('username')->find_all();
            $view = view::factory('controllers/admin/users/index');
            $view->users = $users;
            $view->user_types = $this->_getUserTypes();
            //$this->view = $view;

            $status = "OK";
            $response = array('view' => $view->render(), 'status' => $status);
            echo json_encode($response);
        }
    }

    public function action_delete() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $user = ORM::factory("Users", $id);
            if ((!empty($_POST)) && ($user->id)) {
                $user->delete();
                $view = view::factory('controllers/admin/users/index');
                $users = ORM::factory('Users')->find_all();
                $view->users = $users;
                $status = "DELETED";
                $response = array("view" => $view->render(), "status" => $status);
            } else {
                $view = view::factory('controllers/admin/users/index');
                $users = ORM::factory('Users')->find_all();
                $view->users = $users;
                $status = "NO_RECORD";
                $response = array("view" => $view->render(), "status" => $status);
            }
            echo json_encode($response);
        }
    }

    public function action_campaign() {
        $this->template->title = 'Usuarios de la Campa&ntilde;a - Admin';
        $id = $this->request->query('campaign');
        $campaign = ORM::factory('Campaign', $id);
        $users = ORM::factory('Users')
                ->where('campaign_id', '=', $id)
                ->find_all();
        $view = view::factory('controllers/admin/users/campaign');
        $users_list = view::factory('controllers/admin/users/users_list');
        $users_list->users = $users;
        $view->campaign = $campaign;
        $view->users = $users_list;
        $view->users_count = count($users);
        $this->view = $view;
    }

    public function action_ajaxGenerateUsersFromCampaign() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $default_password = $this->request->post('default_password');
            $campaign = ORM::factory('Campaign', $id);
            $employees = $campaign->employees->find_all();
            if (!is_null($default_password)) {
                $campaign->default_password = $default_password;
                $campaign->save();
            }

            foreach ($employees as $employee) {
                $new = ORM::factory('Users')
                                ->where('username', '=', $employee->identificator)
                                ->and_where('campaign_id', '=', $campaign->id)->find();
                $new->username = $employee->identificator;
                if (!is_null($default_password)) {
                    $new->password = md5($default_password);
                    $campaign->default_password = $default_password;
                    $campaign->save();
                } else {
                    $new->password = md5($employee->identificator);
                }
                $new->status = "PASSWORD";
                $new->name = $employee->name;
                $new->type = 'USER';
                $new->employee_id = $employee->id;
                $new->campaign_id = $id;
                $new->email = $employee->email;
                $new->save();
            }
            $users = ORM::factory('Users')
                    ->where('campaign_id', '=', $id)
                    ->find_all();
            $users_list = view::factory('controllers/admin/users/users_list');
            $users_list->users = $users;
            $response = array('view' => $users_list->render());
            echo json_encode($response);
        }
    }

    public function action_ajaxGetSelection() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $option = $this->request->post('opt');

            if ($option == "ADMIN-CAMPAIGN") {
                $campaings = ORM::factory('Campaign')->where('status', '!=', 'DELETED')->order_by('name')->find_all()->as_array('id', 'name');
                $view = view::factory('controllers/admin/users/extra_type_selection');
                $view->label = "Campa&ntilde;a:";
                $view->types = $campaings;
                $view->type = 'campaign';
                $response = array('view' => $view->render());
                echo json_encode($response);
            } else if ($option == "ADMIN-COMPANY") {
                $company = ORM::factory('Company')->where('status', '!=', 'DELETED')->order_by('name')->find_all()->as_array('id', 'name');
                $view = view::factory('controllers/admin/users/extra_type_selection');
                $view->label = "Compania:";
                $view->types = $company;
                $view->type = 'company';
                $response = array('view' => $view->render());
                echo json_encode($response);
            }
        }
    }

    public function action_restorePassword() {
        $user_id = $this->_decryptNumber($this->request->query('p'));
        $user = ORM::factory('User', $user_id);
        if ($user->id) {
            if (!empty($_POST)) {
                $u_id = $this->request->post('user');
                $password = $this->request->post('password');
                $u = ORM::factory('Users', $u_id);
                $u->password = md5($password);
                $u->status = "";
                $u->save();
                $this->redirect('admin/home/login');
            } else {
                $this->template->title = 'Restaurar contrase&ntilde;a';
                $view = View::factory('controllers/admin/users/restore_password');
                $view->user = $user;
                $this->view = $view;
            }
        } else {
            $this->redirect('admin/home/login');
        }
    }

    public function action_changePassword() {
        $user_id = $this->_decryptNumber($this->request->query('p'));
        $user = ORM::factory('Users', $user_id);
        if ($user->id) {
            if (!empty($_POST)) {
                $u_id = $this->request->post('user');
                $password = $this->request->post('password');
                $u = ORM::factory('Users', $u_id);
                $u->password = md5($password);
                $u->status = "";
                $u->save();
                $this->redirect('admin/home');
            } else {
                $this->template->title = 'Cambiar contrase&ntilde;a';
                $view = View::factory('controllers/admin/users/change_password');
                $view->user = $user;
                $this->view = $view;
            }
        } else {
            $this->redirect('admin/home/login');
        }
    }

    private function _getUserTypes() {
        $types = array(
            "USER" => "Usuario Normal",
            "ADMIN" => "Administrador Total",
            "ADMIN-COMPANY" => "Administrador Compania",
            "ADMIN-CAMPAIGN" => "Administrador Campa&ntilde;a");
        return $types;
    }

}

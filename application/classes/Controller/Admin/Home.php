<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Home extends Controller_Admin_Containers_Default {

    public function action_index() {
        $session = Session::instance();
        $name = $session->get('user_name');
        $this->template->title = 'Inicio - Admin ';
        $view = view::factory('controllers/admin/home/index');
        $view->name = $name;
        $view->campaigns = ORM::factory('Company')->count_all();
        $view->companies = ORM::factory('Campaign')->count_all();
        $view->users = ORM::factory('User')->count_all();
        $this->view = $view;
    }

    public function action_reports() {

        $this->template->title = 'Inicio - Admin';
        $view = view::factory('controllers/admin/home/reports');
        $this->view = $view;
    }

    public function action_login() {
        if ($_POST) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');

            if (($username == 'aadmin') && ($password == 'admin')) {
                $session = Session::instance();
                $session->set('user', 'ADMIN');
                $session->set('user_name', 'Admin Default');
                $session->set('user_type', 'ADMIN');
                $this->redirect('admin/home');
            } else {
                $user = ORM::factory('User')
                        ->where('username', '=', $username)
                        ->and_where('password', '=', md5($password))
                        ->find();
                if ($user->id) {
                    $session = Session::instance();
                    $session->set('user', $user->id);
                    $session->set('user_type', $user->type);
                    $session->set('user_name', $user->name);
                    if ($user->type == "ADMIN") {
                        $this->redirect('admin/home');
                    } else if ($user->type == "USER") {
                        $this->redirect('home');
                    }
                } else {
                    $this->redirect('admin/home/login');
                }
            }
        } else {
            $this->template->title = 'Actuaria 360 - Login';
            $view = view::factory('controllers/admin/home/login');
            $this->view = $view;
        }
    }

    public function action_logout() {
        $session = Session::instance();
        $session->delete('user');
        $session->delete('user_name');
        $session->delete('user_type');
        $this->redirect('admin/home/login');
    }

    public function action_reset() {
        $this->template->title = 'Recuperar cuenta - Admin ';
        $view = view::factory('controllers/admin/home/reset');
        $this->view = $view;
    }

}

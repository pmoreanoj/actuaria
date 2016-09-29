<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Web_Home extends Controller_Web_Containers_Default {

    public function action_index() {
        $this->template->title = 'Actuaria 360 - Home';
        $view = View::factory('controllers/web/home/index');
        $this->view = $view;
    }

    public function action_login() {
        if ($_POST) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');

            if (($username == 'uuser') && ($password == 'user')) {
                $session = Session::instance();
                $session->set('user', 'USER_DEFAULT');
                $session->set('user_type', 'USER');
                $this->redirect('home');
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
                    $this->redirect('home/login');
                }
            }
        } else {
            $this->template->title = 'Actuaria 360 - Login';
            $view = view::factory('controllers/web/home/login');
            $this->view = $view;
        }
    }
    public function action_logout() {
        $session = Session::instance();
        $session->delete('user');
        $session->delete('user_name');
        $session->delete('user_type');
        $this->redirect('home/login');
    }
    public function action_staticprofile() {
        $this->template->title = 'Actuaria 360 - Profile';
        $view = view::factory('controllers/web/home/profile');
        $this->view = $view;
        $employee = ORM::factory('Employee', 1);
        $view->employee = $employee;
    }

    public function action_reports() {
        $this->template->title = 'Actuaria 360 - Reportes Personales';
        $view = view::factory('controllers/web/home/reports');
        $this->view = $view;
    }

}

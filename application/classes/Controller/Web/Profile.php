<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Web_Profile extends Controller_Web_Containers_Default {

    public function action_profile() {
        $this->template->title = 'Actuaria 360 - Profile';
        $id = $this->request->query('id');
        $employee = ORM::factory('Employee', $id);
        $campaign = $employee->campaign;
        $view = view::factory('controllers/web/profile/profile');
        $view->employee = $employee;
        $view->campaign = $campaign;
        $this->view = $view;
    }

    public function action_edit() {
        $this->template->title = 'Actuaria 360 - Profle - Edit';
        $id = $this->request->query('id');
        $employee = ORM::factory('Employee', $id);
        $file = View::factory('controllers/web/profile/tmpImage');
        $file->tmp = $employee->image;
        $view = view::factory('controllers/web/profile/edit');
        $view->employee = $employee;
        $view->file=$file;
        $this->view = $view;
    }

    public function action_update() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $name = $this->request->post('name');
            $age = $this->request->post('age');
            $email = $this->request->post('email');

            $update = ORM::factory("Employee", $id);
            $update->name = $name;
            $update->age = $age;
            $update->email = $email;
            $update->save();
            
            //new
            $tmp = strip_tags($this->request->post('file'));

            if ($tmp != '') {
                $id = $update->id;
                $sourcePath = $tmp;
                //die($tmp);
                $ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
                $targetPath = 'files/employee_photo/' . $id . '.' . $ext;
                //move_uploaded_file($sourcePath, $targetPath);
                rename($sourcePath, $targetPath);
                $update->image = $targetPath;
                $update->save();
            }

            //$status = "OK";

            //$view = view::factory('controllers/admin/company/index');
            //$companies = ORM::factory('Company')
              //      ->where('status', '!=', 'DELETED')
                //    ->find_all();
            //$view->companies = $companies;


            //$response = array("status" => $status, "view" => $view->render());
            //echo json_encode($response);
            //new

            $employee = ORM::factory('Employee', $id);
            $view = view::factory('controllers/web/profile/profile');
            $view->employee = $employee;
            $this->view = $view;
        }
    }

    public function action_uploadTmpImage() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
//            echo Debug::vars($_FILES);
//            die();
            $sourcePath = $_FILES['logo']['tmp_name'];       // Storing source path of the file in a variable
            $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);

            if (($ext == 'png') || ($ext == 'jpeg') || ($ext == 'jpg')) {
                $date = date_create();
                $filename = date_timestamp_get($date) . '.' . $ext;
                $targetPath = "files/tmp/" . $filename;  // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath);    // Moving Uploaded file
                $view = View::factory('controllers/web/profile/tmpImage');
                $view->tmp = $targetPath;
                $response = array('tmp' => $targetPath, 'view' => $view->render(), 'status' => 'OK');
                echo json_encode($response);
            } else {
                $response = array('status' => 'FORMAT');
                echo json_encode($response);
            }
        }
    }

}
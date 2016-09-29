<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Company extends Controller_Admin_Containers_Default {

    public function action_index() {

        $this->template->title = 'Company - Admin';
        $view = view::factory('controllers/admin/company/index');
        $companies = ORM::factory('Company')
                ->where('status', '!=', 'DELETED')
                ->find_all();
        $view->companies = $companies;
        $this->view = $view;
    }

    public function action_create() {

        if (!empty($_POST)) {

            $newCompany = ORM::factory('Company');
            $newCompany->name = strip_tags($this->request->post('name'));
            $newCompany->address = strip_tags($this->request->post('address'));
            $newCompany->email = strip_tags($this->request->post('email'));
            $newCompany->more = strip_tags($this->request->post('description'));
            $newCompany->save();

            $tmp = strip_tags($this->request->post('file'));

            if ($tmp != '') {
                $id = $newCompany->id;
                $sourcePath = $tmp;
                //die($tmp);
                $ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
                $targetPath = 'files/companies_logo/' . $id . '.' . $ext;
                //move_uploaded_file($sourcePath, $targetPath);
                rename($sourcePath, $targetPath);
                $newCompany->logo = $targetPath;
                $newCompany->save();
            }

            $this->redirect("admin/company");
        } else {
            $this->template->title = 'New Company - Admin';
            $view = view::factory('controllers/admin/company/create');
            $this->view = $view;
        }
    }

    public function action_delete() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $company = ORM::factory("Company", $id);
            if ((!empty($_POST)) && ($company->id)) {
                //$company->delete();
                $company->status = 'DELETED';
                $company->save();
                $view = view::factory('controllers/admin/company/index');
                $companies = ORM::factory('Company')
                        ->where('status', '!=', 'DELETED')
                        ->find_all();
                $view->companies = $companies;
                $status = "DELETED";
                $response = array("view" => $view->render(), "status" => $status);
            } else {
                $view = view::factory('controllers/admin/company/index');
                $companies = ORM::factory('Company')->find_all();
                $view->companies = $companies;
                $status = "NO_RECORD";
                $response = array("view" => $view->render(), "status" => $status);
            }
            echo json_encode($response);
        }
    }

    public function action_edit() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $company = ORM::factory("Company", $id);
            $file = View::factory('controllers/admin/company/tmpImage');
            $file->tmp = $company->logo;
            $view = view::factory('controllers/admin/company/edit');
            $view->company = $company;
            $view->file = $file;
            $view = $view->render();
            $status = "OK";
            $response = array("view" => $view, "status" => $status);
            echo json_encode($response);
        }
    }

    public function action_update() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $name = $this->request->post('name');
            $address = $this->request->post('address');
            $email = $this->request->post('email');
            $more = $this->request->post('more');
            $company = ORM::factory("Company", $id);

            $company->name = $name;
            $company->address = $address;
            $company->email = $email;
            $company->more = $more;

            $company->save();

            $tmp = strip_tags($this->request->post('file'));

            if ($tmp != '') {
//                /$id = $company->id;
                $date = date_create();
                $sourcePath = $tmp;
                //die($tmp);
                $ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
                $filename = date_timestamp_get($date) . '.' . $ext;
                $targetPath = 'files/companies_logo/' . $filename;
                //move_uploaded_file($sourcePath, $targetPath);
                rename($sourcePath, $targetPath);
                $company->logo = $targetPath;
                $company->save();
            }

            $status = "OK";

            $view = view::factory('controllers/admin/company/index');
            $companies = ORM::factory('Company')
                    ->where('status', '!=', 'DELETED')
                    ->find_all();
            $view->companies = $companies;


            $response = array("status" => $status, "view" => $view->render());
            echo json_encode($response);
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
                $view = View::factory('controllers/admin/company/tmpImage');
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

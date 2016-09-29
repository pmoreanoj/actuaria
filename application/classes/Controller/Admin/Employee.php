<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Employee extends Controller_Admin_Containers_Default {

    public function action_index() {
        $campaign_id = strip_tags($this->request->query('id'));
        $campaign = ORM::factory('Campaign', $campaign_id);
        $this->template->title = 'Employee ' . $campaign->name . ' - Admin';
        $view = view::factory('controllers/admin/employee/index');
        $view->campaign = $campaign;
        $this->view = $view;
    }

    public function action_campaign() {
        $campaign_id = strip_tags($this->request->query('campaign'));
        $campaign = ORM::factory('Campaign', $campaign_id);
        $employees = $campaign->employees->find_all();
        $levels = $campaign->levels->find_all();
        $this->template->title = $campaign->company->name . ' - Admin';
        $view = view::factory('controllers/admin/employee/campaign');
        $view->campaign = $campaign;
        $view->employees = $employees;
        $view->levels = $levels;
        $this->view = $view;
    }

    public function action_create() {
        if (!empty($_POST)) {
            $newUser = ORM::factory('Employee');
            $newUser->campaign_id = strip_tags($this->request->post('campaign'));
            $newUser->identificator = strip_tags($this->request->post('identificator'));
            $newUser->name = strip_tags($this->request->post('name'));
            $newUser->gender = strip_tags($this->request->post('gender'));
            $newUser->level = strip_tags($this->request->post('level'));
            $newUser->area = strip_tags($this->request->post('area'));
            $newUser->position = strip_tags($this->request->post('position'));
            $newUser->email = strip_tags($this->request->post('email'));
            $newUser->age = strip_tags($this->request->post('age'));
            $newUser->income = strip_tags($this->request->post('income'));
            $newUser->save();

            $this->redirect('admin/employee/campaignview' . "?id=" . strip_tags($this->request->post('campaign')));
        } else {
            $campaign_id = strip_tags($this->request->query('id'));
            $campaign = ORM::factory('Campaign', $campaign_id);
            $levels = $campaign
                    ->levels
                    ->order_by('name')
                    ->where('level', '!=', '0')
                    ->find_all()
                    ->as_array('id', 'name');
            $areas = $campaign
                    ->areas
                    ->order_by('name')
                    ->find_all()
                    ->as_array('id', 'name');
            $view = View::factory('controllers/admin/employee/create');
            $view->campaign = $campaign;
            $view->levels = $levels;
            $view->areas = $areas;
            $this->view = $view;
        }
    }

    public function action_employeebylevel() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $campaign = $this->request->post('campaign');
            $level = $this->request->post('level');
            $area = $this->request->post('area');

            if (($level != 'default') && ($area == '0')) {
                $employees = ORM::factory('Employee')
                        ->where('campaign_id', '=', $campaign)
                        ->and_where('level', '=', $level)
                        ->order_by('name')
                        ->find_all();
                //Die($area);
            } else if (($level == 'default') && ($area != '0')) {
                $employees = ORM::factory('Employee')
                        ->where('campaign_id', '=', $campaign)
                        ->and_where('area', '=', $area)
                        ->order_by('name')
                        ->find_all();
                //Die('AREAS');
            } else {
                $employees = ORM::factory('Employee')
                        ->where('campaign_id', '=', $campaign)
                        ->and_where('level', '=', $level)
                        ->and_where('area', '=', $area)
                        ->order_by('name')
                        ->find_all();
                //Die('ELSE');
            }

            $view = View::factory('controllers/admin/employee/employee_assignations');
            $view->employees = $employees;
            $result = array('view' => $view->render());
            echo json_encode($result);
        }
    }

    public function action_campaignview() {
        $campaign_id = strip_tags($this->request->query('id'));
        $campaign = ORM::factory('Campaign', $campaign_id);
        $employees = $campaign->employees->order_by('name')->find_all();
        $this->template->title = $campaign->company->name . ' - Admin';
        $view = view::factory('controllers/admin/employee/campaignview');
        $view->campaign = $campaign;
        $view->employees = $employees;
        //$view->levels = $levels;
        $this->view = $view;
    }

    public function action_employees() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->query('campaign');
            if (0 < $_FILES['file']['error']) {
                echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            } else {
                $name = $_FILES['file']['name'];
                $file = move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $_FILES['file']['name']);
                //echo 'Working';
                //$myfile = fopen('files/' . $name, "r") or die("Unable to open file!");
                //echo fread($myfile, filesize('files/' . $name));
                //fclose($myfile);
                $filename = 'files/' . $name;
                //$data = $this->_readCsv($filename);
                $data = $this->_readCsv2($filename);
                $levels = $data['levels'];
                $fields = $data['fields'];
                $areas = $data['areas'];
                //$error = $data['error'];
                //$warnings = $data['warnings'];
                $warnings = $this->_checkData($data['warnings'], $data['error'], $data['fields']);
                $data = $data['data'];
                $view = View::factory('controllers/admin/employee/tableCsv');
                $view->employees = $data;
                $view->levels = $levels;
                $view->areas = $areas;
                $view->dictonary = $this->_getDictonarieFromServer();
                $view->warnings = $warnings;
                $result = array(
                    'id' => $id,
                    'data' => $data,
                    'levels' => $levels,
                    'areas' => $areas,
                    'fields' => $fields,
                    'warnings' => $warnings,
                    'length' => count($data),
                    "view" => $view->render());
                echo json_encode($result);
            }
        }
    }

    private function _checkData($warnings, $errors, $fields) {
        $new_warnings = array();
        foreach ($warnings as $key => $count) {
            if ($count > 0) {
                $new_warnings[substr($key, 0, -1)] = array('level' => substr($key, -1), 'count' => $count + 1);
            }
        }

        $required = $this->_checkRequiredFields($fields);

        $result = array("repetition" => $new_warnings, "required" => $required, "columns" => $errors);

        return $result;
    }

    private function _checkRequiredFields($fields) {
        $required = array("identificator", "name", "gender", "level", "area");
        $error = array();
        foreach ($required as $f) {
            if (!isset($fields[$f])) {
                array_push($error, $f);
            }
        }
        return $error;
    }

    public function action_saveEmployees() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->query('campaign');
            if (0 < $_FILES['file']['error']) {
                echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            } else {
                $name = $_FILES['file']['name'];
                $file = move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $_FILES['file']['name']);

                $filename = 'files/' . $name;
                $data = $this->_readCsv2($filename);
                $levels = $data['levels'];
                $fields = $data['fields'];
                $areas = $data['areas'];
                $warnings = $this->_checkData($data['warnings'], $data['error'], $data['fields']);
                $data = $data['data'];
                $this->_saveEmployees($data, $fields, $id);
                $this->_saveLevels($levels, $fields, $id);
                $this->_saveAreas($areas, $fields, $id);

                $view = View::factory('controllers/admin/employee/index');
                $view->campaign = ORM::factory('Campaign', $id);
                $result = array(
                    'id' => $id,
                    //'data' => $data,
                    //'levels' => $levels,
                    //'warnings' => $warnings,
                    'length' => count($data),
                    "view" => $view->render());
                unlink($filename);

                echo json_encode($result);
            }
        }
    }

    private function _readCsv2($filename) {
        $keys = $this->_getDictonarieFromUser();

        $file = fopen($filename, "r");
        $data = array();
        $warnings = array();
        $error = array();
        $levels = array();
        $areas = array();
        $fields = array();
        $count = 0;
        while (!feof($file)) {
            $row = fgetcsv($file, 0, ';', '"');
            if ($count == 0) {
                $i = 0;
                foreach ($row as $field) {
                    $field = strtolower($field);
                    if (isset($keys[$field])) {
                        //array_push($fields, $keys[$field]);
                        $fields[$keys[$field]] = $i;
                    } else {
                        //array_push($fields, 'UKwNOWN '.$field);
                        //$fields['UKwNOWN ' . $field] = $i;
                        array_push($error, $field);
                    }
                    $i++;
                }
            } else if ($count != 0) {

                $key = $row[0] . $row[3];

                if (isset($warnings[$key])) {
                    $warnings[$key]+=1;
                } else {
                    $warnings[$key] = 0;
                }
                //$level = intval($row[3]);
                $level = intval($row[$fields['level']]);
                //if (is_int($level)) {
                if ($level != 0) {
                    if (isset($levels[$level])) {
                        $levels[$level]+=1;
                    } else {
                        $levels[$level] = 0;
                    }
                }
                if (isset($fields['area'])) {
                    $area = $row[$fields['area']];

                    if (isset($area)) {
                        if (isset($areas[$area])) {
                            $areas[$area]+=1;
                        } else {
                            $areas[$area] = 1;
                        }
                    }
                }

                array_push($data, $row);
            }
            $count++;
        }
        fclose($file);
        ksort($levels);

        return array("data" => $data, "warnings" => $warnings, "levels" => $levels, "areas" => $areas, "fields" => $fields, "error" => $error);
    }

    private function _checkWarnings($warnings) {
        $new = array();
        foreach ($warnings as $key => $count) {
            if ($count > 0) {
                $new[$key] = $count;
            }
        }
        return $new;
    }

    private function _saveEmployees($data, $fields, $campaign_id) {
        foreach ($data as $employee) {
            if ($employee[0]) {
                $new = ORM::factory('Employee');
                $new->campaign_id = $campaign_id;
                $new->identificator = $employee[$fields['identificator']];
                $new->name = $employee[$fields['name']];
                $new->gender = $employee[$fields['gender']];
                $new->level = $employee[$fields['level']];
                $new->area = $employee[$fields['area']];
                $new->position = $employee[$fields['position']];
                $new->email = $employee[$fields['email']];
                $new->save();
            }
        }
    }

    private function _saveLevels($data, $fields, $campaign_id) {
        $new = ORM::factory('Level');
        $new->campaign_id = $campaign_id;
        $new->level = '0';
        $new->name = "Transversal";
        $new->save();
        foreach ($data as $key => $level) {
            $new = ORM::factory('Level');
            $new->campaign_id = $campaign_id;
            $new->level = $key;
            $new->name = "Nivel " . $key;
            $new->save();
        }
    }

    private function _saveAreas($data, $fields, $campaign_id) {

        foreach ($data as $area => $count) {
            $new = ORM::factory('Area');
            $new->campaign_id = $campaign_id;
            $new->name = $area;
            $new->save();
        }
    }

    public function action_deleteEmployees() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $campaign_id = $this->request->post('id');
            $campaign = ORM::factory('Campaign', $campaign_id);
            $employees = $campaign->employees->find_all();
            foreach ($employees as $employee) {
                $employee->delete();
            }
            $employees = $campaign->employees->find_all();
            $levels = $campaign->levels->find_all();
            foreach ($levels as $level) {
                $level->delete();
            }
            $levels = $campaign->levels->find_all();
            $view = view::factory('controllers/admin/employee/campaign');
            $view->campaign = $campaign;
            $view->employees = $employees;
            $view->levels = $levels;

            $result = array(
                'id' => $campaign_id,
                "view" => $view->render());
            echo json_encode($result);
        }
    }

    public function action_edit() {
        if (!empty($_POST)) {
            $id = strip_tags($this->request->post('employee'));
            $newUser = ORM::factory('Employee', $id);
            $newUser->campaign_id = strip_tags($this->request->post('campaign'));
            $newUser->identificator = strip_tags($this->request->post('identificator'));
            $newUser->name = strip_tags($this->request->post('name'));
            $newUser->gender = strip_tags($this->request->post('gender'));
            $newUser->level = strip_tags($this->request->post('level'));
            $newUser->area = strip_tags($this->request->post('area'));
            $newUser->position = strip_tags($this->request->post('position'));
            $newUser->email = strip_tags($this->request->post('email'));
            $newUser->age = strip_tags($this->request->post('age'));
            $newUser->income = strip_tags($this->request->post('income'));
            $newUser->save();

            $this->redirect('admin/employee/campaignview' . "?id=" . strip_tags($this->request->post('campaign')));
        } else {

            $id = $this->request->query('id');
            $employee = ORM::factory('Employee', $id);
            $campaign = ORM::factory('Campaign', $employee->campaign_id);
            $levels = $campaign
                    ->levels
                    ->order_by('name')
                    ->where('level', '!=', '0')
                    ->find_all()
                    ->as_array('id', 'name');
            $areas = $campaign
                    ->areas
                    ->order_by('name')
                    ->find_all()
                    ->as_array('id', 'name');
            $view = view::factory('controllers/admin/employee/edit');
            $view->employee = $employee;
            $view->levels = $levels;
            $view->areas = $areas;
            $this->view = $view;
        }
    }

    public function action_ajaxDelete() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('employee');
            $employee = ORM::factory('Employee', $id);
            $campaign_id = $employee->campaign_id;
            $employee->delete();
            
            $campaign = ORM::factory('Campaign', $campaign_id);
            $employees = $campaign->employees->order_by('name')->find_all();
            $this->template->title = $campaign->company->name . ' - Admin';
            $view = view::factory('controllers/admin/employee/campaignview');
            $view->campaign = $campaign;
            $view->employees = $employees;
            
            $response=array('campaign'=>$campaign_id);
            
            echo json_encode($response);
               
        }
    }

    private function _getDictonarieFromUser() {
        $keys = array(
            "cedula" => "identificator",
            "nombre" => "name",
            "genero" => "gender",
            "nivel" => "level",
            "area" => "area",
            "email" => "email",
            "cargo" => "position",
            "edad" => "age",
            "ingreso" => "income");
        return $keys;
    }

    private function _getDictonarieFromServer() {
        $keys = array(
            "identificator" => "C&eacute;dula",
            "name" => "Nombre",
            "gender" => "G&eacute;nero",
            "level" => "Nivel",
            "area" => "Area",
            "email" => "Email",
            "position" => "Cargo",
            "age" => "Edad",
            "income" => "Ingreso");
        return $keys;
    }

}

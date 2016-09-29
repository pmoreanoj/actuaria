<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Assignations extends Controller_Admin_Containers_Default {

    public function action_index() {
        $id = $this->request->query('id');
        $this->template->title = 'Asignaciones - Admin';
        $view = view::factory('controllers/admin/assignations/index');

        $campaign = ORM::factory('Campaign', $id);
        $employees = $campaign->employees->order_by('name')->find_all();
        $view->campaign = $campaign;
        $view->employees = $employees;
        $this->view = $view;
    }

    public function action_manual() {

        $this->template->title = 'Asignaciones Manual- Admin';
        $view = view::factory('controllers/admin/assignations/manual');
        $id = 1;
        $campaign = ORM::factory('Campaign', $id);
        $areas = $campaign->areas->order_by('name')->find_all()->as_array('name', 'name');
        $areas = array_merge(array("0" => "Seleccione Area"), $areas);
        $view->campaign = $campaign;
        $view->levels = $this->_getLevels($campaign);
        $view->areas = $areas;
        $this->view = $view;
    }

    public function action_personal() {
        $id = $this->request->query('employee');
        $employee = ORM::factory('Employee', $id);
        $level = ORM::factory('Level')
                ->where('campaign_id', '=', $employee->campaign->id)
                ->and_where('level', '=', $employee->level)
                ->find();
        $areas = $employee->campaign->areas->order_by('name')->find_all()->as_array('name', 'name');
        $areas = array_merge(array("0" => "Seleccione Area"), $areas);
        $this->template->title = $employee->name . ' - Admin';
        $view = view::factory('controllers/admin/assignations/personal');
        $view->employee = $employee;
        $view->level = $level;
        $view->areas = $areas;
        $view->levels = $this->_getLevels($employee->campaign);
        $view->types = array('EVALUATED' => 'Ser Evaluado', 'EVALUATOR' => 'Evaluar a');
        $this->view = $view;
    }

    public function action_reports() {

        $this->template->title = 'Inicio - Admin';
        $view = view::factory('controllers/admin/home/reports');
        $this->view = $view;
    }

    public function action_test() {

        $this->template->title = 'Inicio - Admin';
        $id = $this->request->query('id');
        $campaign = ORM::factory('Campaign', $id);
        $this->_assignLowerLevel($campaign);
        $this->_assignSameLevel($campaign);
        $this->_assignUpperLevel($campaign);
        $this->redirect('admin/assignations/index?id=' . $id);
    }

    private function _assignLowerLevel($campaign) {
        $employees = $campaign->employees->find_all();
        $settings = $campaign->settings;
        foreach ($employees as $employee) {
            while ($employee->lower_level < $settings->lower_level) {
                $level = $employee->level - 1;
                $evaluated = $this->_getAvailableEmployee($campaign, $employee, $level, -1);
                if ($evaluated->id) {
                    $this->_saveAssignation($employee, $evaluated, -1);
                } else {
                    break;
                }
            }
        }
    }

    private function _assignSameLevel($campaign) {
        $employees = $campaign->employees->find_all();
        $settings = $campaign->settings;
        foreach ($employees as $employee) {
            while ($employee->same_level < $settings->same_level) {
                $level = $employee->level;
                $evaluated = $this->_getAvailableEmployee($campaign, $employee, $level, 0);
                if ($evaluated->id) {
                    $this->_saveAssignation($employee, $evaluated, 0);
                } else {
                    break;
                }
            }
        }
    }

    private function _assignUpperLevel($campaign) {
        $employees = $campaign->employees->find_all();
        $settings = $campaign->settings;
        foreach ($employees as $employee) {
            while ($employee->upper_level < $settings->upper_level) {
                $level = $employee->level + 1;
                $evaluated = $this->_getAvailableEmployee($campaign, $employee, $level, 1);
                if ($evaluated->id) {
                    $this->_saveAssignation($employee, $evaluated, 1);
                } else {
                    break;
                }
            }
        }
    }

    private function _getAvailableEmployee($campaign, $employee, $level, $type) {
        $settings = $campaign->settings;
        if ($type == -1) {
            $employees = ORM::factory('Employee')
                    ->where('campaign_id', '=', $campaign->id)
                    ->and_where('id', '!=', $employee->id)
                    ->and_where('level', '=', $level)
                    ->and_where('upper_level', '<', $settings->upper_level)
                    ->find();
            return $employees;
        } else if ($type == 0) {
            $employees = ORM::factory('Employee')
                    ->where('campaign_id', '=', $campaign->id)
                    ->and_where('id', '!=', $employee->id)
                    ->and_where('level', '=', $level)
                    ->and_where('same_level', '<', $settings->same_level)
                    ->find();
            return $employees;
        } else if ($type == 1) {
            $employees = ORM::factory('Employee')
                    ->where('campaign_id', '=', $campaign->id)
                    ->and_where('id', '!=', $employee->id)
                    ->and_where('level', '=', $level)
                    ->and_where('lower_level', '<', $settings->lower_level)
                    ->find();
            return $employees;
        }
    }

    private function _saveAssignation($evaluator, $evaluated, $type) {
        $new = ORM::factory('Assignations');
        $new->campaign_id = $evaluator->campaign_id;
        $new->evaluator_id = $evaluator->id;
        $new->evaluated_id = $evaluated->id;
        $new->save();

        if ($type == -1) {
            $evaluated->upper_level = $evaluated->upper_level + 1;
            $evaluator->lower_level = $evaluator->lower_level + 1;
            $evaluated->save();
            $evaluator->save();
        } else if ($type == 0) {
            $evaluated->same_level = $evaluated->same_level + 1;
            $evaluator->same_level = $evaluator->same_level + 1;
            $evaluated->save();
            $evaluator->save();
        } else if ($type == 1) {
            $evaluator->upper_level = $evaluator->upper_level + 1;
            $evaluated->lower_level = $evaluated->lower_level + 1;
            $evaluated->save();
            $evaluator->save();
        }
    }

    private function _getLevels($campaign) {
        $result = array();
        $result["default"] = "Seleccione Nivel";
        $levels = $campaign->levels->find_all();
        foreach ($levels as $level) {
            if ($level->level != 0) {
                $result[$level->level] = $level->name;
            }
        }
        return $result;
    }

    public function action_ajaxAddAssignation() {
        $this->auto_render = false;

        if ($this->request->is_ajax()) {
            $campaign = $this->request->post('campaign');
            $evaluator = $this->request->post('evaluator');
            $evaluated = $this->request->post('evaluated');
            $id = $this->request->post('employee');
            $action = $this->request->post('action');

            $new = ORM::factory('Assignations');
            $new->campaign_id = $campaign;
            $new->evaluator_id = $evaluator;
            $new->evaluated_id = $evaluated;
            $new->personalized = 'YES';
            $new->save();

            if ($action == 'PERSONAL') {
                $employee = ORM::factory('Employee', $id);
                $level = ORM::factory('Level')
                        ->where('campaign_id', '=', $employee->campaign->id)
                        ->and_where('level', '=', $employee->level)
                        ->find();
                $areas = $employee->campaign->areas->order_by('name')->find_all()->as_array('name', 'name');
                $areas = array_merge(array("0" => "Seleccione Area"), $areas);
                $view = view::factory('controllers/admin/assignations/personal');
                $view->level = $level;
                $view->employee = $employee;
                $view->levels = $this->_getLevels($employee->campaign);
                $view->areas = $areas;
                $view->types = array('EVALUATED' => 'Ser Evaluado', 'EVALUATOR' => 'Evaluar a');
                $result = array('view' => $view->render());
                echo json_encode($result);
            } elseif ($action == 'MANUAL') {
                $view = view::factory('controllers/admin/assignations/manual');
                $campaign = ORM::factory('Campaign', $campaign);
                $areas = $campaign->areas->order_by('name')->find_all()->as_array('name', 'name');
                $areas = array_merge(array("0" => "Seleccione Area"), $areas);
                $view->campaign = $campaign;
                $view->levels = $this->_getLevels($campaign);
                $view->areas = $areas;
                $result = array('view' => $view->render());
                echo json_encode($result);
            }
        }
    }

    public function action_ajaxDeleteAssignation() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $employee = $this->request->post('employee');
            $action = $this->request->post('action');
            $assignation = $this->request->post('id');

            $a = ORM::factory('Assignations', $assignation);
            $a->delete();

            if ($action == 'PERSONAL') {
                $employee = ORM::factory('Employee', $employee);
                $level = ORM::factory('Level')
                        ->where('campaign_id', '=', $employee->campaign->id)
                        ->and_where('level', '=', $employee->level)
                        ->find();
                $areas = $employee->campaign->areas->order_by('name')->find_all()->as_array('name', 'name');
                $areas = array_merge(array("0" => "Seleccione Area"), $areas);
                $view = view::factory('controllers/admin/assignations/personal');
                $view->employee = $employee;
                $view->level = $level;
                $view->areas=$areas;  
                $view->levels = $this->_getLevels($employee->campaign);
                $view->types = array('EVALUATED' => 'Ser Evaluado', 'EVALUATOR' => 'Evaluar a');
                $result = array('view' => $view->render());
                echo json_encode($result);
            }
        }
    }

    public function action_ajaxBubble() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('employee');
            $employee = ORM::factory('Employee', $id);
            $view = view::factory('controllers/admin/assignations/bubble');
            //$view->employee = $employee;
            $view->evaluated = $employee->evaluated->find_all();
            $view->evaluator = $employee->evaluator->find_all();
            $response = array('status' => 'OK', 'view' => $view->render());
            //$response = array('status' => 'OK');
            echo json_encode($response);
        }
    }

    public function action_ajaxGetProgress() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $campaign_id = $this->request->post('campaign');
            $a_new = ORM::factory('Assignations', $campaign_id)
                    ->where('campaign_id', '=', $campaign_id)
                    ->and_where('status', '=', 'NEW')
                    ->count_all();
            $a_incomplete = ORM::factory('Assignations', $campaign_id)
                    ->where('campaign_id', '=', $campaign_id)
                    ->and_where('status', '=', 'INCOMPLETE')
                    ->count_all();
            $a_complete = ORM::factory('Assignations', $campaign_id)
                    ->where('campaign_id', '=', $campaign_id)
                    ->and_where('status', '=', 'COMPLETE')
                    ->count_all();

            $result = array();

            array_push($result, array('Sin Responder', $a_new));
            array_push($result, array('En Progreso', $a_incomplete));
            array_push($result, array('Finalizada', $a_complete));

            $total_count = $a_new + $a_complete + $a_incomplete;

            if ($total_count == 0) {
                $response = array('data' => $result, 'count' => 0);
            } else {
                $response = array('data' => $result, 'count' => $total_count);
            }

            echo json_encode($response);
        }
    }

}

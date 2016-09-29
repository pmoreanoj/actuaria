<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Web_Assignations extends Controller_Web_Containers_Default {

    public function action_assignations() {
        $this->template->title = 'Actuaria 360 - Assignations';
        
        $employee_id = $this->request->query('employee');
        $employee = ORM::factory('Employee', $employee_id);
        $campaign = $employee->campaign;
        $evaluators = $employee->evaluator->find_all();
        //$view->assignations = $assignations_per_employee;
        $view = View::factory('controllers/web/assignations/assignations');
        $view->evaluators = $evaluators;
        $view->employee = $employee;
        $view->campaign = $campaign;
        $this->view = $view;
    }
}
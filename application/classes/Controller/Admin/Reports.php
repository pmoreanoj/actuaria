<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Reports extends Controller_Admin_Containers_Default {

    public function action_index() {
        //$id=$this->request->query('id');
        $id = $this->request->query('id');
        $campaign = ORM::factory('Campaign', $id);
        $employees = $campaign->employees->find_all();
        //$employee = ORM::factory('Employee', $employee_id);
        //$evaluators = $employee->evaluator->find_all();
        $this->template->title = 'Reportes de ' . $campaign->name . ' - Admin';
        $view = View::factory('controllers/admin/reports/index');

        $view->campaign = $campaign;
        $view->employees = $employees;
        //$view->settings=$campaign->settings;
        $this->view = $view;
    }

    //TAB #1 in Reports
    public function action_ajaxGetLevels() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            if ($campaign->name) {
                $levels = $campaign->levels
                                ->where('level', '!=', 0)
                                ->order_by('level')
                                ->find_all()->as_array('level', 'name');

                $query = DB::query(Database::SELECT, 'SELECT COUNT(id) as count, level FROM employee '
                                . 'WHERE campaign_id=' . $id . ' GROUP BY level order by level');
                $count = $query->execute()->as_array('level', 'count');

                $result = array();

                foreach ($levels as $level => $name) {
                    array_push($result, array($name, intval($count[$level])));
                }

                $response = array('data' => $result, 'count' => count($levels));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetAreas() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);

            if ($campaign->name) {
                //$areas = array();
                $areas = $campaign->employees
                                ->where('id', '!=', 0)
                                ->order_by('area')
                                ->find_all()->as_array('area', 'area');

                $query = DB::query(Database::SELECT, 'SELECT COUNT(id) as count, area FROM employee '
                                . 'WHERE campaign_id=' . $id . ' GROUP BY area order by area');
                $count = $query->execute()->as_array('area', 'count');

                $result = array();

                foreach ($areas as $area => $name) {
                    array_push($result, array($name, intval($count[$area])));
                }

                $response = array('data' => $result, 'count' => count($areas));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetGenre() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            $genres = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $genres = $campaign->employees
                                ->where('gender', '!=', 0)
                                ->order_by('gender')
                                ->find_all()->as_array('gender', 'gender');

                $query = DB::query(Database::SELECT, 'SELECT COUNT(id) as count,gender FROM employee '
                                . 'WHERE campaign_id=' . $id . ' GROUP BY gender order by gender');
                $count = $query->execute()->as_array('gender', 'count');
                $result = array();

                foreach ($genres as $genre => $name) {
                    array_push($result, array($name, intval($count[$genre])));
                }

                $response = array('data' => $result, 'count' => count($genres));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetAge() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            $ages = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $ages = $campaign->employees
                                ->where('age', '!=', NULL)
                                ->order_by('age')
                                ->find_all()->as_array('age', 'age');

                $query = DB::query(Database::SELECT, 'SELECT count(id) as count, age FROM employee '
                                . 'WHERE campaign_id=' . $id . ' GROUP BY age order by age');
                $count = $query->execute()->as_array('age', 'count');
                $result = array();

                foreach ($ages as $age => $name) {
                    array_push($result, array($name, intval($count[$age])));
                }

                $response = array('data' => $result, 'count' => count($ages));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetIncome() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            $incomes = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $incomes = $campaign->employees
                                ->where('income', '!=', NULL)
                                ->order_by('income')
                                ->find_all()->as_array('income', 'income');

                $query = DB::query(Database::SELECT, 'SELECT count(id) as count, income FROM employee '
                                . 'WHERE campaign_id=' . $id . ' GROUP BY income order by income');
                $count = $query->execute()->as_array('income', 'count');
                $result = array();

                foreach ($incomes as $income => $name) {
                    array_push($result, array($name, intval($count[$income])));
                }

                $response = array('data' => $result, 'count' => count($incomes));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    //TAB #2 in Reports

    public function action_ajaxGetQuestionsTPerLevel() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);

            $array_levels_by_questionType = array();
            if ($campaign->name) {
                //  $transversal_level = $campaign->levels
                //        ->where('level', '=', 0)
                //      ->find();

                $levels = $campaign->levels->where('level', '!=', 0)->find_all();

                foreach ($levels as $level) {
                    
                    $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, qt.name as name, '
                                    . 'chq.level_id FROM answer a '
                                    . 'JOIN employee e ON a.evaluated_id = e.id '
                                    . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                    . 'JOIN question_type qt ON qt.id = chq.question_type_id '
                                    . 'JOIN level lev ON chq.level_id = lev.id '
                                    . 'WHERE lev.level = 0 AND e.level =' . $level->level . ' '
                                    . 'GROUP BY chq.question_type_id ORDER BY qt.name');
                    
                    $levels_by_questionType = $query->execute()->as_array('name', 'score'); //se sobreescribe el último nivel.
                    $array_levels_by_questionType[$level->name] = $levels_by_questionType;
                } 
                
                $qType = array();
                
                foreach($array_levels_by_questionType as $row){
                    foreach($row as $row_qt => $value){
                        $qType[$row_qt]=array();
                    }
                }
                
                foreach($qType as $qType_name => $qType_value){
                    foreach($array_levels_by_questionType as $row){
                        if(isset($row[$qType_name])){
                            array_push($qType[$qType_name], floatval($row[$qType_name]));
                        }
                        else{
                            array_push($qType[$qType_name], 0);
                        }
                    }
                }
                $levels_qt = array('Tipo');
                array_push($levels_qt,array_keys($array_levels_by_questionType));
                
                array_unshift($levels_qt, 'Tipo');
                $levels_qt = array_values($levels_qt);
                $data =  array_merge(array_values($levels_qt), $qType);
                
                $response = array('data' => $data);
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetQuestionsTPerArea() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);

            $array_areas_by_questionType = array();
            if ($campaign->name) {
                //  $transversal_level = $campaign->levels
                //        ->where('level', '=', 0)
                //      ->find();

                $areas = $campaign->areas->where('id', '!=', 0)->find_all();

                foreach ($areas as $area) {
                    $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, qt.name as name, '
                                    . 'ar.name as area_name FROM answer a '
                                    . 'JOIN employee e ON a.evaluated_id = e.id '
                                    . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                    . 'JOIN question_type qt ON qt.id = chq.question_type_id '
                                    . 'JOIN area ar ON e.area = ar.name '
                                    . 'WHERE chq.level_id =' . 1 . ' AND ar.id =' . $area->id . ' '
                                    . 'GROUP BY chq.question_type_id ORDER BY qt.name;');
                    $areas_by_questionType = $query->execute()->as_array('name', 'score'); //se sobreescribe el último nivel.
                    $array_areas_by_questionType[$area->name] = $areas_by_questionType;
                }    // [name_level][question_type_name][score]            

                $qt = array();
                $first_row = array("Tipo");

                foreach ($array_areas_by_questionType as $area_name => $value) {
                    array_push($first_row, $area_name);
                    foreach ($value as $qt_value => $qt_score) {
                        foreach ($areas as $area) {
                            $qt[$qt_value][$area->name] = 0;
                        }
                        $qt[$qt_value][$area_name] = $qt_score;
                    }
                }

                $result = array();
                array_push($result, $first_row);
                foreach ($qt as $question_type => $r) {
                    $row = array();
                    array_push($row, $question_type);
                    foreach ($r as $area_name => $score) {
                        array_push($row, floatval($score));
                    }
                    array_push($result, $row);
                }

                $response = array('data' => $result, 'count' => count($result), 'qt' => $qt);
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetQuestionPerGender() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);

            $array_genders_by_questionType = array();
            if ($campaign->name) {
                $employees = $campaign->employees->where('gender', '!=', NULL)->find_all();

                foreach ($employees as $employee) {
                    $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, qt.name as name, '
                                    . 'e.gender FROM answer a '
                                    . 'JOIN employee e ON a.evaluated_id = e.id '
                                    . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                    . 'JOIN question_type qt ON qt.id = chq.question_type_id '
                                    . 'WHERE chq.level_id =' . 1 . ' AND e.gender = "' . $employee->gender . '" '
                                    . 'GROUP BY chq.question_type_id ORDER BY qt.name;');
                    $genders_by_questionType = $query->execute()->as_array('name', 'score'); //se sobreescribe el último nivel.
                    $array_genders_by_questionType[$employee->gender] = $genders_by_questionType;
                }    // [name_level][question_type_name][score]            

                $qt = array();
                $first_row = array("Tipo");

                foreach ($array_genders_by_questionType as $gender_name => $value) {
                    array_push($first_row, $gender_name);
                    foreach ($value as $qt_value => $qt_score) {
                        foreach ($employees as $employee) {
                            $qt[$qt_value][$employee->gender] = 0;
                        }
                        $qt[$qt_value][$gender_name] = $qt_score;
                    }
                }

                $result = array();
                array_push($result, $first_row);
                foreach ($qt as $question_type => $r) {
                    $row = array();
                    array_push($row, $question_type);
                    foreach ($r as $gender_name => $score) {
                        array_push($row, floatval($score));
                    }
                    array_push($result, $row);
                }

                $response = array('data' => $result, 'count' => count($result), 'qt' => $qt);
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetQuestionPerAge() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);

            $array_ages_by_questionType = array();
            if ($campaign->name) {
                $employees = $campaign->employees->where('age', '!=', NULL)->find_all();

                foreach ($employees as $employee) {
                    $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, qt.name as name, '
                                    . 'e.age FROM answer a '
                                    . 'JOIN employee e ON a.evaluated_id = e.id '
                                    . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                    . 'JOIN question_type qt ON qt.id = chq.question_type_id '
                                    . 'WHERE chq.level_id =' . 1 . ' AND e.age = "' . $employee->age . '" '
                                    . 'GROUP BY chq.question_type_id ORDER BY qt.name;');
                    $ages_by_questionType = $query->execute()->as_array('name', 'score'); //se sobreescribe el último nivel.
                    $array_ages_by_questionType[$employee->name] = $ages_by_questionType;
                }    // [name_level][question_type_name][score]            

                $qt = array();
                $first_row = array("Tipo");

                foreach ($array_ages_by_questionType as $age_value => $value) {
                    array_push($first_row, $age_value);
                    foreach ($value as $qt_value => $qt_score) {
                        foreach ($employees as $employee) {
                            $qt[$qt_value][$employee->name] = 0;
                        }
                        $qt[$qt_value][$age_value] = $qt_score;
                    }
                }

                $result = array();
                array_push($result, $first_row);
                foreach ($qt as $question_type => $r) {
                    $row = array();
                    array_push($row, $question_type);
                    foreach ($r as $age_value => $score) {
                        array_push($row, floatval($score));
                    }
                    array_push($result, $row);
                }

                $response = array('data' => $result, 'count' => count($result), 'qt' => $qt);
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetAveragePerLevel() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            if ($campaign->name) {
                $levels = $campaign->levels
                                ->where('level', '!=', 0)
                                ->order_by('level')
                                ->find_all()->as_array('level', 'name');

                $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, l.level FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'JOIN level l ON e.level = l.level '
                                . 'WHERE chq.level_id = ' . 1 . ' GROUP BY l.name ORDER BY l.name;');
                $count = $query->execute()->as_array('level', 'score');
//me da error cuando no ha respondido aunque sea uno por nivel, porque los índices no coinciden.
                if (count($count) == count($levels)) {
                    $result = array();

                    foreach ($levels as $level => $name) {
                        array_push($result, array($name, floatval($count[$level])));
                    }

                    $response = array('data' => $result, 'count' => count($levels));
                    echo json_encode($response);
                } else {
                    $response = array('count' => 0);
                    echo json_encode($response);
                }
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetAveragePerArea() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            if ($campaign->name) {
                $areas = $campaign->employees
                                ->where('area', '!=', 0)
                                ->order_by('area')
                                ->find_all()->as_array('area', 'area'); //tengo que filtrar por las areas de gente que
                //ya tiene al menos una respuesta...

                $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, ar.name as area FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'JOIN area ar ON e.area = ar.name '
                                . 'WHERE chq.level_id = 1 GROUP BY ar.name ORDER BY ar.name;');
                $count = $query->execute()->as_array('area', 'score');
//me da error cuando no ha respondido aunque sea uno por área, porque los índices no coinciden.
                if (count($count) == count($areas)) {
                    $result = array();

                    foreach ($areas as $area => $name) {
                        array_push($result, array($name, floatval($count[$area])));
                    }

                    $response = array('data' => $result, 'count' => count($areas)); {
                        echo json_encode($response);
                    }
                } else {
                    $response = array('count' => 0);
                    echo json_encode($response);
                }
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetAveragePerAge() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            if ($campaign->name) {
                $ages = $campaign->employees
                                ->where('age', '!=', NULL)
                                ->order_by('age')
                                ->find_all()->as_array('age', 'age');

                $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, e.age FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'WHERE chq.level_id = ' . 1 . ' GROUP BY e.age ORDER BY e.age;');
                $count = $query->execute()->as_array('age', 'score');

                $result = array();

                foreach ($ages as $age => $name) {
                    array_push($result, array($name, floatval($count[$age])));
                }

                $response = array('data' => $result, 'count' => count($ages));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetAveragePerIncome() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            if ($campaign->name) {
                $incomes = $campaign->employees
                                ->where('income', '!=', NULL)
                                ->order_by('income')
                                ->find_all()->as_array('income', 'income');

                $query = DB::query(Database::SELECT, 'SELECT avg(score) as score, e.income FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'WHERE chq.level_id = ' . 1 . ' GROUP BY e.income ORDER BY e.income;');
                $count = $query->execute()->as_array('income', 'score');

                $result = array();

                foreach ($incomes as $income => $name) {
                    array_push($result, array($name, floatval($count[$income])));
                }

                $response = array('data' => $result, 'count' => count($incomes));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    //TAB #3 in Reports
    public function action_ajaxGetIndividualLevel1Performance() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            //$employees = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $people = $campaign->employees
                                ->where('level', '=', 1)
                                ->order_by('name')
                                ->find_all()->as_array('name', 'name');

                $query = DB::query(Database::SELECT, 'SELECT avg(a.score) as score, e.name FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'WHERE e.level = ' . 1 . ' AND chq.level_id = ' . 2 . ' GROUP BY a.evaluated_id ORDER BY e.name;');
                $count = $query->execute()->as_array('name', 'score');
//si todos los empleados de ese nivel, no tienen al menos una evaluación hecha por alguien más, da ERROR

                if (count($count) == count($people)) {

                    $result = array();

                    foreach ($people as $person => $name) {
                        array_push($result, array($name, floatval($count[$person])));
                    }

                    $response = array('data' => $result, 'count' => count($people));
                    echo json_encode($response);
                } else {
                    $response = array('count' => 0);
                    echo json_encode($response);
                }
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetIndividualLevel2Performance() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            //$employees = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $people = $campaign->employees
                                ->where('level', '=', 2)
                                ->order_by('name')
                                ->find_all()->as_array('name', 'name');

                $query = DB::query(Database::SELECT, 'SELECT avg(a.score) as score, e.name FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'WHERE e.level = ' . 2 . ' AND chq.level_id = ' . 3 . ' GROUP BY a.evaluated_id ORDER BY e.name;');
                $count = $query->execute()->as_array('name', 'score');
                if (count($count) == count($people)) {


                    $result = array();

                    foreach ($people as $person => $name) {
                        array_push($result, array($name, floatval($count[$person])));
                    }

                    $response = array('data' => $result, 'count' => count($people));
                    echo json_encode($response);
                } else {
                    $response = array('count' => 0);
                    echo json_encode($response);
                }
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetIndividualLevel3Performance() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            //$employees = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $people = $campaign->employees
                                ->where('level', '=', 3)
                                ->order_by('name')
                                ->find_all()->as_array('name', 'name');

                $query = DB::query(Database::SELECT, 'SELECT avg(a.score) as score, e.name as name FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'WHERE e.level = ' . 3 . ' AND chq.level_id = ' . 4 . ' GROUP BY a.evaluated_id ORDER BY e.name;');
                $count = $query->execute()->as_array('name', 'score');
                if (count($count) == count($people)) {


                    $result = array();

                    foreach ($people as $person => $name) {
                        array_push($result, array($name, floatval($count[$person])));
                    }

                    $response = array('data' => $result, 'count' => count($people));
                    echo json_encode($response);
                } else {
                    $response = array('count' => 0);
                    echo json_encode($response);
                }
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetIndividualLevel4Performance() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            //$employees = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $people = $campaign->employees
                                ->where('level', '=', 4)
                                ->order_by('name')
                                ->find_all()->as_array('name', 'name');

                $query = DB::query(Database::SELECT, 'SELECT avg(a.score) as score, e.name as name FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'WHERE e.level = ' . 4 . ' AND chq.level_id = ' . 5 . ' GROUP BY a.evaluated_id ORDER BY e.name;');
                $count = $query->execute()->as_array('name', 'score');
                if (count($count) == count($people)) {


                    $result = array();

                    foreach ($people as $person => $name) {
                        array_push($result, array($name, floatval($count[$person])));
                    }

                    $response = array('data' => $result, 'count' => count($people));
                    echo json_encode($response);
                } else {
                    $response = array('count' => 0);
                    echo json_encode($response);
                }
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    public function action_ajaxGetIndividualLevel5Performance() { //preguntas transversales por niveles
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            //$employees = array(); //aqui voy a guardar el género F y M

            if ($campaign->name) {
                $people = $campaign->employees
                                ->where('level', '=', 5)
                                ->order_by('name')
                                ->find_all()->as_array('name', 'name');

                $query = DB::query(Database::SELECT, 'SELECT avg(a.score) as score, e.name as name FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'WHERE e.level = ' . 5 . ' AND chq.level_id = ' . 6 . ' GROUP BY a.evaluated_id ORDER BY e.name;');
                $count = $query->execute()->as_array('name', 'score');
                if (count($count) == count($people)) {

                    $result = array();

                    foreach ($people as $person => $name) {
                        array_push($result, array($name, floatval($count[$person])));
                    }

                    $response = array('data' => $result, 'count' => count($people));
                    echo json_encode($response);
                } else {
                    $response = array('count' => 0);
                    echo json_encode($response);
                }
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

    //TAB #4 in Reports

    public function action_ajaxGetQuestionPerSingleEmployee() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            $id_employee = $this->request->post('employee');
            $employee = ORM::factory('Employee', $id_employee);
            $questions_per_employee = array();
            if ($employee->name) {
                
//                $queryQuestion = DB::query(Database::SELECT, 'SELECT qt.name as qtname FROM answer a '
//                        . 'JOIN employee e ON a.evaluated_id = e.id '
//                        . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
//                        . 'JOIN question_type qt ON qt.id = chq.question_type_id '
//                        . 'WHERE e.id = ' . $employee->id . ' GROUP BY qtname ORDER BY qtname;');
//                $questions_per_employee = $queryQuestion->execute()->as_array('qtname');
                //$questions_per_employee = $queryQuestion->execute()->as_array('qtname','qtname');
                
                $query = DB::query(Database::SELECT, 'SELECT avg(a.score) as score, e.name as name, '
                                . 'qt.name as qtname FROM answer a '
                                . 'JOIN employee e ON a.evaluated_id = e.id '
                                . 'JOIN campaign_has_question chq ON a.question_id = chq.id '
                                . 'JOIN question_type qt ON qt.id = chq.question_type_id '
                                . 'WHERE e.id = ' . $employee->id . ' GROUP BY qt.id ORDER BY qt.id;');
                $count = $query->execute()->as_array('qtname', 'score');

                $rows = array_keys($count);
                $data = array_values($count);
                
                $response = array('rows'=>$rows, 'data'=>$data);
                //$response = array('data' => $questions_per_employee, 'count' => count($questions_per_employee));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }
}
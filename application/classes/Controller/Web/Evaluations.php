<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Web_Evaluations extends Controller_Web_Containers_Default {

    public function action_evaluations() {
        $this->template->title = 'Actuaria 360 - Evaluations';
        $employee_id = $this->request->query('employee');
        $evaluated_id = $this->request->query('evaluated'); //en auto-evalaucion es el mismo id que employee
        $employee = ORM::factory('Employee', $employee_id); //evaluador
        $evaluated = ORM::factory('Employee', $evaluated_id); //evaluado
        $campaign = $evaluated->campaign;
        $questions = $campaign->questions->find_all(); //campaign_has_questions
        $quesitons_per_evaluated = array(); //arreglo de preguntas específicas a mostrar
        $questions_transversals = array(); //arreglo de preguntas transversales a mostrar

        foreach ($questions as $question) {
            if ($question->level->level == $evaluated->level) { //LAS PREGUNTAS A EVALUAR SON DEL NIVEL DEL EVALUADOR O EL EVALUADO
                array_push($quesitons_per_evaluated, $question);
                //$quesitons_per_employee[$quesiton->id]=$question->question_text;
            } else if ($question->level->level == 0) {
                array_push($questions_transversals, $question);
            }
            else
                continue;
        }

        $view = view::factory('controllers/web/evaluations/evaluations');
        $view->questions = $this->_order_array($quesitons_per_evaluated);
        $view->questions_t = $this->_order_array($questions_transversals);
        $view->employee = $employee;
        $view->evaluated = $evaluated;
        $view->campaign = $campaign;
        $this->view = $view;
    }

    private function _order_array($questions) {
        $q_per_category = array();
        foreach ($questions as $question) {
            $type = $question->question_type_id;
            if (isset($q_per_category[$type])) {
                array_push($q_per_category[$type], $question);
            } else {
                $q_per_category[$type] = array();
                array_push($q_per_category[$type], $question);
            }
        }
        return $q_per_category;
    }

    private function _evaluation_progress($evaluator, $evaluated) {
        $evaluation_progress = ORM::factory('Answer')->where('evaluated_id', '=', $evaluated)->
                        and_where('evaluator_id', '=', $evaluator)->find_all();

        $evaluated_questions = ORM::factory('CampaignHasQuestions')->
                        where('level_id', '=', $evaluated->level)->find_all();

        $progress = (count($evaluation_progress) / count($evaluated_questions));
    }

    public function action_savequestions() {
        $this->auto_render = false;
        //die('Error');
        if ($this->request->is_ajax()) {
            $answers = ($this->request->post('answers'));
            $campaign_id = ($this->request->post('campaign'));
            $evaluator_id = ($this->request->post('evaluator'));
            $evaluated_id = ($this->request->post('evaluated'));
            $evaluation_status = ($this->request->post('status'));
            //echo "Campaña: " . $campaign_id . "Evaluated id: " . $evaluated_id . "Evaluator id: " . $evaluator_id;
            //print_r($answers);
            //die();
            
            $assig_status = ORM::factory('Assignations')->where('evaluated_id', '=', $evaluated_id)->
            and_where('evaluator_id', '=', $evaluator_id)->find();
            
            $assig_status->status = $evaluation_status;
            $assig_status->save();
            
            foreach ($answers as $id => $question) {

                $a = ORM::factory('Answer')->where('question_id', '=', $id)->
                                and_where('evaluator_id', '=', $evaluator_id)->
                                and_where('evaluated_id', '=', $evaluated_id)->
                                and_where('campaign_id', '=', $campaign_id)->count_all();
                if ($a != 0) {
                    $a = ORM::factory('Answer')->where('question_id', '=', $id)->
                                    and_where('evaluator_id', '=', $evaluator_id)->
                                    and_where('evaluated_id', '=', $evaluated_id)->
                                    and_where('campaign_id', '=', $campaign_id)->find();
                    $a->score = $question;
                    $a->save();
                } else {
                    $new = ORM::factory('Answer');
                    $new->question_id = $id;
                    $new->score = $question;
                    $new->evaluator_id = $evaluator_id;
                    $new->evaluated_id = $evaluated_id;
                    $new->campaign_id = $campaign_id;
                    $new->save();
                }
            }
        }
        else
            die('Error');
    }
}
?>
<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Question extends Controller_Admin_Containers_Default {

    public function action_index() {

        $this->template->title = 'Preguntas - Admin';
        $view = view::factory('controllers/admin/question/index');
        $questions = ORM::factory('Question')->find_all();
        $question_types = ORM::factory('QuestionType')->count_all();
        $view->questions = $questions;
        $view->question_types=$question_types;
        $this->view = $view;
    }

    public function action_create() {

        if (!empty($_POST)) {
            $question_type=$this->request->post('questionTypes');
            $question_text=$this->request->post('questionText');
            
            $new=ORM::factory('Question');
            $new->question_type_id=$question_type;
            $new->question_text=$question_text;
            $new->save();
            
            if($new->id){
                $this->redirect('admin/question');
            }
        } else {
            $this->template->title = 'Crear Preguntas - Admin';
            $view = view::factory('controllers/admin/question/create');
            $questionTypes = ORM::factory('QuestionType')->find_all()->as_array('id', 'name');
            $view->questionTypes = $questionTypes;
            $this->view = $view;
        }
    }

    public function action_view() {
        $this->template->title = 'Lista de preguntas - Admin';
        $questions = ORM::factory('Question')->find_all();
        $view = view::factory('controllers/admin/question/view');
        $questions_view = view::factory('controllers/admin/question/questions_list');
        $questions_view->questions = $questions;
        $view->questions_view = $questions_view;
        $view->question_types = $this->_getQuestionTypesSelection();
        $this->view = $view;
    }

    public function action_edit() {
        $this->template->title = 'Editar Pregunta - Admin';
        $id = $this->request->query('question');
        $question = ORM::factory('Question', $id);
        $view = view::factory('controllers/admin/question/edit');
        $view->question = $question;
        $view->question_types = $this->_getQuestionTypesSelection();
        $this->view = $view;
    }

    public function action_campaign() {
        $id = $this->request->query('id');
        $campaign = ORM::factory('Campaign', $id);
        $types = $this->_getQuestionTypesSelection();

        $levels = $campaign->levels->find_all();
        $savedQuestions = View::factory('controllers/admin/question/savedQuestions');
        $savedQuestions->campaign = $campaign;
        $savedQuestions->levels = $levels;

        $this->template->title = 'Preguntas ' . $campaign->name . '- Admin';
        $view = view::factory('controllers/admin/question/campaign');
        $view->campaign = $campaign;
        $view->types = $types;
        $view->savedQuestions = $savedQuestions;


        $this->view = $view;
    }

    public function action_uploadcsv() {

        $this->template->title = 'Subir Preguntas - Admin';
        $view = view::factory('controllers/admin/question/uploadCsv');
        $this->view = $view;
    }

    public function action_uploadcsvengine() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {

            if (0 < $_FILES['file']['error']) {
                echo 'Error: ' . $_FILES['file']['error'] . '<br>';
            } else {
                $name = $_FILES['file']['name'];
                $file = move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $_FILES['file']['name']);
                $filename = 'files/' . $name;
                $data = $this->_readCsv($filename);
                $view = View::factory('controllers/admin/question/tableCsv');
                $view->questions = $data['data'];
                $view->types = $this->_getQuestionTypes($data['types']);
                $result = array(
                    "view" => $view->render(),
                    "data" => $data['data']
                );
                echo json_encode($result);
                return $result;
            }
        }
    }

    public function action_savequestions() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $name = $_FILES['file']['name'];
            $file = move_uploaded_file($_FILES['file']['tmp_name'], 'files/' . $_FILES['file']['name']);
            $filename = 'files/' . $name;
            $data = $this->_readCsv($filename);
            $questions = $data['data'];
            foreach ($questions as $question) {
                if (!is_null($question[1])) {
                    $new = ORM::factory('Question');
                    $new->question_text = $question[0];
                    $new->question_type_id = $this->_getQuestionTypeId($question[1]);
                    $new->save();
                }
            }
            $view = View::factory('controllers/admin/question/index');
            $q = ORM::factory('Question')->find_all();
            $view->questions = $q;
            $response = array("view" => $view->render());
            echo json_encode($response);
        }
    }

    private function _readCsv($filename) {
        $file = fopen($filename, "r");
        $data = array();
        $types = array();
        $count = 0;
        while (!feof($file)) {
            $row = fgetcsv($file, 0, ';', '"');
            if ($count > 0) {
                array_push($data, $row);
                array_push($types, $row[1]);
            }
            $count++;
        }
        fclose($file);
        return array("data" => $data, "types" => $types);
    }

    private function _getQuestionTypeId($type) {
        $question_type = ORM::factory("QuestionType");
        $qt = $question_type->where('name', '=', $type)->find();
        if (isset($id)) {
            return $qt->id;
        } else {
            $question_type->name = $type;
            $question_type->save();
            return $question_type->id;
        }
    }

    private function _getQuestionTypes($types) {
        $new = array();
        foreach ($types as $type) {
            if (isset($new[$type])) {
                $new[$type] ++;
            } else {
                $new[$type] = 1;
            }
        }
        return $new;
    }

    private function _getQuestionTypesSelection() {
        $t = ORM::factory('QuestionType')->order_by('name')->find_all();
        $types = array();
        //$types[0]="Seleccione su opci&oacute;n";
        foreach ($t as $type) {
            $types[$type->id] = $type->name;
        }
        asort($types);
        $option = "Seleccione su opci&oacute;n";
        array_unshift($types, $option);
        return $types;
    }

    private function _retrieveQuestionCampaignAjax($campaign_id) {
        $campaign = ORM::factory('Campaign', $campaign_id);
        $levels = $campaign->levels->find_all();
        $view = View::factory('controllers/admin/question/savedQuestions');
        $view->campaign = $campaign;
        $view->levels = $levels;
        $response = array('view' => $view->render());
        echo json_encode($response);
    }

    public function action_addQuestionToCampaign() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $campaign_id = $this->request->post('campaign');
            $level = $this->request->post('level ');
            $question_id = $this->request->post('question');
            $question_type_id = $this->request->post('question_type');
            $new = ORM::factory('CampaignHasQuestions');
            $new->campaign_id = $campaign_id;
            $new->level_id = $level;
            $new->question_id = $question_id;
            $new->question_type_id = $question_type_id;
            $new->save();

            $this->_retrieveQuestionCampaignAjax($campaign_id);
        }
    }

    public function action_removeQuestionFromCampaign() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $new = ORM::factory('CampaignHasQuestions', $id);
            $campaign_id = $new->campaign->id;
            $new->delete();
            $this->_retrieveQuestionCampaignAjax($campaign_id);
        }
    }

    public function action_ajaxQuestionText() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $question = ORM::factory('CampaignHasQuestions', $id);
            if ($question->customized == 'NO') {
                $text = $question->question->question_text;
            } else {
                $text = $question->question_customed;
            }
            $view = View::factory('controllers/admin/question/editDialog');
            $view->text = $text;
            $view->question = $id;
            $result = array('text' => $view->render());
            echo json_encode($result);
        }
    }

    public function action_ajaxQuestionPersonalized() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $text = $this->request->post('text');
            $question = ORM::factory('CampaignHasQuestions', $id);
            $question->question_customed = $text;
            $question->customized = 'YES';
            $question->save();

            $savedQuestions = View::factory('controllers/admin/question/savedQuestions');
            $savedQuestions->campaign = $question->campaign;
            $savedQuestions->levels = $question->campaign->levels->find_all();

            $result = array('status' => 'SUCESS', 'questions' => $savedQuestions->render());
            echo json_encode($result);
        }
    }

    public function action_ajaxQuestionPersonalizedReset() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $question = ORM::factory('CampaignHasQuestions', $id);
            $question->question_customed = '';
            $question->customized = 'NO';
            $question->save();

            $savedQuestions = View::factory('controllers/admin/question/savedQuestions');
            $savedQuestions->campaign = $question->campaign;
            $savedQuestions->levels = $question->campaign->levels->find_all();

            $result = array('status' => 'SUCESS', 'questions' => $savedQuestions->render());
            echo json_encode($result);
        }
    }

    public function action_ajaxGetQuestionsByType() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('question_type');
            if ($id != 0) {
                $questions = ORM::factory('QuestionType', $id)->questions->find_all();
            } else {
                $questions = ORM::factory('Question')->find_all();
            }
            $questions_view = view::factory('controllers/admin/question/questions_list');
            $questions_view->questions = $questions;
            $response = array('view' => $questions_view->render());
            echo json_encode($response);
        }
    }

    public function action_ajaxChangeDefault() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $question_id = $this->request->post('question');
            $actuaria_360 = $this->request->post('actuaria');
            $work = $this->request->post('work');
            $question = ORM::factory('Question', $question_id);

            if ($actuaria_360) {
                $question->actuaria_360 = $actuaria_360;
                $question->save();
                $status = '360';
            } else if ($work) {
                $question->work = $work;
                $question->save();
                $status = 'work';
            }
            $response = array('status' => $status);

            echo json_encode($response);
        }
    }

    public function action_ajaxUpdateQuestion() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('question');
            $text = $this->request->post('text');
            $type = $this->request->post('type');
            $actuaria = $this->request->post('actuaria');
            $work = $this->request->post('work');
            $question = ORM::factory('Question', $id);
            $question->question_text = $text;
            $question->question_type_id = $type;
            $question->actuaria_360 = $actuaria;
            $question->work = $work;
            $question->save();

            $questions = ORM::factory('Question')->find_all();
            $view = view::factory('controllers/admin/question/view');
            $questions_view = view::factory('controllers/admin/question/questions_list');
            $questions_view->questions = $questions;
            $view->questions_view = $questions_view;
            $view->question_types = $this->_getQuestionTypesSelection();

            $response = array('status' => 'UPDATED', 'view' => $view->render());
            echo json_encode($response);
        }
    }

    public function action_ajaxGetCampaignQuestions() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            $count_questions = $campaign->questions->count_all();
            $max = 0;
            if ($campaign->name) {
                $levels = $campaign->levels
                        ->order_by('level')
                        ->find_all();
                $result = array();
                foreach ($levels as $level) {
                    $count = intval($level->questions->count_all());
                    array_push($result, array($level->name, $count));

                    if ($max < $count) {
                        $max = $count;
                    }
                }
                $response = array('data' => $result, 'campaign' => $id, 'max' => $max, 'count' => $count_questions);
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

}

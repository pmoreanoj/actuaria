<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Questiontype extends Controller_Admin_Containers_Default {

    public function action_index() {
         $this->template->title = 'Tipos de Preguntas - Admin';
        $view = view::factory('controllers/admin/questiontype/index');
        $qt=ORM::factory('QuestionType')->order_by('name')->find_all();
        $view->questionTypes=$qt;
        $this->view = $view;
    }
    
    public function action_create() {

        if (!empty($_POST)) {
            
//            $new=ORM::factory('Question');
//            $new->question_type_id=$question_type;
//            $new->question_text=$question_text;
//            $new->save();
            
            if($new->id){
                $this->redirect('admin/questiontype');
            }
        } else {
            $this->template->title = 'Crear Preguntas - Admin';
            $view = view::factory('controllers/admin/questiontype/create');
            
            //$view->questionTypes = $questionTypes;
            $this->view = $view;
        }
    }
    public function action_getTypesAjax(){
        $this->auto_render=false;
        if($this->request->is_ajax()){
            $id=$this->request->post("id");
            $campaign_id=$this->request->post("campaign");
            $campaign=ORM::factory('Campaign', $campaign_id);
            $levels=$this->_getLevelsSelection($campaign->levels->find_all());
            $types=ORM::factory('QuestionType', $id);
            $question=$types->questions->find_all();
            $view = view::factory('controllers/admin/questiontype/typesajax');
            $view->questions=$question;
            $view->levels=$levels;
            $result=array('view'=>$view->render());
            echo json_encode($result);
        }
    }
    
    
     private function _getLevelsSelection($levels){
        $l=array();
        foreach($levels as $level){
            $l[$level->id]=$level->name;
        }
        return $l;
    }
}
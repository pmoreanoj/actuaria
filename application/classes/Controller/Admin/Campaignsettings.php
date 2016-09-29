<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Campaignsettings extends Controller_Admin_Containers_Default {

    public function action_index() {
        $id=$this->request->query('id');
        $campaign = ORM::factory('Campaign',$id);
        $this->template->title = 'Configuracion de '.$campaign->name.' - Admin';
        $view = View::factory('controllers/admin/campaignsettings/index');
        
        $view->campaign = $campaign;
        $view->settings=$campaign->settings;
        $this->view = $view;
    }
    
    public function action_update(){
        $this->auto_render=false;
        if($this->request->is_ajax()){
            $id=$this->request->post('id');
            $upper_level=$this->request->post('upper_level');
            $same_level=$this->request->post('same_level');
            $lower_level=$this->request->post('lower_level');
            //_weight
            $upper_level_weight=$this->request->post('upper_level_weight');
            $same_level_weight=$this->request->post('same_level_weight');
            $lower_level_weight=$this->request->post('lower_level_weight');
            
            $settings=ORM::factory('CampaignSettings', $id);
            $settings->upper_level=$upper_level;
            $settings->same_level=$same_level;
            $settings->lower_level=$lower_level;
            $settings->upper_level_weight=$upper_level_weight;
            $settings->same_level_weight=$same_level_weight;
            $settings->lower_level_weight=$lower_level_weight;
            $settings->save();
            
            $view = View::factory('controllers/admin/campaignsettings/index');
            $view->campaign=$settings->campaign;
             $view->settings=$settings->campaign->settings;
            $response=array('view'=>$view->render());
            
            echo json_encode($response);
            
        }
    }

   

}

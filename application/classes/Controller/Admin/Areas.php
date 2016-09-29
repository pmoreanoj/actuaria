<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Areas extends Controller_Admin_Containers_Default {

    
    public function action_campaign() {
        $id = $this->request->query('id');
        $campaign = ORM::factory("Campaign", $id);
        $this->template->title = $campaign->name . ' - Admin';
        $view = view::factory('controllers/admin/areas/campaign');
        $view->campaign = $campaign;
        $this->view = $view;
    }
      public function action_edit() {
        $id = $this->request->query('id');
        $area = ORM::factory("Area", $id);
        $this->template->title = $area->name . ' - Admin';
        $view = view::factory('controllers/admin/areas/edit');
        $view->area = $area;
        $this->view = $view;
    }
/*
   
    public function action_update() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $name = $this->request->post('name');
            $level = $this->request->post('level');

            $update = ORM::factory("Level", $id);
            $update->name = $name;
            $update->level = $level;
            $update->save();

            $view = view::factory('controllers/admin/level/edit');
            $view->level = $update;

            $response = array('view' => $view->render());
            echo json_encode($response);
        }
    }
*/
    public function action_ajaxGetAreasCampaign() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            if ($campaign->name) {
               
                $query = DB::query(Database::SELECT, 'SELECT COUNT(id) as count,area FROM employee '
                                . 'WHERE campaign_id=' . $id . ' GROUP BY area order by area');
                $count = $query->execute()->as_array('area', 'count');

                $result = array();

                foreach($count as $area=>$c){
                    array_push($result, array($area,  intval($c)));
                }
                $response = array('data' => $result, 'count' => count($result));
                echo json_encode($response);
            } else {
                $response = array('count' => 0);
                echo json_encode($response);
            }
        }
    }

}

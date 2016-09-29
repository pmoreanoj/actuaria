<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Levels extends Controller_Admin_Containers_Default {

    public function action_campaign() {
        $id = $this->request->query('id');
        $campaign = ORM::factory("Campaign", $id);
        $this->template->title = $campaign->name . ' - Admin';
        $view = view::factory('controllers/admin/level/campaign');
        $view->campaign = $campaign;
        $this->view = $view;
    }

    public function action_edit() {
        $id = $this->request->query('id');
        $level = ORM::factory("Level", $id);
        $this->template->title = $level->name . ' - Admin';
        $view = view::factory('controllers/admin/level/edit');
        $view->level = $level;
        $this->view = $view;
    }

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

            $campaign = ORM::factory("Campaign", $update->campaign->id);
            $view = view::factory('controllers/admin/level/campaign');
            $view->campaign = $campaign;
            $this->view = $view;

//            $view = view::factory('controllers/admin/level/edit');
//            $view->level = $update;

            $response = array('view' => $view->render());
            echo json_encode($response);
        }
    }

    public function action_ajaxGetLevelsCampaign() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('campaign');
            $campaign = ORM::factory('Campaign', $id);
            if ($campaign->name) {
                $levels = $campaign->levels
                                ->where('level', '!=', 0)
                                ->order_by('level')
                                ->find_all()->as_array('level', 'name');

                $query = DB::query(Database::SELECT, 'SELECT COUNT(id) as count,level FROM employee '
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

}

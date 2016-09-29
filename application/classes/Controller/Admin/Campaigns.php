<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Campaigns extends Controller_Admin_Containers_Default {

    public function action_index() {
        $this->template->title = 'Campañas - Admin';
        $view = view::factory('controllers/admin/campaigns/index');
        $campaigns = ORM::factory('Campaign')
                ->where('status', '!=', 'DELETED')
                ->find_all();
        $view->campaigns = $campaigns;
        $this->view = $view;
    }

    public function action_view() {
        $campaign_id = strip_tags($this->request->query('id'));
        $campaign = ORM::factory('Campaign', $campaign_id);
        $this->template->title = $campaign->company->name . ' - Admin';
        $employees = $campaign->employees->find_all();
        $levels = $campaign->levels->find_all();

        $view = view::factory('controllers/admin/campaigns/view');
        $view->campaign = $campaign;
        $view->employees = $employees;
        $view->levels = $levels;
        $this->view = $view;
    }

    public function action_edit() {

        $this->auto_render = false;

        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $campaign = ORM::factory('Campaign', $id);
            $companies = $this->_getCompanies();
            $view = view::factory('controllers/admin/campaigns/edit');
            $view->campaign = $campaign;
            $view->companies = $companies;
            $status = "OK";
            $response = array('view' => $view->render(), 'status' => $status);
            echo json_encode($response);
        }
    }

    public function action_create() {

        if (!empty($_POST)) {

            $newCampaign = ORM::factory('Campaign');
            $newCampaign->company_id = strip_tags($this->request->post('company'));
            $newCampaign->name = strip_tags($this->request->post('name'));

            $start_date = strip_tags($this->request->post('start_date'));
            $start_date = DateTime::createFromFormat('d-m-Y', $start_date)->format('Y-m-d');
            $newCampaign->initial_date = $start_date;

            $end_date = strip_tags($this->request->post('end_date'));
            $end_date = DateTime::createFromFormat('d-m-Y', $end_date)->format('Y-m-d');
            $newCampaign->final_date = $end_date;

            $newCampaign->description = strip_tags($this->request->post('description'));

            $newCampaign->save();

            $settings = ORM::factory('CampaignSettings');
            $settings->campaign_id = $newCampaign->id;
            $settings->save();

            $this->redirect("admin/campaigns");
        } else {
            $this->template->title = 'Creación Campaña - Admin';
            $view = view::factory('controllers/admin/campaigns/create');
            $view->companies = $this->_getCompanies();
            $this->view = $view;
        }
    }

    public function action_delete() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $campaign = ORM::factory("Campaign", $id);
            if ((!empty($_POST)) && ($campaign->id)) {
                //$campaign->delete();
                $campaign->status = 'DELETED';
                $campaign->save();
                $view = view::factory('controllers/admin/campaigns/index');
                $campaigns = ORM::factory('Campaign')
                        ->where('status', '!=', 'DELETED')
                        ->find_all();
                $view->campaigns = $campaigns;
                $status = "DELETED";
                $response = array("view" => $view->render(), "status" => $status);
            } else {
                $view = view::factory('controllers/admin/campaigns/index');
                $campaigns = ORM::factory('Campaign')->find_all();
                $view->campaigns = $campaigns;
                $status = "NO_RECORD";
                $response = array("view" => $view->render(), "status" => $status);
            }
            echo json_encode($response);
        }
    }

    public function action_update() {

        $this->auto_render = false;

        if ($this->request->is_ajax()) {
            $id = $this->request->post('id');
            $company = $this->request->post('company');
            $name = $this->request->post('name');
            $start_date = strip_tags($this->request->post('start_date'));
            $start_date = DateTime::createFromFormat('d-m-Y', $start_date)->format('Y-m-d');

            $end_date = strip_tags($this->request->post('end_date'));
            $end_date = DateTime::createFromFormat('d-m-Y', $end_date)->format('Y-m-d');


            $campaign = ORM::factory('Campaign', $id);

            $campaign->company_id = $company;
            $campaign->name = $name;
            $campaign->initial_date = $start_date;
            $campaign->final_date = $end_date;
            $campaign->description = strip_tags($this->request->post('description'));
            $campaign->save();

            $view = view::factory('controllers/admin/campaigns/index');
            $campaigns = ORM::factory('Campaign')
                    ->where('status', '!=', 'DELETED')
                    ->find_all();
            $view->campaigns = $campaigns;

            $status = "OK";
            $response = array('view' => $view->render(), 'status' => $status);
            echo json_encode($response);
        }
    }

    private function _getCompanies() {
        $companies = ORM::factory("Company")
                ->where('status', '!=', 'DELETED')
                ->order_by('name')
                ->find_all();
        $result = array();
        foreach ($companies as $company) {
            $result[$company->id] = $company->name;
        }
        return $result;
    }

    public function action_ajaxGetGender() {

        $this->auto_render = false;

        if ($this->request->is_ajax()) {
            $genders = array("M" => "Masculino", "F" => "Femenino");
            $id = $this->request->post('campaign');
            $query = DB::query(Database::SELECT, 'SELECT COUNT(id) as count,gender FROM employee '
                            . 'WHERE campaign_id=' . $id . ' GROUP BY gender');
            $count = $query->execute()->as_array('gender', 'count');

            $result = array();


            foreach ($count as $gender => $gender_count) {
                array_push($result, array($genders[$gender], intval($gender_count)));
            }

            $response = array('data' => $result, 'count' => count($count));
            echo json_encode($response);
        }
    }

    public function action_ajaxChangeStatus() {
        $status_dic=array('NEW'=>'Nueva','IN_PROGRESS'=>'En Progreso','DONE'=>'Finalizada','DELETED'=>'Borrada');
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $id=$this->request->post('campaign');
            $status=$this->request->post('status');
            $c=ORM::factory('Campaign', $id);
            $questions=$c->questions->count_all();
            $employees=$c->employees->count_all();
            $accounts=ORM::factory('Users')->where('campaign_id', '=', $c->id)->count_all();
            
            if($questions==0){
                 $response=array('status'=>'QUESTIONS'); 
            }
            else if($accounts>=$employees){
                $c->status=$status;
            $c->save();   
            $response=array('status'=>'OK','new_status'=>$status_dic[$c->status]);
            }
            else{
              $response=array('status'=>'ACCOUNTS','employees'=>$employees,'accounts'=>$accounts);  
            }
             echo json_encode($response);  
            
        }
    }
    
     public function action_progress() {
         $id=  strip_tags($this->request->query('id'));
         $campaign=ORM::factory('Campaign', $id);
         $this->template->title = 'Progeso '.$campaign->company->name . ' - Admin';
         $view = view::factory('controllers/admin/campaigns/progress');
         $this->view=$view;
         
     }

}

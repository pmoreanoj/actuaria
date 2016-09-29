<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Email extends Controller_Admin_Containers_Default {

    public function action_ajaxResetPassword() {
        $this->auto_render = false;
        if ($this->request->is_ajax()) {
            $status="NOT_FOUND";
            $email = $this->request->post('email');
            $username = $this->request->post('username');
            $user = ORM::factory('User')
                    ->where('email', '=', $email)
                    ->and_where('username', '=', $username)
                    ->find();
            if ($user->id) {
                $subject = "Tu contraseña de Actuaria 360";
                $message = View::factory('controllers/admin/email/resetPassword');
                $message->user = $user;
                $message->user_hash=$this->_encryptNumber($user->id);
                $this->_sendEmail($email, $subject, $message->render());
                $status="FOUND";
            }
            
            $response=array('status'=>$status);
            echo json_encode($response);
                  
        }
    }

}

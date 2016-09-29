<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Containers_Default extends Controller_Template {

    public $template = 'containers/admin';
    public $view;

    /**
     * @see system/classes/kohana/controller/Kohana_Controller_Template::before()
     */
    public function before() {
        //Required because we are extending Controller_Template
        parent::before();

        if ($this->auto_render) {
            //Sets the "Default" title set on the container
            $this->template->title = 'Sector administrativo';
            $this->template->content = '';

            $this->template->styles = array();
            $this->template->scripts = array();
        }

        //Cleans the view so that every action can set it
        //by itself without problems
        $this->view = NULL;
    }

    /**
     * @see system/classes/kohana/controller/Kohana_Controller_Template::after()
     */
    public function after() {
        if ($this->auto_render) {
            $action = $this->request->action();
            $controller = $this->request->controller();

            $session = Session::instance();
            $user_id = $session->get('user');
            $user_type = $session->get('user_type');
            $user = ORM::factory('User', $user_id);

            if (($action != 'login') && ($controller != 'home')) {
                if (!isset($user_id)) {
                    if (($action != 'restorePassword') && ($controller != 'users')) {
                        $this->redirect('admin/home/login');
                    }
                    
                } else {
                    if ($user->status == "PASSWORD") {
                        if (($action != 'changePassword') && ($controller != 'users')) {
                            $this->redirect('admin/users/changePassword?p=' . $this->_encryptNumber($user_id));
                        }
                    }
                      else if ($user_type == "USER") {
                        $this->redirect('home');
                    }
                }
            }


            //Build the styles array
            $css_file = 'media/css/controllers/admin/' . $controller . '/' . $action . '.css';
            $styles = array(
                'media/style/template/bootstrap.css' => 'screen',
                'media/style/template/style.css' => 'screen',
                'media/style/template/style-responsive.css' => 'screen',
                'media/style/css/font-awesome/css/font-awesome.css' => 'screen',
                'media/style/css/template/theme.css' => 'screen',
                'media/style/switch/bootstrap-switch.min.css' => 'screen',
                'media/style/animate/animate.css' => 'screen',
                'media/style/jqueryui/jquery-ui.min.css' => 'screen'
            );

            //VALIDATING FILE
            if (file_exists($css_file)) {
                $styles = array_merge($styles, array($css_file => 'screen'));
            }

            //Build the scripts array
            $js_file = 'media/js/controllers/admin/' . $controller . '/' . $action . '.js';
            //echo $js_file;
            //DIE();
            $scripts = array(
                //'media/js/jquery/jquery-1.11.1.min.js',
                //'media/js/template/jquery.js',
                'media/js/template/bootstrap.min.js',
                'media/js/template/jquery-ui-1.9.2.custom.min.js',
                'media/js/template/jquery.ui.touch-punch.min.js',
                'media/js/template/jquery.nicescroll.js',
                'media/js/template/jquery.scrollTo.min.js',
                'media/js/switch/bootstrap-switch.min.js',
                'media/js/noty/jquery.noty.packaged.min.js',
                'media/js/noty/default.js',
                'https://www.google.com/jsapi',
                'media/js/template/common-scripts.js',
                'media/js/charts/chart.min.js',
                'media/js/charts/Chart.js',
                'media/js/charts/Chart.Radar.js',
                'highcharts-all.js'
            );

            //VALIDATING FILE
            if (file_exists($js_file)) {
                $scripts = array_merge($scripts, array($js_file));
            }

            //Set styles and scripts on the template (container). This can also be
            //done from any action method
            $this->template->styles = array_merge($styles, $this->template->styles);
            $this->template->scripts = array_merge($scripts, $this->template->scripts);




            //If $this->view is set display it on the
            //containers $content
            $this->template->content = $this->view;
        }

        //Required because we are extending Controller_Template
        parent::after();
    }

    public function _sendEmail($to, $subject, $message) {
        $headers = 'From: actuaria360@panda-corp.com' . "\r\n" .
                'Reply-To: actuaria360@panda-corp.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion() . "\r\n" .
                'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
                'MIME-Version: 1.0' . "\r\n\r\n";

        mail($to, $subject, $message, $headers);
    }

    public function _encryptNumber($text) {
        $const = 6996;
        $hashids = new Hashids('this is my salt');
        $hash = $hashids->encrypt($const, $text);

        return $hash;
    }

    public function _decryptNumber($text) {
        $hashids = new Hashids('this is my salt');

        $result = $hashids->decrypt($text);
        //echo Debug::vars($result);
        //die();
        return $result[1];
    }

}

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keyword" content="">

        <link  href="<?php echo URL::site('/media/images/useful/favicon.ico') ?>" rel="shortcut icon">
        <title><?php echo $title ?> - Actuaria 360</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php
        foreach ($styles as $file => $type)
            echo HTML::style($file, array('media' => $type)), PHP_EOL
            ?>
        <script type="text/javascript" src="<?php echo URL::site(); ?>media/js/jquery/jquery-1.11.1.min.js"></script>
    </head>

    <script type="text/javascript">
        var document_root = '<?php echo URL::site(); ?>';
    </script>

    <script class="include" type="text/javascript" src="<?php echo URL::site(); ?>media/js/template/jquery.dcjqaccordion.2.7.js"></script>
    <body>
        <?php
        $session = Session::instance();
        $user = $session->get('user');
        $name = $session->get('user_name');
        
        $employee = ORM::factory('Employee', $user);
        ?>
        <section id="container" >
            <!-- **********************************************************************************************************************************************************
            TOP BAR CONTENT & NOTIFICATIONS
            *********************************************************************************************************************************************************** -->
            <!--header start-->
            <header class="header black-bg">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
                </div>
                <!--logo start-->
                <!--
                <a href="index.html" class="logo"><b>Actuaria 360</b></a>
                -->
                <a href="<?php echo URL::site('/home') ?>" class="logo">
                    <b>
                        <?php echo HTML::image('media/images/useful/logo.png', array('id' => 'logo-main')) ?>
                        &nbsp;
                    </b>
                </a>
                <!--logo end-->
                <div class="nav notify-row" id="top_menu">
                    <!--  notification start -->
                    <ul class="nav top-menu">
                        <!-- settings start -->
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                                <i class="fa fa-tasks"></i>
                                <span class="badge bg-theme">4</span>
                            </a>
                            <ul class="dropdown-menu extended tasks-bar">
                                <div class="notify-arrow notify-arrow-green"></div>
                                <li>
                                    <p class="green">Tienes 1 tarea(s) pendiente(s)</p>
                                </li>
                                <li>
                                    <a href="index.html#">
                                        <div class="task-info">
                                            <div class="desc">Evaluación 1</div>
                                            <div class="percent">40%</div>
                                        </div>
                                        <div class="progress progress-striped">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li class="external">
                                    <a href="#">Ver todas las notificaciones</a>
                                </li>
                            </ul>
                        </li>
                        <!-- settings end -->
                        <!-- inbox dropdown start-->
                        <li id="header_inbox_bar" class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-theme">5</span>
                            </a>
                            <ul class="dropdown-menu extended inbox">
                                <div class="notify-arrow notify-arrow-green"></div>
                                <li>
                                    <p class="green">Tienes 1 nuevo(s) mensaje(s)</p>
                                </li>
                                <li>
                                    <a href="<?php echo URL::site('/home') ?>">
                                        <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                        <span class="subject">
                                            <span class="from">Marcelo Morales</span>
                                            <span class="time">Just now</span>
                                        </span>
                                        <span class="message">
                                            Hola, ¿como va todo?
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo URL::site('/home') ?>">Ver todos los mensajes.</a>
                                </li>
                            </ul>
                        </li>
                        <!-- inbox dropdown end -->
                    </ul>
                    <!--  notification end -->
                </div>
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li>
                            <?php
                            if (isset($user)):
                                ?>
                                <a class="logout" href="<?php echo URL::site('home/logout') ?>">
                                    Logout
                                </a>
                            <?php else: ?>
                                <a class="logout" href="<?php echo URL::site('home/login') ?>">
                                    Login
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </header>
            <!--header end-->

            <!-- **********************************************************************************************************************************************************
            MAIN SIDEBAR MENU
            *********************************************************************************************************************************************************** -->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion">
                        <hr>
                        <?php
                        if ($employee->image != NULL) {
                            ?>
                            <p class="centered"><a href="<?php echo URL::site('/home') ?>">
                                    <?php echo HTML::image($employee->image, array('witdh' => '50', 'height' => '50', 'alt' => '', 'class' => 'img-circle')) ?></a></p>
                                    
                                    <h5 class="centered"><?php echo $name; ?></h5>
                         <?php   
                        }
                        else{
                            ?>
                            <p class="centered"><a href="<?php echo URL::site('/home') ?>">
                                <?php echo HTML::image('media/images/icons/contact_light.png', array('witdh' => '50', 'height' => '50', 'alt' => '', 'class' => 'img-circle')) ?></a></p>
                            <h5 class="centered"><?php echo $name; ?></h5>
                            <?php
                        }
                        ?>


                        <li class="mt">
                            <a href="<?php echo URL::site('/profile/profile?id=' . $user . '  ') ?>" >
                                <div class="side-bar-icon">
                                    <i class="fa fa-dashboard"></i>
                                </div>

                                <div class="side-bar-text">Perfil</div>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="<?php echo URL::site('/assignations/assignations?employee=' . $user . ' ') ?>" >
                                <div class="side-bar-icon">
                                    <i class="fa fa-desktop"></i>
                                </div>
                                <div class="side-bar-text">Evaluaciones</div>
                            </a>

                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;" >
                                <div class="side-bar-icon">
                                    <i class=" fa fa-bar-chart-o"></i>
                                </div>
                                <div class="side-bar-text">Reportes</div>
                            </a>
                        </li>
                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->

            <!-- **********************************************************************************************************************************************************
            MAIN CONTENT
            *********************************************************************************************************************************************************** -->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper site-min-height">
                    <div class="row mt">
                        <div class="col-lg-12">
                            <?php echo $content ?>
                        </div>
                    </div>

                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2015 - Actuaria 360
                    <a href="#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>

        <script>
            //custom select box
            /*
             $(function() {
             $('select.styled').customSelect();
             });
             */
        </script>
        <!--Loading scripts after from template recommendation -->
        <?php
        foreach ($scripts as $file)
            echo HTML::script($file), PHP_EOL
            ?>
    </body>
</html>


<html>

    <head>
        <meta charset="utf-8">
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
        <?php
        //foreach ($scripts as $file)
        //  echo HTML::script($file), PHP_EOL
        ?>
        <script type="text/javascript" src="<?php echo Url::site(); ?>media/js/jquery/jquery-1.11.1.min.js"></script>
    </head>

    <script type="text/javascript">
        var document_root = '<?php echo Url::site(); ?>';
    </script>

    <script class="include" type="text/javascript" src="<?php echo Url::site(); ?>media/js/template/jquery.dcjqaccordion.2.7.js"></script>
    <body>



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
                <a href="<?php echo URL::site('admin') ?>" class="logo">

                    <b>
                        <?php echo HTML::image('media/images/useful/logo.png', array('id' => 'logo-main')) ?>
                        &nbsp;
                    </b>  
                </a>
                <!--logo end-->
                <?php
                $session = Session::instance();
                $user = $session->get('user');
                $name = $session->get('user_name');
                if (isset($user)):
                    ?>
                    <!--
                        <div class="nav notify-row" id="top_menu">
                            
                            <ul class="nav top-menu">
                             
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                                        <i class="fa fa-tasks"></i>
                                        <span class="badge bg-theme">4</span>
                                    </a>
                                    <ul class="dropdown-menu extended tasks-bar">
                                        <div class="notify-arrow notify-arrow-green"></div>
                                        <li>
                                            <p class="green">You have 4 pending tasks</p>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <div class="task-info">
                                                    <div class="desc">DashGum Admin Panel</div>
                                                    <div class="percent">40%</div>
                                                </div>
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                        <span class="sr-only">40% Complete (success)</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <div class="task-info">
                                                    <div class="desc">Database Update</div>
                                                    <div class="percent">60%</div>
                                                </div>
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                        <span class="sr-only">60% Complete (warning)</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <div class="task-info">
                                                    <div class="desc">Product Development</div>
                                                    <div class="percent">80%</div>
                                                </div>
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <div class="task-info">
                                                    <div class="desc">Payments Sent</div>
                                                    <div class="percent">70%</div>
                                                </div>
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                                        <span class="sr-only">70% Complete (Important)</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="external">
                                            <a href="#">See All Tasks</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                <li id="header_inbox_bar" class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-theme">5</span>
                                    </a>
                                    <ul class="dropdown-menu extended inbox">
                                        <div class="notify-arrow notify-arrow-green"></div>
                                        <li>
                                            <p class="green">You have 5 new messages</p>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                                <span class="subject">
                                                    <span class="from">Zac Snider</span>
                                                    <span class="time">Just now</span>
                                                </span>
                                                <span class="message">
                                                    Hi mate, how is everything?
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <span class="photo"><img alt="avatar" src="assets/img/ui-divya.jpg"></span>
                                                <span class="subject">
                                                    <span class="from">Divya Manian</span>
                                                    <span class="time">40 mins.</span>
                                                </span>
                                                <span class="message">
                                                    Hi, I need your help with this.
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <span class="photo"><img alt="avatar" src="assets/img/ui-danro.jpg"></span>
                                                <span class="subject">
                                                    <span class="from">Dan Rogers</span>
                                                    <span class="time">2 hrs.</span>
                                                </span>
                                                <span class="message">
                                                    Love your new Dashboard.
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html#">
                                                <span class="photo"><img alt="avatar" src="assets/img/ui-sherman.jpg"></span>
                                                <span class="subject">
                                                    <span class="from">Dj Sherman</span>
                                                    <span class="time">4 hrs.</span>
                                                </span>
                                                <span class="message">
                                                    Please, answer asap.
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="index.html#">See all messages</a>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                           
                        </div>
                    -->
                <?php endif; ?>
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li>
                            <?php
                            if (isset($user)):
                                ?>
                                <a class="logout" href="<?php echo URL::site('admin/home/logout') ?>">
                                    Logout
                                </a>
                            <?php else: ?>
                                <a class="logout" href="<?php echo URL::site('admin/home/login') ?>">
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
                        <?php
                        //$session = Session::instance();
                        //$user = $session->get('user');
                        if (isset($user)):
                            ?>
                            <p class="centered"><a href="#"><img src="<?php echo URL::site('/media/images/icons/ui-sam.jpg') ?>" class="img-circle" width="60"></a></p>
                            <h5 class="centered"><?php echo $name ?></h5>

                            <li class="mt">
                                <a href="<?php echo URL::site('admin/Company') ?>">
                                    <div class="side-bar-icon">
                                        <i class="fa fa-building"></i>
                                    </div>
                                    <div class="side-bar-text">
                                        Empresas
                                    </div>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo URL::site('admin/Campaigns') ?>">
                                    <div class="side-bar-icon">
                                        <i class="fa fa-terminal"></i>
                                    </div>
                                    <div class="side-bar-text">
                                        Campa&ntilde;as
                                    </div>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo URL::site('admin/Users') ?>">
                                    <div class="side-bar-icon">
                                        <i class="fa fa-male"></i>
                                    </div>
                                    <div class="side-bar-text">Usuarios</div>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo URL::site('admin/Question') ?>">
                                    <div class="side-bar-icon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="side-bar-text">Preguntas</div>
                                </a>
                            </li> 
                            <!--
                            <li class="sub-menu">
                                <a href="javascript:;" >
                                    <div class="side-bar-icon">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="side-bar-text">Preguntas</div>
                                </a>
                                <ul class="sub">
                                    <li><a  href="<?php echo URL::site('admin/Question') ?>">General</a></li>
                                    <li><a  href="<?php echo URL::site('admin/Questiontype') ?>">Tipos</a></li>
                                    <li><a  href="#">Campa&ntilde;as</a></li>
                                </ul>
                            </li>
                            -->
                        </ul>
                    <?php endif; ?>
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
                        <div class="col-lg-12" id="dyn_content">
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
                    <a href="blank.html#" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>
        <?php
        foreach ($scripts as $file)
            echo HTML::script($file), PHP_EOL
            ?>
    </body>


</div>

</body>

</html>


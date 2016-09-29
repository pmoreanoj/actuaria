<html>
    <head>
        <meta charset="utf-8">
        <link  href="/media/images/useful/favicon.ico" rel="shortcut icon">
        <title><?php echo $title ?> - Research</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php
        foreach ($styles as $file => $type)
            echo HTML::style($file, array('media' => $type)), PHP_EOL
            ?>
        <?php
        foreach ($scripts as $file)
            echo HTML::script($file), PHP_EOL
            ?>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    </head>

    <script type="text/javascript">
        var document_root = '<?php echo Url::site(); ?>';
    </script>


    <body>
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

        <div class="off-canvas-wrap" data-offcanvas>
            <div class="inner-wrap">
                <nav class="tab-bar">
                    <section class="left-small">
                        <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
                    </section>

                    <section class="middle tab-bar-section">
                        <h1 class="title">Telemedicina</h1>
                    </section>

                    <section class="right-small">
                        <a class="right-off-canvas-toggle menu-icon" href="#"><span></span></a>
                    </section>
                </nav>

                <aside class="left-off-canvas-menu">
                    <ul class="off-canvas-list">
                        <li><label>Menu</label></li>

                    </ul>
                </aside>

                <aside class="right-off-canvas-menu">
                    <ul class="off-canvas-list">
                        <li><label>Users</label></li>

                    </ul>
                </aside>

                <section>
                    <div class="main-content">
                        <?php echo $content ?>
                    </div>

                </section>

                <a class="exit-off-canvas"></a>

            </div>
        </div>

        <div class="row footer ">
            <ul class="inline-list right">
                <li>Developed by David Villacis</li>
            </ul>
        </div>
        <script>
            $(document).foundation();
        </script>  
    </body>

</html>


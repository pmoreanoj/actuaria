<div>
    <h3>Preguntas</h3>


    <div class="row mt">

        <div class="col-md-4 col-sm-4 mb">
            <div class="white-panel pn">
                <div class="white-header">
                    <h5>Preguntas</h5>
                </div>

                <div class="row">
                    <a href="<?php echo URL::site('admin/question/view') ?>">
                        <h2><?php echo count($questions) ?></h2>
                    </a>
                </div>
            </div><! --/grey-panel -->
        </div><!-- /col-md-4-->
        <div class="col-md-4 col-sm-4 mb">
            <div class="white-panel pn">
                <div class="white-header">
                    <h5>Tipos de Preguntas</h5>
                </div>
                <div class="row ">
                    <a href="<?php echo URL::site('admin/questiontype') ?>">

                        <h2><?php echo $question_types ?></h2>
                    </a>
                </div>

            </div><! -- /darkblue panel -->
        </div><!-- /col-md-4 -->

        <div class="col-md-4 col-sm-4 mb">
            <div class="white-panel pn">
                <div class="white-header">
                    <h5>Agregar Pregunta</h5>
                </div>
                <a href="<?php echo URL::site('admin/question/create') ?>">
                    <h1 class="fa fa-plus"></h1>
                </a>
            </div>
        </div><! --/col-md-4 -->




    </div>

    <div class="row mt">
        <div class="col-md-4 col-sm-4 mb">
            <div class="white-panel pn">
                <div class="white-header">
                    <h5>Subir Preguntas</h5>
                </div>
                <div class="row ">
                    <a href="<?php echo URL::site('admin/question/uploadcsv') ?>">

                        <h2 class="fa fa-arrow-up"></h2>
                    </a>
                </div>
            </div><! -- /darkblue panel -->
        </div><!-- /col-md-4 -->
    </div>



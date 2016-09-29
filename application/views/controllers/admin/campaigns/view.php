
<?php $status_dic = array('NEW' => 'Nueva', 'IN_PROGRESS' => 'En Progreso', 'DONE' => 'Finalizada', 'DELETED' => 'Borrada'); ?>
<div id="top-panel" class="content-panel">
    <div class="row white-header"> <div class="row col-md-12 text-center">
            <h3><?php echo $campaign->name . ' - ' . $campaign->company->name ?></h3>
        </div></div>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">

            <div class="row col-md-12" style="font-size: 18px">
                <?php echo Form::hidden('id', $campaign->id, array('id' => 'campaign')) ?>
                <p>
                    Inicio:
                    <?php
                    $initial_date = new DateTime($campaign->initial_date);
                    $initial_date = $initial_date->format('d-m-Y');
                    echo $initial_date;
                    ?>
                </p>
                <p>
                    Fin:
                    <?php
                    $final_date = new DateTime($campaign->final_date);
                    $final_date = $final_date->format('d-m-Y');
                    echo $final_date;
                    ?>
                </p>
                <p>
                    Estado de la campa&ntilde;a: <span id="c-status"><?php echo $status_dic[$campaign->status] ?></span>
                </p>

                <p>
                    <a href='<?php echo URL::site('admin/reports') . "?id=" . $campaign->id ?>'>Reportes</a>
                </p>
            </div>
        </div>
        <?php if ($campaign->company->logo): ?>
            <div class="col-md-5 text-right">
                <?php echo HTML::image($campaign->company->logo, array('style' => 'max-width:50%;max-height:40%')); ?>
            </div>
        <?php endif; ?>  
    </div> 
    <div class="row text-center" style="font-size: 18px">
        <a  class="c-play" href="#">
            <i class="fa fa-play"></i>&nbsp;&nbsp;Iniciar
        </a>
        <a  class="c-stop" href="#">
            <i class="fa fa-stop"></i>&nbsp;&nbsp;Detener
        </a>
    </div>
    <div class="row">


    </div>
</div>

<div>


</div>


<div class="row mt">
    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Empleados</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/employee/index') . '?id=' . $campaign->id ?>">
                    <div id="gender_chart"></div>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->


    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>

                    Niveles

                </h5>
            </div>

            <div class="row data">
                <a href="<?php echo URL::site('admin/levels/campaign') . '?id=' . $campaign->id ?>">
                    <div id="levels_chart"></div>
                </a>
            </div>



        </div><! -- /darkblue panel -->
    </div><!-- /col-md-4 -->

    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>

                    Areas

                </h5>
            </div>
            <a href="<?php echo URL::site('admin/areas/campaign') . '?id=' . $campaign->id ?>">    
                <div id="areas_chart" ></div>
            </a> 

        </div>
    </div><! --/col-md-4 -->

</div>

<div class="row mt">
    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Progreso</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/campaigns/progress').'?id='.$campaign->id ?>">
                   <div id="progress_chart"></div>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->
    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>

                    Preguntas

                </h5>
            </div>

            <a href="<?php echo URL::site('admin/question/campaign') . '?id=' . $campaign->id ?>">          
                <div id="questions_chart" ></div>
            </a>

        </div>
    </div><! --/col-md-4 -->
    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Configuraciones</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/campaignsettings/index') . '?id=' . $campaign->id ?>">
                    <h2 class="fa fa-gear"></h2>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->
</div>


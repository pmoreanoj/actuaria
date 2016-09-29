<div class="content-panel">
    <div class="row">
        <div class="col-md-6">
            <h3><?php echo $campaign->name ?></h3>
            <input type="hidden" id="campaign" value="<?php echo $campaign->id ?>">
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" style="text-align: center">
            <div class="row">
                Evaluator
            </div>
            <div class="row">
                <?php echo Form::select('levels_evaluator', $levels, NULL, array('class' => 'levels_selection levels_evaluator', 'type' => 'EVALUATOR')) ?>
            </div>
            <div class="row">
                <?php echo Form::select('areas_evaluator', $areas, NULL, array('class' => 'areas_selection select areas_evaluator', 'type' => 'EVALUATOR')) ?>

            </div>
            <div class="row" id="evaluator"></div>
        </div>
        <div class="col-md-6" style="text-align: center">
            <div class="row">
                Evaluated
            </div>
            <div class="row">
                <?php echo Form::select('levels_evaluated', $levels, NULL, array('class' => 'levels_selection levels_evaluated', 'type' => 'EVALUATED')) ?>
            </div>
             <div class="row">
                <?php echo Form::select('areas_evaluated', $areas, NULL, array('class' => 'areas_selection select areas_evaluated', 'type' => 'EVALUATED')) ?>

            </div>
            <div class="row" id="evaluated" style="text-align: center"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center">
            <?php echo Form::submit('sbt', 'Asignar', array('id' => 'sbt_assignation')) ?>
        </div>
    </div>
</div>
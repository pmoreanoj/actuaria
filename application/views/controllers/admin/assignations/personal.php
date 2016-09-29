<div class="content-panel">
    <div class="row">
        <div class="col-md-2">
            Nombre:
        </div>
        <div class="col-md-6">
            <?php echo $employee->name ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Cargo:
        </div>
        <div class="col-md-6">
            <?php echo $employee->position ?>
        </div>
    </div>
     <div class="row">
        <div class="col-md-2">
            Area:
        </div>
        <div class="col-md-6">
            <?php echo $employee->area ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Nivel:
        </div>
        <div class="col-md-6">
            <?php echo $level->name ?>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-12">
            Evaluando
        </div>
        <?php echo Form::hidden('campaign', $employee->campaign->id, array('id' => 'campaign')) ?>
        <?php echo Form::hidden('employee', $employee->id, array('id' => 'employee')) ?>
        <div class="col-md-12">
            <table>
                <?php foreach ($employee->evaluator->find_all() as $e): ?>
                    <tr>
                        <td><?php echo $e->evaluated->name ?> - <?php
                            $level = ORM::factory('Level')
                                            ->where('campaign_id', '=', $e->evaluated->campaign)
                                            ->and_where('level', '=', $e->evaluated->level)->find();
                            echo $level->name;
                            ?>
                            <i assignation='<?php echo $e->id ?>' class="fa fa-times delete_assignation" style="color:red;margin-left: 0.3em; cursor:pointer"></i></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            Evaluado
        </div>
        <div class="col-md-12">
            <table>
                <?php foreach ($employee->evaluated->find_all() as $e): ?>
                    <tr>
                        <td><?php echo $e->evaluator->name ?> - <?php
                            $level = ORM::factory('Level')
                                            ->where('campaign_id', '=', $e->evaluator->campaign)
                                            ->and_where('level', '=', $e->evaluator->level)->find();
                            echo $level->name;
                            ?>
                            <i assignation='<?php echo $e->id ?>' class="fa fa-times delete_assignation" style="color:red;margin-left: 0.3em; cursor:pointer"></i></td>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            Agregar asignacion
        </div>
    </div>
    <div class="row">    
        <div class="col-md-12">
            <?php echo Form::select('levels_evaluator', $levels, NULL, array('class' => 'levels_selection select', 'type' => 'EVALUATED')) ?>
        </div>
    </div>
     <div class="row">    
        <div class="col-md-12">
            <?php echo Form::select('areas_evaluator', $areas, NULL, array('class' => 'areas_selection select', 'type' => 'EVALUATED')) ?>
        </div>
    </div>
    <div class="row">   
        <div class="col-md-4">
            <?php echo Form::select('type', $types, NULL, array('id' => 'types')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row" id="employees" style="text-align: center"></div>
        </div>
        <div class="row">
            <div class="col-md-12" style="text-align: center">
                <?php echo Form::submit('sbt', 'Asignar', array('id' => 'sbt_assignation')) ?>
            </div>
        </div>
    </div>

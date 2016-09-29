<?php echo Form::hidden('id', $level->id, array('id'=>'id'))?>
<div class="form-panel form-horizontal style-form">
    <h3><?php echo $level->name?> - <?php echo $level->campaign->name?> - <?php echo $level->campaign->company->name?></h3>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10"><?php echo Form::input('name', $level->name, array('id' => 'name', 'class' => 'form-control')) ?></div>
    </div>
     <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Level</label>
        <div class="col-sm-10"><?php echo Form::input('level', $level->level, array('id' => 'level', 'class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <?php echo Form::button('button_update', 'Guardar', array('id'=>'button_update'))?>
        </div>
    </div>
</div>
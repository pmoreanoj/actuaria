<?php echo Form::hidden('id', $settings->id, array('id'=>'id'))?>
<div class="form-panel">
    <div class="form-group">
        <div class="col-md-12">
            <h4>Configuraci&oacute;n - <?php echo $campaign->name ?> - <?php echo $campaign->company->name ?></h4>
        </div>
    </div>
    <hr></hr> 
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Nivel Superior</label>
        <div class="col-sm-10"><?php echo Form::input('upper_level', $settings->upper_level, array('id' => 'upper_level', 'class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Mismo nivel</label>
        <div class="col-sm-10"><?php echo Form::input('same_level', $settings->same_level, array('id' => 'same_level', 'class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Nivel inferior</label>
        <div class="col-sm-10"><?php echo Form::input('lower_level', $settings->lower_level, array('id' => 'lower_level', 'class' => 'form-control')) ?></div>
    </div>
    
    <hr></hr> 
    <div class="form-group">
        <div class="col-md-12">
            <h4>Ponderaciones por nivel</h4>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Nivel Superior</label>
        <div class="col-sm-10"><?php echo Form::input('upper_level_weight', $settings->upper_level_weight, array('id' => 'upper_level_weight', 'class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Mismo nivel</label>
        <div class="col-sm-10"><?php echo Form::input('same_level_weight', $settings->same_level_weight, array('id' => 'same_level_weight', 'class' => 'form-control')) ?></div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Nivel inferior</label>
        <div class="col-sm-10"><?php echo Form::input('lower_level_weight', $settings->lower_level_weight, array('id' => 'lower_level_weight', 'class' => 'form-control')) ?></div>
    </div>
    
    <div class="form-group">
        <?php echo Form::button('button_save', 'Guardar', array('id'=>'button_save'))?>
    </div>
</div>

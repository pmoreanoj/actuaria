<?php echo Form::hidden('id', $area->id, array('id'=>'id'))?>
<div class="form-panel form-horizontal style-form">
    <h3><?php echo $area->name?> - <?php echo $area->campaign->name?> - <?php echo $area->campaign->company->name?></h3>
    <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
        <div class="col-sm-10"><?php echo Form::input('name', $area->name, array('id' => 'name', 'class' => 'form-control')) ?></div>
    </div>
     <div class="form-group">
         <label class="col-sm-2 col-sm-2 control-label">Descripci&oacute;n</label>
        <div class="col-sm-10">
            <?php echo Form::textarea('description', $area->description, array("id"=>"description"))?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <?php echo Form::button('button_update', 'Guardar', array('id'=>'button_update'))?>
        </div>
    </div>
</div>
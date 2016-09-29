<form method="POST">
    <?php echo Form::hidden('campaign', $campaign->id, array('id' => 'campaign')) ?>
    <div class="form-panel form-horizontal style-form">
        <h3>Agregar Empleado</h3>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Identificador</label>
            <div class="col-sm-10"><?php echo Form::input('identificator', NULL, array('id' => 'identificator', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10"><?php echo Form::input('name', NULL, array('id' => 'name', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">G&eacute;nero</label>
            <div class="col-sm-10">
                <?php //echo Form::input('genre', NULL, array('id' => 'genre', 'class' => 'form-control')) ?>
                <?php echo Form::select('gender', array('M'=>'Masculino','F'=>'Femenino'), NULL, array('id' => 'gender', 'class' => 'form-control'))?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nivel</label>
            <div class="col-sm-10">    
                <?php echo Form::select('level', $levels, NULL, array('id' => 'level', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Area</label>
            <div class="col-sm-10">    
                <?php echo Form::select('area', $areas, NULL, array('id' => 'area', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Posici&oacute;n</label>
            <div class="col-sm-10"><?php echo Form::input('position', NULL, array('id' => 'position', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email</label>
            <div class="col-sm-10"><?php echo Form::input('email', NULL, array('id' => 'email', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Edad</label>
            <div class="col-sm-10"><?php echo Form::input('age', NULL, array('id' => 'age', 'class' => 'form-control')) ?></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Ingreso</label>
            <div class="col-sm-10"><?php echo Form::input('income', NULL, array('id' => 'income', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <?php echo Form::button('button_create', 'Guardar', array('id' => 'button_create', 'class' => 'btn btn-primary')) ?>
            </div>
        </div>
    </div>
</form>
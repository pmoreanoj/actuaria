<div class="form-panel">
    <h4 class="mb"><i class="fa fa-angle-right"></i>Editar Empleado</h4>
    

    <form class="form-horizontal style-form" method="post">
        <?php echo Form::hidden('employee', $employee->id, array('id' => 'employee')) ?>
        <?php echo Form::hidden('campaign', $employee->campaign_id, array('id' => 'campaign')) ?>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">C&eacute;dula</label>
            <div class="col-sm-10"><?php echo Form::input('identificator', $employee->identificator, array("id" => "identificator", 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10"><?php echo Form::input('name', $employee->name, array("id" => "name", 'class' => 'form-control')) ?></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">G&eacute;nero</label>
            <div class="col-sm-10">
                <?php // echo Form::input('gender', $employee->gender, array("id" => "gender", 'class' => 'form-control')) ?>
                <?php echo Form::select('gender', array('M'=>'Masculino','F'=>'Femenino'), $employee->gender, array('id' => 'gender', 'class' => 'form-control'))?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nivel</label>
            <div class="col-sm-10">
                <?php //echo Form::input('level', $employee->level, array("id" => "level", 'class' => 'form-control')) ?>
                <?php echo Form::select('level', $levels, $employee->level, array('id' => 'level', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Area</label>
            <div class="col-sm-10">
                <?php //echo Form::input('area', $employee->area, array("id" => "area", 'class' => 'form-control')) ?>
                <?php echo Form::select('area', $areas, $employee->area, array('id' => 'area', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Cargo</label>
            <div class="col-sm-10">
                <?php echo Form::input('position', $employee->position, array("id" => "position", 'class' => 'form-control')) ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <?php echo Form::input('email', $employee->email, array("id" => "email", 'class' => 'form-control')) ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Edad</label>
            <div class="col-sm-10">
                <?php echo Form::input('age', $employee->age, array("id" => "age", 'class' => 'form-control')) ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Ingreso</label>
            <div class="col-sm-10">
                <?php echo Form::input('income', $employee->income, array("id" => "income", 'class' => 'form-control')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Imagen</label>
            <div class="col-sm-10">
                <?php echo Form::file('file', array("id" => "file", 'class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-1 col-md-1">
                <button class="update_employee btn btn-primary" name="<?php echo $employee->name ?>" id="<?php echo $employee->id ?>" >Guardar</button>
            </div>

            <div class="col-lg-1 col-md-1">
                <button class="delete_employee btn btn-danger" employee="<?php echo $employee->id?>" name="<?php echo $employee->name ?>" id="<?php echo $employee->id ?>"  >Borrar</button>
            </div>
        </div>
    </form>
</div>

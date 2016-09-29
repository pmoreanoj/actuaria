<div class="content-panel">
    <?php echo Form::hidden('id', $employee->id, array('id' => 'id')) ?>
    <div class="form-panel form-horizontal style-form">
        <div class="centered center-block">
            <h2>Actuaria 360 - Perfil</h2>
        </div>
        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>

        <div class="col-md-4 center-block centered"></div>
        <div id="logo-container">
            <?php echo $file ?>
        </div>
        <?php echo Form::hidden('file', NULL, array('id' => 'file')) ?>
        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10"><?php echo Form::input('name', $employee->name, array('id' => 'name', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email</label>
            <div class="col-sm-10"><?php echo Form::input('email', $employee->email, array('id' => 'email', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Edad</label>
            <div class="col-sm-10"><?php echo Form::input('edad', $employee->age, array('id' => 'age', 'class' => 'form-control')) ?></div>
        </div>
        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>
        <div class="form-group">
            <div class="col-sm-1">
                <a href="<?php echo URL::site('/profile/profile?id=' . $employee->id) ?>" >
                    <?php echo Form::button('button_update', 'Volver', array('class' => 'btn btn-warning')) ?>
                </a>
            </div>
            <div class="text-right col-md-11">
                <?php echo Form::button('button_update', 'Guardar', array('id' => 'button_update', 'class' => 'btn btn-success')) ?>
            </div>
        </div>
    </div>
</div>
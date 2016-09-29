<div class="form-panel">
    <h4 class="mb"><i class="fa fa-angle-right"></i>Crear un nuevo Usuario</h4>
    <form class="form-horizontal style-form" method="post">
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <?php echo Form::input('name', NULL, array('id' => 'name', 'class' => 'span3 form-control', 'placeholder' => 'Nombre. Ej: Juan Pablo', 'size' => '30', 'style' => 'height: 31')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre de Usuario:</label>
            <div class="col-sm-10">
                <?php echo Form::input('username', NULL, array('id' => 'username', 'class' => 'span3 form-control', 'placeholder' => 'Nombre del usuario. Ej: pablo1', 'size' => '30', 'style' => 'height: 31')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Contraseña:</label>
            <div class="col-sm-10">
                <?php echo Form::password('password', NULL, array('id' => 'password', 'class' => 'span3 form-control', 'placeholder' => 'Mínimo 8 caracteres', 'size' => '20', 'style' => 'height: 31')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Correo electr&oacute;nico</label>
            <div class="col-sm-10">
                <?php echo Form::input('email', NULL, array('id' => 'email', 'class' => 'span3 form-control', 'placeholder' => 'correo', 'size' => '20', 'style' => 'height: 31')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Tipo de usuario:</label>
            <div class="col-sm-10">
                <?php //echo Form::input('type', NULL, array('id' => 'type', 'class' => 'span3 form-control', 'placeholder' => 'Ej: admin/user', 'size' => '20', 'style' => 'height: 31')) ?>
                <?php echo Form::select('type', $user_types, NULL, array("id" => "type")); ?>
            </div>
        </div>

        <div id="extra_type" class="form-group">
           
        </div>
        <div class="form-group">
            <div class="col-lg-12 col-md-12">
                <?php echo Form::submit('sbt', "Crear Usuario", array("id" => "sbt", "class" => "btn btn-info")) ?>
            </div>
        </div>

    </form>
</div>

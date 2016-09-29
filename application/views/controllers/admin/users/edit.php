<div class="form-panel">
    <h4 class="mb"><i class="fa fa-angle-right"></i>Editar <?php echo $user->username?></h4>
    <form class="form-horizontal style-form" method="post">
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-10">
                <?php echo Form::input('name', $user->name, array('id' => 'name', 'class' => 'span3 form-control', 'placeholder' => 'Nombre Ej: Juan Pablo', 'size' => '30', 'style' => 'height: 31')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre de Usuario:</label>
            <div class="col-sm-10">
                <?php echo Form::hidden('id', $user->id, array("id"=>"id"))?>
                <?php echo Form::input('username', $user->username, array('id' => 'username', 'class' => 'span3 form-control', 'placeholder' => 'Nombre del usuario. Ej: pablo1', 'size' => '30', 'style' => 'height: 31')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Contraseña:</label>
            <div class="col-sm-10">
                <?php echo Form::password('password', $user->password, array('id' => 'password', 'class' => 'span3 form-control', 'placeholder' => 'Mínimo 8 caracteres', 'size' => '20', 'style' => 'height: 31')) ?>
            </div>
        </div>
         <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Contraseña:</label>
            <div class="col-sm-10">
                <?php echo Form::input('email', $user->email, array('id' => 'email', 'class' => 'span3 form-control', 'placeholder' => 'Mínimo 8 caracteres', 'size' => '20', 'style' => 'height: 31')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Tipo de usuario::</label>
            <div class="col-sm-10">
                <?php //echo Form::input('type', NULL, array('id' => 'type', 'class' => 'span3 form-control', 'placeholder' => 'Ej: admin/user', 'size' => '20', 'style' => 'height: 31')) ?>
            <?php echo Form::select('type', $user_types, $user->type,array("id"=>"type"));?>
            </div>
        </div>
        <div id="extra_type" class="form-group">
           
        </div>
        <div class="form-group">
            <div class="col-md-2">
                <button class="update_user btn btn-info" name="<?php echo $user->username?>" id="<?php echo $user->id ?>" >Guardar</button>
            </div>
            <div class="col-md-2">
                <button class="delete_user btn btn-danger deletion_straight" name="<?php echo $user->username?>" user_id="<?php echo $user->id ?>" >Borrar</button>
            </div>
        </div>

    </form>
</div>

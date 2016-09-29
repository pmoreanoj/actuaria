<div class="form-panel">
    <h4 class="mb"><i class="fa fa-angle-right"></i>Cambie su Contrase&ntilde;a</h4>

    <form class="form-horizontal style-form" method="post">
        <?php echo Form::hidden('user', $user->id, array("id"=>"user"));?>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <p class="col-sm-12 col-sm-12 control-label"> <?php echo $user->name?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nueva Contrase&ntilde;a</label>
            <div class="col-sm-10">
                <?php echo Form::password('password', NULL, array("id" => "password")) ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <?php echo Form::submit('sbt', "Cambiar Contraseña", array("id" => "sbt", "class" => "btn btn-primary")); ?>
            </div>
        </div>
    </form>
</div>


<div class="form-panel">
    <h4 class="mb"><i class="fa fa-angle-right"></i><?php echo "Editando " . $company->name ?></h4>
    <form class="form-horizontal style-form" method="post">

        <?php echo Form::hidden('id', $company->id, array('id' => 'id')) ?>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10"><?php echo Form::input('name', $company->name, array('id' => 'name', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Dirrecci&oacute;n</label>
            <div class="col-sm-10"><?php echo Form::input('address', $company->address, array('id' => 'address', 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email</label>
            <div class="col-sm-10"><?php echo Form::input('email', $company->email, array('id' => 'email', 'class' => 'form-control')) ?></div>
        </div>

        <div id="logo-container" class="form-group">
            <?php echo $file ?>
        </div>

        <?php echo Form::hidden('file', NULL, array('id' => 'file')); ?>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Mas Detalles</label>
            <div class="col-sm-10"><?php echo Form::textarea('more', $company->more, array("id" => "more", 'class' => 'form-control')) ?></div>
        </div>

        <div class="form-group">
            <div class="col-lg-1 col-md-1">
                <button class="update_company btn btn-primary" name="<?php echo $company->name ?>" id="<?php echo $company->id ?>" >Guardar</button>
            </div>
       
            <div class="col-lg-1 col-md-1">
                <button class="delete_company btn btn-danger" name="<?php echo $company->name ?>" company="<?php echo $company->id ?>" >Borrar</button>
            </div>
        </div>
    </form>
</div>

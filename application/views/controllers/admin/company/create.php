
<div class="form-panel">
    <h4 class="mb"><i class="fa fa-angle-right"></i>Crear Empresa</h4>
    <form class="form-horizontal style-form" method="post">

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <?php echo Form::input('name', NULL, array('id' => 'name', 'class' => 'form-control')) ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Dirrecci&oacute;n</label>
            <div class="col-sm-10"><?php echo Form::input('address', NULL, array('id' => 'address', 'class' => 'form-control')) ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Email</label>
            <div class="col-sm-10"><?php echo Form::input('email', NULL, array('id' => 'email', 'class' => 'form-control')) ?>
            </div>
        </div>
        <div id="logo-container" class="form-group">
            <label class="col-sm-2 control-label">Logo</label>
            <div class="col-sm-4"><?php echo Form::file('logo', array('id' => 'logo', 'style' => 'color: transparent')) ?> </div>     
        </div>
        <?php echo Form::hidden('file', NULL, array('id' => 'file')); ?>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Mas Detalles</label>
            <div class="col-sm-10"><?php echo Form::textarea('description', NULL, array("id" => "description", 'class' => 'form-control')) ?>
            </div>
        </div>


        <div class="form-group">
            <div class="col-lg-12 col-md-12">
                <?php echo Form::submit('sbt', "Crear", array("id" => "sbt", 'class' => 'btn btn-primary')) ?>
            </div>
        </div>


    </form>
</div>
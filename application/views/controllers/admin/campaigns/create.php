
<div class="form-panel">

    <h4 class="mb"><i class="fa fa-angle-right"></i>Crear Campa&ntilde;a</h4>
    <form class="form-horizontal style-form" method="post">
       
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Empresa</label>
            <div class="col-sm-10">
                <?php echo Form::select('company', $companies, NULL, array("id" => "company", 'class' => 'form-control')) ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <?php echo Form::input('name', NULL, array("id" => "name", 'class' => 'form-control')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Inicio de campa&ntilde;a:</label>
            <div class="col-sm-10">
                <?php echo Form::input('start_date', NULL, array("id" => "start_date", 'class' => 'form-control')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Fin de campa&ntilde;a:</label>
            <div class="col-sm-10">
                <?php echo Form::input('end_date', NULL, array("id" => "end_date", 'class' => 'form-control')) ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <?php echo Form::textarea('description', NULL, array("id" => "description", 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <?php echo Form::submit('sbt', "Crear", array("class" => "sbt_create btn btn-primary")) ?>
            </div>
        </div>
    </form>
</div>


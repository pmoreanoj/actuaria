<div class="form-panel">
    <h4 class="mb">Agregar Tipo de Pregunta</h4>
    <form class="form-horizontal style-form" method="post">
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Tipo de pregunta:</label>
            <div class="col-sm-10">
                <?php echo Form::input('name', NULL, array("id"=>"name"))?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12 col-sm-12 control-label">Detalles</label>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                 <?php echo Form::textarea('more', NULL, array("id" => "more","style"=>"width:600px;height:100pxs")) ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-12 col-md-12">
                <?php echo Form::submit('sbt', "Agregar Tipo de Pregunta", array("id" => "sbt", "class" => "btn btn-info")) ?>
            </div>
        </div>
    </form>
</div>

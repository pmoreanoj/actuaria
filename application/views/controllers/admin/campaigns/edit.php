<div class="form-panel">
    <h4 class="mb"><i class="fa fa-angle-right"></i>Editar Campa&ntilde;a</h4>
    <?php echo Form::hidden('id', $campaign->id, array('id' => 'id')) ?>

    <form class="form-horizontal style-form" method="post">
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Empresa</label>
            <div class="col-sm-10"><?php echo Form::select('company', $companies, $campaign->company_id, array("id" => "company", 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10"><?php echo Form::input('name', $campaign->name, array("id" => "name", 'class' => 'form-control')) ?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Inicio de campa&ntilde;a:</label>
            <div class="col-sm-10">
                <?php
                $initial_date = new DateTime($campaign->initial_date);
                $initial_date = $initial_date->format('d-m-Y');
                echo Form::input('start_date', $initial_date, array("id" => "start_date", 'class' => 'form-control'))
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Fin de campa&ntilde;a:</label>
            <div class="col-sm-10">
                <?php
                $final_date = new DateTime($campaign->final_date);
                $final_date = $final_date->format('d-m-Y');
                echo Form::input('end_date', $final_date, array("id" => "end_date", 'class' => 'form-control'))
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
                <?php echo Form::textarea('description', $campaign->description, array("id" => "description", 'class' => 'form-control')); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-1 col-md-1">
                <button class="update_campaign btn btn-primary" name="<?php echo $campaign->company->name ?>" id="<?php echo $campaign->id ?>" >Guardar</button>
            </div>

            <div class="col-lg-1 col-md-1">
                <button class="delete_campaign btn btn-danger" name="<?php echo $campaign->company->name ?>" id="<?php echo $campaign->id ?>" >Borrar</button>
            </div>
        </div>
    </form>
</div>

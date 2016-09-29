<div class="content-panel">
    <div class="row">
        <div class="col-md-12">
            Empleados Campa&ntilde;a <?php echo $campaign->name ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            Empresa: <?php echo $campaign->company->name ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            Empleados: <?php echo count($employees) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            Niveles: <?php echo count($levels) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo Form::button('delete_employee', 'Borrar Datos', array("class" => "delete_employee")) ?>
        </div>
    </div>
    <?php echo Form::hidden('id', $campaign->id, array("id" => "id")) ?>

    <hr/>

    <div class="row">
        <div class="col-md-12">
            <?php echo Form::file('data', array('id' => 'data')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="csvData"></div>

        </div>
    </div>
</div>
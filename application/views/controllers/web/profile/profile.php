<div class="content-panel">
    <div class="row centered">
        <h1>Bienvenido/a </h1> 
        <h3><?php echo $employee->name; ?> </h3>
        <h1>Software Actuaria 360</h1>
    </div>

    <div class="row col-md-offset-1">
        <hr class="col-md-10">
    </div>

    <div class="row center-block">
        <div class="col-md-10">
            <h3>Datos Personales</h3>
        </div>
        <br>
        <div class="row center-block">
            <p class="col-md-10">Nombre Completo: <?php echo $employee->name; ?></p>
        </div>
        <div class= "col-md-10"><p>Correo Electrónico:<?php echo $employee->email; ?></p></div>
        <div class= "col-md-10"><p>Número de Cédula:<?php echo $employee->identificator; ?></p></div>
        <div class="col-md-10">
            <a href="<?php echo URL::site('/profile/edit?id=' . $employee->id) ?>"><button class="btn btn-warning">Editar</button></a>
        </div>
    </div>
    <div class="row col-md-offset-1">
        <hr class="col-md-10">
    </div>

    <div class="row center-block">
        <div class="col-md-10"><h3>Datos Profesionales</h3></div>
        <br>
        <div class="col-md-10"><p>Nombre de la Compañía: <?php echo $employee->campaign->name; ?></p></div>
        <div class="col-md-10"><p>Jerarquía dentro de la compañía: Nivel <?php echo $employee->level; ?></p></div>
    </div>
    <div class="row col-md-offset-1">
        <hr class="col-md-10">
    </div>

    <div class="row center-block">

        <div class="col-md-10">
            <h3>Tareas Pendientes</h3>
        </div>

        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>

        <div class="col-md-10">
            <a href="<?php echo URL::site('assignations/assignations') . '?employee=' . $employee->id ?>" >
                <button class="btn btn-success">Ir a Evaluaciones</button>
            </a>
        </div>

        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>

        <div class="col-md-10">
            <?php
            if ($campaign->status == 'NEW') {
                ?>
                <button class="btn btn-success" disabled='true'>Ir a la Auto-Evaluación</button>
                <?php
            }
            else if($campaign->status == 'IN_PROGRESS'){
                ?>
                <a href="<?php echo URL::site('evaluations/evaluations') . '?employee=' . $employee->id . '&evaluated=' . $employee->id ?>" >

                <button class="btn btn-success">Ir a la Auto-Evaluación</button>
            </a>
                <?php
            }
            ?>
            
        </div>
    </div>
</div> 

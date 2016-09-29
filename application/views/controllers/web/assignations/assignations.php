<div class="content-panel">
    <div class="row center-block centered">
        <h2>Sección de Evaluaciones</h2>
    </div>
    <div class="row col-md-offset-1">
        <hr class="col-md-10">
    </div>

    <?php if ($campaign->status == 'NEW') { ?>
        <div class = "row center-block">
            <div class = "col-md-10">
                <h3>Aviso Importante</h3>
                <div class="row col-md-offset-1">
                    <hr class="col-md-10">
                </div>
                <p>La campaña se encuentra en un estado no iniciado.</p>
                <p>No podrá revisar las evaluaciones pendientes hasta que la campaña se encuentre activa para todos
                    los empleados.</p>
                <p>Volver al <strong><a href="<?php echo URL::site('home/') ?>" >inicio</a></strong>.</p>
            </div>

            <?php } else if ($campaign->status == 'DONE') {
            ?>
            <div class="row center-block">
                <h3 class="col-md-10">La campaña ha concluido</h3>
                <div class="row col-md-offset-1">
                    <hr class="col-md-10">
                </div>
                <p class="col-md-10">Lo sentimos. La campaña se encuentra cerrada y no se permite más evaluaciones. Si usted no logró
                    realizar sus evaluaciones le sugerimos que contacte al encargado del Dpto. de RRHH de su empresa.</p>
            </div>
            <?php
        } else {
            $i = 1;
            ?>
            <div class = "col-md-12">
                <h3>Instrucciones para contestar las evaluaciones</h3>
                <div class="row col-md-offset-1">
                    <hr class="col-md-10">
                </div>
                <p class="col-md-12">Las evaluaciones estan habilitadas desde el día que el administrador de la campaña
                    así lo decida hasta el día de finalización de la campaña.
                </p>
                <p class="col-md-12">Dando click al botón de 'Evaluar' de cada empleado entonces se ingresa en la
                    evaluación. Todas las preguntas deben ser respondidas para que el status de la evaluación cambie de
                    'En Progreso' a 'Completa'. Las respuestas a las evaluaciones se guardan cada 5 veces que el usuario
                    registre una nueva respuesta, sin importar si es de la misma pregunta o no. Además existe una
                    opción manual de guardar las evaluaciones dando click en el botón 'Guardar Respuestas'.
                </p>

                <div class="row col-md-offset-1">
                    <hr class="col-md-10">
                </div>

            </div>
            <?php
            foreach ($evaluators as $evaluator) {
                ?>
                <div class="row center-block">
                    <h4><?php echo $i . ")"; ?> </h4>
                </div>
                <div class = "row center-block">
                    <div class = "col-md-10"><p>Nombre Completo:<?php echo $evaluator->evaluated->name; ?></p></div>
                    <div class = "col-md-10"><p>Nivel dentro de la empresa: Nivel<?php echo $evaluator->evaluated->level; ?></p></div>
                    <div class="col-md-10"><p>Status de la Encuesta:

        <?php if ($evaluator->status == 'NEW') { ?>
                                No Iniciada</p>

                        </div>
                        <?php
                    } else if ($evaluator->status == 'INCOMPLETE') {
                        ?>
                        En Proceso...</p></div>
                    <?php
                } else if ($evaluator->status == 'COMPLETE') {
                    ?>
                    COMPLETA   <span><?php echo HTML::image('media/css/controllers/web/home/img/valid.png', array('id' => 'valid')) ?></span></p></div>
                <?php
            }
            ?>

        </div>

        <div class = "row center-block">
            <div class = "col-md-1"><a href = "<?php echo URL::site('evaluations/evaluations') . '?employee=' . $employee->id . '&evaluated=' . $evaluator->evaluated->id ?>" >
                    <button class = "btn btn-success">Evaluar</button>
                </a>
            </div>
        </div>

        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>
        <?php
        $i++;
    }
}
?>
</div>
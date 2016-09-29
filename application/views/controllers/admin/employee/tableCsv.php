<div class="row">
    <div class="col-md-12">
        Count:<?php echo count($employees) ?> 
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php if (!count($warnings['required'])): ?>
            <?php echo Form::button('save_employee', 'Guardar', array("class" => "save_employee")) ?>
        <?php endif; ?>
    </div>
</div>


<?php if (!count($warnings['required'])): ?>
    <?php foreach ($areas as $area => $count): ?>
        <div class="row">
            <div class="col-md-12">
                Nivel <?php echo $area ?>: <?php echo $count ?>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($areas as $area => $count): ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo $area ?>: <?php echo $count ?>
            </div>
        </div>
    <?php endforeach; ?>


<?php endif; ?>

<?php if (count($warnings['required'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?php //print_r( $warnings['required'])?>
                <div>Se debe subir los campos requeridos en el archivo</div>
                <?php foreach ($warnings['required'] as $required) : ?>
                    <div>No se ha subido el campo <b> <?php echo $dictonary[$required] ?></b></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if (count($warnings['repetition'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
                <?php //print_r($warnings['repetition']) ?>
                <div>Tome atencion a los siguientes datos de su archivo de empleados</div>
                <?php foreach ($warnings['repetition']as $identificator => $repetition) : ?>
                    <?php if ($repetition == 1): ?>
                        <div>El n&uacute;mero de c&eacute;dula <b><?php echo $identificator ?></b> se encuentra repetido una vez en el nivel <?php echo $repetition['level']?></div>
                    <?php else: ?>
                        <div>El n&uacute;mero de c&eacute;dula <b><?php echo $identificator ?></b> se encuentra repetido <?php echo $repetition['count']?> veces en el nivel <?php echo $repetition['level']?></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif ?>

<?php if (count($warnings['columns'])): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                <?php print_r($warnings['columns']) ?>
            </div>
        </div>
    </div>
<?php endif ?>


<div>
    <table>
        <tr>
            <th>Identificador</th>
            <th>Nombre</th>
            <th>Genero</th>
            <th>Nivel</th>
            <th>Email</th>
            <th>Cargo</th>
        </tr>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?php echo $employee[0] ?></td>
                <td><?php echo $employee[1] ?></td>
                <td><?php echo $employee[2] ?></td>
                <td><?php echo $employee[3] ?></td>
                <td><?php echo $employee[4] ?></td>
                <td><?php echo $employee[5] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

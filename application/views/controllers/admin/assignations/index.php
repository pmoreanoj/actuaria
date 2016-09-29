
<div class="content-panel">
    <div class="row">
        <div class="col-md-12">
            <h3><?php echo $campaign->name ?></h3>
            <?php echo Form::hidden('campaign', $campaign->id, array('id'=>'campaign'))?>
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo URL::site('admin/assignations/test') . '?id=' . $campaign->id ?>">Generar asignaciones</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo URL::site('admin/assignations/manual') ?>">Asignaci&oacute;n Manual</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <table  class="tablesorter table table-striped table-advance table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Evaluator</th>
                        <th>Evaluated</th>
                        <th>Opciones</th>
                    </tr>
                </thead>

                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td class="person_name" employee="<?php echo $employee->id?>"><?php echo $employee->name ?></td>
                        <td><?php echo $employee->evaluator->count_all() ?></td>
                        <td><?php echo $employee->evaluated->count_all() ?></td>
                        <td>
                            <a href="<?php echo URL::site('admin/assignations/personal') . '?employee=' . $employee->id ?>">
                                Editar
                            </a>
                        </td>
                    </tr>    
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
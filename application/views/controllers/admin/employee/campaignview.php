<div class="content-panel">
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="<?php echo URL::site('admin/employee/create?id='.$campaign->id)?>">
            <button class="btn btn-primary">Agregar Empleado</button>
</a>
        </div>
    </div>
    <table class="tablesorter table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Cargo</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td>
                    <?php echo $employee->name ?>
                </td>

                <td><?php echo $employee->email ?></td>
                <td><?php echo $employee->position ?></td>
                <td>
                    <a href="<?php echo URL::site('admin/employee/edit') . "?id=" . $employee->id ?>">Editar</a>
                    <a href="<?php echo URL::site('profile/profile') . "?id=" . $employee->id ?>">Perfil</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


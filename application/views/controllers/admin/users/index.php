<div class="content-panel">
    <div class="categorybox">
        <div class="row">
            <div class="col-md-10"><h4>Lista de Usuarios de Actuaria 360</h4></div>
            <div class="col-md-1"><a href="<?php echo URL::site('admin/users/create') ?>" >
                    <button class="btn btn-success">Crear Usuario</button>
                </a>
            </div>
        </div>
        <hr></hr> 
        <div class="panel-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th><strong>Nombre de Usuario</strong></th>
                        <th><strong>Tipo de Usuario</strong></th>
                        <th>Opciones</th>           
                    </tr>
                </thead>
                <?php
                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user_types[$user->type]; ?></td>
                        <td>


                            <button user_id="<?php echo $user->id ?>" class="btn btn-info edit_user">Editar</button>

                            <button user_id="<?php echo $user->id ?>"  class="btn btn-danger" data-toggle="modal" data-target="#myModal" data-link="<?php echo URL::site('admin/users') ?>">Eliminar
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <div style="display: none;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Aviso</h4>
                        </div>
                        <div class="modal-body">
                            Seguro desea eliminar este registro?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <a href=""><button type="button" id="ok-button" class="btn btn-primary" >OK</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
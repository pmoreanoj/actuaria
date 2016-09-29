<div class="content-panel">
    <div class="row">
        <div class="col-md-10">
            <h4>Campa&ntilde;as</h4></div>
        <div class="col-md-1"><a href="<?php echo URL::site('admin/campaigns/create') ?>" >
                <button type="button" class="btn btn-success">Crea Campa&ntilde;a</button>
            </a>
        </div>
    </div>
    <hr></hr> 
    <div>

        <table  class="tablesorter table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Empresa</th>
                    <th>Estado</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <th>Opciones</th>
                </tr>
            </thead>

            <?php foreach ($campaigns as $campaign): ?>
                <tr>
                    <td>
                        <a href="<?php echo URL::site('admin/campaigns/view') . "?id=" . $campaign->id ?>">
                            <?php echo $campaign->name ?>
                        </a>
                    </td>
                    <td><?php echo $campaign->company->name ?></td>
                    <?php $status_dic=array("NEW"=>"Nueva","IN_PROGRESS"=>"En progreso","DONE"=>"Finalizada");?>
                    <td><?php echo $status_dic[$campaign->status] ?></td>
                    <td><?php
                        $initial_date = new DateTime($campaign->initial_date);
                        $initial_date = $initial_date->format('d-m-Y');
                        echo $initial_date;
                        ?></td>
                    <td><?php
                        $final_date = new DateTime($campaign->final_date);
                        $final_date = $final_date->format('d-m-Y');
                        echo $final_date;
                        ?></td>
                    <td>
                        <button id="<?php echo $campaign->id ?>" class="edit_campaign btn btn-primary" alt="Editar">Editar</button>
                        <button id="<?php echo $campaign->id ?>" data-toggle="modal" data-target="#myModal" data-campaignid="<?php echo $campaign->id ?>" data-campaign="<?php echo $campaign->name ?>" class=" btn btn-danger" alt="Borrar">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
        <div style="display: none;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Aviso</h4>
                    </div>
                    <div class="modal-body">
                        Desea eliminar a la campa&ntilde;a <span id="campaign-name"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" id="<?php //echo $campaign->id  ?>" class="btn btn-primary" data-dismiss="modal">OK</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
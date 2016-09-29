<div class="content-panel">
    <div class="row col-md-12">
        <h3>Tipos de preguntas</h3> 
    </div>
    <div class="row text-right col-md-12">
        <a href="<?php echo URL::site('admin/questiontype/create') ?>" >
            <button class="btn btn-success">Crear Tipo de pregunta</button>
        </a>
    </div>
    <div class="row col-md-12">
        Conteo: <?php echo count($questionTypes) ?>
    </div

    <div class="panel-body">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th><strong>Nombre</strong></th>
                    <th><strong>#Preguntas</strong></th>
                    <th><strong>Opciones<strong></th>           
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($questionTypes as $type): ?>

                                        <tr>
                                            <td><?php echo $type->name ?></td>
                                            <td><?php echo $type->questions->count_all() ?></td>
                                            <td>Edicion</td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                                </div>


                                </div>
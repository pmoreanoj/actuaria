<div class="content-panel">
    <div class="row">
        <div class="col-md-2">
            <h4>Editar Pregunta</h4>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-4 ajax-message"></div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Tipo de Pregunta
        </div>
        <div class="col-md-10">
            <?php echo Form::select('type', $question_types, $question->question_type_id, array('id' => 'type')) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table>
                <tr>
                    <td>Actuaria 360</td>
                    <td>
                        <?php if ($question->actuaria_360 == 'YES'): ?>
                            <input type="checkbox" class="switch-360" name="my-checkbox" question="<?php echo $question->id ?>" checked/>
                        <?php else: ?>
                            <input type="checkbox" class="switch-360" name="my-checkbox" question="<?php echo $question->id ?>"/>
                        <?php endif; ?>
                    </td>
                    <td>Laboral</td>
                    <td>
                        <?php if ($question->work == 'YES'): ?>
                            <input type="checkbox" class="switch-laboral" name="my-checkbox" question="<?php echo $question->id ?>" checked/>
                        <?php else: ?>
                            <input type="checkbox" class="switch-laboral" name="my-checkbox" question="<?php echo $question->id ?>"/>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            Pregunta
        </div>
    </div>
    <div class="row">
        <?php echo Form::hidden('question', $question->id, array('id' => 'question')) ?>
        <div class="col-md-12">
            <?php echo Form::textarea('text', $question->question_text, array('id' => 'text')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo Form::submit('sbt_update', 'Guardar', array('id'=>'sbt_update'))?>
        </div>
    </div>
</div>


<table  class="tablesorter table table-striped table-advance table-hover">
    <thead>
        <tr>
            <th>Pregunta</th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <?php foreach ($questions as $question): ?>
        <tr>
            <td>
                 <a href="<?php echo URL::site('admin/question/edit' . '?question=' . $question->id) ?>">
                
                <?php echo $question->question_text; ?>
                 </a>
                 </td>
            <td>
                <?php if ($question->actuaria_360 == 'YES'): ?>
                    <input type="checkbox" class="switch-360" name="my-checkbox" question="<?php echo $question->id ?>" checked/>
                <?php else: ?>
                    <input type="checkbox" class="switch-360" name="my-checkbox" question="<?php echo $question->id ?>"/>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($question->work == 'YES'): ?>
                    <input type="checkbox" class="switch-laboral" name="my-checkbox" question="<?php echo $question->id ?>" checked/>
                <?php else: ?>
                    <input type="checkbox" class="switch-laboral" name="my-checkbox" question="<?php echo $question->id ?>"/>
                <?php endif; ?>
            </td>
            
        </tr>
    <?php endforeach; ?>

</table>
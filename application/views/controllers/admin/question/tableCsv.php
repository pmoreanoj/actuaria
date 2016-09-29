<div>
<?php echo Form::button('save_question', 'Guardar', array("class" => "save_question")) ?>
</div>

<div>
<?php foreach($types as $type => $count):?>
    <p><?php echo $type?>: <?php echo $count?></p>
<?php endforeach;?>        
</div>
<div>
    <table>
        <tr>
            <th>Pregunta</th>
            <th>Tipo</th>
        </tr>
        <?php foreach ($questions as $question): ?>
            <tr>
                <td>
                    <?php echo $question[0] ?>
                </td>
                <td>
                    <?php echo $question[1] ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
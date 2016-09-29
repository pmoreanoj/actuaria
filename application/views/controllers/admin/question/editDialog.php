<p>Editar Pregunta</p>
<p>

    <textarea id="new_text" rows="2" cols="60"  ><?php echo $text ?></textarea>
</p>
<p>
    <?php echo Form::submit('sbt_edit', 'Guardar', array('id' => 'sbt_edit', 'question' => $question))
    ?>
    <?php echo Form::submit('sbt_reset', 'Restaurar', array('id' => 'sbt_reset', 'question' => $question)) ?>
</p>

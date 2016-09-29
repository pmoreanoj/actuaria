Upload
<div>
    <?php echo Form::file('data', array('id' => 'data')) ?>
</div>

<div>
<?php echo Form::button('upload_question', 'Cargar', array("class" => "upload_question")) ?>
</div>

<div id="csvData"></div>
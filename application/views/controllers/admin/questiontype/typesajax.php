
<style>
    #selectable .ui-selecting { background: #FECA40;}
    #selectable .ui-selected{background: #f49b20; color: white;}
    #selectable{ list-style-type: none; width: 80%}
</style>
<div>

    Escoja su pregunta

    <ol id="selectable">
        <?php foreach ($questions as $question): ?>
            <li class="ui-widget-content" question="<?php echo $question->id ?>"><?php echo $question->question_text ?></li>
        <?php endforeach; ?>
    </ol>
</div>

<div class="row">
    <div class="col-md-8">
        <?php echo Form::select('levels', $levels, NULL, array('id' => 'levels', 'class' => 'form-control')) ?>
    </div>
    <div class="col-md-4">
        <?php echo Form::button('button_add', "Agregar", array("id" => "button_add", "class" => "btn btn-success btn-sm"))
        ?>
    </div>
</div>


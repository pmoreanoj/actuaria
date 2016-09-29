<div class="content-panel">

    <div class="row">
        <div class="col-md-10">
            <h4>
                <?php echo $campaign->name ?> - <?php echo $campaign->company->name ?>
            </h4>
        </div>

        <div class="col-md-2">
            <h4>Preguntas</h4>
        </div>
    </div>
    <hr/>

    <?php echo Form::hidden('campaign', $campaign->id, array('id' => 'campaign')) ?>
    <?php if (count($types) > 1): ?>

        <div class="row">
            <div class="col-md-8">
                <?php echo Form::select('questionType', $types, NULL, array('id' => 'questionType', 'class' => 'form-control')) ?>
            </div>
        </div>

        <div id="questions"></div>
        <hr/>
        <div id="savedQuestions">
            <?php echo $savedQuestions ?>
        </div>

        <div id="dialog" title="Editar Pregunta"></div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-10">
                <h3>Debe ingresar preguntas</h3>
            </div>
        </div>
    <?php endif; ?>
</div>
<div>
    Evualando
</div>  
<?php foreach ($evaluator as $employee): ?>
    <div>
        <?php echo $employee->evaluated->name.' - '.$employee->evaluated->position?>
    </div>
<?php endforeach; ?>

<div>
    Siendo evaluador por
</div>  
<?php foreach ($evaluated as $employee): ?>
    <div>
        <?php echo $employee->evaluator->name.' - '.$employee->evaluated->position?>
    </div>
<?php endforeach; ?>


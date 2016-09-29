
<div class="row">
    <div class="col-md-12">
        <p >
            N&uacute;mero de preguntas: <?php echo $campaign->questions->count_all() ?>
        <p>
    </div>
</div>

<div id="tabs">
    <ul>
        <?php foreach ($levels as $level): ?>
            <?php if ($level->questions->count_all() > -0): ?>
                <li>
                    <a href="#tabs-<?php echo $level->id ?>">
                        <?php echo $level->name ?>
                    </a>
                </li>

            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <?php foreach ($levels as $level): ?>
        <?php if ($level->questions->count_all() > -0): ?>

            <div id="tabs-<?php echo $level->id ?>">

                <?php
                $questions = $level->questions->find_all();

                foreach ($questions as $question):
                    ?>
                    <div class="row">
                        <div class="col-md-8">
                            <?php if ($question->customized == 'NO'): ?>
                                <?php echo $question->question->question_text ?>
                            <?php else: ?>
                             <?php echo $question->question_customed?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <?php
                            echo
                            Form::button('button_edit', '<i class="fa fa-pencil"></i>', array(
                                "class" => "button_edit btn btn-info btn-sm",
                                "edit" => $question->id
                            ))
                            ?>
                            <?php
                            echo
                            Form::button('button_remove', '<i class="fa fa-trash-o"></i>', array(
                                "class" => "button_remove btn btn-danger  btn-sm",
                                "remove" => $question->id
                            ))
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

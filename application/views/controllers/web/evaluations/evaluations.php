<div class="content-panel">
    <span class="ajax-message centered center-block" id="dyn_content"></span>
    <?php
    if ((int) $employee->id == $evaluated->id) {
        ?>
        <div class="center-block centered">
            <h1>Auto-Evaluación - Actuaria 360</h1>
        </div>

        <div class="center-block col-md-10">
            <p>Nombre del empleado: <?php echo $employee->name; ?></p>
        </div>

        <?php
    } else {
        ?>
        <div class="center-block centered">
            <h1>Evaluación - Actuaria 360</h1>
        </div>

        <div class="center-block col-md-10">
            <p>Nombre del evaluador: <?php echo $employee->name; ?></p>
            <p>Nombre del evaluado: <?php echo $evaluated->name; ?></p>
        </div>
        <?php
    }
    ?>

    <div class="row col-md-offset-1">
        <hr class="col-md-10">
    </div>

    <div class="center-block text-right row">
        <button type="submit" class="btn btn-success save_answers">Guardar Respuestas</button>
    </div>




    <?php if (count($questions) != 0) { ?>
        <div class="row center-block centered">
            <h2>Competencias Específicas</h2>
        </div>
        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>
        <?php
    }
    $i = 1;
//echo Debug::vars($questions);
//die();
    foreach ($questions as $category => $q) {
        ?>

        <div class="category col-md-4">
            <h3><?php echo "*" . ORM::factory('QuestionType', $category)->name ?></h3>
        </div>
        <?php
        foreach ($q as $question) {
            ?>
            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>

            <div class="row center-block centered">
                <p> <?php
                    if ($question->customized == 'NO') {
                        echo $i . ") ¿" . $question->question->question_text . "?";
                        ?></p> 
                    <p>
                        <?php
                    } else {
                        echo $i . ") ¿" . $question->question_customed . "?";
                        ?></p>
                    <?php
                }
                ?>
            </div>

            <?php
            $a = ORM::factory('Answer')->where('question_id', '=', $question->id)->
                            and_where('evaluator_id', '=', $employee->id)->
                            and_where('evaluated_id', '=', $evaluated->id)->
                            and_where('campaign_id', '=', $question->campaign)->find();

            if (!isset($a->score)) {
                ?>
                <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>

                <?php
            } else {
                if ($a->score == 1) {
                    ?>
                    <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1" checked>
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>

                    <?php
                } else if ($a->score == 2) {
                    ?>
                    <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2" checked>
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>
                    <?php
                } else if ($a->score == 3) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3" checked>
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>

                    <?php
                } else if ($a->score == 4) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4" checked>
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>

                    <?php
                } else if ($a->score == 5) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5" checked>
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>
                    <?php
                }
                $i+=1;
            }
        }
    }
    ?>
    <input type="hidden" id="campaign_id" value="<?php echo $campaign; ?>" >
    <input type="hidden" id="evaluator_id" value="<?php echo $employee; ?>" >
    <input type="hidden" id="evaluated_id" value="<?php echo $evaluated; ?>" >

    <div class="row col-md-offset-1">
        <hr class="col-md-10">
    </div>

    <?php if (count($questions_t) != 0) { ?>
        <div class="row center-block centered">
            <h2>Competencias Generales</h2>
        </div>
        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>
        <?php
    }
    $i = 1;

    foreach ($questions_t as $category => $q) {
        ?>
        <div class="category col-md-4">
            <h3><?php echo "*" . ORM::factory('QuestionType', $category)->name ?></h3>
        </div>
        <?php
        foreach ($q as $question) {
            ?>
            <div class="row col-md-offset-1">
                <hr class="col-md-10">
            </div>
            <div class="row center-block centered">
                <p> <?php
                    if ($question->customized == 'NO') {
                        echo $i . ") ¿" . $question->question->question_text . "?";
                        ?></p> 
                    <p>
                        <?php
                    } else {
                        echo $i . ") ¿" . $question->question_customed . "?";
                        ?></p>
                    <?php
                }
                ?>
            </div>

            <?php
            $a = ORM::factory('Answer')->where('question_id', '=', $question->id)->
                            and_where('evaluator_id', '=', $employee->id)->
                            and_where('evaluated_id', '=', $evaluated->id)->
                            and_where('campaign_id', '=', $question->campaign)->find();
            if (!isset($a->score)) {
                ?>
                 <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>
                

                <?php
            } else {
                if ($a->score == 1) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1" checked>
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>
                    
                    <?php
                } else if ($a->score == 2) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2" checked>
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>

                    <?php
                } else if ($a->score == 3) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3" checked>
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>
                    
                    <?php
                } else if ($a->score == 4) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4" checked>
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5">
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>
                    
                    <?php
                } else if ($a->score == 5) {
                    ?>
                     <div class="row centered">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="1">
                        <p>Totalmente en desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="2">
                        <p>En desacuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="3">
                        <p>Neutro</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="4">
                        <p>De acuerdo</p>
                    </div>
                    <div class="col-md-2">
                        <input type="radio" class="answer" name="<?php echo $question->id; ?>" value="5" checked>
                        <p>Totalmente de acuerdo</p>
                    </div>
                </div>
                    
                    <?php
                }
            }
            $i+=1;
        }
        ?>
        <div class="row col-md-offset-1">
            <hr class="col-md-10">
        </div>
        <?php
    }
    ?>

    <div class="center-block right text-right">
        <button type="submit" class="btn btn-success save_answers">Guardar Respuestas</button>
    </div>
    <div class="row col-md-offset-1">
        <hr class="col-md-10">
    </div>
</div>
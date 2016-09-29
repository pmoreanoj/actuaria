<?php

class Model_Question extends ORM {

    protected $_table_name = 'question';
    
    protected $_belongs_to = array(
         'type' => array('model' => 'QuestionType', 'foreign_key' => 'question_type_id'));
}
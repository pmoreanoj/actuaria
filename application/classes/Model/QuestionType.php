<?php

class Model_QuestionType extends ORM {

    protected $_table_name = 'question_type';
    
     protected $_has_many = array(
         'questions' => array('model' => 'Question', 'foreign_key' => 'question_type_id'));
}
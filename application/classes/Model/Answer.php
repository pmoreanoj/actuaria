<?php

class Model_Answer extends ORM {

    protected $_table_name = 'answer';
    protected $_belongs_to = array(
        'rated' => array('model' => 'Employee', 'foreign_key' => 'rated_id'),
        'evaluator' => array('model' => 'Employee', 'foreign_key' => 'evaluator_id'),
        'question' => array('model' => 'Question', 'foreign_key' => 'question_id'),
        'campaign' => array('model' => 'Campaign', 'foreign_key' => 'campaign_id'),
    );

}

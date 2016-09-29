<?php

class Model_CampaignHasQuestions extends ORM {

    protected $_table_name = 'campaign_has_question';
    protected $_belongs_to = array(
        'campaign' => array('model' => 'Campaign', 'foreign_key' => 'campaign_id'),
        'level' => array('model' => 'Level', 'foreign_key' => 'level_id'),
        'question' => array('model' => 'Question', 'foreign_key' => 'question_id'),
        'question_type' => array('model' => 'QuestionType', 'foreign_key' => 'question_type_id'));

}

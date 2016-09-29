<?php

class Model_Level extends ORM {

    protected $_table_name = 'level';
    protected $_belongs_to = array(
        'campaign' => array('model' => 'Campaign', 'foreign_key' => 'campaign_id'));
    protected $_has_many = array(
        'questions' => array('model' => 'CampaignHasQuestions', 'foreign_key' => 'level_id'));

}

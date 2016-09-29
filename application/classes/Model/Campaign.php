<?php

class Model_Campaign extends ORM {

    protected $_table_name = 'campaign';
    protected $_belongs_to = array(
        'company' => array('model' => 'Company', 'foreign_key' => 'company_id'));
    protected $_has_many = array(
        'employees' => array('model' => 'Employee', 'foreign_key' => 'campaign_id'),
        'levels' => array('model' => 'Level', 'foreign_key' => 'campaign_id'),
        'areas' => array('model' => 'Area', 'foreign_key' => 'campaign_id'),
        'questions' => array('model' => 'CampaignHasQuestions', 'foreign_key' => 'campaign_id'),
    );
    protected  $_has_one=array(  
        'settings' => array('model' => 'CampaignSettings', 'foreign_key' => 'campaign_id')
    );

}

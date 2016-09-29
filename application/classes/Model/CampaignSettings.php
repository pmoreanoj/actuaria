<?php

class Model_CampaignSettings extends ORM {

    protected $_table_name = 'campaign_settings';
    
    protected $_belongs_to = array(
        'campaign' => array('model' => 'Campaign', 'foreign_key' => 'campaign_id'));
}
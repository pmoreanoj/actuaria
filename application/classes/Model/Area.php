<?php

class Model_Area extends ORM {

    protected $_table_name = 'area';
    protected $_belongs_to = array(
        'campaign' => array('model' => 'Campaign', 'foreign_key' => 'campaign_id')
    );

}

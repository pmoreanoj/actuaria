<?php

class Model_Assignations extends ORM {

    protected $_table_name = 'assignations';
    protected $_belongs_to = array(
        'campaign' => array('model' => 'Campaign', 'foreign_key' => 'campaign_id'),
        'evaluator' => array('model' => 'Employee', 'foreign_key' => 'evaluator_id'),
        'evaluated' => array('model' => 'Employee', 'foreign_key' => 'evaluated_id'));

}

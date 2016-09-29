<?php

class Model_Employee extends ORM {

    protected $_table_name = 'employee';
    protected $_belongs_to = array(
        'campaign' => array('model' => 'Campaign', 'foreign_key' => 'campaign_id'));
    protected $_has_many = array(
        'evaluated' => array('model' => 'Assignations', 'foreign_key' => 'evaluated_id'),
        'evaluator' => array('model' => 'Assignations', 'foreign_key' => 'evaluator_id'),
    );

}

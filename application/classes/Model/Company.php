<?php

class Model_Company extends ORM {

    protected $_table_name = 'company';
    
    protected $_belongs_to = array(
        'company' => array('model' => 'Company', 'foreign_key' => 'company_id'));
    
    
}
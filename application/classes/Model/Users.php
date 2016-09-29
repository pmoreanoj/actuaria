<?php

class Model_Users extends ORM {

    protected $_table_name = 'users';
    
      protected $_has_one = array(
         'employee' => array('model' => 'Employee', 'foreign_key' => 'employee_id'));
}
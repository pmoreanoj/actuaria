
<?php defined('SYSPATH') or die('No direct access allowed.');
 
return array
(
 'default' => array
 (
  'type'       => 'MySQL',
  'connection' => array(
 
   'hostname'   => 'localhost',
   
   'database'   => 'actuaria',
   'username'   => 'root',
   'password'   => '',
   
    
      /*
   'database'   => 'panda_ecuabuddies',
   'username'   => 'panda_test',
   'password'   => '2m]%,)*eWh2%',
    */
      
   'persistent' => FALSE,

  ),
  'table_prefix' => '',
  'charset'      => 'utf8',
  'caching'      => FALSE,
  'profiling'    => TRUE,
 )
);




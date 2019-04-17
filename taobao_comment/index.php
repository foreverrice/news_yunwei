<?php
  error_reporting(0);
  set_time_limit(0);
  require('function.php');
  $id = $_GET['id'];
  $data = collect_one($id);
  echo json_encode($data);
	  
    

  
 

  ?>
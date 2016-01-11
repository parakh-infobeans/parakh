<?php
require_once 'config.php';
require_once 'class/rating.php';

$update_work_info = new rating();
 
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	//echo "<pre>";print_r($_POST);exit;
	$record = $update_work_info->update_work($_POST);
	if($record == true) {
	  header('Location: work_list.php');
	}
    
    }

?>

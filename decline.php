<?php
require_once 'config.php';
require_once 'class/rating.php';
$save_manager_work = new rating();

      
    
	//echo "<pre>";print_r($_POST);exit('priyesh');
	$record = $save_manager_work->decline($_GET["id"]);
        
	if($record == true) {
	  header('Location: manager_work_list_page.php');
	}
    

?>

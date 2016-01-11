<?php
require_once 'config.php';
require_once 'class/rating.php';
$save_manager_work = new rating();

      
    
	//echo "<pre>";print_r($_POST);exit('priyesh');
	$record = $save_manager_work->decline($_GET["id"]);
        
	if($record == true) {
	  header('Location: work_list_tab2.php');
	}
    

?>

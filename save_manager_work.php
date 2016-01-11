<?php
require_once 'config.php';
require_once 'class/rating.php';
$save_manager_work = new rating();

      
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//echo "<pre>";print_r($_POST);die;
	$record = $save_manager_work->save_manager_work($_POST);
	if($record == true) {
	  header('Location: work_list_tab2.php?chk=6');
	}
    }

?>

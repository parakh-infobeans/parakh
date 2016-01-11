<?php
require_once 'config.php';
require_once 'class/rating.php';
$save_manager_work = new rating();

      
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//echo "<pre>";print_r($_POST);exit('innnn');
	$record = $save_manager_work->save_emp_rating($_POST);
	if($record == true) {
	  if($_POST['save'] == 'Finalize' || $_POST['save'] == 'Submit'){
	  	header('Location: manager_work_list_page.php?chk=12');
          }else if($_POST['save'] == 'Save'){
	  	header('Location: manager_work_list_page.php?chk=13');
	  }
	}
    }

?>

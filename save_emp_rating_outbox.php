<?php
require_once 'config.php';
require_once 'class/rating.php';
$save_manager_work = new rating();

      
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//echo "<pre>";print_r($_POST);exit('innnn');
	$record = $save_manager_work->save_emp_rating($_POST);
	if($record == true) {
          $current_page_name =  basename($_SERVER['PHP_SELF']);
          //echo $current_page_name;exit('exit');
	  if($_POST['save'] == 'Finalize' || $_POST['save'] == 'Submit'){
	  	header('Location: work_list_tab2.php?chk=12');
          }else if($_POST['save'] == 'Save'){
	  	header('Location: work_list_tab2.php?chk=13');
	  }

	}
    }

?>

<?php
require_once 'config.php';
require_once 'class/rating.php';
$save_manager_work_rating = new rating();
$user_role = $_SESSION['userinfo']->role_id;
      
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//echo "<pre>".$user_role;print_r($_POST);die;
	$record = $save_manager_work_rating->save_manager_work_rating($_POST);
	if($record == true) {
          if($user_role == '9') {
	  header('Location: work_list.php?chk=5');
          }
          else {
           header('Location: work_list_tab1.php?chk=5');
          }
	}
    }

?>

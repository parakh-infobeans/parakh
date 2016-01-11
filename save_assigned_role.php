<?php
require_once 'config.php';
require_once 'class/rating.php';
$flag = 1;
$update_profile_info = new rating();

      
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//echo "<pre>";print_r($_POST);die;
	if(isset($_POST['current_user']['update'])) {
	$get_lead = $update_profile_info->get_all_lead($_POST["current_user"]['user_id'],$flag);
	}
	//echo "<pre>====";print_r($get_lead);die;
	$record = $update_profile_info->assigned_role($_POST,$get_lead);
	if($record == true) {
	  header('Location: user_list_page.php?chk=7');
	}
    
    }

?>

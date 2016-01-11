<?php

require_once 'config.php';
require_once 'class/rating.php';
$update_profile_info = new rating();
 
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	//echo "<pre>";print_r($_POST);die;
    if(($_POST['google_name'] == '') || ($_POST['mobile_number'] == '') || $_POST['google_email'] == '' ) {
           header('Location: edit_profile.php?chk=4');
        }
        else{
        $keys = array_keys($_POST);
	$value = "'".implode("','",$_POST)."'";
	$key = implode(",",$keys);
	//echo "=====".$value."=====".$key;die;
	$record = $update_profile_info->update_profile($key,$value,$_POST);
	if($record == true) {
	  header('Location: profile.php?chk=3');
	}
         
        }
    
    }

?>

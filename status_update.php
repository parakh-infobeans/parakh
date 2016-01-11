<?php
require_once 'config.php';
require_once 'class/rating.php';
$flag = 1;
$total_page = (int) (!isset($_GET['page']) ? 1 :$_GET['page']);
$update_status = new rating();
        
      //echo $current_page;die;
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	//echo "<pre>";print_r($_GET);die;
	$record = $update_status->update_status($_GET);        
        
	if($record == true) {
            
            if($_GET['id'] != '') {
                $seach_user = $_GET['search_user'];
                header('Location: user_list_page.php?search_user='.$seach_user."&page=".$total_page);
            }else {
                header('Location: user_list_page.php?page='.$total_page);
            }            
	}
    
    }

?>

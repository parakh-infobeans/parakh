<?php
require_once 'config.php';
require_once 'class/rating.php';
$search_request = new rating();
$page_number = (int) (!isset($_GET['page']) ? 1 :$_GET['page']);
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
  
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	//echo "<pre>";print_r($_POST);die;
        $record = $search_request->pagination("get_manager_work_list_paginate",$page_number,$user_id,$_POST);
              
    
    }

?>

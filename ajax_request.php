<?php
require_once 'config.php';
require_once 'class/rating.php';
require_once 'functions/functions.php';
$ratingObj = new rating();

if(!empty($_REQUEST['pk']))
{
    $edit_status= $ratingObj->edit_comment($_REQUEST);
    if($edit_status)
        echo "Comment updated successfully";
}

if(!empty($_POST['action']) && $_POST['action'] == "check_email") {

    $email = $_POST['email'];
    $record = $ratingObj->check_email($email);

    if($record['id'] == 1) {
        echo 0;
    }
    else {
        echo 1;
    }
}

if(!empty($_POST['action']) && $_POST['action'] == "tm_rating_request") {


    $record = $ratingObj->save_manager_work_rating($_POST);

    if($record== true) {
        echo '<div id="ajax_resp" class="succes-green"><div class="close-alert"></div>'.$errors[5].'</div>';
    }
    else {
         echo '<div id="ajax_resp" class="error-red"><div class="close-alert"></div>'.$errors[20].'</div>';

    }
}

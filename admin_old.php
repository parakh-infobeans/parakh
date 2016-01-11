<?php
require_once 'config.php';
require_once 'class/rating.php';

$renderObj = new rating();
$status = $renderObj->admin_login();
if(isset($_SESSION['userinfo']) && ($_SESSION['userinfo']->role_id == 8)){
    
    header('Location: user_list_page.php');
}

?>

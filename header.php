<?php
require_once 'config.php';
if (isset($_REQUEST['reset'])) {
    unset($_SESSION['token']);
    unset($_SESSION['userinfo']);
    header('Location: index.php');
}
$unread_count = '';
if (isset($renderObj)) {
    $status = $renderObj->get_unread_count();
    $unread_count = ($status['unread'] != '' ? $status['unread'] : '0' );
}
if($_SESSION['userinfo']->role_id != '9') {
	$home_url = "rating_dashboard.php";
}else{
	$home_url = "profile.php";
}
?>

<html>
    <head>

<meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Parakh - The Review System</title>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <link href="css/theme.css" rel="stylesheet" type="text/css" />
        <link href="css/custom.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />

        <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css' />

<!--        <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/common_ajax.js"></script>
        <script type="text/javascript" src="js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox-1.3.1.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('.action-acc-innner').click(function () {
                    $(this).parent().find('.action-acc-parent-inner').slideToggle(600);
                    $(this).parent().find('.action-acc-innner-arr').toggleClass('action-acc-innner-arr1');
                });
                $('a.green-btn, a.red-btn').click(function () {
                    //$('.overlay').show();
                    $(this).parent().find('.dialoguebox').show();
                });
                $('.dialogue-close, .submit-btn').click(function () {
                    //$('.overlay').hide();
                    $(this).parent('.dialoguebox').hide();
                });
            });
        </script>
    </head>
    <body>


        <div id="wrapper">

            <header>
                <div class="logo-lft"><a href="<?php echo $home_url; ?>"><img src="images/logo.png"></a></div>

                                    <div class="logo-rht"><div class="logo-rht-txt">
<a href="profile.php" class="name2">
                    <?php
                    if (!empty($_SESSION['userinfo'])) {
                        $user_name = ($_SESSION['userinfo']->google_name != '' ? $_SESSION['userinfo']->google_name : '');
                        $role_id = $_SESSION['userinfo']->role_id;
                        $get_role_name = $renderObj->get_role_name($role_id);
                        $role_name = ($get_role_name['name'] != '' ? $get_role_name['name'] : '');


                        echo $user_name;

                    }


                    ?></a>
                                            <?php if(isset($_SESSION['userinfo'])){ ?> <a href="index.php?reset=1" class="name2">(Logout)</a><?php } ?></div>
                </div>
                <script type="text/javascript">
$(document).ready(function(){
    $('.close-alert').click(function(){
        $(this).parent().hide();
    });
});
</script>
            </header>
            <section>
                <div class="wrapper">
<div class="header-mid">
                    <?php
                    if (isset($_SESSION['userinfo']) && ($_SESSION['userinfo']->role_id == 8)) {
                        $active_class_user_list = ($current_page_name == 'user_list_page.php' ? 'active' : '');
                        $active_class_add_user = ($current_page_name == 'add_user.php' ? 'active' : '');
                    }

                    if (isset($_SESSION['userinfo']) && (($_SESSION['userinfo']->role_id != ''))) {
                        if ($_SESSION['userinfo']->role_id != '8') {
                            require 'menu.php';
                        }
                    }
                    ?>
                    <?php if ($_SESSION['userinfo']->role_id == 8) { ?>
                        <a class="link-txt" href="add_user.php">Add User</a>
                    <?php }

                    /*if (!empty($_SESSION)) { ?>
                        <a class="link-txt" href="?reset=1">Logout</a>
                    <?php } */ ?>
                                    </div><br/><br/>




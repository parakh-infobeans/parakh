<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once 'config.php';
require_once 'class/rating.php';
require_once 'class/autoloader.php';

//session_start();
########## Google Settings.. Client ID, Client Secret from https://cloud.google.com/console #############
$google_client_id 		= '214742262594-2n34ftoirg8g0fa0v7069c9o4aan1af3.apps.googleusercontent.com';
$google_client_secret 	= 'K7EzJMQuUmyRd2LcZW6vgoSc';
$google_redirect_url 	= GOOGLE_REDIRECT_URL; //path to your script
$google_developer_key 	= '    AIzaSyBkLc90yRD0Z3qYD0H0eC8imc4Vo-6z7A4';

//include google api files
require_once 'src/Google_Client.php';
require_once 'src/contrib/Google_Oauth2Service.php';

$gClient = new Google_Client();
$gClient->setApplicationName('Login to Sanwebe.com');
$gClient->setClientId($google_client_id);
$gClient->setClientSecret($google_client_secret);
$gClient->setRedirectUri($google_redirect_url);
$gClient->setDeveloperKey($google_developer_key);

$google_oauthV2 = new Google_Oauth2Service($gClient);
$set_page_title = 'Login';

//If user wish to log out, we just unset Session variable
if (isset($_REQUEST['reset'])) 
{
  $renderObj = new rating();
  $last_inser_id = $renderObj->logut_log($_SESSION['log_id']);
  unset($_SESSION['token']);
  unset($_SESSION['userinfo']);
  unset($_SESSION['log_id']);
  $gClient->revokeToken();
  session_destroy();
  header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL)); //redirect user back to page
}

//If code is empty, redirect user to google authentication page for code.
//Code is required to aquire Access Token from google
//Once we have access token, assign token to session variable
//and we can redirect user back to page and login.
if (isset($_GET['code'])) 
{ 
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($google_redirect_url, FILTER_SANITIZE_URL));
	return;
}


if (isset($_SESSION['token'])) 
{ 
	$gClient->setAccessToken($_SESSION['token']);
}

try{
    if ($gClient->getAccessToken()) 
    {

              //For logged in user, get details from google using access token
              $user 				= $google_oauthV2->userinfo->get();
              $user_id 				= $user['id'];
              $user_name 			= filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
              $email 				= filter_var($user['email'], FILTER_SANITIZE_EMAIL);
              //$profile_url 			= filter_var($user['link'], FILTER_VALIDATE_URL);
              $profile_image_url 	= filter_var($user['picture'], FILTER_VALIDATE_URL);
              $personMarkup 		= "$email<div><img src='$profile_image_url?sz=50'></div>";
              $_SESSION['token'] 	= $gClient->getAccessToken();        
              $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

            if ($conn->connect_error) {
                    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
            }
            //compare user id in our database
            $user_exist = $conn->query("SELECT * FROM users WHERE google_id=$user_id OR google_email = '$email'")->fetch_object(); 
	    
            if($user_exist)
            {
              if($user_exist->status == '1') {
              $renderObj = new rating();
              $last_inser_id = $renderObj->login_log($user_exist->id);
              $_SESSION['userinfo']= $user_exist;
              $_SESSION['log_id']= $last_inser_id;
              $user_id_primary = $user_exist->id;
              $update_profile_info = $conn->query("UPDATE users SET google_id=$user_id,google_picture_link='$profile_image_url' WHERE id=$user_id_primary");
                if($user_exist->role_id != 9){

//                  header('Location: rating_dashboard.php');
                  header('Location: dashboard.php');
                }else{
//                  header('Location: profile.php');
                    header('Location: dashboard.php');
                }
              }
              else {
                  unset($_SESSION['token']);
                  unset($_SESSION['userinfo']);
                  unset($_SESSION['log_id']);
                  header('Location: index.php?chk=9');
              }
              //echo "innnn";die;
           }else{ 
                    $inst_sql = "INSERT INTO users (role_id,google_id, google_name, google_email, google_picture_link,created_date) 
                    VALUES (9,$user_id, '$user_name','$email','$profile_image_url','".date('Y-m-d H:i:s')."')";
                    $data = mysqli_query($conn, $inst_sql);
                    $last_id = mysqli_insert_id($conn);
                    $user_exist = $conn->query("SELECT * FROM users WHERE google_id=$user_id")->fetch_object(); 

                    if($user_exist)
                    {
                      if($user_exist->status == '1') {
			$renderObj = new rating();
			$last_inser_id = $renderObj->login_log($user_exist->id);
                        $_SESSION['userinfo']= $user_exist;
                        $_SESSION['log_id']= $last_inser_id;
                        if($user_exist->role_id != 9){
                          header('Location: rating_dashboard.php');
                        }else{
                          header('Location: profile.php');
                        }
                      }
                      else {
                          unset($_SESSION['token']);
                          unset($_SESSION['userinfo']);
                          unset($_SESSION['log_id']);
                          header('Location: index.php?chk=9');
                      }
                    }

            }
    }
    else 
    {
            //For Guest user, get google login url
            $authUrl = $gClient->createAuthUrl();
    }
}catch(Exception $e) {
  echo 'Exception Message: ' .$e->getMessage();
  echo '<BR><BR>Exception Trace: ' .$e->getTraceAsString();
  //$authUrl = $gClient->createAuthUrl();
  //header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
  die();
}
?>

<head>
<?php if(ENVIRONMENT == 'LOCAL' || ENVIRONMENT == 'DEV'){ ?>
        <title>Parakh - The Review System Dev</title>
<?php }else if(ENVIRONMENT == 'QA') {?>
	<title>Parakh - The Review System QA</title>
<?php }else { ?>
	<title>Parakh - The Review System</title>
<?php } ?>
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link href="css/theme.css" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css' />
<!--<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>-->
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/jquery.timers.js"></script>
<script type="text/javascript" src="js/jquery.autoScroller.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.action-acc-innner').click(function(){
		$(this).parent().find('.action-acc-parent-inner').slideToggle(600);
		$(this).parent().find('.action-acc-innner-arr').toggleClass('action-acc-innner-arr1');
	});
	$('a.green-btn, a.red-btn').click(function(){
		//$('.overlay').show();
		$(this).parent().find('.dialoguebox').show();
	});	
	$('.dialogue-close, .submit-btn').click(function(){
		//$('.overlay').hide();
		$(this).parent('.dialoguebox').hide();
	});
});
</script>

<script type="text/javascript">
$(window).load(function(){autoScroller('vmarquee')});
</script>
</head>
<body class="body-bg">
	<div class=""><img src="images/login-logo.png"></div>
	<?php  require_once "error.php";   ?>
<div class="login-btn">

		<a href="<?php echo $authUrl; ?>"><img onclick="header.location:<?php echo $authUrl; ?>" src="images/sign-in-with-google.png" /></a>
	
	<div class="link-wrapper">
	<h4><u>News & Announcements</u></h4>
	<div class="autoScroller-container" style="height:140px;overflow:auto">
	<div id="vmarquee">
	<ul id="sub-link">
	<?php
	  $url = 'https://sites.google.com/a/infobeans.com/theinformant/announcements/posts.xml';
	  $feed = new SimplePie();
	  $feed->set_feed_url($url);	  
	  $feed->init();
	  foreach ($feed->get_items() as $item){
	  ?>
	  
	  <li><a href="<?php echo $item->get_link(); ?>" target="_blank"><?php echo $item->get_title();?></a></li>
	  <?php } ?>
	  
	  </ul>
	  </div>
	  </div>

	</div>
	</div>
	
</body>
</html>



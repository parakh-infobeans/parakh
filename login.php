<!doctype html>
<html>
<head>
<title>Rating System</title>
<link href="css/theme.css" rel="stylesheet" type="text/css" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css' />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
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
</head>
<body class="body-bg">
	<div class=""><img src="images/logo.png"></div>
	<div class="login-btn">
		<a href="<?php echo $authUrl; ?>"><img src="images/sign-in-with-google.png" /></a>
	</div>

</body>
</html>

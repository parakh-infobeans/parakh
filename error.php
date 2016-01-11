<?php 
$errors = array (
    1 => "You do not have a Lead/Manager assigned. Please contact the Administrator.",
    2 => "You do not have a Lead/Manager assigned. Please contact the Administrator.",
    3 => "Profile updated successfully.",
    4 => "Please fill the required field(s).",
    5 => "Request sent successfully.",
    6 => "Rating saved successfully.",
    7 => "User details updated successfully.",
    8 => "User added successfully.",
    9 => "Your account has not been activated. Please contact the Administrator.",
    10 => "Status updated successfully.",
    11 => "User already exists."
);
?>
<script type="text/javascript">
$(document).ready(function(){
    $('.close-alert').click(function(){
        $(this).parent().hide();
    });
});    
</script>
<?php
if(isset($_GET['chk'])) {
              $error_id = isset($_GET['chk']) ? (int)$_GET['chk'] : 0;
              if (($error_id != 0) && (array_key_exists($error_id, $errors))) {

	      $cls = "error-red";	
	      if($error_id == '3' || $error_id == '5' || $error_id == '6' || $error_id == '7' || $error_id == '8' || $error_id == '10'){
	      	$cls = "succes-green";
	      } 
?>
            <!--<div class="<?php //echo $cls; ?>" role="alert">
            <button type="button" class="close">x</button>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
<?php //echo $errors[$error_id]; ?>
            </div>-->
            
            <div class="<?php echo $cls; ?>" style="width:40%;margin-left: 28%;"><div class="close-alert"></div> <?php echo $errors[$error_id]; ?></div>

<?php } } ?>

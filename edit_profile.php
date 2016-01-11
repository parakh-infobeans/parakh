<?php
require_once 'config.php';
require_once 'class/rating.php';

$renderObj = new rating();
$record = $renderObj->edit_profile();
  
  if($record != 0) {
    //echo "<prE>";print_r($record);die; 
    $designation = ($record['designation'] != '' ? $record['designation'] : '');
    $name = ($record['google_name'] != '' ? $record['google_name'] : '');
    $email = ($record['google_email'] != '' ? $record['google_email'] : '');
    $mobile_number = ($record['mobile_number'] != '' ? $record['mobile_number'] : '');
  
  }
 
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //print_r($_POST);die; 
      $email = $_POST["google_email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_POST["google_email"] = '';
            $email=$_POST["google_email"];
        }
         extract($_POST); 
    if($_POST['designation'] == '')  {
           //header('Location: add_user.php?id='.$id.'&chk=4');     
            $_GET['chk'] = 4;
           
        }
        else{
        $keys = array_keys($_POST);
	$value = "'".implode("','",$_POST)."'";
	$key = implode(",",$keys);
        //echo "=====".$value."=====".$key;die;
	$record = $renderObj->update_profile($key,$value,$_POST, $id);
        //print_r($_SESSION['userinfo']);die;
        
	$_SESSION['userinfo']->google_name = $_POST['google_name'];
            if($record == true && $_SERVER['REQUEST_METHOD'] === 'POST') {
                header('Location: profile.php?chk=7');

            } else{
               //$_GET['chk'] = 11; 
               header('Location: profile.php');   
            }
         
        }
  }

require_once 'header.php';
?>
<!--<script type = "text/javascript" src = "js/jquery.validate.min.js" ></script>-->
<script type = "text/javascript" src = "js/validate_custom_method.js" ></script>
<script type = "text/javascript" src = "js/validation.js" ></script>
    <!-- Page Content -->    
    
   
<section>
    <div class="wrapper">
        <div class="mid-col-12">
            <?php require_once "error.php";?>
            <div class="profile-wrapper">
                <h2 class="edit-h2">Edit Profile</h2>
                <form class="form-horizontal" id ="edit_profile" role="form" method = "post" action = "">
                    <div class="edit-wrapper">
                            <div class="edit-lft">Name                            
                            </div>
                        <div class="edit-rht"><label><?php echo $name; ?></label><input type="hidden" name="google_name" value="<?php echo $name; ?>" placeholder="" class="edit-rht-input" readonly="true"/></div>
                    </div>
                    <div class="edit-wrapper">
                            <div class="edit-lft">Email                             
                            </div>
                            <div class="edit-rht"><label><?php echo $email?$email:''; ?></label><input type="hidden" id ="user_email" name="google_email" value="<?php echo $email?$email:''; ?>" placeholder="" class="edit-rht-input" readonly="true" /></div>
                    </div>
                    <div class="edit-wrapper">
                            <div class="edit-lft">Mobile No.</div>
                            <div class="edit-rht"><input type="text" name="mobile_number" value="<?php echo $mobile_number; ?>" placeholder="" class="edit-rht-input" maxlength = "10"/></div>
                    </div>
                    <div class="edit-wrapper">
                            <div class="edit-lft">Designation
                            <span class="red">*</span>
                            </div>
                            <div class="edit-rht"><input type="text" name="designation" value="<?php echo $designation; ?>" placeholder="" class="edit-rht-input" maxlength = "50"/></div>
                    </div>
                    <div class="edit-wrapper">
                            <div class="edit-lft">&nbsp;</div>
                            <div class="edit-rht"><input type="submit" value="Save Changes" name="" class="edit-submit-btn" /> 
                            <input type="button" value="Cancel" name="" class="edit-cancel-btn"  onClick="document.location.href='profile.php'"/></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
    
<script type = "text/javascript">
    $(document).ready(function() {

        /*$('#user_email').focusout(function() {
            var email = $('#user_email').val();
            $('#femail').find('div.error').remove();
            if (email != '') {
                if (validateemail(email)) {

                    $.post('ajax_request.php',
                            {
                                email: $('#user_email').val(),
                                'action' : 'check_email'
                            },
                    function(data, textstatus) {
                        //alert(data);
                        if (data == 0) {
                            //alert("innn");
                            $("#edit_profile").submit(function(e) {
                                 e.preventDefault();
                                 $('<div for=\'google_email\' class=\'error\'>This email address is already existsssssss</div>').insertAfter('#user_email');
                             });
                                $('<div for=\'google_email\' class=\'error\'>This email address is already existsaaaaaaaaa</div>').insertAfter('#user_email');
                        }
                        else {
                             $('#femail').find('div.error').remove();
                            //$("#edit_profile").submit();
                        }
                    });

                }
            }
});*/
        $('.logo-rht-txt').mouseover(function(){
		$('ul.dropdown').show();
	});
	$('.logo-rht-txt').mouseout(function(){
		$('ul.dropdown').hide();
	});
        
});
function validateemail(email) {
var emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
if (email == '') {
    return false;
}
if (!email.match(emailRegex)) {
    return false;
}
return true;
}

</script>
<?php
require_once 'footer.php';
?>

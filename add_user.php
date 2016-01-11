<?php
require_once 'config.php';
require_once 'class/rating.php';
$renderObj = new rating();
$id = $_GET['id'];
if($id && $_SERVER['REQUEST_METHOD'] != 'POST'){
    
 $record = $renderObj->add_user($key,$value,$_POST, $id);   
 //echo "<pre>";print_r($record);die;
 if(!empty($record[0])){
 extract($record[0]);
 }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //echo "<pre>";print_r($_POST);die;
     
    $email = $_POST["google_email"];
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_POST["google_email"] = '';
     }
     extract($_POST);	
    if(($_POST['google_name'] == '') || ($_POST['designation'] == '') || $_POST['google_email'] == '' ) {
           //header('Location: add_user.php?id='.$id.'&chk=4');     
            $_GET['chk'] = 4;
           
        }
        else{
        $keys = array_keys($_POST);
	$value = "'".implode("','",$_POST)."'";
	$key = implode(",",$keys);
        //echo "=====".$value."=====".$key;die;
	$record = $renderObj->add_user($key,$value,$_POST, $id);
	//print_r($record);die;
        if($record == true) {
            if($id){
	       header('Location: user_list_page.php?chk=7');
            }else {
               header('Location: user_list_page.php?chk=8');
            }
        }else{
           $_GET['chk'] = 11; 
           //header('Location: add_user.php?chk=11');   
        }
         
        }
    
    } 
require_once 'header.php';
?>
<!--<script type = "text/javascript" src = "js/jquery.validate.min.js" ></script>-->
<!--<script type = "text/javascript" src = "js/validate_custom_method.js" ></script>
<script type = "text/javascript" src = "js/validation.js" ></script>-->
    <!-- Page Content -->

    
<section>
      <div class="wrapper">
          <div class="mid-col-12">
              <?php require_once "error.php";?>
              <div class="profile-wrapper">                  
                    <?php if(!empty($id)) { ?>
                    <h2 class="edit-h2"><?php echo 'Edit User'; ?></h2>
                    <?php } else { ?>
                    <h2 class="edit-h2"><?php echo $set_page_title;?></h2>
                    <?php } ?>
                  <form class="form-horizontal" id ="edit_profile" role="form" method = "post" action = "">
                      <div class="edit-wrapper">
                              <div class="edit-lft">Name
                              <span class="red">*</span>
                              </div>
                              <div class="edit-rht"><input type="text" name="google_name" value="<?php echo $google_name?$google_name:'' ?>" placeholder="" class="edit-rht-input" /></div>
                      </div>
                      <div class="edit-wrapper">
                              <div class="edit-lft">Email
                              <span class="red">*</span>
                              </div>
                              <div class="edit-rht"><input type="text" id ="user_email" name="google_email" value="<?php echo $google_email?$google_email:'' ?>" placeholder="" class="edit-rht-input" /></div>
                      </div>
                      <div class="edit-wrapper">
                              <div class="edit-lft">Mobile No.</div>
                              <div class="edit-rht"><input type="text" name="mobile_number" value="<?php echo $mobile_number?$mobile_number:'' ?>" placeholder="" class="edit-rht-input" maxlength = "10"/></div>
                      </div>
                      <div class="edit-wrapper">
                              <div class="edit-lft">Designation
                              <span class="red">*</span>
                              </div>
                              <div class="edit-rht"><input type="text" name="designation" value="<?php echo $designation?$designation:'' ?>" placeholder="" class="edit-rht-input" maxlength = "50"/></div>
                              <input class="form-control" value="9" name = "role_id" type="hidden">
                              <input class="form-control" value="1" name = "status" type="hidden">
                      </div>
                      <div class="edit-wrapper">
                            <div class="edit-lft">&nbsp;</div>
                            <div class="edit-rht"><input type="submit" value="Save Changes" name="" class="edit-submit-btn" /> 
                            <input type="button" value="Cancel" name="" class="edit-cancel-btn"  onClick="document.location.href='user_list_page.php'"/></div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>  
    
    
    
    
    
    
    
    
<!--   <div class="mid-col-12"> 
    <div class="profile-wrapper" style="min-height: 60%">

        
   <div class="col-xs-12 toppad" >
        <?php require_once "error.php";?>
          <div class="panel panel-info">
            <div class="panel-heading">
                <?php if(!empty($id)) { ?>
                    <h3 class="panel-title"><?php echo 'Edit User'; ?></h3>
                <?php } else { ?>
                    <h3 class="panel-title"><?php echo $set_page_title;?></h3>
                <?php } ?>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
		    <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle">
		    <!-- <img src="//placehold.it/100" class="avatar img-circle" alt="avatar"> 
		     <h6>Upload a different photo...</h6>
		    <input class="form-control" type="file">
		</div> 
                <div class=" col-md-9"> 
                
                
        <form class="form-horizontal" id ="edit_profile" role="form" method = "post" action = "">
          <div class="profile-wrapper-report">
            <label class="pforile-lft-row-col_20">Name </label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $google_name?$google_name:'' ?>" name = "google_name" type="text">
            </div>
          </div>
           <div class="form-group">
            <label class="col-lg-3 control-label">Company:</label>
            <div class="col-lg-8">
              <input class="form-control" value="" type="text">
            </div>
          </div> 
          <div class="profile-wrapper-report" id = "femail">
            <label class="pforile-lft-row-col_20">Email </label>
            <div class="col-lg-8">
              <input class="form-control user_email" id ="user_email" value="<?php echo $google_email?$google_email:'' ?>" name = "google_email" type="text">
            </div>
          </div>
          
          <div class="profile-wrapper-report">
            <label class="pforile-lft-row-col_20">Mobile No. </label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $mobile_number?  $mobile_number:'' ?>" name = "mobile_number" type="text" maxlength = "10">
            </div>
          </div>
          
          <div class="profile-wrapper-report">
            <label class="pforile-lft-row-col_20">Designation </label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $designation?$designation:'' ?>" name = "designation" type="text">
              <input class="form-control" value="9" name = "role_id" type="hidden">
              <input class="form-control" value="1" name = "status" type="hidden">
            </div>
          </div>
          
          <div class="profile-wrapper-report">
            <label class="pforile-lft-row-col_20"></label>
            <div class="col-lg-8">
              <input class="btn btn-primary" value="Save Changes" type="submit">
              <span></span>
               <input class="btn btn-default" value="Cancel" type="reset" onClick="document.location.href='user_list_page.php'">
            </div>
          </div>
        </form>
                
                </div>
              </div>
            </div>
                 
          </div>
        </div>
      </div>
    </div>-->
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

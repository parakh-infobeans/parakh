<?php
require 'class/rating.php';
$renderObj = new rating();
$record = $renderObj->edit_user($_GET["id"]);


require_once 'header.php';
?>
<script type = "text/javascript" src = "js/jquery.validate.min.js" ></script>
<script type = "text/javascript" src = "js/validate_custom_method.js" ></script>
<script type = "text/javascript" src = "js/validation.js" ></script>
    <!-- Page Content -->
    <div class="container">
    <div class="container">
      <div class="row">
        <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > -->
        
   <div class="col-xs-12 toppad" >
        <?php require_once "error.php";?>
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $set_page_title;?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
               <!-- <div class="col-md-3 col-lg-3 " align="center"> 
		    <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle">
		    <!-- <img src="//placehold.it/100" class="avatar img-circle" alt="avatar"> -->
		    <!-- <h6>Upload a different photo...</h6>
		    <input class="form-control" type="file">
		</div> -->
                <div class=" col-md-9 col-lg-9 "> 
                
                
        <form class="form-horizontal" id ="edit_profile" role="form" method = "post" action = "">
          <div class="form-group">
            <label class="col-lg-3 control-label">Name </label>
            <div class="col-lg-8">
              <input class="form-control" value="" name = "google_name" type="text">
            </div>
          </div>
          <!-- <div class="form-group">
            <label class="col-lg-3 control-label">Company:</label>
            <div class="col-lg-8">
              <input class="form-control" value="" type="text">
            </div>
          </div> -->
          <div class="form-group" id = "femail">
            <label class="col-lg-3 control-label">Email </label>
            <div class="col-lg-8">
              <input class="form-control user_email" id ="user_email" value="" name = "google_email" type="text">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Mobile Number </label>
            <div class="col-lg-8">
              <input class="form-control" value="" name = "mobile_number" type="text" maxlength = "10">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Designation </label>
            <div class="col-lg-8">
              <input class="form-control" value="" name = "designation" type="text">
              <input class="form-control" value="9" name = "role_id" type="hidden">
              <input class="form-control" value="1" name = "status" type="hidden">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
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
    </div>
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
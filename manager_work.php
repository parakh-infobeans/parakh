<?php
require_once 'config.php';
require_once 'class/rating.php';
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
$all_member = $renderObj->get_all_member($user_id);
//echo "<pre>";print_r($all_member);exit;
if(empty($all_member)) {
    header('Location: profile.php?chk=2');
}
require_once 'header.php';
?>
<style>
    .button {
      display: inline-block;
      position: relative;
      width: 45%;
      height: 24px;
      line-height: 24px;
      border-radius: 2px;
      font-size: 0.9em;
      background-color: #fff;
      color: #646464;
    }
     .button.narrow {
      /*width: 60px;*/
      height:auto;
    }
    
    .button.grey {
      background-color: #eee;
    }
    
    .center {
      text-align: center;
    }
    
    .label {
      padding: 0 16px;
    }
    
    .label-blue {
      color: #4285f4; 
    }
    
    .label-red {
      color: #d23f31; 
    }
    .radio_remove {
        clip: rect(0px, 0px, 0px, 0px);
        pointer-events: none;
        position: absolute;
    }
    
       .btn.active, .btn:active {
	background-color: red;
	font-weight: bold;
	color: white;
    	outline: 0 none;
   }
   
    .back, .back .btn:active{
       background: transparent !important;
       box-shadow: 40px 40px 40px rgba(0, 0, 0, 0.125) inset !important;
       outline: 0 none !important;
    }
</style>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type = "text/javascript" src = "js/jquery.validate.min.js" ></script>
<script type = "text/javascript" src = "js/validate_custom_method.js" ></script>
<script type = "text/javascript" src = "js/validation.js" ></script>
    <!-- Page Content -->
    <div class="container">

    
    
    <div class="container">
      <div class="row">
        <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > -->
        
   <div class="col-xs-12 toppad" >
       <?php if(isset($_GET['chk'])) {
              $error_id = isset($_GET['chk']) ? (int)$_GET['chk'] : 0;
              if (($error_id != 0) && (array_key_exists($error_id, $errors))) {
        ?>
            <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $errors[$error_id]; ?>
            </div>
              <?php } } ?>
   
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
                
                
        <form class="form-horizontal" role="form" method = "post" action = "save_manager_work.php" id="manager_rating">
          
          <?php if(isset($all_member) && !empty($all_member)) { ?>
            <div class="form-group">
            <label class="col-lg-3 control-label">Team Member:</label>
	      <div class="col-lg-8">
              <div class="ui-select">
                <select id="team_member" style="" class="form-control font_black" name = "team_member">
                <option selected="selected" value = "">Please Select</option>
                <?php foreach($all_member as $key=>$val) { ?>
		      <option value = "<?php echo $val['user_id']; ?>"><?php echo $val['user_name']; ?></option>
		<?php } ?>
                </select>
              </div>
	      </div>
	    </div>
	    <?php } ?>
            
            <!--<div class="form-group">
	    <label class="col-lg-3 control-label">Rating :</label>
	     <div class="col-lg-8">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary radio_inline" style = "border-radius: 4px !important;">
                  <input type="radio" name="rating" id="option2" value ="1" autocomplete="off"> Rating +1
                </label>
                <label class="btn btn-primary radio-inline radio-inline_left">
                    <input type="radio" name="rating" id="option3" value="0" autocomplete="off"> Rating -1
                </label>
                <label class="btn btn-primary active radio-inline radio-inline_left">
                  <input type="radio" name="rating" id="option1" value="2" autocomplete="off" checked> None
                </label>
            </div>
                 </div>
            </div>-->
            
             <div class="form-group">
	    <label class="col-lg-3 control-label">Rating:</label>
	     <div class="col-lg-8">
<!--            <div class="btn-group" data-toggle="buttons">-->
                <label style="border-radius: 4px !important;" class="radio_chk btn active radio_inline button raised grey narrow">
                  <input type="radio" checked="checked" autocomplete="off" class="radio_remove" value="1" id="option1" name="rating"> +1
                </label>
		<label style="border-radius: 4px !important;" class="radio_chk btn radio_inline button raised grey narrow">
                  <input type="radio"  autocomplete="off" class="radio_remove" value="0" id="option2" name="rating"> -1
                </label>
<!--            </div>-->
                 </div>
            </div>
            
<!--            <div class="form-group">
	    <label class="col-lg-3 control-label">Rating +1:</label>
	     <div class="col-lg-8">
            <div class="btn-group" data-toggle="buttons">
                <label style="border-radius: 4px !important;" class="radio_chk btn active radio_inline button raised grey narrow">
                  <input type="radio" checked="checked" autocomplete="off" class="radio_remove" value="1" id="option1" name="rating"> +1
                </label>
            </div>
                 </div>
            </div>
            <div class="form-group">
	    <label class="col-lg-3 control-label">Rating -1:</label>
	     <div class="col-lg-8">
            <div class="btn-group" data-toggle="buttons">
                <label style="border-radius: 4px !important;" class="radio_chk btn radio_inline button raised grey narrow">
                  <input type="radio" autocomplete="off" class="radio_remove" value="0" id="option2" name="rating"> -1
                </label>
            </div>
                 </div>
            </div>-->
<!--            <div class="form-group">
	    <label class="col-lg-3 control-label">None:</label>
	     <div class="col-lg-8">
            <div class="btn-group" data-toggle="buttons">
                <label style="border-radius: 4px !important;" class="radio_chk btn radio_inline button raised grey narrow">
                  <input type="radio" autocomplete="off" class="radio_remove" value="2" id="option3" name="rating"> None
                </label>
            </div>
                 </div>
            </div>-->
            
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Title :</label>
            <div class="col-lg-8">
              <input class="form-control" value="" name = "work_title" type="text">
            </div>
          </div>
          
<!--          <div class="form-group">
            <label class="col-lg-3 control-label">Description :</label>
            <div class="col-lg-8">
              <textarea class="form-control"  name = "work_desc" rows="5"></textarea>
            </div>commnet_text
          </div>-->
            
          <div class="form-group">
                <label class="col-md-3 control-label">Date of work:</label>
<!--                <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>-->
                
                <div class='col-lg-8'>
                    <input type='text' class="form-control" id='datetimepicker4' name='work_date'/>
                </div>
            </div>
            
          <input class="form-control" value="<?php echo $_SESSION['userinfo']->id ?>" name = "user_id" type="hidden">
          
	    
	    
	    <!--<div class="form-group">
	    <label class="col-lg-3 control-label">Rating :</label>
	     <div class="col-lg-8">
	      <label class="radio-inline">
		<input type="radio" name="rating" value = "1"> +1
	      </label>
	      <label class="radio-inline">
		<input type="radio" name="rating" value = "0"> -1
	      </label>
	    </div>
	    </div>-->
            
            <div class="form-group">
            <label class="col-lg-3 control-label">Reason :</label>
            <div class="col-lg-8">
              <textarea class="form-control"  name = "comment" rows="5" id="reason"></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" name="save" value="Save" type="submit" id="save">
              <span></span>
              <input class="btn btn-primary" name="save" value="Submit" type="submit" id="submit">
              <!--a href="" class="btn btn-default back" role="button">Back</a-->
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
<?php
require_once 'footer.php';//}else{
    //header('Location: index.php');
//}
?>         
<script type="text/javascript">
            $(document).ready(
  
  /* This is the function that will get executed after the DOM is fully loaded */
  function () {
    $( "#datetimepicker4" ).datepicker({
      changeMonth: true,//this option for allowing user to select month
      changeYear: true, //this option for allowing user to select from year range
      maxDate: new Date()
    });
    
    var reason = $("#reason").val();
    
            if(reason == ''){
               //alert('hello');
                $('#submit').attr('disabled',true);
            }else{
                $('#submit').attr('disabled',false);
            }
        
        $('#reason').focusout(function(){

            var reason = $("#reason").val();
            if(reason.trim() != ''){
                $('#submit').attr('disabled', false);
            }else{
                $('#submit').attr('disabled', true);
            }

        })
        
        //$('.sendButton').attr('disabled',true);
            $('#reason').keyup(function(){
               
                if($(this).val().trim() ==''){
                    $('#submit').attr('disabled', true);
                }else{
                    $('#submit').attr('disabled',false);
                }
        })
        
       $(".radio_chk input[name='rating']").click(function(){
            var chk_radio = $(this).val();
            var chk_radio_id = $(this).attr('id');
            $('.radio_chk').removeClass('active');
            $('#'+chk_radio_id).parent().addClass('active');
                //$('#select-table > .roomNumber').attr('enabled',false);
        });
          
  }
 

);
</script>

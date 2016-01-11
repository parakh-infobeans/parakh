<?php
require_once 'config.php';
require_once 'class/rating.php';
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
$lead_list = $renderObj->get_all_lead($user_id);
if($lead_list == 0) {
    header('Location: profile.php?chk=1');
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
                <div class=" col-md-9 col-lg-9 "> 
                
                
        <form class="form-horizontal" role="form" method = "post" action = "save_manager_work_rating.php" id="manager_work">
          
            <?php if(isset($lead_list) && !empty($lead_list)) { ?>
            <div class="form-group">
            <label class="col-lg-3 control-label">To</label>
	      <div class="col-lg-8">
              <div class="ui-select">
                <select id="team_member" class="form-control" name = "lead_id">
                <?php foreach($lead_list as $key=>$val) { 
                        if($val['role_name'] == "Lead") {
                ?>
                      <option value = "<?php echo $val['manager_id']; ?>" selected="selected"><?php echo $val['manager_name'].":".$val['role_name']; ?></option>
                <?php }  else { ?>
		      <option value = "<?php echo $val['manager_id']; ?>"><?php echo $val['manager_name'].":".$val['role_name']; ?></option>
		<?php } } ?>
                </select>
              </div>
	      </div>
	    </div>
	    <?php } ?>
            
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
            
        
            <div class="form-group">
                <label class="col-md-3 control-label">Work Date:</label>
               
                <div class='col-lg-8'>
                    <input type='text' class="form-control" id='datetimepicker4' name='work_date' autocomplete="off" />
                </div>
            </div>
          
            <div class="form-group">
            <label class="col-lg-3 control-label">Title :</label>
            <div class="col-lg-8">
              <input class="form-control" value="" name = "work_title" type="text">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Reason :</label>
            <div class="col-lg-8">
              <textarea class="form-control"  name = "work_desc" rows="5"></textarea>
            </div>
          </div>
          <input class="form-control" value="<?php echo $_SESSION['userinfo']->id ?>" name = "user_id" type="hidden">
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Submit" type="submit">
              <span></span>
             <!--input class="btn btn-default" value="Cancel" type="reset" onClick="window.location='work_list_tab1.php'"--> 
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

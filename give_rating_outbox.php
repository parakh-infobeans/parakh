<?php
require_once 'config.php';
require_once 'class/rating.php';
//$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
$all_member = $renderObj->get_request($_GET["id"]);
$renderObj->unread_request($_GET["id"]);
$get_comment = $renderObj->get_comment_detail($_GET["id"]);
$get_rating = $renderObj->get_rating_detail($_GET["id"]);
if(!empty($get_comment)) {
    $comment_text = $get_comment['comment_text'];
}
else {
    $comment_text = '';
}

if(!empty($get_rating)) {
    $rating_chk = $get_rating['rating'];
}
else {
    $default_rate = $renderObj->get_work_details($all_member[0]['work_id']);
    if(isset($default_rate['request_for'])) {
     $rating_chk = $default_rate['request_for'];   
    }
    else {
     $rating_chk = 'no';   
    }
}
//echo $rating_chk;
//echo "<pre>";print_r($all_member);exit;

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
    
/*        .btn.active, .btn:active {
       background-image: none;
   box-shadow: 40px 40px 40px rgba(0, 0, 0, 0.125) inset;
    outline: 0 none;
   }*/
   
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
   
   .TM_name{
       
       width: 62% !important;
   }
</style>
    <!-- Page Content -->
    <div class="container">

    
    
    <div class="container">
      <div class="row">
        <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > -->
        
   <div class="col-xs-12 toppad" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $set_page_title; ?></h3>
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
                
          
                    <form class="form-horizontal" role="form" method = "post" action = "save_emp_rating_outbox.php">
            <?php foreach ($all_member as $key=>$val) { 
                //echo $val['work_id'];exit('Priyesh');
	    $work_title = $renderObj->get_work_details($val['work_id']);
            //$emp_name = $renderObj->get_profile($val['from_id']);
            
            $name = ($work_title['google_name'] != '' ? $work_title['google_name'] : 'N/A');
            $title = ($work_title['title'] != '' ? $work_title['title'] : 'N/A');
            $desc = ($work_title['description'] != '' ? $work_title['description'] : 'N/A');
            $work_date = ($work_title['work_date'] != '' ? $work_title['work_date'] : 'N/A');
            $workdate = date("m-d-Y", strtotime($work_date));
	    $request_for = $work_title['request_for'];
            
	    if($workdate == '0000-00-00 00:00:00'){
	   	$workdate = "N/A";
	    }else{	
            	$workdate = date("m-d-Y", strtotime($workdate));
	    }            
	   // $id = $val['id'];
	  
	  ?>    
          <div class="form-group">
            <label class="col-lg-3 control-label">Team Member :</label>
            <div class="col-lg-8">
                <label class="col-lg-3 control-label TM_name" style="text-align: left; font-weight: normal;"> <?php echo $name; ?> </label> 
              <!--<input class="form-control" value="" name = "work_title" type="text">-->
            </div>
          </div>
                        
          <div class="form-group">
            <label class="col-lg-3 control-label">Title :</label>
            <div class="col-lg-8">
                <label class="col-lg-3 control-label" style="text-align: left; font-weight: normal;"> <?php echo $title; ?> </label> 
              <!--<input class="form-control" value="" name = "work_title" type="text">-->
            </div>
          </div>
          
<!--          <div class="form-group">
            <label class="col-lg-3 control-label">Work Description :</label>
            <div class="col-lg-8">
              <label class="col-lg-3 control-label" style="text-align: left; font-weight: normal;"> <?php echo $desc; ?> </label>
              <textarea class="form-control"  name = "work_desc" rows="5"></textarea>
            </div>
          </div>
                        -->
          <div class="form-group">
            <label class="col-lg-3 control-label">Date of work :</label>
            <div class="col-lg-8">
              <label class="col-lg-3 control-label" style="text-align: left; font-weight: normal;"> <?php echo $workdate; ?> </label>
              <!--<textarea class="form-control"  name = "work_desc" rows="5"></textarea>-->
            </div>
          </div>
          <input class="form-control" value="<?php echo $val['work_id'] ?>" name = "work_id" type="hidden">
          <input class="form-control" value="<?php echo $val['to_id'] ?>" name = "team_member" type="hidden">
            <?php } ?>
          <input class="form-control" value="<?php echo $_SESSION['userinfo']->id ?>" name = "user_id" type="hidden">
          <input class="form-control" value="<?php echo $_GET["id"] ?>" name = "request_id" type="hidden">
          
          
	    <?php //if(isset($all_member) && !empty($all_member)) { ?>
            <!--<div class="form-group">
            <label class="col-lg-3 control-label">Team Member</label>
	      <div class="col-lg-8">
              <div class="ui-select">
                <select id="team_member" class="form-control" name = "team_member">
                <option selected="selected" value = "-1">Please Select</option>
                <?php //foreach($all_member as $key=>$val) { ?>
		      <option value = "<?php //echo $val['user_id']; ?>"><?php //echo $val['user_name']; ?></option>
		<?php //} ?>
                </select>
              </div>
	      </div>
	    </div>-->
	    <?php //} ?>
	    
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
<!--            <div class="form-group">
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
                <?php
                $chked_0 = $chked_1 = '';
		if($request_for == '0'){
			$chked_0 = 'checked="checked"';	
			$cls_0 = "active";		
		}else{
			$chked_1 = 'checked="checked"';	
			$cls_1 = "active";		
		} ?>
<!--            <div class="btn-group" data-toggle="buttons">-->
                <label style="border-radius: 4px !important;" class="radio_chk btn  <?php echo $cls_1; ?> radio_inline button raised grey narrow">
                  <input type="radio"  <?php echo $chked_1; ?> autocomplete="off" class="radio_remove" value="1" id="option1" name="rating"> +1
                </label>
		<label style="border-radius: 4px !important;" class="radio_chk btn  <?php echo $cls_0; ?> radio_inline button raised grey narrow">
                  <input type="radio"  <?php echo $chked_0; ?>  autocomplete="off" class="radio_remove" value="0" id="option2" name="rating"> -1
                </label>
<!--            </div>-->
                 </div>
            </div>
            
<!--            <div class="form-group">
	    <label class="col-lg-3 control-label">Rating +1:</label>
	     <div class="col-lg-8">
            <div class="btn-group" data-toggle="buttons">
                <label style="border-radius: 4px !important;" class="radio_chk btn active radio_inline button raised grey narrow">
                    <?php if($rating_chk == 'no') { ?>
                    <input type="radio" checked="checked" autocomplete="off" class="radio_remove" value="1" id="option1" name="rating"> +1
                    <?php } else { ?>
                    <input type="radio" <?php if($rating_chk == '1') echo 'checked="checked"'; ?> autocomplete="off" class="radio_remove" value="1" id="option1" name="rating"> +1
                    <?php } ?>
                </label>
            </div>
                 </div>
            </div>
            <div class="form-group">
	    <label class="col-lg-3 control-label">Rating -1:</label>
	     <div class="col-lg-8">
            <div class="btn-group" data-toggle="buttons">
                <label style="border-radius: 4px !important;" class="radio_chk btn radio_inline button raised grey narrow">
                  <input type="radio" <?php if($rating_chk == '0') echo 'checked="checked"'; ?>  autocomplete="off" class="radio_remove" value="0" id="option0" name="rating"> -1
                </label>
            </div>
                 </div>
            </div>-->
<!--            <div class="form-group">
	    <label class="col-lg-3 control-label">None:</label>
	     <div class="col-lg-8">
            <div class="btn-group" data-toggle="buttons">
                <label style="border-radius: 4px !important;" class="radio_chk btn radio_inline button raised grey narrow">
                  <input type="radio" <?php //if($rating_chk == 2) echo 'checked="checked"'; ?> autocomplete="off" class="radio_remove" value="2" id="option2" name="rating"> None
                </label>
            </div>
                 </div>
            </div>-->
	    
	    
	    <div class="form-group">
            <label class="col-lg-3 control-label">Reason :</label>
            <div class="col-lg-8">
              <textarea class="form-control" name = "comment" rows="5" id="reason"><?php echo $comment_text; ?></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" name="save" value="Save" type="submit" id="save">
              <span></span>
              <input class="btn btn-primary" name="save" value="Submit" type="submit" id="submit">
              <a href="<?php echo basename($_SERVER['HTTP_REFERER']);?>" class="btn btn-default back" role="button">Back</a>
            </div>
          </div>
        </form>
                
                </div>
              </div>
            </div>
                 <!--<div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>-->
            
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
    function () {
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
        
        $('#reason').keyup(function(){
                
                if($(this).val().trim() ==''){
                    $('#submit').attr('disabled', true);
                }else{
                    $('#submit').attr('disabled',false);
                }
        })
        
        var radio_check_value = <?php echo $rating_chk;?>;
        if(radio_check_value === 0){
            
            radio_check_value =2;
        }else{
            
            radio_check_value =1;
        }
        $('.radio_chk').removeClass('active');
        $('#option'+radio_check_value).parent().addClass('active');
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

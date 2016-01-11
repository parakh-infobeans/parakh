<?php
require_once 'config.php';
require_once 'class/rating.php';
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
//$renderObj->sample_get_book_details_id(1);
$session_val = $renderObj->check_session();

if($session_val == 1){

$record = $renderObj->edit_work($_GET["id"]);
$record1 = $renderObj->get_all_lead($_SESSION['userinfo']->id);
  
  if($record != 0) {
    
    $title = ($record['title'] != '' ? $record['title'] : '');
    $description = ($record['description'] != '' ? $record['description'] : '');
    //$mobile_number = ($record['mobile_number'] != '' ? $record['mobile_number'] : '');
    
    
  
  }
require_once 'header.php';
?>
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
                
                
        <form class="form-horizontal" role="form" method = "post" action = "update_work.php">
          <div class="form-group">
            <label class="col-lg-3 control-label">Title :</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $title; ?>" name = "work_title" type="text">
            </div>
          </div>
          
          <!-- <div class="form-group">
            <label class="col-lg-3 control-label">Company:</label>
            <div class="col-lg-8">
              <input class="form-control" value="" type="text">
            </div>
          </div> -->
          <div class="form-group">
            <label class="col-lg-3 control-label">Description :</label>
            <div class="col-lg-8">
              <textarea class="form-control"  name = "work_desc" rows="5"><?php echo $description?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Requested To : </label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="" class="form-control" name = "request_to">
                <option selected="selected" value = "-1">Please Select</option>
                <?php foreach ($record1 as $key=>$val) { ?>
                  <option value="<?php echo $val['manager_id'];?> "><?php echo $val['manager_name'];?></option>;
                  <?php 
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <input class="form-control" value="<?php echo $_SESSION['userinfo']->id ?>" name = "user_id" type="hidden">
          <input class="form-control" value="<?php echo $_GET["id"] ?>" name = "id" type="hidden">
          <!--<div class="form-group">
            <label class="col-lg-3 control-label">Assigned :</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php// echo $mobile_number; ?>" name = "assigned_to" type="text">
            </div>
          </div>-->
          <!-- <div class="form-group">
            <label class="col-lg-3 control-label">Time Zone:</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="user_time_zone" class="form-control">
                  <option value="Hawaii">(GMT-10:00) Hawaii</option>
                  <option value="Alaska">(GMT-09:00) Alaska</option>
                  <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                  <option value="Arizona">(GMT-07:00) Arizona</option>
                  <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                  <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                  <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                  <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Username:</label>
            <div class="col-md-8">
              <input class="form-control" value="janeuser" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Password:</label>
            <div class="col-md-8">
              <input class="form-control" value="11111122333" type="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Confirm password:</label>
            <div class="col-md-8">
              <input class="form-control" value="11111122333" type="password">
            </div>
          </div>-->
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Save Changes" type="submit">
              <span></span>
              <!-- <input class="btn btn-default" value="Cancel" type="reset"> -->
              <a href="work_list.php" class="btn btn-default" role="button">Cancel</a>
            </div>
          </div>
        </form>
                
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
<?php
require_once 'footer.php';}else{
    header('Location: index.php');
}
?>
<?php
require_once 'config.php';
require_once 'class/rating.php';
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
$all_member = $renderObj->get_all_member($user_id);
//echo "<pre>";print_r($all_member);exit;

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
              <h3 class="panel-title"><?php //echo $name; ?></h3>
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
                
                
        <form class="form-horizontal" role="form" method = "post" action = "save_manager_work.php">
          <div class="form-group">
            <label class="col-lg-3 control-label">Title :</label>
            <div class="col-lg-8">
              <input class="form-control" value="" name = "work_title" type="text">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Description :</label>
            <div class="col-lg-8">
              <textarea class="form-control"  name = "work_desc" rows="5"></textarea>
            </div>
          </div>
          <input class="form-control" value="<?php echo $_SESSION['userinfo']->id ?>" name = "user_id" type="hidden">
          
	    <?php if(isset($all_member) && !empty($all_member)) { ?>
            <div class="form-group">
            <label class="col-lg-3 control-label">Team Member</label>
	      <div class="col-lg-8">
              <div class="ui-select">
                <select id="team_member" class="form-control" name = "team_member">
                <option selected="selected" value = "-1">Please Select</option>
                <?php foreach($all_member as $key=>$val) { ?>
		      <option value = "<?php echo $val['user_id']; ?>"><?php echo $val['user_name']; ?></option>
		<?php } ?>
                </select>
              </div>
	      </div>
	    </div>
	    <?php } ?>
	    
	    <div class="form-group">
	    <label class="col-lg-3 control-label">Rating :</label>
	     <div class="col-lg-8">
	      <label class="radio-inline">
		<input type="radio" name="rating" value = "1"> +1
	      </label>
	      <label class="radio-inline">
		<input type="radio" name="rating" value = "0"> -1
	      </label>
	    </div>
	    </div>
	    
	    
	    <div class="form-group">
            <label class="col-lg-3 control-label">Comment :</label>
            <div class="col-lg-8">
              <textarea class="form-control"  name = "comment" rows="5"></textarea>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary" value="Save Changes" type="submit">
              <span></span>
              <!-- <input class="btn btn-default" value="Cancel" type="reset"> -->
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
require_once 'footer.php';//}else{
    //header('Location: index.php');
//}
?>
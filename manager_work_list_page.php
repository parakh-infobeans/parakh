<?php
require_once 'config.php';
require_once 'class/rating.php';
$renderObj = new rating();
$page_number = (int) (!isset($_GET['page']) ? 1 :$_GET['page']);
//$renderObj->sample_get_book_details_id(1);
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
//$record = $renderObj->get_manager_work_list($user_id);
$record = $renderObj->pagination("get_manager_work_list_paginate",$page_number,$user_id);
$team_member = $renderObj->get_all_member($user_id);
$renderObj->clear_unread_count();

/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$page_number = (int) (!isset($_GET['page']) ? 1 :$_GET['page']);
        $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
	//echo "<pre>";print_r($_POST);die;
        $record = $renderObj->pagination("get_manager_work_list_paginate",$page_number,$user_id,$_POST);
              
    echo "<pre>";print_r($record);die("=====");
    }*/

//$status = $renderObj->get_status();
//echo "<pre>";print_r($team_member);die;
require_once 'header.php';
?>
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
            <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $errors[$error_id]; ?>
            </div>
              <?php } } ?> 
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title"><?php echo $set_page_title;?></h3></div>
<div class="panel-body">
   
     <div class = "spacer40"></div>

   <!-- <form class="form-inline" action ="" method ="post" >

        
        <div class="form-group">
            <label class="col-lg-3 control-label">Status</label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="" class="form-control" name = "status">
                <option selected="selected" value = "">Please Select</option>
                  <option value="0">Pending</option>;
                  <option value="1">Deny</option>;
                  <option value="2">Accepted</option>;
                </select>
              </div>
            </div>
          </div>
        
        <div class="form-group">
            <label class="col-lg-3 control-label">Team Member </label>
            <div class="col-lg-8">
              <div class="ui-select">
                <select id="" class="form-control" name = "request_from">
                <option selected="selected" value = "">Please Select</option>
                <?php //foreach ($team_member as $key=>$val) { ?>
                  <option value="<?php //echo $val['user_id'];?> "><?php //echo $val['user_name'];?></option>;
                  <?php 
                 // }
                  ?>
                </select>
              </div>
            </div>
          </div>
        
        <!--<div class="form-group">

            <label class="sr-only" for="inputEmail">Email</label>

            <input type="email" class="form-control" id="inputEmail" placeholder="Email">

        </div>

        <div class="form-group">

            <label class="sr-only" for="inputPassword">Password</label>

            <input type="password" class="form-control" id="inputPassword" placeholder="Password">

        </div>-->

        <!--<div class="checkbox">

            <label><input type="checkbox"> Remember me</label>

        </div> -->

        <!--<button type="submit" class="btn btn-primary">Login</button>

    </form>-->

<div class = "spacer40"></div> 

   <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Date</th>
            <th>From</th>
            <th>Requested For</th>
<!--            <th>Work Date</th>-->
            <th>Title</th>
            
            <!--<th>To</th>-->
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
	  <?php //echo "<pre>";print_r($record[0]);die;
            if(!empty($record[0])) { 
            foreach ($record[0] as $key=>$val) { 
	    $id = $val['id'];
            if($val['read_status'] == 0) {
                $class = "active";
            }
            else {
                $class = "";
            }
	  
	  ?>
            
          <tr class = "<?php echo $class; ?>">
            <td><?php echo date("d-M-Y", strtotime($val['req_date']));?></td>
             <td><?php echo $val['from_name'];?></td>
            <td><?php if($val['rating'] == ''){ echo 'NA';}else if($val['rating']== 1){ echo '+1';}else if($val['rating']== 0){ echo'-1'; } ?></td>
<!--        <td><?php // echo date("d-M-Y", strtotime($val['work_date']));?></td>-->
            <td><?php echo ($val['title'] != '' ? $val['title'] : 'NA');?></td>
            <!--<td><?php //echo $val['to_name'];?></td>-->
            <td><?php 
                        if (array_key_exists($val['status'],$status_flag)) {
                        echo $status_flag[$val['status']];
                        $action_stat = $status_flag[$val['status']];
                        }
                        else {
                            echo "NA";
                        }
                ?>
            </td>
            <td data-title="Actions" class="actions">
                <a title="View Detail" href="view_request.php?id=<?php echo $id;?>">
		<!--<i class="icon-large icon-heart">View</i> -->
                    <span class="glyphicon glyphicon-eye-open"></span>
		</a>
            <?php $pending = constant("Pending");
                    if($action_stat == $pending) { ?>
                &nbsp;
                <a title="Give Rating" href="give_rating.php?id=<?php echo $id;?>">
		<i class="glyphicon glyphicon-star "></i>
		</a>
                &nbsp;
                <a title="Decline" href="decline.php?id=<?php echo $id;?>">
		<i class="glyphicon glyphicon-remove"></i>
		</a>
                
            <?php } ?>
            </td>
          </tr>
         <?php }
            }
            else { 
         ?>
          <tr>
              <td colspan = "6"> No Record Found.</td>
          </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>
        </div>
       
       
            <div class="panel-footer clearfix">
                <div class="pull-right">
                    <?php require 'pagination_html.php';?>
                </div>
            </div>
       
   </div>
   
        </div>
      </div>
    </div>
<?php
require_once 'footer.php';
?>

<?php
require_once 'config.php';
require_once 'class/rating.php';

$renderObj = new rating();
//$renderObj->sample_get_book_details_id(1);
$session_val = $renderObj->check_session();
//echo "<pre>";print_r($status_flag);exit;
$limit = 20;                                //how many items to show per page
$page = $_GET["page"];

if($session_val == 1){
    
$user_count = $renderObj->get_work_count_manager($_SESSION['userinfo']->id);
//echo $user_count;exit('hello');
    
    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = 0;                             //if no page var is given, set start to 
    
    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
    
    $prev = $page - 1;                          //previous page is page - 1
    $next = $page + 1;                          //next page is page + 1
    $lastpage = ceil($user_count/$limit);      //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                      //last page minus 1
//echo $prev." -- ".$next;exit('Priyesh');
    $pagination = "";
    if($lastpage > 1)
    {   
        //$pagination .= "<div class=\"pagination\">";
        //previous button
        if ($page > 1) 
            $pagination.="<a class=\"btn btn-sm btn-warning\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Edit this user\" href=\"work_list_tab2.php?page=$prev\"><i>« Previous</i></a>";
            //$pagination.= "<a href=\"user_list.php?page=$prev\">« previous</a>";
        else
            $pagination.="<a class=\"disabled btn btn-sm btn-warning\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Edit this user\" href=\"work_list_tab2.php?page=$prev\"><i>« Previous</i></a>";
           // $pagination.= "<span class=\"disabled\">« previous</span>"; 
            $pagination.="&nbsp &nbsp &nbsp";
        //next button
        if ($page < $lastpage) 
            $pagination.= "<a class=\"btn btn-sm btn-danger\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Remove this user\" href=\"work_list_tab2.php?page=$next\"><i>next »</i></a>";
            //$pagination.= "<a href=\"user_list.php?page=$next\">next »</a>";
        else
            $pagination.= "<a class=\"disabled btn btn-sm btn-danger\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Remove this user\" href=\"work_list_tab2.php?page=$next\"><i>next »</i></a>";
           // $pagination.= "<span class=\"disabled\">next »</span>";
       // $pagination.= "</div>\n";       
    }

$record = $renderObj->get_work_list_pagination_manager($_SESSION['userinfo']->id,$start,$limit);
//echo "<pre>";print_r($record);exit;
require_once 'header.php';
?>
    <!-- Page Content -->
    <div class="container">
<!--  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="work_list.php" aria-controls="home" role="tab" data-toggle="tab">Review Inbox</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Review Outbox</a></li>
  </ul>-->
    
    
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
   
<div role="tabpanel">

  <!-- Nav tabs -->
  <?php require_once 'tab.php';?> 
  <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home">
   <!-- <div class = "spacer40"></div>

    <form class="form-inline" >

        <div class="form-group">

            <label class="sr-only" for="inputEmail">Email</label>

            <input type="email" class="form-control" id="inputEmail" placeholder="Email">

        </div>

        <div class="form-group">

            <label class="sr-only" for="inputPassword">Password</label>

            <input type="password" class="form-control" id="inputPassword" placeholder="Password">

        </div>

        <!--<div class="checkbox">

            <label><input type="checkbox"> Remember me</label>

        </div> -->

       <!-- <button type="submit" class="btn btn-primary">Login</button>

    </form>

<div class = "spacer40"></div> -->
    

   <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Date</th>
            <th>Title</th>
            <th>Created For</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
	  <?php 
            $flag = 0;
            $action_flag = 0;
            //echo "<pre>";print_r($record);die;
            if(!empty($record)){
            foreach ($record as $key=>$val) { 
	    $request_status = $renderObj->get_request_status($val['id']);
            //echo "<pre>";print_r($request_status);
            //$status = ($request_status['status'] != '' ? $request_status['status'] : 'N/A');
              if (array_key_exists($request_status['status'],$status_flag)) {
                        $status = $status_flag[$request_status['status']];
                        $action_stat = $status_flag[$request_status['status']];
                        }
                        else {
                            $status = "Request Not Send";
                            $flag = 1;
                        }
	    $id = $val['id'];
	  
	  ?>
        
          <tr>
            <td><?php if($val['work_date']=='0000-00-00 00:00:00') {
			echo "N/A";
		}else{
			echo date("d-M-Y", strtotime($val['work_date']));
		}
		?></td>
            <td><?php echo $val['title'];?></td>
            <!-- <td><?php //echo $val['google_name'];?></td> -->
            <td><?php 
                        if($val['for_id'] == $val['created_by_id']) {
                            echo "Me";
                        }
                        else {
                        echo $val['google_name'];
                        $action_flag = 1;
                        }
                        ?></td>
            <td><?php echo $status;?></td>
            <td data-title="Actions" class="actions">
                <?php 
				
		if($status != "Accepted" && $status != "Declined" && $status != 'Accepted/Rated') { ?>
		<!-- <a title="Edit Work" href="edit_work.php?id=<?php //echo $val['id'];?>">
		<i class="glyphicon glyphicon-edit"> </i>
		</a> 
                |-->
                
                <a title="Give Rating" href="give_rating_outbox.php?id=<?php echo $val['request_id'];?>">
		<i class="glyphicon glyphicon-star "></i>
		</a>
                <?php  } else { ?>
                <a title="View" href="view_review_outbox_detail.php?id=<?php echo $val['id'];?>">
		<i class="glyphicon glyphicon-eye-open"> </i>
		</a>    
                <?php } ?>
                <?php if($status != "Accepted" && $status != "Declined"  && $status != 'Accepted/Rated') { ?>
                <a title="Delete" href="decline_outbox.php?id=<?php echo $val['request_id'];?>">
		<i class="glyphicon glyphicon-remove"></i>
		</a>
                <?php } ?>
                <!--<a title="View Request" href="view_request_work.php?id=<?php //echo $val['id'];?>">
		<i class="glyphicon glyphicon-eye-open"> </i>
		</a>-->
                <?php if($flag == 0) { ?> 
                <?php if($action_flag == '1') { ?>
                <!--<a title="View Rating" href="view_direct_request.php?id=<?php //echo $val['id'];?>">
		<i class="glyphicon glyphicon-list"> </i>
		</a>-->
                <?php } else {
                 ?>
                <!--<a title="View All Send Request" href="view_all_send_request.php?id=<?php //echo $val['id'];?>">
		<i class="glyphicon glyphicon-list"> </i>
		</a>-->
                <?php } } ?>
            </td>
          </tr>
        <?php   $action_flag = 0; $flag = 0;
            
                }
            }
            else {
         ?>
          <tr>
              <td colspan = "6"> No Record Found.</td>
          </tr>
            <?php } ?>
        </tbody>
      </table>
    </div></div></div>
       
   </div>
   <!--<div class="panel-footer">
                        <a class="btn btn-sm btn-primary" type="button" data-toggle="tooltip" data-original-title="Broadcast Message"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <?php //echo $pagination; ?>
                            <!--<a class="btn btn-sm btn-warning" type="button" data-toggle="tooltip" data-original-title="Edit this user" href="edit.html"><i class="glyphicon glyphicon-edit"></i></a>
                            <a class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" data-original-title="Remove this user"><i class="glyphicon glyphicon-remove"></i></a>-->
                       <!-- </span>
                        
                        <span class="pull-right">
                            <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-8">
                              <!--<input class="btn btn-primary" value="Save Changes" type="submit">
                              <span></span>
                              <!-- <input class="btn btn-default" value="Cancel" type="reset"> -->
                             <!-- <a href="manager_work_rating.php" class="btn btn-primary" role="button">Add Work</a>
                            </div>
                          </div>
                        </span>
                    </div>-->
                             
                    <div class="panel-footer clearfix">
                        <div class="pull-right">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
        </div>
   
        </div>
   
   
        </div>
      </div>
    </div>
<?php
require_once 'footer.php';?></div> <?php }else{
    header('Location: index.php');
}
?>
<script type = "text/javascript">   
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>

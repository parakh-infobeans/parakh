<?php
require_once 'config.php';
require_once 'class/rating.php';

$renderObj = new rating();
//$renderObj->sample_get_book_details_id(1);
$session_val = $renderObj->check_session();

$limit = 5;                                //how many items to show per page
$page = $_GET["page"];

if($session_val == 1){
//echo "<pre>";print_r($_SESSION);exit('priyesh');
    
$user_count = $renderObj->get_allrequest_count($_SESSION['userinfo']->id); 
    
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
            $pagination.="<a class=\"btn btn-sm btn-warning\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Edit this user\" href=\"request_list.php?page=$prev\"><i>« Previous</i></a>";
            //$pagination.= "<a href=\"user_list.php?page=$prev\">« previous</a>";
        else
            $pagination.="<a class=\"disabled btn btn-sm btn-warning\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Edit this user\" href=\"request_list.php?page=$prev\"><i>« Previous</i></a>";
           // $pagination.= "<span class=\"disabled\">« previous</span>"; 
            $pagination.="&nbsp &nbsp &nbsp";
        //next button
        if ($page < $lastpage) 
            $pagination.= "<a class=\"btn btn-sm btn-danger\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Remove this user\" href=\"request_list.php?page=$next\"><i>next »</i></a>";
            //$pagination.= "<a href=\"user_list.php?page=$next\">next »</a>";
        else
            $pagination.= "<a class=\"disabled btn btn-sm btn-danger\" type=\"button\" data-toggle=\"tooltip\" data-original-title=\"Remove this user\" href=\"request_list.php?page=$next\"><i>next »</i></a>";
           // $pagination.= "<span class=\"disabled\">next »</span>";
       // $pagination.= "</div>\n";       
    }
//echo $lastpage.$pagination;exit('Hello');
$record = $renderObj->get_allrequest_details_pagination($_SESSION['userinfo']->id,$start,$limit);

//$record = $renderObj->get_allrequest_details($_SESSION['userinfo']->id);
//echo "<pre>";print_r($record);exit;
require_once 'header.php';
?>
    <!-- Page Content -->
    <div class="container">

    
    
    <div class="container">
      <div class="row">
        <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > -->
        
   <div class="col-xs-12 toppad" >
   <div class="panel panel-info">
       <div class="panel-heading"><h3 class="panel-title"><?php echo $_SESSION['userinfo']->google_name; ?></h3></div>
<div class="panel-body">
   

   <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Sr No.</th>
            <th>Title</th>
            <th>Request From</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
	  <?php foreach ($record as $key=>$val) { 
	    $work_title = $renderObj->get_work_details($val['work_id']);
            $emp_name = $renderObj->get_profile($val['from_id']);
            
            $title = ($work_title['title'] != '' ? $work_title['title'] : 'N/A');
            $name = ($emp_name['google_name'] != '' ? $emp_name['google_name'] : 'N/A');
	    $id = $val['id'];
	  
	  ?>
        
          <tr>
            <th scope="row"><?php echo $key+1;?></th>
            <td><?php echo $title;?></td>
            <td><?php echo $name;?></td>
            <td><?php echo $val['status'];?></td>
            <td data-title="Actions" class="actions">
                <?php if ($val['status'] == 'Verified' || $val['status'] == 'Decline'){
                    
                }else{?>
		<a title="Give Rating" href="give_rating.php?id=<?php echo $val['id'];?>">
		<i class="glyphicon glyphicon-star"> </i></a>
                <i class="icon-large icon-heart"> / </i>
                <a title="Decline Request" href="decline.php?id=<?php echo $val['id'];?>">
		<i class="glyphicon glyphicon-remove"> </i></a>
                <?php } ?>
		</a>
            </td>
          </tr>
         <?php } ?>
        </tbody>
      </table>
    </div>
       <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <!--<input class="btn btn-primary" value="Save Changes" type="submit">
              <span></span>
              <!-- <input class="btn btn-default" value="Cancel" type="reset"> -->
              <!--<a href="work.php" class="btn btn-primary" role="button">Add Work</a>-->
            </div>
          </div>
       </div>
   <div class="panel-footer">
                        <a class="btn btn-sm btn-primary" type="button" data-toggle="tooltip" data-original-title="Broadcast Message"><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <?php echo $pagination; ?>
                            <!--<a class="btn btn-sm btn-warning" type="button" data-toggle="tooltip" data-original-title="Edit this user" href="edit.html"><i class="glyphicon glyphicon-edit"></i></a>
                            <a class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" data-original-title="Remove this user"><i class="glyphicon glyphicon-remove"></i></a>-->
                        </span>
                    </div>
   
    </div>
   
        </div>
   
        </div>
      </div>
    
<?php
require_once 'footer.php'; ?></div> <?php }else{
    header('Location: index.php');
}
?>
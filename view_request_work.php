<?php
require_once 'config.php';
require_once 'class/rating.php';
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
//$renderObj->sample_get_book_details_id(1);
$session_val = $renderObj->check_session();

if($session_val == 1){

$record = $renderObj->get_work_details($_GET["id"]);
$request = $renderObj->get_request_details($_GET["id"]);

//echo "<pre>";print_r($request);exit;
require_once 'header.php';
?>
    <!-- Page Content --> 
    <div class="container">
      <div class="row">
        <!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-    
            offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > -->
        
   <div class="col-xs-12 toppad" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $set_page_title; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-12 col-lg-12 "> 
        <!--<form class="form-horizontal" role="form" method = "post" action = "">-->
        <div class = "form-horizontal">
          <div class="form-group">
            <label class="col-lg-3 control-label">Title :</label>
            <div class="col-lg-9">
              <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;"> <?php echo $record['title']; ?> </label> 
<!--              <input class="form-control" value="<?php //echo $record['title']; ?>" name = "work_title" type="text">-->
            </div>
          </div>
          
          <!-- <div class="form-group">
            <label class="col-lg-3 control-label">Company:</label>
            <div class="col-lg-8">
              <input class="form-control" value="" type="text">
            </div>
          </div> -->
          <div class="form-group">
            <label class="col-lg-3 control-label">Reason :</label>
            <div class="col-lg-9">
                <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;"> <?php echo $record['description']; ?> </label> 
              
            </div>
          </div>
          
           <div class="form-group">
            <label class="col-lg-3 control-label">Requested To : </label>
            <div class="col-lg-9">
                <?php foreach($request as $val){
                    $request_to = $renderObj->get_profile($val['to_id']);
                    $get_rating = $renderObj->get_rating_detail($val['id']);
                    //print_r($request_to);exit;
                ?>
                    <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;">
                         <?php
                        if (array_key_exists($val['status'],$status_flag)) {
                        $status = $status_flag[$val['status']];
                        $action_stat = $status_flag [$val['status']];
                        }
                        /*else {
                            $status = "Request Not Send";
                        }*/
                        if($action_stat == "Accepted") {
                            $get_rating = $renderObj->get_rating_detail($val['id']);
                        }
                        if(!empty($get_rating)) {
                            $rating = "<br /> Rating Score : ".$get_rating['rating'];
                        }
                        else {
                            $rating = '';
                        }
                            echo $request_to['google_name']." : ".$status."".$rating;       
                         ?> 
                    </label> 
            <?php }
            ?>
              
            </div>
          </div>
         
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-9">
              <a href="<?php echo basename($_SERVER['HTTP_REFERER']);?>" class="btn btn-default" role="button">Back</a>
              <span></span>
              <!-- <input class="btn btn-default" value="Cancel" type="reset"> -->
            </div>
          </div>
       <!-- </form> -->
       </div>
                
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

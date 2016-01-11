<?php
require_once 'config.php';
require_once 'class/rating.php';
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
//$renderObj->sample_get_book_details_id(1);
//$session_val = $renderObj->check_session();

//if($session_val == 1){
$renderObj->unread_request($_GET["id"]);
$record = $renderObj->get_request_detail($_GET["id"]);
//echo "<pre>";print_r($record);die;
if(is_array($record) && !empty($record)) {
	
      $record_title = ($record['title'] != '' ? $record['title'] : 'NA');
      $description = ($record['description'] != '' ? $record['description'] : 'NA');
      $request_from = ($record['from_name'] != '' ? $record['from_name'] : 'NA');
      $status = ($record['status'] != '' ? $record['status'] : '');

      if($record['request_for'] == '')
      {
          $request_for = 'NA';
      
      }else if($record['request_for'] == 1){ 
      
          $request_for = '+1';
         
      }else if($record['request_for'] == 0){
             
          $request_for =  '-1';
             
      }
      
  
  }
//echo "<pre>";print_r($record);exit;
require_once 'header.php';
?>
    <!-- Page Content -->
    <div class="container">

    
    
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
               <!-- <div class="col-md-3 col-lg-3 " align="center"> 
		    <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle">
		    <!-- <img src="//placehold.it/100" class="avatar img-circle" alt="avatar"> -->
		    <!-- <h6>Upload a different photo...</h6>
		    <input class="form-control" type="file">
		</div> -->
                <div class=" col-md-9 col-lg-9 "> 
                
                
        <!-- <form class="form-horizontal" role="form" method = "post" action = ""> -->
        <div class = "form-horizontal">
          <div class="form-group">
            <label class="col-lg-3 control-label">Title :</label>
            <div class="col-lg-9">
              <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;"> <?php echo $record_title; ?> </label> 
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
                <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;"> <?php echo $description; ?> </label> 
              
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">Requested For : </label>
            <label class="col-lg-3 control-label" style="text-align: left; font-weight: normal; padding-left: 30px;"> <?php echo $request_for; ?> </label> 
            <div class="col-lg-8">
              
            </div>
          </div>
          
           <div class="form-group">
            <label class="col-lg-3 control-label">From : </label>
            <label class="col-lg-3 control-label" style="text-align: left; font-weight: normal; padding-left: 30px;"> <?php echo $request_from; ?> </label> 
            <div class="col-lg-8">
              
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-lg-3 control-label">Status :</label>
            <div class="col-lg-9">
                <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;">
                     <?php
                        if (array_key_exists($record['status'],$status_flag)) {
                        echo $status_flag[$record['status']];
                        $action_stat = $status_flag[$record['status']];
                        }
                     ?> 
                </label> 
              
            </div>
          </div>
          
          <?php if($record['request_id'] != '' && ($record['status'] == 2)) {
          //if($record['request_id'] != '') {
          ?>
            
           <!--div class="form-group">
            <label class="col-lg-3 control-label">Rating : </label>
            <label class="col-lg-3 control-label" style="text-align: left; font-weight: normal;"> 
                <?php
		if($record['rating'] == '1'){ 
		   echo "+1";
		}else if($record['rating'] == '0'){
                   echo "-1"; 
		}
		?> 
            </label> 
            <div class="col-lg-8">
              
            </div>
          </div-->
          
          <?php } ?>
          
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
<!--                <a href="manager_work_list_page.php" class="btn btn-default" role="button">Back</a>-->
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

            
          </div>
        </div>
      </div>
    </div>
<?php
require_once 'footer.php';//}else{
    //header('Location: index.php');
//}
?>

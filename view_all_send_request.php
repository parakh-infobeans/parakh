<?php
require_once 'config.php';
require_once 'class/rating.php';
//echo "<pre>";print_r($_SESSION);exit;
$renderObj = new rating();
//$renderObj->sample_get_book_details_id(1);
$session_val = $renderObj->check_session();

if($session_val == 1){
$view_all_sendrequest = $renderObj->view_all_send_request($_GET["id"]);
$get_work_detail = $renderObj->get_work_details($_GET["id"]);

//echo "<pre>";print_r($view_all_sendrequest);exit;
require_once 'header.php';
?>
    <!-- Page Content -->
    <div class="container">

    
    
    <div class="container">
      <div class="row">
   <div class="col-xs-12 toppad" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $set_page_title; ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-12 col-lg-12 "> 
                    
        <div class = "form-horizontal">
          <div class="form-group">
            <label class="col-lg-2 control-label" style="text-align: left;">Title :</label>
            <div class="col-lg-9">
              <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;"> <?php echo $get_work_detail['title']; ?> </label> 
            </div>
          </div>
            <div class="form-group">
            <label class="col-lg-2 control-label" style="text-align: left;">Reason :</label>
            <div class="col-lg-9">
                <label class="col-lg-8 control-label" style="text-align: left; font-weight: normal;"> <?php echo $get_work_detail['description']; ?> </label> 
              
            </div>
          </div>
            <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
<!--            <th>Sr No.</th>-->
            <th>To</th>
            <th>Requested For</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
           <?php
           if(!empty($view_all_sendrequest)) {
           foreach($view_all_sendrequest as $key=>$val) { ?>
          <tr>
<!--            <th scope="row"><?php echo $key+1;?></th>-->
            <td><?php echo $val['to_name'];?></td>

            <td><?php if($val['request_for'] == '1'){
                        echo "+1";
                      }else{
                          echo "-1";
                      }
                ?></td>
            <!-- <td><?php //echo $val['from_name'];?></td> -->
            <td><?php echo date("d-M-Y H:i", strtotime($val['created_date']));?></td>
            <td><?php 
            
                    if (array_key_exists($val['status'],$status_flag)) {
                        $status = $status_flag[$val['status']];
                        $action_stat = $status_flag[$val['status']];
                        }
                        else {
                            $status = "Request Not Send";
                        }
                        
                        if($action_stat == "Accepted") {
                            $rate = $val['rating'];
                            /*if($rate == 2){
                            $rating_show = " | Rating Score : None";
                            }
                            else {
                            $rating_show = " | Rating Score : $rate";
                            }*/
                        }
                        else {
                            $rating_show = "";
                        }
            
            echo $status."".$rating_show;?></td>
          </tr>
        <?php }
            }
            else {
        ?>
          <tr>
              <td colspan="4">No Record Found...</td>
          </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>

          
          <div class="form-group">
            <div class="col-md-9">
              <a href="<?php echo basename($_SERVER['HTTP_REFERER']);?>" class="btn btn-default" role="button">Back</a>
              <span></span>
            </div>
          </div>
          </div>
  
                </div>
              </div>
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

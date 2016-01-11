<?php
require_once 'config.php';
require_once 'class/rating.php';
$renderObj = new rating();
//$renderObj->sample_get_book_details_id(1);
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
$record = $renderObj->get_manager_work_list($user_id);
//$status = $renderObj->get_status();
//echo "<pre>";print_r($status);die;
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

   <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Sr No.</th>
            <th>From</th>
            <th>To</th>
            <th>Title</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
	  <?php foreach ($record as $key=>$val) { 
	  
	    $id = $val['id'];
	  
	  ?>
        
          <tr>
            <th scope="row"><?php echo $key+1;?></th>
            <td><?php echo $val['from_name'];?></td>
            <td><?php echo $val['to_name'];?></td>
            <td><?php echo $val['title'];?></td>
            <td><?php 
                        if (array_key_exists($val['status'],$status)) {
                        echo $status[$val['status']];
                        $action_stat = $status[$val['status']];
                        }
                        else {
                            echo "NA";
                        }
                ?>
            </td>
            <td data-title="Actions" class="actions">
                <a title="Assigned Role" href="view_request.php?id=<?php echo $id;?>">
		<i class="icon-large icon-heart">View</i>
		</a>
            <?php $pending = constant("Pending");
                    if($action_stat == $pending) { ?>
                &nbsp;|
                <a title="Assigned Role" href="give_rating.php?id=<?php echo $id;?>">
		<i class="icon-large icon-heart">Rating</i>
		</a>
            <?php } ?>
            </td>
          </tr>
         <?php } ?>
        </tbody>
      </table>
    </div>
   
   
   
        </div>
      </div>
    </div>
<?php
require_once 'footer.php';
?>

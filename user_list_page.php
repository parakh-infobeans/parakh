<?php
require_once 'config.php';
require_once 'class/rating.php';
$page_number = (int) (!isset($_GET['page']) ? 1 : $_GET['page']);
$renderObj = new rating();

//$renderObj->sample_get_book_details_id(1);
//$record = $renderObj->get_user_list();
$search_user = '';
if (!empty($_GET['search_user'])) {
    $search_user = $_GET["search_user"];
    $record = $renderObj->pagination("get_user_list_pagination", $page_number, $search_user);
} else {
    $record = $renderObj->pagination("get_user_list_pagination", $page_number);
}

//echo "<pre>";print_r($record);die;

require_once 'header.php';
?>

<!-- Page Content -->

<?php require_once "error.php"; ?>

<div class="mid-col-12">

    <div class="profile-wrapper">


             <div class="profile-wrapper-report">
                <div class="profile-lft-row ">
                <form class="form-horizontal" role="form" method = "GET" action = "">
                    <div class="form-group">
                        <label>User/Email:  </label>
                        <input name="search_user"  type="text" value="<?php echo $search_user; ?>">
                    </div>
                    <div class="form-group">

                        <div class="col-md-8">
                            <input class="btn btn-primary" value="Go" type="submit">
                            <span></span>
                            <input class="btn btn-default" value="Cancel" type="reset" onClick="document.location.href = 'user_list_page.php'">
                        </div>
                    </div>
                </form>
                </div>



                    <div class="profile-lft-row ">
                        <h3 class="panel-title"><?php echo $set_page_title; ?><?php //echo $_SESSION['userinfo']->google_name;  ?></h3>
                    </div>


                        <div class="profile-lft-row">
                            <div class="pforile-lft-row-col_10 header">Emp Code</div>
                            <div class="pforile-lft-row-col_20 header">Name</div>
                            <div class="pforile-lft-row-col_30 header">Email</div>
                            <div class="pforile-lft-row-col_15 header">Mobile Number</div>
                            <div class="pforile-lft-row-col_10 header">Status</div>
                            <div class="pforile-lft-row-col_15 header">Action</div>

                        </div>
                        <?php
                        if (!empty($record[0])) {
                            foreach ($record[0] as $key => $val) {

                                $id = $val['id'];
                                ?>
                                <div class="profile-lft-row">
                                    <div class="pforile-lft-row-col_10"><?php echo str_pad($val['id'], 4, '0', STR_PAD_LEFT); ?></div>
                                    <div class="pforile-lft-row-col_20"><?php echo ($val['google_name'] != '' ? $val['google_name'] : 'NA'); ?></div>
                                    <div class="pforile-lft-row-col_30"><?php echo ($val['google_email'] != '' ? $val['google_email'] : 'NA'); ?></div>
                                    <div class="pforile-lft-row-col_15"><?php echo ($val['mobile_number'] != '' ? $val['mobile_number'] : 'NA'); ?></div>
                                    <div class="pforile-lft-row-col_10"><?php $status = ($val['status'] == '0' ? 'Inactive' : 'Active');
                        echo $status;
                        ?></div>
                                    <div class="pforile-lft-row-col_15">

                                        <a  title="Assigned Lead" href="assigned_role.php?id=<?php echo $id; ?>">
                                            <i class="glyphicon glyphicon-check">a</i>
                                        </a> &nbsp;

                                        <a  title="Edit User" href="add_user.php?id=<?php echo $id; ?>">
                                            <i class="glyphicon glyphicon-check">e</i>
                                        </a> &nbsp;


                                        <?php if ($val['status'] == '0') { ?>
                                            <a  title="Active" href="status_update.php?id=<?php echo $id; ?>&page=<?php echo $page_number; ?>&search_user=<?php echo $search_user ?>&status=1">
                                                <input type="button" class = "SwitchBtn_Check" style="width: 70%" value= "Active" />

                                            </a>
                                        <?php } else { ?>
                                            <a  title="InActive" href="status_update.php?id=<?php echo $id; ?>&page=<?php echo $page_number; ?>&search_user=<?php echo $search_user ?>&status=0">
                                                <input type="button" class = "SwitchBtn_Check" style="width: 70%" value= "Inactive"/>

                                            </a>
                                        <?php } ?>

                                    </div>


                                </div>
                            <?php }
                        }
                        ?>



                    <div class="profile-lft-row ">

                        <?php require 'pagination_html.php'; ?>
                    </div>
            </div>

    </div> <!-- /profile-wrapper-->
</div> <!-- / mid-col-12-->
<?php
require_once 'footer.php';
?>

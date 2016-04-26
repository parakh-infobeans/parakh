<?php
require_once 'config.php';
require_once 'class/rating.php';
$flag = 1;
$role_flag = 2;
$renderObj = new rating();
$record = $renderObj->get_profile($_GET["id"]);
$all_user_list = $renderObj->get_user_list_admin($_GET["id"]);

$all_roles = $renderObj->get_all_role_for_admin();
$get_lead = $renderObj->get_all_lead($_GET["id"],$flag,'');

if($record != 0) {
    
    $name = ($record['google_name'] != '' ? $record['google_name'] : 'NA');
    $current_user_id = ($record['id'] != '' ? $record['id'] : 'NA');
    $email = ($record['google_email'] != '' ? $record['google_email'] : 'NA');
    $mobile_number = ($record['mobile_number'] != '' ? $record['mobile_number'] : 'NA');
  }
//echo "<pre>";print_r($get_lead);print_r($all_roles);die;
require_once 'header.php';
?>

    <!-- Page Content -->
    
 <section>
    <div class="wrapper">
        <div class="mid-col-12">            
            <div class="profile-wrapper">
                <h2 class="edit-h2"><?php echo $set_page_title; //$name; ?></h2>
                <form class="form-horizontal" id ="edit_profile" role="form" method = "post" action = "save_assigned_role.php">
                    <div class="edit-wrapper">
                            <div class="edit-lft">Name:</div>
                            <div class="edit-rht"><label class="col-lg-8 control-label" style="text-align:left !important"><?php echo $name; ?></label></div>
                            <input class="form-control" value="<?php echo $current_user_id; ?>" name = "current_user[user_id]" type="hidden">
                    </div>
                    <div class="edit-wrapper">
                            <div class="edit-lft">Role:</div>
                            <div class="edit-rht"><select id="team_member" class="form-control" name = "role_id">                
                                <option value = "1" <?php if($record['role_id'] == 1) { echo ' selected="selected"'; } ?> >Lead</option>
                                <option value = "3" <?php if($record['role_id'] == 3) { echo ' selected="selected"'; } ?>>Manager</option>
                                <option value = "9" <?php if($record['role_id'] == 9) { echo ' selected="selected"'; } ?>>Team Member</option>
                                </select>
                            </div>
                    </div>
                    
                             <?php 
                        if(is_array($get_lead) && !empty($get_lead)) 
                        { //echo "<pre>";print_r($get_lead);die;
                            foreach ($all_roles as $role_key=>$role_value) 
                            { ?>
                                <div class="edit-wrapper">
                                <label class="edit-lft"><?php echo $role_value['name'];?></label>
                                <div class="col-lg-8">
                                    <div class="edit-rht">
                                        <select id="<?php echo $role_value['short_name']; ?>" class="form-control" name = "assigned_role[<?php echo $role_value['id'];?>]">
                                            <option selected="selected" value = "-1">Please Select</option> <?php 
                                            foreach ($all_user_list as $key=>$val) 
                                            { 
                                                if(array_key_exists($role_value['id'],$get_lead)) 
                                                {                   
                                                    if($val['id'] == $get_lead[$role_value['id']]) 
                                                    {  
                                                        ?> <option value="<?php echo $val['id'];?>" selected = selected><?php echo $val['google_name'];?></option> <?php 
                                                    }
                                                    else 
                                                    {  
                                                        ?> <option value="<?php echo $val['id'];?>"><?php echo $val['google_name'];?></option> <?php 
                                                    }    
                                                }
                                                else 
                                                { 
                                                    ?> <option value="<?php echo $val['id'];?>"><?php echo $val['google_name'];?></option> <?php
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                </div> <?php              
                            }  ?>
                                <input class="form-control" value="1" name = "current_user[update]" type="hidden">  
                             <?php                  
                        }
                        else 
                        {
                            foreach ($all_roles as $role_key=>$role_value) 
                            { ?>
                                <div class="edit-wrapper">
                                <label class="edit-lft"><?php echo $role_value['name'];?></label>
                                <div class="col-lg-8">
                                    <div class="edit-rht">
                                    <select id="<?php echo $role_value['short_name']; ?>" class="form-control" name = "assigned_role[<?php echo $role_value['id'];?>]">
                                        <option selected="selected" value = "-1">Please Select</option> <?php 
                                        foreach ($all_user_list as $key=>$val) 
                                        { 
                                            ?><option value="<?php echo $val['id'];?> "><?php echo $val['google_name'];?></option> <?php 
                                        }
                                       ?>
                                     </select>
                                   </div>
                                 </div>
                               </div> <?php                    
                            }                 
                        } ?> 
                    
                    
                    <div class="edit-wrapper">
                            <div class="edit-lft">&nbsp;</div>
                            <div class="edit-rht"><input type="submit" value="Save Changes" name="" class="edit-submit-btn" /> 
                            <input type="reset" value="Cancel" name="" class="edit-cancel-btn"  onClick="document.location.href='user_list_page.php'"/></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>    
    
    
    
    
    
    <!--<div class="mid-col-12"> 
    <div class="profile-wrapper" style="min-height: 50%">
       
        
   <div class="col-xs-12 toppad" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $set_page_title; //$name; ?></h3>
            </div>
              
            <div class="panel-body">
              <div class="row">
                  <div class="col-md-9"> 
                
        <form class="form-horizontal" role="form" method = "post" action = "save_assigned_role.php">
          <div class="profile-wrapper-report">
            <label class="pforile-lft-row-col_20">Name </label>
            <div class="col-lg-8">
                <label class="col-lg-8 control-label" style="text-align:left !important"><?php echo $name; ?></label>
              <input class="form-control" value="<?php echo $current_user_id; ?>" name = "current_user[user_id]" type="hidden">
            </div>
          </div>
            
          <div class="profile-wrapper-report">
            <label class="pforile-lft-row-col_20">Role</label>
	      <div class="col-lg-8">
              <div class="ui-select">
                <select id="team_member" class="form-control" name = "role_id">                
                <option value = "1" <?php if($record['role_id'] == 1) { echo ' selected="selected"'; } ?> >Lead</option>
                <option value = "3" <?php if($record['role_id'] == 3) { echo ' selected="selected"'; } ?>>Manager</option>
                <option value = "9" <?php if($record['role_id'] == 9) { echo ' selected="selected"'; } ?>>Team Member</option>
                </select>
              </div>
	      </div>
	    </div>
          
	   <?php 
            if(is_array($get_lead) && !empty($get_lead)) 
            { //echo "<pre>";print_r($get_lead);die;
                foreach ($all_roles as $role_key=>$role_value) 
                { ?>
                    <div class="profile-wrapper-report">
                    <label class="pforile-lft-row-col_20"><?php echo $role_value['name'];?></label>
                    <div class="col-lg-8">
                        <div class="ui-select">
                            <select id="<?php echo $role_value['short_name']; ?>" class="form-control" name = "assigned_role[<?php echo $role_value['id'];?>]">
                                <option selected="selected" value = "-1">Please Select</option> <?php 
                                foreach ($all_user_list as $key=>$val) 
                                { 
                                    if(array_key_exists($role_value['id'],$get_lead)) 
                                    {                   
                                        if($val['id'] == $get_lead[$role_value['id']]) 
                                        {  
                                            ?> <option value="<?php echo $val['id'];?>" selected = selected><?php echo $val['google_name'];?></option> <?php 
                                        }
                                        else 
                                        {  
                                            ?> <option value="<?php echo $val['id'];?>"><?php echo $val['google_name'];?></option> <?php 
                                        }    
                                    }
                                    else 
                                    { 
                                        ?> <option value="<?php echo $val['id'];?>"><?php echo $val['google_name'];?></option> <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    </div> <?php              
                }  ?>
                    <input class="form-control" value="1" name = "current_user[update]" type="hidden">  
		 <?php                  
            }
            else 
            {
                foreach ($all_roles as $role_key=>$role_value) 
                { ?>
                    <div class="profile-wrapper-report">
                    <label class="pforile-lft-row-col_20"><?php echo $role_value['name'];?></label>
                    <div class="col-lg-8">
                        <div class="ui-select">
                        <select id="<?php echo $role_value['short_name']; ?>" class="form-control" name = "assigned_role[<?php echo $role_value['id'];?>]">
                            <option selected="selected" value = "-1">Please Select</option> <?php 
                            foreach ($all_user_list as $key=>$val) 
                            { 
                                ?><option value="<?php echo $val['id'];?> "><?php echo $val['google_name'];?></option> <?php 
                            }
                           ?>
                         </select>
                       </div>
                     </div>
                   </div> <?php                    
                }                 
            } ?>          
            <div class="profile-wrapper-report">
              <label class="pforile-lft-row-col_20"></label>
              <div class="col-md-8">
                <input class="btn btn-primary" value="Save Changes" type="submit">
                <span></span>
                <input class="btn btn-default" value="Cancel" type="reset" onClick="document.location.href='user_list_page.php'">
              </div>
            </div>
            </form>                
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>-->
<?php
require_once 'footer.php';
?>

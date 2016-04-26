<?php
require_once 'config.php';
require_once 'class/rating.php';
require_once 'functions/functions.php';
$renderObj = new rating();
$user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id : 0);

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'getMemberByAlphabets') {

        $char = strip_tags($_GET['char']);
        $serchedUsrListByAlphabet = $renderObj->get_all_members_by_alphabets($_GET['char'], $user_id);
        $userFoundCnt = count($serchedUsrListByAlphabet);
        $response = '';
        if ($userFoundCnt > 0) {
            foreach ($serchedUsrListByAlphabet as $key => $value) {
                $team_mem_profile_pic = ($value['google_picture_link'] != '') ? $value['google_picture_link'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';


                $response .='<div class = "lft-div-my-team marginbot10">
            <div class = "div-team-lft-img"><a href="javascript:void(0);" id ="' . $value['id'] . '"><img src = "' . $team_mem_profile_pic . '" style="border-radious:50%" onClick="getMemberDetails(' . $value['id'] . ')"/></a></div>
            <div class = "div-team-lft-txt"><a class = "name" id ="' . $value['id'] . '" href="javascript:void(0);" id="' . $value['id'] . '" onClick="getMemberDetails(' . $value['id'] . ')">' . $value['google_name'] . '</a></div>
                                                </div>';
            }
        } else {
            $response .='<strong>No record found.</strong>';
        }

        echo $response;
        die;
    }

    if ($_GET['action'] == 'getMemberBySearchKeyword') {

        $serchedUsrListByKeyword = $renderObj->get_members_by_search_keyword($_GET['searchKeyword'], $user_id);
        $response = '';
//        $response .='<div id="content-1" class="content">';
        $userFoundCnt = count($serchedUsrListByKeyword);
        if ($userFoundCnt > 0) {
            foreach ($serchedUsrListByKeyword as $key => $value) {
                $team_mem_profile_pic = ($value['google_picture_link'] != '') ? $value['google_picture_link'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';


                $response .='<div class = "lft-div-my-team marginbot10">
            <div class = "div-team-lft-img"><a href="javascript:void(0);" id="' . $value['id'] . '"><img src = "' . $team_mem_profile_pic . '"  onClick="getMemberDetails(' . $value['id'] . ')"/></a></div>
            <div class = "div-team-lft-txt"><a class = "name"  id ="' . $value['id'] . '" href="javascript:void(0);" onClick="getMemberDetails(' . $value['id'] . ')">' . $value['google_name'] . '</a></div>
                                                </div>';
            }
        } else {
            $response .='<strong>No record found.</strong>';
        }
        echo $response;
        die;
    }

    if ($_GET['action'] == 'getMemberDetails') {

        $membersDetails = $renderObj->get_team_member_details($_GET['memberId']);
        $response = '';
        $profile_pic = ($membersDetails['google_picture_link'] != '') ? $membersDetails['google_picture_link'] . "?sz=100" : "images/user.png";
        $response .='<div class="mid-col-4">
                                       <div class="mid-col-top relative">
                                           <div class="gallery-wrap">
                                               <div class="gallery clearfix">
                                                   <div class="gallery__item" id="">
                                                           <div class="mid-col-img"><a href="javascript:void(0);"><img src="' . $profile_pic . '"/></a></div>
                                                           <p class="center name-txt"><a href="javascript:void();" class="name">' . $membersDetails['google_name'] . '</a><p>
                                                           <p class="center" style="color:#515151;">' . $membersDetails['designation'] . '</p>
                                                           <span class="request-positive-green-2">+1</span>
                                                       </div>
                                               </div>                                     
                                           </div>
                                       </div>
                                       <div class="mid-col-bel-other">
                                           <input type="hidden" id="leadId" name="leadId" value="' . $membersDetails['manager_id'] . '">
                                           <input type="hidden" id="user_id" name="user_id" value="' . $user_id . '">
                                           <input type="hidden" id="for_id" name="for_id" value="' . $membersDetails['id'] . '">
                                           <textarea name="work_desc" id="work_desc" class="textarea-dialogue-other marginbot10" placeholder="Message write here..."></textarea>
                                           <a class="green-btn" onClick="rateTeamMember(' . $membersDetails['id'] . ')" id="green" href="javascript:void(0);">Submit</a>
                                           
                                       </div>

                        </div>';
        echo $response;
        die;
    }
    if ($_GET['action'] == 'rate_team_mem_plus') {

        $rateTeamMemDetails = $renderObj->rate_team_mem_plus($_GET);
        if ($rateTeamMemDetails == true) {
            echo 'success';
            die;
        } else {

            echo 'fail';
            die;
        }
    }
}
require_once 'header.php';

$record = $renderObj->get_profile($user_id);
if ($record != 0) {
    $name = ($record['google_name'] != '' ? $record['google_name'] : 'NA');
    $email = ($record['google_email'] != '' ? $record['google_email'] : 'NA');
    $mobile_number = ($record['mobile_number'] != '' ? $record['mobile_number'] : 'NA');
    $designation = ($record['designation'] != '' ? $record['designation'] : 'NA');
    $profile_pic = ($record['google_picture_link'] != '') ? $record['google_picture_link'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
}
$get_work_rating = $renderObj->get_work_rating($user_id);
$plus_rating = 0;
$minus_rating = 0;
foreach (@$get_work_rating as $key => $val) {

    if ($val['rating'] == 1) {

        $plus_rating++;
    } else if ($val['rating'] == 0) {
        $minus_rating++;
    }
}

$allMemberList = $renderObj->get_all_group_team_members($user_id);

$myActivityListRating = $renderObj->get_my_recent_activity($user_id);

$myActivityListFeedback = $renderObj->get_my_recent_activity_feedback($user_id);

$myActivityList = array_merge($myActivityListRating, $myActivityListFeedback);
$myActivityList = $renderObj->sort_date($myActivityList);


$lead_list = $renderObj->get_all_lead($user_id);
?>
<section>
    <div class="wrapper">
        <div class="overlay" id="overlay_rateme"></div>
        <div class="mid-col-12">
            <div class="home-mid-wrapper relative">

                <?php if ($_SESSION['userinfo']->role_id != 9) { ?>
                    <div class="" style="position:absolute; right:10px; top:10px;"><a href="rating_dashboard.php" class="edit-submit-btn">My Team</a></div>
                <?php } ?>
                <div class="profile-lft">
                    <!--span class="user-img"></span-->
                    <div class="mid-col-img"><a href="javascript:void(0);"><img src="<?= $profile_pic; ?>"></a></div>
                </div>
                <div class="home-profile-rht-other relative">
                    <div class="rank-div">R-100</div>
                    <p class="name-txt"><?= $name; ?></p>
                    <p class="paddingtop5 paddingbot10"><?= $designation ?></p>
                    <div class="home-rating-left">
                        <span class="request-positive-green-3"><?php
                if ($plus_rating > 0) {
                    echo '+';
                } echo $plus_rating;
                ?></span>
                    </div>
                    <div class="home-rating-left">
                        <span class="request-negative-red-3"><?php
                            if ($minus_rating > 0) {
                                echo '-';
                            } echo $minus_rating;
                            ?></span>
                    </div>
                </div>
                <div>
                    <a href="profile.php" class="edit-submit-btn margintop70 marginlft20">View Profile</a>
                </div>
                <div class="profile-hr"></div>
                <div class="full-width left center relative">
                    <div class="accordian-arrow-2"></div>
                    <div class="img-acc" style="display: none;">
                        <div class="image1"><img src="images/rating-star.png" /></div>
                        <div class="image1"><img src="images/directional-icon.png" /></div>
                        <div class="image1"><img src="images/cloud-icon.png" /></div>
                        <div class="image1"><img src="images/directional-icon2.png" /></div>
                        <div class="image1"><img src="images/location-icon.png" /></div>
                    </div>
                </div>
                <div class="profile-hr"></div>
                <div class="full-width left">
                    <!--------------------->

                    <!--------------------->
                </div>
                <div class="profile-wrapper-report">

                    <div class="lft-div">
                        <h2>ICC Team</h2>
                        <p class="marginbottop20"><input type="text" value="" id="serachMember" placeholder="Search" class="search-input" /></p>

                        <div class="div-team-lft">
                            <div id="content-1" class="content">
                                <?php
                                foreach ($allMemberList as $key => $value) {
                                    $team_mem_profile_pic = ($value['google_picture_link'] != '') ? $value['google_picture_link'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
                                    ?>

                                    <div class="lft-div-my-team marginbot10">
                                        <div class="div-team-lft-img"><a href="javascript:void(0);" id="<?= $value['id']; ?> " onClick="getMemberDetails(<?= $value['id']; ?>)"><img src="<?= $team_mem_profile_pic; ?>" /></a></div>
                                        <div class="div-team-lft-txt"><a href="javascript:void(0);" class="name" id="<?= $value['id']; ?>" onClick="getMemberDetails(<?= $value['id']; ?>)"><?= $value['google_name']; ?></a></div>
                                    </div>
<?php } ?>
                            </div>
                        </div>
                        <div class="div-team-rht">
                            <p><a onClick="getMemberByAlphabets('All')" class="a-down" id="All" >All</a></p>
                            <?php foreach (range('A', 'Z') as $char) { ?>
                                <p><a class="a-down" id="<?= $char; ?>" onClick="getMemberByAlphabets('<?= $char; ?>')" ><?= $char; ?></a></p>

<?php }
?>
                        </div>    
                    </div>

                    <div class="center-div" >
                        <h2 id="rateMe">Rate Me</h2>
                        <div id="error" class="error">
                            Your request is <strong> Sent !</strong> 
                        </div>
                        <a href="javascript:void(0);" id ='closebtn'>
                            <img id ='close' class="error" src="images/close-btn.png" style="position: relative; float: right; height: 15px; top: -26px; left: -10px;background-color: white;border-radius:8px; ">
                        </a>
<?php if (is_array($lead_list)) { ?>
                            <div class="mid-col-4-new">

                                <div class="mid-col-4">
                                    <div class="mid-col-top relative">
                                        <div class="gallery-wrap">
                                            <div class="gallery clearfix">
                                                <?php
                                                $i = 0;
                                                foreach ($lead_list as $user) {
                                                    $profile_pic = ($user['google_picture_link'] != '') ? $user['google_picture_link'] . "?sz=100" : "images/user.png";
                                                    $i++;
                                                    ?>
                                                    <div class="gallery__item" id="manager_<?php echo $user['manager_id']; ?>">
                                                        <div class="mid-col-img"><a href="javascript:void(0);"><img src="<?php echo $profile_pic; ?>"/></a></div>
                                                        <p class="center name-txt"><a href="javascript:void();" class="name"><?php echo $user['manager_name']; ?></a><p>
                                                        <p class="center"><?php echo $user['role_name']; ?></p>
                                                        <span class="request-positive-green-2">+1</span>
                                                    </div>
    <?php } ?>
                                            </div>
    <?php if (count($lead_list) > 1) { ?>
                                                <div class="gallery__controls clearfix">
                                                    <div href="#" class="gallery__controls-prev">
                                                        <img src="images/lft-arrow.png" alt="" />
                                                    </div>
                                                    <div href="#" class="gallery__controls-next">
                                                        <img src="images/rht-arrow.png" alt="" />
                                                    </div>
                                                </div>
    <?php } ?>
                                        </div>
                                    </div>
                                    <input type="hidden" id="leadId" name="leadId" value="<?= $user['manager_id']; ?>">
                                    <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>">
                                    <input type="hidden" id="for_id" name="for_id" value="<?= $user_id; ?>">

                                    <div class="mid-col-bel-other">
                                        <textarea name="work_desc" id="work_desc" class="textarea-dialogue-other marginbot10" placeholder="Message write here..."></textarea>
                                        <a class="green-btn" onclick="submitRating()" id="green" href="javascript:void(0);">Submit</a>
                                    </div>

                                </div>

                            </div>
                        <?php } else { ?>

                            <div class="mid-col-4-new noLeadAssigned" > You do not have a Lead/Manager assigned. Please contact the Administrator. </div>

<?php } ?>
                        <div id="ajaxBusy" class="ajaxLoader" ><p><img id="imgAjaxLoader" class="ajaxLoaderImg" src="./images/loading.gif" /></p></div>
                    </div>
                    <div class="rht-div">
                        <h2 class="paddingbot10 marginbot10">Recent Activity</h2>

                        <div class="div-team-lft">
                            <div id="content-2" class="content">
                                <?php
                                if (count($myActivityList) > 0) {
                                    foreach ($myActivityList as $key => $value) {
//                                        echo '<pre>';
                                //                                                                                print_r($myActivityList);
                                        if ($value['user_id'] != $user_id) {
                                            $ratedby_mem_profile_pic = ($value['google_picture_link'] != '') ? $value['google_picture_link'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
                                            $name = $value['ratedby'] ;
                                            
                                        } else {
                                            $ratedby_mem_profile_pic = ($value['for_picture'] != '') ? $value['for_picture'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
                                             $name = $value['rated_to'] ;
                                        }

                                        $rating = (($value['rating'] == 1) ? +1 : -0);
                                        if ($value['rating'] == '+1' || $value['rating'] == '-1') {
                                            ?>                                  
                                            <div class="lft-div-my-team marginbot10" ti>
                                                <?php if ($value['user_id'] == $user_id) { 
                                                    $ratedby_mem_profile_pic = ($value['for_picture'] != '') ? $value['for_picture'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
                                                    ?> 
                                                
                                                    <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $ratedby_mem_profile_pic; ?>" width="50" height="50" /></div>
                                                    <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>">
                                                    <a href="javascript:void(0);" class="name" ><strong><?= $name ?></strong></a> 
                                                    rated you 
                                                <?php } else { 
                                                    $ratedby_mem_profile_pic = ($value['for_picture'] != '') ? $value['for_picture'] . "?sz=100" : 'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
                                                    ?>
                                                    
                                                    <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $ratedby_mem_profile_pic; ?>" width="50" height="50" /></div>
                                                    <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>">                                                   
                                                    <a href="javascript:void(0);" class="name" ><strong>You</strong></a> 
                                                    rated <strong><?= $value['ratedby']?></strong>
                                                    
                                               <?php } ?>
                                               <?php if ($value['rating'] == '+1') { ?>    
                                                        <span class="green-div"><?= $value['rating']; ?></span>
            <?php } else if ($value['rating'] == '-1') { ?>
                                                        <span class="red-div"><?= $value['rating']; ?></span>    
                                            <?php } ?>        

                                                </div>
                                            </div>
                                            <?php
                                        }
                                        if ($value['rating'] == 'approved' || $value['rating'] == 'declined') {
                                            ?>
                                                           
                                                     
                                            <div class="lft-div-my-team marginbot10">
                                                <?php if ($value['rating'] == 'approved') {
                                                    if ($value['user_id'] == $user_id) {
                                                            ?> 

                                                                <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['google_picture_link']; ?>" width="50" height="50" /></div>
                                                                <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">
                                                                <a href="javascript:void(0);" class="name" ><strong>You</strong></a>   
                                                                approved <strong><?= $value['rated_to'];  ?> </strong><br> <strong class="green-div"> +1</strong> request.</div>
                                                        <?php
                                                        } else {
                                                                ?>

                                                                    <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['google_picture_link']; ?>" width="50" height="50" /></div>
                                                                    <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">                                                   
                                                                    <a href="javascript:void(0);" class="name" ><strong><?= $value['ratedby'] ?></strong></a> 
                                                                    approved your <br><strong class="green-div">+1</strong> request</div>

                                                        <?php } } else { ?> 
                                                    
                                                      
                                                        <?php if ($value['user_id'] == $user_id) { ?>
                                                          <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['google_picture_link']; ?>" width="50" height="50" /></div>
                                                                <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">
                                                                <a href="javascript:void(0);" class="name" ><strong>You</strong></a>   
                                                                declined <strong><?= $value['rated_to'];  ?> </strong> request.</div>
                                                                                                                    
                                                        <?php } else{ ?>
                                                            <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['google_picture_link']; ?>" width="50" height="50" /></div>
                                                            <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">
                                                            <a href="javascript:void(0);" class="name"><strong><?= $value['ratedby']; ?></strong></a>
                                                            declined your request
                                                            </div>
                                                        <?php } ?>
                                                    
                                            <?php } ?>
                                            </div>
                                        <?php } ?>
                                        <?php if(empty($value['rating'])){ 
                                            if ($value['response_parent'] !='0'){ 
                                                    if ($value['user_id'] == $user_id) { ?>
                                                <div class="lft-div-my-team marginbot10">
					       <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['for_picture']; ?>" width="50" height="50" /></div>
                                               <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">
                                               <b>You</b> have given a response to <a href="javascript:void(0);" class="name" ><strong><?= $value['google_name'];  ?></strong></a>   
                                               </div>
                                        </div> 
                                            <?php }else { ?>
                                                <div class="lft-div-my-team marginbot10">
					       <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['for_picture']; ?>" width="50" height="50" /></div>
                                               <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">
                                               <a href="javascript:void(0);" class="name" ><strong><?= $value['ratedby'];  ?></strong></a> has given a response
                                               </div>
                                               </div>       
                                            <?php }}else {
                                                if ($value['user_id'] == $user_id) { ?>
					<div class="lft-div-my-team marginbot10">
					       <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['for_picture']; ?>" width="50" height="50" /></div>
                                               <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">
                                               Feedback given to <a href="javascript:void(0);" class="name" ><strong><?= $value['google_name'];  ?></strong></a>   
                                               </div>
                                        </div>       
                                        <?php } else { ?>
                                        <div class="lft-div-my-team marginbot10">
					       <div class="div-team-lft-img" title="<?= date("F j, Y, g:i a",strtotime($value['created_date']));?>"><img src="<?= $value['for_picture']; ?>" width="50" height="50" /></div>
                                               <div class="div-team-lft-txt" title="<?= date("F j, Y, g:i a", strtotime($value['created_date'])); ?>">
                                               Feedback received from <a href="javascript:void(0);" class="name" ><strong><?= $value['ratedby'];  ?></strong></a>   
                                               </div>
                                         </div>      
                                        <?php } } }?>
                                        
                                        <?php
                                    }
                                } else {
                                    ?>

                                    <div class="lft-div-my-team marginbot10">
                                        <strong>No recent activity found.</strong>
                                    </div>
<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
<?php require_once 'footer.php'; ?>

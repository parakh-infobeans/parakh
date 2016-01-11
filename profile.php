<?php
    require_once 'config.php';
    require_once 'class/rating.php';
    $renderObj = new rating();
    $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
    $user_id = ($_GET['id'] != '' ? $_GET['id']: $user_id);
    $chk = ($_GET['chk'] != '' ? $_GET['chk']: '0');
    if(!empty($_REQUEST['edit_comment']) && $renderObj->is_profile_access_allowed($user_id,$_SESSION['userinfo']->id)===false)
        header('Location: rating_dashboard.php?chk=19');
    $record = $renderObj->get_profile($user_id);
    $get_work_rating = $renderObj->get_work_rating($user_id);
    if($record != 0)
    {
        $name = ($record['google_name'] != '' ? $record['google_name'] : 'NA');
        $email = ($record['google_email'] != '' ? $record['google_email'] : 'NA');
        $mobile_number = ($record['mobile_number'] != '' ? $record['mobile_number'] : 'NA');
        $designation = ($record['designation'] != '' ? $record['designation'] : 'NA');
        $profile_pic = ($record['google_picture_link'] != '')?$record['google_picture_link']."?sz=100":'https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100';
    }
    require_once 'header.php';
    $html_for_minus_one = $html_for_plus_one = '';
    $plus_rating = 0;$minus_rating = 0;
    foreach(@$get_work_rating as $key=>$val)
    {
        $date = 'N/A';
	if($val['created_date'])
            $date = date("d-M-Y", strtotime($val['created_date']));
	$val['title'] = ($val['title'] != '' ? $val['title']: 'N/A');
	$val['given_by_name'] = ($val['given_by_name'] != '' ? $val['given_by_name']: 'N/A');
	$val['description'] = ($val['description'] != '' ? $val['description']: 'N/A');
        $val['description'] = ($val['manager_comment']!='') ? $val['manager_comment'] : $val['description'];
        if($val['rating'] == 1)
        {
            $plus_rating++;
            $html_for_plus_one .= '<div class="profile-lft-row"><div class="pforile-lft-row-col"  style="padding-right:5px">';
            if(!empty($_REQUEST['edit_comment']) && ($val['given_by']==$_SESSION['userinfo']->id)  && ($val['user_id']!=$_SESSION['userinfo']->id))
            {
                $val['description'] = ($val['description']=='N/A') ? '' : $val['description'];
                $html_for_plus_one .='<a href="#" id="comments_'.$val["rate_id"].'" data-type="textarea" data-pk="'.$val["rate_id"].'" class="editable">'.$val['description'].'</a>';
            }
            else
                $html_for_plus_one .= $val['description'];

            $html_for_plus_one .= '&nbsp;</div>';
            $html_for_plus_one .= '<div class="pforile-lft-row-col2">'.$val['given_by_name'].'&nbsp;</div><div class="pforile-lft-row-col2">'.$date.'&nbsp;</div></div>';
        }
        else if($val['rating'] == 0)
        {
            $minus_rating++;
            $html_for_minus_one .= '<div class="profile-lft-row"><div class="pforile-lft-row-col" style="padding-right:5px">';
            if(!empty($_REQUEST['edit_comment']) && ($val['given_by']==$_SESSION['userinfo']->id)  && ($val['user_id']!=$_SESSION['userinfo']->id))
            {
                $val['description']= ($val['description']=='N/A') ? '' : $val['description'];
                $html_for_minus_one .='<a href="#" id="comments_'.$val["rate_id"].'" data-type="textarea" data-pk="'.$val["rate_id"].'" class="editable">'.$val['description'].'</a>';
            }
            else
                $html_for_minus_one .=  $val['description'];
            $html_for_minus_one .= '&nbsp;</div>';
            $html_for_minus_one .= '<div class="pforile-lft-row-col2">'.$val['given_by_name'].'&nbsp;</div><div class="pforile-lft-row-col2">'.$date.'&nbsp;</div></div>';
        }
    }
    $html_for_minus_one = ($html_for_minus_one == '') ? "<div class='center'>No ratings available.</div>" : $html_for_minus_one;
    $html_for_plus_one = ($html_for_plus_one == '') ? "<div class='center'>No ratings available.</div>" : $html_for_plus_one;
    echo (isset($chk) && $chk>0) ? '<div class="succes-green"><div class="close-alert"></div>'.$errors[$chk].'</div>' : '';
?>
   <section>
        <div class="wrapper">
            <div class="mid-col-12">
                <div class="profile-wrapper">
                    <div class="profile-lft">
                        <div class="mid-col-img"><a href="javascript:void(0);"><img src="<?php echo $profile_pic; ?>"></a></div>
                    </div>
                    <div class="profile-rht">
                        <p class="name-txt"><?php echo $name; ?></p>
                        <p class="paddingtop5 paddingbot10"><?php echo $designation; ?></p>
                    </div>
                    <?php echo (empty($_REQUEST['edit_comment'])) ? '<a class="link-txt-request" style="margin-top:-50px" href="edit_profile.php">Edit Profile </a>' : ''; ?>
                    <div class="profile-hr"></div>
                    <div class="profile-wrapper-report">
                        <div class="profile-lft-report">
                            <div class="profile-lft-row">
                                <span class="request-positive-green-3">
                                <?php echo ($plus_rating > 0) ? "+".$plus_rating : '0';?>
                                </span>
                            </div>
                            <?=$html_for_plus_one?>
                        </div>
                        <div class="profile-rht-report">
                            <div class="profile-lft-row">
                                <span class="request-negative-red-3"><?php echo ($minus_rating > 0) ? "-".$minus_rating : '0';?></span>
                           </div>
                           <?=$html_for_minus_one?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <!-- x-editable (bootstrap version) -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.4.6/bootstrap-editable/js/bootstrap-editable.min.js"></script>
    <script src="js/inline_edit.js"></script>
    <script type="text/javascript">
	function edit_reason(rate_id)
        {
	   	alert(rate_id);
                $("#textarea_"+rate_id).attr('contenteditable','true');

	}
    </script>
    <style>
   .editable-click, a.editable-click {
    border-bottom: 1px dashed #000000;
    text-decoration: none;
    color:#000000;
    }
    a.editable-click:hover {
    border-bottom: 1px dashed #0088cc;
    text-decoration: none;
    color:#0088cc;
    }
    .editable-empty, .editable-empty:hover, .editable-empty:focus {
    color: #dd1144;
    font-style: italic;
    text-decoration: none;
    }
    html, body {height: 100%;}
    body{margin:0px;padding:0px;background-color:#31546f;font-family:Open Sans, Arial, Helvetica, sans-serif;
        color:#515151;font-size:14px;line-height:20px;}
    header, section, footer{
            display: block;
            clear:both;
    }
    header{
            background:#3c3c3c;
            height:111px;
    }
    footer{
            background:#adadad;
            text-align:center;
            color:#FFF;
        clear: both;
        display: block;
            margin-top:20px;
    }
    img{ border:0px;width:auto;max-width:131%;}
</style>
<?php require_once 'footer.php'; ?>

<?php
    require_once 'config.php';
    require_once 'class/rating.php';
    require_once 'functions/functions.php';
    $renderObj = new rating();
   
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
      if($_POST['comment'] == 'comment'){
	$record = $renderObj->edit_comment($_POST);
      }
      if($_POST['comment'] == 'response'){
        $record = $renderObj->feedbackResponseSave($_POST);
      }
    }
   
    $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
    $user_id = ($_GET['id'] != '' ? $_GET['id']: $user_id);
    $chk = ($_GET['chk'] != '' ? $_GET['chk']: '0');
    if(!empty($_REQUEST['edit_comment']) && $renderObj->is_profile_access_allowed($user_id,$_SESSION['userinfo']->id)===false)
        header('Location: rating_dashboard.php?chk=19');
    $record = $renderObj->get_profile($user_id);
    $get_work_rating = $renderObj->get_work_rating($user_id);
    $get_feedback = $renderObj->get_feedback($user_id);
    
   
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
    $i++;
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
                $val['description'] = ($val['description']=='N/A') ? 'Add Comment' : $val['description'];
//                 $html_for_plus_one .='<a href="#" id="comments_'.$val["rate_id"].'" data-type="textarea" data-pk="'.$val["rate_id"].'" class="editable">'.$val['description'].'</a>';
		$html_for_plus_one .='<a id="comment|'.$val["rate_id"] .'|'.$i.'|'.$val['user_id'].'" href="javascript:void(0);" title="Click to edit comment" class="edit-comment-btn">'.$val['description'].'</a>';
		$html_for_plus_one .= '<div class="overlay" id="overlay_comment_'.$val["rate_id"].'"></div>
				      <div class="dialoguebox2" id="commentDialog_'.$val["rate_id"].'">
				      <div class="dialogue-title">Please provide a reason for your rating</div>
				      <div class="dialogue-close2"><img src="images/close-btn.png" title="Close" width="20" height="20" /></div>';
		if($val['description'] != 'Add Comment'){
		  $html_for_plus_one .= '<textarea class="textarea-dialogue marginbot10 comment_comment_'.$val["rate_id"].'" placeholder="type your message/reason here...">'.$val['description'].'</textarea>';
		}else{
		  $html_for_plus_one .= '<textarea class="textarea-dialogue marginbot10 comment_comment_'.$val["rate_id"].'" placeholder="type your message/reason here..."></textarea>';
		}		       
		$html_for_plus_one .= '<div>
				      <div class="right_col"><input style="float:right;margin-right:7px;" type="button" value="Submit" name="submit_btn" id="submit_btn" class="submit-btn"/></div>
				      </div>
				      </div>';
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
                $val['description']= ($val['description']=='N/A') ? 'Add Comment' : $val['description'];
                //$html_for_minus_one .='<a href="#" id="comments_'.$val["rate_id"].'" data-type="textarea" data-pk="'.$val["rate_id"].'" class="editable">'.$val['description'].'</a>';
                $html_for_minus_one .='<a id="comment|'.$val["rate_id"] .'|'.$i.'|'.$val['user_id'].'" href="javascript:void(0);" title="Click to edit comment" class="edit-comment-btn">'.$val['description'].'</a>';
		$html_for_minus_one .= '<div class="overlay" id="overlay_comment_'.$val["rate_id"].'"></div>
					<div class="dialoguebox2" id="commentDialog_'.$val["rate_id"].'">
					<div class="dialogue-title">Please provide a reason for your rating</div>
					<div class="dialogue-close2"><img src="images/close-btn.png" title="Close" width="20" height="20" /></div>';
		if($val['description'] != 'Add Comment'){
		  $html_for_minus_one .= '<textarea class="textarea-dialogue marginbot10 comment_comment_'.$val["rate_id"].'" placeholder="type your message/reason here...">'.$val['description'].'</textarea>';
		}else{
		  $html_for_minus_one .= '<textarea class="textarea-dialogue marginbot10 comment_comment_'.$val["rate_id"].'" placeholder="type your message/reason here..."></textarea>';
		}
					
		
		$html_for_minus_one .= '<div>
					<div class="right_col"><input style="float:right;margin-right:7px;" type="button" value="Submit" name="submit_btn" id="submit_btn" class="submit-btn"/></div>
					</div>
					</div>';
            }
            else
                $html_for_minus_one .=  $val['description'];
            $html_for_minus_one .= '&nbsp;</div>';
            $html_for_minus_one .= '<div class="pforile-lft-row-col2">'.$val['given_by_name'].'&nbsp;</div><div class="pforile-lft-row-col2">'.$date.'&nbsp;</div></div>';
        }
    }
   
    foreach(@$get_feedback as $key=>$val)
    {
    $get_response = $renderObj->get_response($val['id']);    
    $i++;
    $date = 'N/A';
    if($val['created_date'])
            $date = date("d-M-Y", strtotime($val['created_date']));
    //$val['title'] = ($val['title'] != '' ? $val['title']: 'N/A');
    $val['given_by_name'] = ($val['given_by_name'] != '' ? $val['given_by_name']: 'N/A');
    $val['description'] = ($val['description'] != '' ? $val['description']: 'N/A');
        //$val['description'] = ($val['manager_comment']!='') ? $val['manager_comment'] : $val['description'];
        //    $plus_rating++;
            $html_for_feedback .= '<div class="profile-lft-row"><div class="box-two"><p class="wrap-text">';
           
            $html_for_feedback .= $val['description'];

            $html_for_feedback .= '</p></div>';
            
            $html_for_feedback .= '<div class="box-three"><p>'.$val['given_by_name'].'</p></div>
 				   <div class="box-four"><p>'.$date.'</p></div>
 				   <div class="box-one"><a id="response|'.$val["id"] .'|'.$val['feedback_from'].'|'.$val['feedback_to'].'" class="response-btn" style="text-align: center;" href="javascript:void(0);">View</a> </div></div>';
            $html_for_feedback .= '<div class="overlay" id="overlay_response_'.$val["id"].'"></div>
                                   <div class="popup-content" id="responseDialog_'.$val["id"].'">
                                   <div class="view_response"> <b>View Response</b> </div>    
                                   <div class="dialogue-close2" style="right:13px;">
                                   <img style="margin-left:4px;" width="20" height="20" title="Close" src="images/close-btn-response.png">
                                   </div>  <div class="response_description">
                                   <p class="profile-lft-row-response"><span style=" word-wrap: break-word;">'.$val['description'].'</span><br><span class="sub-response-title"><i>Posted by : '.$val['given_by_name'].' on '.$date.'</i></span></p>';
            foreach($get_response as $key=>$val1){
                $date_response = date("d-M-Y", strtotime($val1['created_date']));
                $html_for_feedback .= '<p class="profile-lft-row-response"><span style=" word-wrap: break-word;">'.$val1['description'].'</span><br><span class="sub-response-title"><i>Posted by : '.$val1['given_by_name'].' on '.$date_response.'</i></span></p>';
            }
            $html_for_feedback .= '</div><div class="response-textarea"><textarea class="popup-inputbox response_comment_'.$val["id"].'" placeholder="type your response here..."></textarea>
				   <div class="pop-up-submit">
 				   <input class="edit-submit-btn" name="edit-submit-btn" id="edit-submit-btn" type="button" value="Submit">	
 				   </div> </div></div>';

    }
    $html_for_minus_one = ($html_for_minus_one == '') ? "<div class='center'>No ratings available.</div>" : $html_for_minus_one;
    $html_for_plus_one = ($html_for_plus_one == '') ? "<div class='center'>No ratings available.</div>" : $html_for_plus_one;
    $html_for_feedback = ($html_for_feedback == '') ? "<div class='center'>No feedback available.</div>" : $html_for_feedback;
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
                            <div class="profile-team-lft">
                            <div class="content" id="content-2">
			      <?=$html_for_plus_one?>
			    </div>
                            </div>
                        </div>
                        <div class="profile-rht-report">
                            <div class="profile-lft-row">
                                <span class="request-negative-red-3"><?php echo ($minus_rating > 0) ? "-".$minus_rating : '0';?></span>
                           </div>
                           <div class="profile-team-lft">
                            <div class="content" id="content-1">
			      <?=$html_for_minus_one?>
                           </div>
                           </div>
                        </div>
                    </div>
                    <div class="about-section" id="about">
			<h2>Feedback: an opportunity to improve</h2>
		    <?php if(!empty($get_feedback)){ ?>
		    <div class="profile-lft-row" style="width: 94%;">
		    <div class="box-two">
		    <p><b>Description</b></p>
		    </div>
		    <div class="box-three">
		    <p><b>Given By</b></p>
		    </div>
		    <div class="box-four">
		    <p><b>Given On</b></p>
		    </div>
		    <div class="box-one">
		    <p><b>Action</b></p>
		    </div>
		    </div>
		    <?php } ?>
		    <div class="profile-team-lft">
		    <div class="content-feedback" id="content-3">
		      <?=$html_for_feedback?>
		      </div>
		    </div>
		    </div>
                </div>
            </div>
        </div>
    </section>
    
     <div id="ajaxBusy" class="ajaxLoader"><p><img id="imgAjaxLoader" class="ajaxLoaderImg" src="./images/loading.gif" /></p></div>
    <script type="text/javascript">
        $(document).ready(function () {
              
        $('.popup-content').hide();
	    var button = '';
            $.ajaxSetup({
                beforeSend: function () {
                    $(".ajaxLoader").show();
                    $('.dialoguebox2').hide();
                    $('.popup-content').hide();
                },
                complete: function () {
                    $(".ajaxLoader").hide();
                }
            });
           
           
            $('a.edit-comment-btn').click(function () {
                var val = this.id.split('|');
                $('div#overlay_' + val[0] + '_' + val[1]).show();
                $('div#commentDialog_' + val[1]).show();
                var flag = '';
                $('.submit-btn').bind('click', {"val": val, "flag": ""}, editCommentSubmit);
                $('.dialogue-close2').bind('click', {}, closeEditCommentDialog);
            });
            
            $('a.response-btn').click(function () {
                var val = this.id.split('|');
                $('div#overlay_' + val[0] + '_' + val[1]).show();
                $('div#responseDialog_' + val[1]).show();
                var flag = '';
                $('.edit-submit-btn').bind('click', {"val": val, "flag": ""}, responseSubmit);
                $('.dialogue-close2').bind('click', {}, closeResponseDialog);
            });
	    
	    function closeEditCommentDialog(event)
            {
                $(".textarea-dialogue").removeClass("red-border");
                $('.overlay').hide();
                $(this).parent('.dialoguebox2').hide();
                //window.location.reload();
            }
            
            function closeResponseDialog(event)
            {
                $(".textarea-dialogue").removeClass("red-border");
                $('.overlay').hide();
                $('.popup-content').hide();
                //$(this).parent('.dialoguebox2').hide();
                //window.location.reload();
            }

            function editCommentSubmit(event)
            {
            
                var val = event.data.val;
                var bit = event.data.flag;
                var msg = '';
                var id = val[1];
                var wchBtn = val[0];
                var alpha = $(".link-all").html();
                var clkBtn = event.target.id;
                if (wchBtn == "comment")
                {
                    var mess = $(".comment_comment_" + id).val();
                }
                var data = "&action=btn_click&rating_id=" + id + "&comment=" + wchBtn + "&desc=" + mess + "&alphaValue=" + alpha;
                var resp = "";
                if (bit != '')
                {
                    $.post("profile.php", data, function (response) {
                        $(".succes-green").show();
                        $('.overlay').hide();
                    });
                }else
                {
                    if (clkBtn == 'submit_btn' && mess == '')
                    {
                        $(".textarea-dialogue").addClass("red-border");
                        return false;
                    }
			$.post("profile.php?"+val[3]+"&edit_comment=true", data, function (response) {
			window.location.reload();

                    });
                }
            }
            
            function responseSubmit(event)
            {
            
                var val = event.data.val;
                var bit = event.data.flag;
                var msg = '';
                var id = val[1];
                var wchBtn = val[0];
                var alpha = $(".link-all").html();
                var clkBtn = event.target.id;
                if (wchBtn == "response")
                {
                    var mess = $(".response_comment_" + id).val();
                }
                <?php if($_SESSION['userinfo']->id != $user_id) { //Response given by Lead/Manager on parent feedback?>
                    var data = "&action=btn_click&feedback_id=" + id + "&comment=" + wchBtn + "&desc=" + mess + "&feedback_to=" + val[3];    
                <?php } else { //Response given by Team member on parent feedback?>
                    var data = "&action=btn_click&feedback_id=" + id + "&comment=" + wchBtn + "&desc=" + mess + "&feedback_to=" + val[2];
                <?php } ?>
                
                var resp = "";
                if (bit != '')
                {
                        $.post("profile.php", data, function (response) {
                        $(".succes-green").show();
                        $('.overlay').hide();
                    });
                }else
                {
                    if (clkBtn == 'edit-submit-btn' && mess == '')
                    {
                        $(".textarea-dialogue").addClass("red-border");
                        return false;
                    }
			$.post("profile.php", data, function (response) {
			window.location.reload();

                    });
                }
            }
        });
    </script>
   
    <style>
    
    
    #content-3 .mCustomScrollBox{
    max-width: 98%;
    }
    .edit-comment-btn{
    border-bottom: 1px dashed #515151;
    color: #515151;
    text-decoration: none;
    margin-top:10px;
    }
    .red-border {
    border: 1px solid red;
    }
    .textarea-dialogue {
    background-color: #fff !important;
    border: 1px solid #999 !important;
    box-shadow: unset !important;
    height: 100px;
    padding: 5px;
    resize: none;
    width: 95% !important;
    }
    .content{
    height:422px;
    width:511px;
    }
    .content-feedback{
    height:422px;
    width:100%;
    }
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

    <?php
    require_once 'config.php';
    require_once 'class/rating.php';
    require_once 'functions/functions.php';
    $renderObj = new rating();
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'){
        if($_POST['comment'] == 'feedback'){
	  $record = $renderObj->saveFeedback($_POST);
        }else{
	  $record = $renderObj->saveWorkManager($_POST);
        }
    }    

    $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id : 0);
    $alphaValue = ($_POST['alphaValue'] != '' ? $_POST['alphaValue'] : 0);
    if ($alphaValue == 'All')
        $alphaValue = '';

    $team_member = $renderObj->get_all_sub_employee_list($user_id);
    $rating_dashboard = $renderObj->rating_dashboard($employeeList, $alphaValue);
    $rating_dashboard = sortByRating($rating_dashboard);

    if (!empty($rating_dashboard)) {
        $i = 0;
        foreach ($rating_dashboard as $key => $val) {
            $i++;
            $user_id = $val['id'];
            $user_name = $val['google_name'];
            $profile_pic = ($val['google_picture_link']) ? $val['google_picture_link'] . "?sz=100" : 'images/user.png';
            ?>
            <div class="mid-col-4">
                <div class="mid-col-top">
                    <div class="mid-col-img"><a href="./profile.php?id=<?= $val['id'] ?>&edit_comment=true"><img src="<?php echo $profile_pic; ?>" /></a></div>
                    <p class="center name-txt"><strong><?php echo $val['google_name']; ?></strong><p>
                    <p class="center paddingtop5 paddingbot10"><?php echo ($val['designation'] !== '' ? $val['designation'] : "N/A"); ?><p>
                    <p class="center"><img src="images/message-icon.png"><p>
                    <p class="center paddingbot10"><?php echo $val['google_email'] ?></p>
                    <div class="center action-acc-parent relative">
                        <div class="action-accordian">
                            <a id="feedback|<?= $user_id ?>|<?= $i ?>|<?= $user_name ?>" href="javascript:void(0);" class="feedback-btn" ><img title="Give Feedback" src="images/edit-btn.png"/></a>
                            <div class="overlay" id="overlay_feedback_<?= $user_id ?>"></div>
                            <div class="dialoguebox2" id="feedbackDialog_<?= $user_id ?>">
			      <div class="dialogue-title"><?php echo $errors[14]; ?></div>
			      <div class="dialogue-close2"><img src="images/close-btn.png" title="Close" width="20" height="20" /></div>
			      <textarea class="textarea-dialogue marginbot10 feedback_comment_<?= $user_id ?>" placeholder="type your message/reason here..."></textarea>
			      <div>
				  <div class="right_col"><input style="float:right;margin-right:7px;" type="button" value="Submit" name="submit_btn" id="submit_btn" class="submit-btn"/></div>
			      </div>
			    </div>
                            
                            
                            <a href="javascript:void(0);"><img src="images/add-btn.png"/></a>
                            <a href="./profile.php?id=<?= $val['id'] ?>&edit_comment=true"><img src="images/view-btn.png"/></a>
                            <a href="javascript:void(0);"><img src="images/delete-btn.png"/></a>
                        </div>
                        <div class="action-acc-parent-inner"></div>
                        <div class="action-acc-innner"><div class="action-acc-innner-arr"></div></div>
                    </div>
                </div>
                <div class="mid-col-bel">
                    <div class="mid-col-bel-lft relative"><a href="javascript:void(0);" id="green|<?= $user_id ?>|<?= $i ?>" class="green-btn rateButton green_<?= $i ?>"><?php echo ($val['rating_plus'] > 0 ? "+" . $val['rating_plus'] : '0'); ?></a>
                        <div class="overlay" id="overlay_green_<?= $user_id ?>"></div>
                        <div class="dialoguebox2" id="greenDialog_<?= $user_id ?>">
                            <div class="dialogue-title"><?php echo $errors[14]; ?></div>
                            <div class="dialogue-close2"><img src="images/close-btn.png" title="Rate Later" width="20" height="20" /></div>
                            <textarea class="textarea-dialogue marginbot10 green_comment_<?= $user_id ?>" placeholder="type your message/reason here..."></textarea>
                            <div class="wrap">
                                <div class="left_col"><input style="float:left" type="button" value="Submit without comments" id="rate_without_submit_btn" onclick="javascript:$('.green_comment_<?= $user_id ?>').val('');" name="rate_without_comment_btn" class="submit-btn"/></div>
                                <div class="right_col"><input style="float:right" type="button" value="Submit" name="submit_btn" id="submit_btn" class="submit-btn"/></div>
                            </div>
                        </div>
                    </div>
                    <div class="mid-col-bel-rht relative"><a href="javascript:void(0);" id="red|<?= $user_id ?>|<?= $i ?>" class="red-btn rateButton red_<?= $i ?>"><?php echo ($val['rating_minus'] > 0 ? "-" . $val['rating_minus'] : '0'); ?></a>
                        <div class="overlay" id="overlay_red_<?= $user_id ?>"></div>
                        <div class="dialoguebox2" id="redDialog_<?= $user_id ?>">
                            <div class="dialogue-title"><?php echo $errors[14]; ?></div>
                            <div class="dialogue-close2"><img src="images/close-btn.png" title="Rate Later" width="20" height="20"/></div>
                            <textarea class="textarea-dialogue marginbot10 red_comment_<?= $user_id ?>" id="comment|<?= $user_id ?>" name="comment|<?= $user_id ?>" placeholder="type your message/reason here..."></textarea>
                            <div class="wrap">
                                <div class="left_col"><input style="float:left" type="button" value="Submit without comments" onclick="javascript:$('.red_comment_<?= $user_id ?>').val('');" id="rate_without_submit_btn" name="rate_without_comment_btn" class="submit-btn"/></div>
                                <div class="right_col"><input style="float:right" type="button" value="Submit" name="submit_btn" id="submit_btn" class="submit-btn"/></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>  <?php } ?>
    <div id="ajaxBusy" class="ajaxLoader"><p><img id="imgAjaxLoader" class="ajaxLoaderImg" src="./images/loading.gif" /></p></div>
    <script type="text/javascript">
        $(document).ready(function () {
            var button = '';
            $.ajaxSetup({
                beforeSend: function () {
                    $(".ajaxLoader").show();
                    $('.dialoguebox2').hide();
                },
                complete: function () {
                    $(".ajaxLoader").hide();
                }
            });
            $("a.red-btn").addClass("red-btn-active-dashboard");
            $('.action-acc-innner').click(function () {
                $(this).parent().find('.action-acc-parent-inner').slideToggle(600);
                $(this).parent().find('.action-acc-innner-arr').toggleClass('action-acc-innner-arr1');
            });
            
            $('a.feedback-btn').click(function () {
                var val = this.id.split('|');
                $(".action-accordian").removeClass("action-accordian").addClass("action-accordian-new");
		$(".dialogue-title").html("Write your views for "+ val[3]);
                $('div#overlay_' + val[0] + '_' + val[1]).show();
                $('div#feedbackDialog_' + val[1]).show();
                var flag = '';
                $('.submit-btn').bind('click', {"val": val, "flag": ""}, feedbackSubmit);
                $('.dialogue-close2').bind('click', {}, closeFeedbackDialog);
            });

            $('a.green-btn').click(function () {
                var val = this.id.split('|');
                $(".green_" + val[2]).removeClass("green-btn").addClass("green-btn-active-dashboard");
                $(".red_" + val[2]).removeClass("red-btn-active-dashboard").addClass("red-btn");
                $('div#overlay_' + val[0] + '_' + val[1]).show();
                $('div#greenDialog_' + val[1]).show();
                var flag = '';
                $('.submit-btn').bind('click', {"val": val, "flag": ""}, rateSubmit);
                $('.dialogue-close2').bind('click', {}, closeDialog);
            });

            $('a.red-btn').click(function () {
                var val = this.id.split('|');
                $(".green_" + val[2]).removeClass("green-btn").addClass("green-btn-active-dashboard");
                $(".red_" + val[2]).removeClass("red-btn-active-dashboard").addClass("red-btn");
                $('div#overlay_' + val[0] + '_' + val[1]).show();
                $('div#redDialog_' + val[1]).show();
                var flag = '';
                $('.submit-btn').bind('click', {"val": val, "flag": ""}, rateSubmit);
                $('.dialogue-close2').bind('click', {}, closeDialog);
            });

            function closeDialog(event)
            {
                $(".textarea-dialogue").removeClass("red-border");
                $('.overlay').hide();
                $(this).parent('.dialoguebox2').hide();
                window.location.reload();
            }
            
            function closeFeedbackDialog(event)
            {
                $(".textarea-dialogue").removeClass("red-border");
                $('.overlay').hide();
                $(this).parent('.dialoguebox2').hide();
                //window.location.reload();
            }

            function rateSubmit(event)
            {
                var val = event.data.val;
                var bit = event.data.flag;
                var msg = '';
                var id = val[1];
                var wchBtn = val[0];
                var rating = '';
                var alpha = $(".link-all").html();
                var clkBtn = event.target.id;
                if (wchBtn == "green")
                {
                    rating = 1;
                    var mess = $(".green_comment_" + id).val();
                }
                if (wchBtn == "red")
                {
                    rating = 0;
                    var mess = $(".red_comment_" + id).val();
                }
                var data = "&action=btn_click&user_id=" + id + "&rating=" + rating + "&desc=" + mess + "&alphaValue=" + alpha;
                var resp = "";
                if (bit != '')
                {
                    $.post("user_rating_dashboard.php", data, function (response) {
                        $("#content_listing").html(response);
                        $(".succes-green").show();
                        $('.overlay').hide();
                    });
                }
                else
                {
                    if (mess == "undefined" || mess == undefined)
                        mess = "";
                    if (clkBtn == 'submit_btn' && mess == '')
                    {
                        $(".textarea-dialogue").addClass("red-border");
                        return false;
                    }
                    $.post("user_rating_dashboard.php", data, function (response) {
                        $("#content_listing").html(response);
                        $(".succes-green").show();
                        $('.overlay').hide();
                    });
                }
            }
            
            function feedbackSubmit(event)
            {console.log(event);
                var val = event.data.val;
                var bit = event.data.flag;
                var msg = '';
                var id = val[1];
                var wchBtn = val[0];
                var alpha = $(".link-all").html();
                var clkBtn = event.target.id;
                if (wchBtn == "feedback")
                {
                    var mess = $(".feedback_comment_" + id).val();
                }
                
                var data = "&action=btn_click&user_id=" + id + "&comment=" + wchBtn + "&desc=" + mess + "&alphaValue=" + alpha;
                var resp = "";
                console.log(bit);
                if (bit != '')
                {
                    $.post("user_rating_dashboard.php", data, function (response) {
                        $("#content_listing").html(response);
                        $(".succes-green").show();
                        $('.overlay').hide();
                    });
                }
                else
                {
                    if (mess == "undefined" || mess == undefined)
                        mess = "";
                    if (clkBtn == 'submit_btn' && mess == '')
                    {
                        $(".textarea-dialogue").addClass("red-border");
                        return false;
                    }
                    $.post("user_rating_dashboard.php", data, function (response) {
                        $("#content_listing").html(response);
                        $(".succes-green").show();
                        $('.overlay').hide();
                    });
                }
            }
        });
    </script>
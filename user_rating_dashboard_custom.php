<?php
    require_once 'config.php';
    require_once 'class/rating.php';
    require_once 'functions/functions.php';
    $renderObj = new rating();
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=== 'xmlhttprequest' )
        $record = $renderObj->saveWorkManager($_POST);
    $alphaValue = strip_tags($_POST['alphaValue']);
    $alphaValue = ($alphaValue != '' ? $alphaValue : 0);
    $alphaValue = ($alphaValue == 'All') ? '' : $alphaValue;
    $team_member = $renderObj->get_all_member_custom();
    $rating_dashboard = $renderObj->rating_dashboard($team_member, $alphaValue);
    $rating_dashboard = sortByRating($rating_dashboard);
    //pr($rating_dashboard);
    if(!empty($rating_dashboard)) {
      $i = 0;
      foreach($rating_dashboard as $key=>$val) {
	$i++;
        $user_id = $val['id'];
        $profile_pic = ($val['google_picture_link'])?$val['google_picture_link']."?sz=100":'images/user.png'; ?>
        <div class="mid-col-4">
            <div class="mid-col-top">
                <div class="mid-col-img"><a href="./profile.php?id=<?=$val['id']?>&edit_comment=true"><img src="<?php echo $profile_pic; ?>" /></a></div>
                <p class="center name-txt"><strong><?php echo $val['google_name'];?></strong><p>
                <p class="center paddingtop5 paddingbot10"><?php echo ($val['designation']!==''?$val['designation']: "N/A"); ?><p>
                <p class="center"><img src="images/message-icon.png"><p>
                <p class="center paddingbot10"><?php echo $val['google_email']?></p>
            </div>
            <div class="mid-col-bel-other">
                <textarea name="work_desc" id="work_desc" class="textarea-dialogue-other marginbot10" placeholder="type your message/reason here..."></textarea>
                <a class="green-btn" href="javascript:void(0);" onclick="submit_rating('<?=$val['id']?>','<?=$val['manager_id']?>');">Submit</a>
            </div>
        </div>
    <?php } } else { ?>  <?php } ?>
    <div id="ajaxBusy" class="ajaxLoader"><p><img id="imgAjaxLoader" class="ajaxLoaderImg" src="./images/loading.gif"/></p></div>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                beforeSend:function(){
                    $(".ajaxLoader").show();
                    $('.dialoguebox2').hide();
                },
                complete:function(){
                    $(".ajaxLoader").hide();
                }
            });
        });

        function submit_rating(for_id,manager_id)
        {
            $('.overlay').show();
            var user_id = "<?php echo $_SESSION['userinfo']->id ?>";
            //alert(manager_id); return false;
            if(manager_id==undefined || user_id==undefined || manager_id=='' || for_id == '')
            {
                alert('Error reading form values, Cannot process request.');
                return;
            }
            var rating = 1;
            var reason = $("#work_desc").val();
            if(reason.trim() == '')
            {
               var error_msg='<div id="ajax_resp" class="error-red"><div class="close-alert"></div>'+"<?php echo $errors[15]; ?>"+'</div>';
               $("#error_container").html(error_msg);
               $("#error_container").show();
               $('.overlay').hide();
               $(".textarea-dialogue-other").addClass("red-border");
               return false;
            }
            var data = "&action=tm_rating_request&lead_id="+manager_id+"&user_id="+user_id+"&for_id="+for_id+"&rating="+rating+"&work_desc="+reason;
            $.post("ajax_request.php", data, function(response){
                  $("#error_container").html(response);
                  $("#error_container").show();
                  $('.overlay').hide();
                  $(".textarea-dialogue-other").removeClass("red-border");
                  $("#work_desc").val("");
                  window.location.reload();
            });
        }
    </script>
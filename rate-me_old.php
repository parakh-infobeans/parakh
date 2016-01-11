<?php
    require_once 'config.php';
    require_once 'class/rating.php';
    require_once 'functions/functions.php';
    $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
    $renderObj = new rating();
    $lead_list = $renderObj->get_all_lead($user_id);

    if($lead_list == 0)
        header('Location: profile.php?chk=1');
    $request_list = $renderObj->get_user_request_details($user_id,'0');
    require_once 'header.php';
?>
<div id="error_container"><div class="error-red"><div class="close_alert_rateme"></div></div></div>
<div class="overlay" id="overlay_rateme"></div>
    <div class="mid-col-12">
        <div class="mid-col-4">
            <div class="mid-col-top relative">
                <div class="gallery-wrap">
                    <div class="gallery clearfix">
                        <?php
                          $i = 0;
                          foreach($lead_list as $user){
                          $profile_pic = ($user['google_picture_link'] != '')?$user['google_picture_link']."?sz=100":"images/user.png";
                          $i++; ?>
                          <div class="gallery__item" id="manager_<?php echo $user['manager_id'];?>">
                                <div class="mid-col-img"><a href="javascript:void(0);"><img src="<?php echo $profile_pic; ?>"/></a></div>
                                <p class="center name-txt"><a href="javascript:void();" class="name"><?php echo $user['manager_name']; ?></a><p>
                                <p class="center"><?php echo $user['role_name']; ?></p>
                                <span class="request-positive-green-2">+1</span>
                          </div>
                          <?php }  ?>
                    </div>
                    <?php if(count($lead_list)>1) { ?>
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
            <div class="mid-col-bel-other">
                <textarea name="work_desc" id="work_desc" class="textarea-dialogue-other marginbot10" placeholder="type your message/reason here..."></textarea>
                <a class="green-btn" href="javascript:void(0);">Submit</a>
            </div>
        </div>
    <?php
    if(count($request_list) > 0) {
        foreach ($request_list as $request_details) {
            $date = "N/A";
            if($request_details['created_date'])
                $date = date("d-M-Y H:i", strtotime($request_details['created_date']));
            $profile_pic = ($request_details['google_picture_link'] != '')?$request_details['google_picture_link']."?sz=100":"images/user.png";
            $lead_name=(!empty($request_details['google_name']))? $request_details['google_name'] : "&nbsp;";
            $lead_role=(!empty($request_details['role_name']))? $request_details['role_name'] : "&nbsp;";
            ?>
            <div class="mid-col-4 box">
                 <?php $rating = $request_details['rating'];
                       switch($request_details['status'])
                       {
                           case '0':
                               $status_text= 'Request is pending';
                               break;
                           case '1':
                               $status_text= 'Request is declined';
                               break;
                           case '2':
                               $status_text= 'Request is approved';
                               break;
                       }?>
                <div class="triangle-topright" title= "<?=$status_text?>"></div>
                <div class="mid-col-top">
                    <div class="mid-col-img"><a href="javascript:void(0);"><img src="<?php echo $profile_pic; ?>" /></a></div>
                    <p class="center name-txt"><a href="javascript:void();" class="name"><?php echo $lead_name; ?></a><p><p class="center"><?php echo $lead_role; ?></p>
                    <?php if ($request_details['request_for'] == 1){ ?>
                        <span class="request-positive-green-2">+1</span>
                    <?php }else if($request_details['request_for'] == 0){ ?>
                         <span class="request-negative-red">-1</span>
                   <?php }?>
                </div>
                <div class="mid-col-bel-other rateme_desc_height">
                    <div class="scroll-y">
                        <span>
                            <?php echo ($request_details['description'] != '' ? $request_details['description'] : 'N/A');
                            $date_tobe_formatted = date_create($request_details['created_date']);
                            echo "</p><BR><p style='text-align:right;background-color:#eae8e9;line-height:20px;font-size:12px;font-family: Open Sans, Arial, Helvetica, sans-serif;'>";
                            echo '<i>'.$today = date_format( $date_tobe_formatted,"j F, Y g:i a").'</i></p>'; ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php } }?>
    </div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
<script type="text/javascript">
    $(window).load(function(){
        $(".gallery__link").fancybox({
            'titleShow'     : false,
            'transitionIn'  : 'elastic',
            'transitionOut' : 'elastic'
        });
        var totalWidth = 0;
        $(".gallery__item").each(function(){
            totalWidth = totalWidth + $(this).outerWidth(true);
        });
        var maxScrollPosition = totalWidth - $(".gallery-wrap").outerWidth();
        var maxScrollPosition = totalWidth - $(".gallery-wrap1").outerWidth();
        var maxScrollPosition = totalWidth - $(".gallery-wrap2").outerWidth();

        function toGalleryItem($targetItem){
            if($targetItem.length){
                var newPosition = $targetItem.position().left;

                if(newPosition <= maxScrollPosition){
                    $targetItem.addClass("gallery__item--active");
                    $targetItem.siblings().removeClass("gallery__item--active");
                    $(".gallery").animate({
                        left : - newPosition
                    });
                } else {
                    $(".gallery").animate({left : - maxScrollPosition});
                };
            };
        };
        $(".gallery").width(totalWidth);
        $(".gallery__item:first").addClass("gallery__item--active");
        $(".gallery__controls-prev").addClass("gallery__controls_inactive");

        $(".gallery__controls-prev").click(function(){
            var $targetItem = $(".gallery__item--active").prev();
            $(".gallery__controls-next").removeClass("gallery__controls_inactive");
            $(".gallery__controls-prev").addClass("gallery__controls_inactive");
            toGalleryItem($targetItem);
        });

        $(".gallery__controls-next").click(function(){
            var $targetItem = $(".gallery__item--active").next();
            $(".gallery__controls-prev").removeClass("gallery__controls_inactive");
            $(".gallery__controls-next").addClass("gallery__controls_inactive");
            toGalleryItem($targetItem);
        });
    });
    </script>
    <script type="text/javascript" src="js/jquery.fancybox-1.3.1.js"></script>
    <div id="ajaxBusy" class="ajaxLoader" ><p><img id="imgAjaxLoader" class="ajaxLoaderImg" src="./images/loading.gif" /></p></div>
    <script>
        $(document).ready(function(){
            $('#error_container').click(function(){ $('#error_container').hide();});
            $('#error_container').hide();
            $.ajaxSetup({
                beforeSend:function(){ $(".ajaxLoader").show();},
                complete:function(){
                  //  $(".ajaxLoader").hide();
                }
            });

            $('a.green-btn').click(function(){
                $('.overlay').show();
                var manager=$(".gallery__item--active").attr('id');
                var user_id="<?php echo $_SESSION['userinfo']->id ?>";
                if(manager==undefined || user_id==undefined )
                           {
                    alert('Error reading form values, Cannot process request.');
                    return;
                }
                var manager_id = manager.split('_');
                manager_id=manager_id[1];
                var rating=1;
                var reason=$("#work_desc").val();
                if(reason.trim() == ''){
                   var error_msg='<div id="ajax_resp" class="error-red"><div class="close-alert"></div>'+"<?php echo $errors[15]; ?>"+'</div>';
                   $("#error_container").html(error_msg);
                   $("#error_container").show();
                   $('.overlay').hide();
		   $(".textarea-dialogue-other").addClass("red-border");
		   return false;
	         }
                var data = "&action=tm_rating_request&lead_id="+manager_id+"&user_id="+user_id+"&for_id="+user_id+"&rating="+rating+"&work_desc="+reason;

                $.post("ajax_request.php", data, function(response){
                      $("#error_container").html(response);
                      $("#error_container").show();
                      $('.overlay').hide();
                      $(".textarea-dialogue-other").removeClass("red-border");
                      $("#work_desc").val("");
                      window.location.reload();
                });
            });
        });
    </script>
<?php require_once 'footer.php';?>

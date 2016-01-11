<?php
    require_once 'config.php';
    require_once 'class/rating.php';
    require_once 'functions/functions.php';
    $renderObj = new rating();
    $page_number = (int) (!isset($_GET['page']) ? 1 :$_GET['page']);
    $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $comment_key = "comment_".$_POST['ptr'];
        $_POST['comment'] = $_POST[$comment_key];

        if($_POST['status'] == 0)
        {
            $record = $renderObj->decline($_POST);
            $chk = 17;
        }
        else if($_POST['status'] == 1)
        {
            $record = $renderObj->save_emp_rating($_POST);
            $chk = 16;
        }
    }
    $pending_requests = $renderObj->get_team_member_requests($user_id);
    require_once 'header.php';
?>
<script type="text/javascript">
    $(document).ready(function(){
	$("a.red-btn-request").addClass("red-btn-active");
	$('.request-accordian-bot').click(function(){
            $(this).parent().find('.request-accordian-top').slideToggle(600);
            $(this).parent().find('.accordian-arrow').toggleClass('accordian-arrow-down');
	});
	$('.logo-rht-txt').mouseover(function(){
            $('ul.dropdown').show();
	});
	$('.logo-rht-txt').mouseout(function(){
            $('ul.dropdown').hide();
	});
    });

    function green_click(i)
    {
        document.getElementById('give_rating_'+i).status.value = '1';
        $('.overlay_'+i).show();
        $('.dialoguebox2_'+i).show();
        $("#green_click_"+i).removeClass("green-btn-request").addClass("green-btn-active");
        $("#red_click_"+i).removeClass("red-btn-active").addClass("red-btn-request");
    }

    function red_click(i)
    {
        document.getElementById('give_rating_'+i).status.value = '0';
        $("#green_click_"+i).removeClass("green-btn-active").addClass("green-btn-request");
        $("#red_click_"+i).removeClass("red-btn-request").addClass("red-btn-active");
        $('.overlay_'+i).show();
        $('.dialoguebox2_'+i).show();
    }

    function close_popup(i)
    {
        $('.overlay').hide();
        $('.dialoguebox2').hide();
    }

    function submit_popup(i)
    {
        $('.overlay').hide();
        $('.dialoguebox2').hide();
        $('#overlay_rateme').show();
        $('#ajaxBusy').show();
        document.getElementById('give_rating_'+i).submit();
    }
</script>
<div class="overlay" id="overlay_rateme"></div>
<div id="ajaxBusy" class="ajaxLoader"><p><img id="imgAjaxLoader" class="ajaxLoaderImg" src="./images/loading.gif" alt="Loading"/></p></div>
<?php echo (isset($chk)) ? '<div class="succes-green"><div class="close-alert"></div>'.$errors[$chk].'</div>' : ''; ?>
    <div class="add-request-block">
        <a class="link-txt-request" href="rate-me.php">Rate Me</a>
    </div>
    <div class="mid-col-12">
        <?php if(count($pending_requests) > 0 ){
            $i = 0;
            foreach($pending_requests as $request_details){
                $i++;
                $profile_pic = ($request_details['google_picture_link'] != '')?$request_details['google_picture_link']."?sz=100":"images/user.png";
        ?>
        <div class="mid-col-4">
            <form class="form-horizontal" name="give_rating_<?php echo $i;?>" id="give_rating_<?php echo $i;?>" id="" role="form" method="post" action="">
                <input value="<?=$i?>" name = "ptr" id="ptr" type="hidden"/>
                <input value="<?=$request_details['work_id'] ?>" name = "work_id" type="hidden"/>
                <input value="<?=($request_details['for_id'] != NULL && $request_details['for_id'] == $request_details['from_id']) ? $request_details['from_id'] : $request_details['for_id']; ?>" name = "team_member" type="hidden"/>
                <input value="<?=$_SESSION['userinfo']->id ?>" name = "user_id" type="hidden"/>
                <input value="<?=$request_details['request_id'] ?>" name = "request_id" type="hidden"/>
                <input value="1" name = "status" id="status" type="hidden"/>
                <div class="mid-col-top">
                    <div class="mid-col-img"><a href="javascript:void(0);"><img src="<?php echo $profile_pic;?>" /></a></div>
                    <p class="center name-txt"><a href="javascript:void();" class="name"><?php echo $request_details['google_name']; ?></a></p>
                    <p class="center name-txt request-txt">Hey, would you like to rate me <?php // echo $request_details['google_name']; ?></p>
                    <span class="request-positive-green">+1</span>
                    <div class="request-accordian relative" style="margin-top:20px;">
                        <div class="request-accordian-back">
                            <input type="radio" checked="checked" autocomplete="off" class="radio_remove" value="1" id="option1" name="rating">
                            <p style="overflow-y: auto; height: 80px;">
                                <?php $date_tobe_formatted = date_create($request_details['created_date']);
                                    echo $request_details['description'];
                                    echo "</p><p style='text-align:right;padding-right:5px;background-color:#c6c6c6;line-height:20px;font-size:12px;font-family: Open Sans, Arial, Helvetica, sans-serif;'>";
                                    echo "<i>".$today = date_format( $date_tobe_formatted,"j F, Y g:i a")."</i></p>"; ?>
                        </div>
                        <div class="request-accordian-top" style="display:none;"></div>
                        <div class="request-accordian-bot relative">
                            <div class="accordian-arrow"></div>
                        </div>
                    </div>
                </div>
                <div class="mid-col-bel">
                    <div class="mid-col-bel-lft"><a id="green_click_<?php echo $i;?>" href="javascript:void(0);" class="green-btn-request" style="margin-top: 18px" onclick="green_click(<?php echo $i;?>);"></a></div>
                    <div class="mid-col-bel-rht"><a id="red_click_<?php echo $i;?>" id="red_click_<?php echo $i;?>" href="javascript:void(0);" class="red-btn-request" style="margin-top: 18px" onclick="red_click(<?php echo $i;?>);"></a></div>
                </div>
                <!-- overlay pop up start -->
                <div class="overlay overlay_<?php echo $i;?>"></div>
                <div class="dialoguebox2 dialoguebox2_<?php echo $i;?>">
                    <div class="dialogue-title"><?php echo $errors[14];?></div>
                    <textarea class="textarea-dialogue marginbot10" name="comment_<?php echo $i;?>" id="reason_<?php echo $i;?>" placeholder="type your comments here..."><?=$request_details['description']?></textarea>
                    <input type="button"value="Submit" onclick="submit_popup(<?php echo $i;?>);" name="" class="submit-btn"/><input type="button" value="Cancel" onclick="close_popup(<?php echo $i;?>);" name="" class="cancel-btn"/>
                </div>
                <!-- overlay pop up end -->
            </form>
        </div><?php } } else { echo "<div class=\"profile-wrapper\">Hooray, no requests here!</div>"; }?>
    </div>
<?php require_once 'footer.php';?>

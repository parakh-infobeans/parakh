<?php
    require_once 'config.php';
    require_once 'class/rating.php';
    $renderObj = new rating();
    $page_number = (int) (!isset($_GET['page']) ? 1 :$_GET['page']);
    $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id: 0);
    require_once 'header.php';
    $user_data = $renderObj->get_all_member_custom();
    if(isset($_GET['chk'])) {
        $error_id = isset($_GET['chk']) ? (int)$_GET['chk'] : 0;
        if(($error_id != 0) && (array_key_exists($error_id, $errors)))
        {
            $cls = "error-red";
            echo '<div class="',$cls,'" style="width:55%;margin-left: 28%;"><div class="close-alert"></div>',$errors[$error_id],'</div>';
        } } ?>
    <div class="succes-green"><div class="close-alert"></div> <?php echo $errors[18]; ?></div>
    <div id="allchars" class="link-block-all">
        <a href="javascript:void(0);" id="charAll" class="link-all link-alphabet Alphas">All</a>
        <?php $names = array();
        foreach($user_data as $character)
            $names[] = substr($character['name'], 0, 1);
        $names = array_unique($names);
        foreach($names as $character)
            echo '<a href="javascript:void(0);" id="char',$character['name'],'" class="link-alphabet Alphas">',ucfirst($character['name']),'</a>';
        ?>
    </div>
    <div id="content_listing" class="mid-col-12"></div>
<?php require_once 'footer.php';?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".succes-green").hide();
        var alphaVal = $(".link-all").html();
        $.post("user_rating_dashboard_custom.php", '', function(response){
            $("#content_listing").html(response);
        });
        $(".Alphas").click(function(){
            var alphaVal = this.text;
            var data = "&alphaValue="+alphaVal;
            $("#allchars a").removeClass("link-all");
            $.post("user_rating_dashboard_custom.php", data, function(response){
                $("#char"+alphaVal).addClass("link-all");
                $("#content_listing").html(response);
            });
        });

    });
</script>
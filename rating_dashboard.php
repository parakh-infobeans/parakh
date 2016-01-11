    <?php
    require_once 'config.php';
    require_once 'class/rating.php';

    $renderObj = new rating();
    $page_number = (int) (!isset($_GET['page']) ? 1 : $_GET['page']);
    $user_id = ($_SESSION['userinfo']->id != '' ? $_SESSION['userinfo']->id : 0);
    $team_member = $renderObj->get_all_sub_employee_list($user_id);
    $cnt_team_member = count($team_member);
    $chars = $renderObj->get_user_characters($employeeList);
    require_once 'header.php';
    ?>
    <br/>
    <?php
    if (isset($_GET['chk'])) {
        $error_id = isset($_GET['chk']) ? (int) $_GET['chk'] : 0;
        if (($error_id != 0) && (array_key_exists($error_id, $errors))) {
            $cls = "error-red";
            ?>
            <div class="<?php echo $cls; ?>" style="width:55%;margin-left: 28%;"><div class="close-alert"></div> <?php echo $errors[$error_id]; ?></div>

        <?php }
    } ?>
    <div class="succes-green" ><div class="close-alert"></div> <?php echo $errors[18]; ?></div>
    <div id="allchars" class="link-block-all">
        <a href="javascript:void(0);" id="charAll" class="link-all link-alphabet Alphas">All</a>
        <?php
        foreach ($chars as $character) {
            ?>
            <a href="javascript:void(0);" id="char<?php echo $character['name']; ?>" class="link-alphabet Alphas"><?php echo ucfirst($character['name']); ?></a>
            <?php
        }
        ?>

    </div>
    <div id="allchars" class="link-block-all"><a style="color:white;"> <strong style="color: white;padding-top: 0px;">Total Members : </strong> <?= $cnt_team_member; ?> </a></div>
    <div id="content_listing" class="mid-col-12" style="padding-top:4px">
    </div>

    <?php
    require_once 'footer.php';
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".succes-green").hide();
            var alphaVal = $(".link-all").html();

            $.post("user_rating_dashboard.php", '', function (response) {
                $("#content_listing").html(response);
            });
           $(".Alphas").click(function () {

                var alphaVal = this.text;
                var data = "&alphaValue=" + alphaVal;
                $("#allchars a").removeClass("link-all");
                $.post("user_rating_dashboard.php", data, function (response) {
                    $("#char" + alphaVal).addClass("link-all");
                    $("#content_listing").html(response);
                });
            });
        });

    </script>

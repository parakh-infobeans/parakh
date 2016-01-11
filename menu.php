<?php
$user_pages = array();
$user_pages["dashboard.php"] = "Home";
$user_pages["rate-me.php"] = "Rate Me";
$user_pages["rating-request.php"] = "Requests";
$user_pages["ranking.php"] = "Ranking";
$activePage = basename($_SERVER['PHP_SELF']);
$emp_pages = array();
$emp_pages["dashboard.php"] = "Home";
$emp_pages["rate-me.php"] = "Rate Me";
$emp_pages["ranking.php"] = "Ranking";
if ($_SESSION['userinfo']->role_id != '9') {
    $i = 0;
    foreach ($user_pages as $url => $title) {
        $i++;
        $cls = '';
        if ($activePage == $url)
            $cls = "main-link-active";
        ?>
        <a href="<?php echo $url; ?>" class="link-alphabet <?php echo $cls; ?> "> 
        <?php echo $title; ?></a> <?php
        if ($i != count($user_pages)) {
            echo "|";
        }
    }
} else {
    $i = 0;
    foreach ($emp_pages as $url => $title) {
        $i++;
        $cls = '';
        if ($activePage == $url)
            $cls = "main-link-active";
        ?>
        <a href="<?php echo $url; ?>" class="link-alphabet  <?php echo $cls; ?>">
            <?php echo $title; ?></a> <?php
            if ($i != count($emp_pages)) {
                echo "|";
            }
        }
    }
    ?>



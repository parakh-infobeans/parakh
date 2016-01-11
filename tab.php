<!-- Nav tabs -->
<?php $current_page_name =  basename($_SERVER['PHP_SELF']); ?>
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?php if($current_page_name == 'work_list_tab1.php') echo 'class="active"' ?>><a href="work_list_tab1.php">My Work List </a></li>
    <li role="presentation" <?php if($current_page_name == 'work_list_tab2.php') echo 'class="active"' ?>><a href="work_list_tab2.php">Team's Work List</a></li>
  </ul>

<!--<a href="work_list_tab1.php" >Review Inbox</a>
  <a href="work_list_tab2.php" >Review Outbox</a>-->
<?php
    //echo "<pre>";print_r($record);//exit("In Pagination");
    $current_page_name =  basename($_SERVER['PHP_SELF']);
    $current_page = (int) (!isset($_GET['page']) ? 1 :$_GET['page']); 
    //echo $current_page;
    $per_page = $record[3];    
?>
<!-- Total Records : <?php //echo $record[2]; ?> -->
<?php
    if($record[1] != 0) { ?>
        <span class="pull-right">

        <?php
        if ($current_page == 1) 
        {   
            if ($current_page == 1 && $record[2] <= $per_page) 
            {   ?>
                <a class="btn btn-sm btn-danger disabled" type="button" data-toggle="tooltip" data-original-title="Previous"><< Previous</a>
                <a class="btn btn-sm btn-warning disabled" type="button" data-toggle="tooltip" data-original-title="Next">Next >></a>
            <?php 
            }else {
            ?>
               <a class="btn btn-sm btn-danger disabled" type="button" data-toggle="tooltip" data-original-title="Previous"><< Previous</a>
                <a class="btn btn-sm btn-warning" type="button" data-toggle="tooltip" data-original-title="Next" href="<?php echo $current_page_name; ?>?page=<?php echo $current_page+1; ?>&search_user=<?php echo $search_user;?>">Next >></a>
            <?php 
            }
        }
        else if($current_page != $record[1]) 
        {   ?>
            <a class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" data-original-title="Previous" href = "<?php echo $current_page_name; ?>?page=<?php echo $current_page-1; ?>&search_user=<?php echo $search_user;?>" ><< Previous</a>
            <a class="btn btn-sm btn-warning" type="button" data-toggle="tooltip" data-original-title="Next" href="<?php echo $current_page_name; ?>?page=<?php echo $current_page+1; ?>&search_user=<?php echo $search_user;?>">Next >></a>
            <?php            
        } 
        else 
        {   ?>          
            <a class="btn btn-sm btn-danger" type="button" data-toggle="tooltip" data-original-title="Previous" href = "<?php echo $current_page_name; ?>?page=<?php echo $current_page-1; ?>&search_user=<?php echo $search_user;?>" ><< Previous</a>
            <a class="btn btn-sm btn-warning disabled" type="button" data-toggle="tooltip" data-original-title="Next" href="#">Next >></a>
            <?php             
        } ?>
        </span>
      <?php 
      } 
      
    ?>

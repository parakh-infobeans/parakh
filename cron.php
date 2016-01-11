<?php 
require_once 'config.php';
require_once '/var/www/html/rating/trunk/class/rating.php';
require_once '/var/www/html/rating/trunk/functions/functions.php';

$ratingObj = new rating();
//$ratingObj1 = new rating();
if(ENVIRONMENT=='LIVE' )
{
    $data=$ratingObj->reminder_add_reason(REMINDER_1_ADD_REASON_DAYS);
    reminderAddReasonToManager($data);
    $data=$ratingObj->revert_expired_award_one(REVERT_RATING_DAY_LIMIT);
 
} 
else 
  {
        
  $reminder_limit=(!empty($_REQUEST["reminder_limit"])? $_REQUEST["reminder_limit"]: 2) ;
  $revert_limit=(!empty($_REQUEST["revert_limit"])? $_REQUEST["revert_limit"]: 30 ) ;
  
  $data=$ratingObj->reminder_add_reason($reminder_limit);
  reminderAddReasonToManager($data);
  $data=$ratingObj->revert_expired_award_one($revert_limit); 
    
}

?>
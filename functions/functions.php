<?php
define('NEWLINE','<BR/>');
define('EMAIL_SUBJECT_RECEIVED', 'Parakh - Rating Request Received');
define('EMAIL_SUBJECT_RESPONSE', 'Parakh - Your request has been ');
define('EMAIL_FOOTER', 'Thanks, '.NEWLINE.'Parakh Team');
require_once REL_PATH.'class/class.smtp.php';
require_once REL_PATH.'class/class.phpmailer.php';

function reminderAddReasonToManager($data)
{
    if(!empty($data))
    {
        $userObj=new rating();
        $pending_count=0;
        $lead_name="Lead";
        $subject="Parakh - You have <PENDING_COUNT> pending ratings.";
        $message_template.="Dear <LEAD_NAME>,".NEWLINE.NEWLINE;
        $due_date = date('Y-m-d 23:59:59',strtotime("+10 days"));
        $message_template.="You have rated the following team member(s) without providing rating reason. We request you to add a reason to your rating, else the ratings will be reverted.".NEWLINE.NEWLINE;
        $message_template.="<table width='70%' border='0' cellpadding='4' cellspacing='1'><tr style='background-color:#0099CC;color:#FFF'><td>Team Member</td><td>Rating</td><td>Rating On</td><td>Expires On</td><tr>";
        $message="";
        $total_record=count($data);
        for($i=0; $i<$total_record;)
        {
            $bgcolor=($i%2==0)? "#FFFFFF":"#87CEEB";
            $message.="<tr style='background-color:".$bgcolor.";'>";
            $message.="<td>".$data[$i]["tm_name"]."</td>";
            $message.="<td>".(($data[$i]["rating"]==1)? "+1" : "&nbsp;-1")."</td>";
            $date_tobe_formatted = @date_create($data[$i]["created_date"]);
            $create_on = @date_format($date_tobe_formatted,"jS F, Y  h:iA");
            $expire_date= @date_modify($date_tobe_formatted,'+10 day');
            $expire_date = @date_format($expire_date,"jS F, Y");
            $message.="<td>". $create_on."</td>";
            $message.="<td>". $expire_date."</td>";
            $message.="</tr>";
            $pending_count++;
            if($data[$i]["given_by"]!==$data[$i+1]["given_by"] || ($i==($total_record-1)))
            {
                $message.="</table>";
                $lead_name=$userObj->get_user_full_name($data[$i]['given_by']);
                $to["name"]=$lead_name;
                $lead_name=explode(" ", trim($lead_name));
                $lead_name=$lead_name[0];
                $message=$message_template.$message;
                $message.=NEWLINE;
                $message.= EMAIL_FOOTER;
                $to["email"]=$userObj->get_user_email($data[$i]['lead_id']);
                $subject=str_replace('<PENDING_COUNT>', $pending_count, $subject);
                $message=str_replace('<LEAD_NAME>', $lead_name, $message);
                if(ENVIRONMENT!='LIVE')
                    $to["email"]= LEAD_EMAIL;
                smtp_send_mail($to, $subject, $message);
                $pending_count=0;
                $message = '';
                $i++;
                continue;
            }
            $i++;
        }
    }
    else
        echo 'No records found to send reminder email.<BR/><BR/>';
 }

function notifyRequestToManager($data)
{
    $userObj=new rating();
    $lead_name=$userObj->get_user_full_name($data['lead_id']);
    $to["name"]=$lead_name;
    $lead_name=explode(" ", trim($lead_name));
    $lead_name=$lead_name[0];
    $team_member_name=$userObj->get_user_full_name($data['user_id']);
    $subject = EMAIL_SUBJECT_RECEIVED;
    $message = "Dear ".$lead_name.",".NEWLINE;
    $message.= "You have received a rating request.".NEWLINE." Login to <a href='".SITE_URL."'>".SITE_NAME."</a> to approve/decline request.".NEWLINE;
    $message.= NEWLINE;
    $message.= EMAIL_FOOTER;
    $to["email"] = $userObj->get_user_email($data['lead_id']);
    if(ENVIRONMENT!="LIVE")
        $to["email"] = LEAD_EMAIL;
    smtp_send_mail($to, $subject, $message);
}

function notifyAwardOne($data)
{
    $request_status = ($data['rating']==='1')? 'approved' : 'declined';
    $rating = ($request_status == 'approved') ? '+1' : '-1';
    $userObj= new rating();
    $lead_name = $userObj->get_user_full_name($_SESSION['userinfo']->id);
    $team_member_name=$userObj->get_user_full_name($data['user_id']);
    $to['name']=$team_member_name;
    $team_member_name=explode(" ", trim($team_member_name));
    $team_member_name=$team_member_name[0];
    $subject = 'Parakh - You have been rated';
    $message = 'Dear '.$team_member_name.','.NEWLINE;
    $message.= 'You have received a '.$rating.' rating.'.NEWLINE." Login to <a href='".SITE_URL."'>".SITE_NAME.'</a> to view details.'.NEWLINE;
    $message.= NEWLINE;
    $message.= EMAIL_FOOTER;
    $to['email'] = $userObj->get_user_email($data['user_id']);
    $lead_email = $userObj->get_user_email($_SESSION['userinfo']->id);
    if(ENVIRONMENT!='LIVE')
        $to['email']=TM_EMAIL;
    smtp_send_mail($to, $subject, $message);
    
    /* This will send the copy of eamil to practise head whenever the team member is rated +1 or -1 */
    if($to['email'] != PRACTICE_HEAD_EMAIL && $lead_email != PRACTICE_HEAD_EMAIL){
      notifyCopyAwardOne($data);
    }
}

function notifyCopyAwardOne($data)
{
    $request_status = ($data['rating']==='1')? 'approved' : 'declined';
    if($data['work_desc'] == ''){
      $work_desc = $data['comment'];
    }else{
      $work_desc = $data['work_desc'];
    }
    $rating = ($request_status == 'approved') ? '+1' : '-1';
    $userObj= new rating();
    $lead_name = $userObj->get_user_full_name($_SESSION['userinfo']->id);
    $team_member_name=$userObj->get_user_full_name($data['user_id']);
    $to['name']=$team_member_name;
    //$team_member_name=explode(" ", trim($team_member_name));
    //$team_member_name=$team_member_name[0];
    $subject = 'Parakh - New rating alert';
    if(trim($work_desc) != ''){
      $message.= $team_member_name.' has received a '.$rating.' rating by '.$lead_name.' for "'.$work_desc.'".'.NEWLINE;
    }else{
      $work_desc = 'N/A';
      $message.= $team_member_name.' has received a '.$rating.' rating by '.$lead_name.' for "'.$work_desc.'".'.NEWLINE;
    }    
    $message.= NEWLINE;
    $message.= EMAIL_FOOTER;
    $to['email']=PRACTICE_HEAD_EMAIL;
    smtp_send_mail($to, $subject, $message);
}

function notifyRequestStatus($data, $status)
{
    $request_status = ($status=='approve')? 'approved' : 'declined';
    $rating = ($request_status == 'approved') ? '+1' : '-1';
    $userObj = new rating();
    $lead_name = $userObj->get_user_full_name($data['user_id']);
    $team_member_name = $userObj->get_user_full_name($data['team_member']);
    $to['name'] = $team_member_name;
    $team_member_name = explode(" ", trim($team_member_name));
    $team_member_name = $team_member_name[0];
    $subject = EMAIL_SUBJECT_RESPONSE.$request_status.'!';
    $message = 'Hi '.$team_member_name.','.NEWLINE;
    $comment = (isset($data['comment']) &&  !empty($data['comment']))? ' with reason: <i>'.$data['comment'].'</i>.': '.';
    $message.= 'Your request has been '.$request_status.'.'.NEWLINE." Login to <a href='".SITE_URL."'>".SITE_NAME.'</a> to view details.'.NEWLINE;
    $message.= NEWLINE;
    $message.= EMAIL_FOOTER;
    $to['email'] = $userObj->get_user_email($data['team_member']);
    $lead_email = $userObj->get_user_email($data['user_id']);
    if(ENVIRONMENT!= 'LIVE')
        $to['email']=TM_EMAIL;
    smtp_send_mail($to, $subject, $message);
    
    /* This will send the copy of eamil to practise head whenever the team lead approves the request of team member */
    if($status == 'approve'){
      notifyCopyAwardOne($data);
    }
}


function smtp_send_mail($to,$subject,$message)
{
    if(empty($to["email"]))
        return;
    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'parakh.info@gmail.com';                 // SMTP username
    $mail->Password = 'Info0909';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->From = FROM_EMAIL;
    $mail->FromName = FROM_NAME;
    $mail->addAddress($to["email"],$to["name"]);     // Add a recipient
    $mail->addReplyTo(FROM_EMAIL, FROM_NAME);
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    if(!$mail->send()) {
        return true;
    } else {
       return false;
    }
}

function sortByRating($data)
{
     foreach ($data as $key => $row) {
         $rating_plus[$key]  = $row['rating_plus'];
         $rating_minus[$key] = $row['rating_minus'];
     }
     array_multisort($rating_plus, SORT_DESC,SORT_NUMERIC, $rating_minus, SORT_ASC,SORT_NUMERIC, $data);
     return($data);
}
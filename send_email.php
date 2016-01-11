<?php
require_once 'class/class.smtp.php';
require_once 'class/class.phpmailer.php';
function smtp_send_mail($to,$subject,$message)
{
    
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'parakh.info@gmail.com';                 // SMTP username
    $mail->Password = 'Info0909';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->From = 'parakh.info@gmail.com';
    $mail->FromName = 'Parakh System';
    $mail->addAddress($to);     // Add a recipient
                   // Name is optional
    $mail->addReplyTo('parakh.info@gmail.com', 'Parakh System');

    $mail->addBCC('aarya.bhosale@infobeans.com');

        // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $message;


    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
    
}
//echo phpinfo();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 

        
  $subject="Parakh - Aarya has rated you ";
  
  $message="Dear Team Member<br />";
  $message.="Thanks, <br />";
  $message.="Parakh Team";
  $to="parekh.member@gmail.com";
   
  
 
      
        
    smtp_send_mail($to,$subject,$message);


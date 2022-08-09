<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$opt = $_GET['opt'];
require '../constants/settings.php';
require '../constants/db_config.php';
require '../constants/uniques.php';

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = :email");
	$stmt->bindParam(':email', $opt);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $rec = count($result);
	
	if ($rec == "0") {
	    print '
	 <div class="alert alert-warning">
     No account is associated with email <strong>'.$opt.'</strong>
	 </div>
     ';
		
	}else{
    foreach($result as $row)
    {
	
    $myfname = $row['first_name'];
	$mylname = $row['last_name'];
	$mymail = $row['email'];
	$full_name = "$myfname $mylname";
	$idt = 'token'.get_rand_numbers(17).'';
    $token = md5($idt);
    $def_link = 'http://localhost/Nsujobscopes/System/reset.php?token='.$token.'';

    $stmt = $conn->prepare("DELETE FROM tbl_tokens WHERE email = :email");
	$stmt->bindParam(':email', $opt);
    $stmt->execute();

    $stmt = $conn->prepare("INSERT INTO tbl_tokens (email, token) VALUES (:email, :token)");
    $stmt->bindParam(':email', $opt);
	$stmt->bindParam(':token', $token);
    $stmt->execute();	

	$message = "Hellow!! <b>$full_name</b>, <br>Click <a href='$def_link'>HERE</a> to reset your <b>NSU Job Scopes</b> password.";   
    require 'PHPMailer\PHPMailerAutoload.php';

    $mail = new PHPMailer(true);
                          

    $mail->IsSMTP();

    // $mail->SMTPDebug  = 3;  
    $mail->SMTPAuth   = TRUE;
   
    $mail->Port       = 465;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "nsu.jobscopes@gmail.com"; 
    $mail->Password   = "xhkkiwmalaorrrhc";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
                         

    $mail->SetFrom("nsu.jobscopes@gmail.com", "NSU Job Scopes");
    $mail->AddReplyTo("nsu.jobscopes@gmail.com");
    $mail->addAddress($mymail , $full_name);              
   
    $mail->isHTML(true);                                 

    $mail->Subject = 'Password Reset';
    $mail->Body    = $message;
    $mail->AltBody = $message;

    if(!$mail->send()) {
    print '
	 <div class="alert alert-danger">
     An error occurred please contact us for more help.
	 </div>
     ';
    } else {
    print '
	 <div class="alert alert-info">
     A link to reset your password was sent to '.$mymail.'.
	 </div>
     ';
    }

	
    }
} 


					  
	}catch(PDOException $e)
    {

    }
	


?>
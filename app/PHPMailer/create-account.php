<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


date_default_timezone_set('Asia/Dhaka');

if (isset($_POST['reg_mode'])) {
checkemail();	
}else{
header("location:../");		
}


function checkemail() {
	
try {
	require '../constants/db_config.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$email = $_POST['email'];
	$account_type = $_POST['acctype'];
	
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = :email");
	$stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetchAll();
	$records = count($result);
	
	if ($account_type == "101") {
	$role = "Employee";	
	}else{
	$role = "Employer";	
	}
	
	if ($records > 0) {
	header("location:../register.php?p=$role&r=0927");	
		
	}else{
	
	if ($account_type == "101") {
	register_as_employee();
	}else{
	register_as_employer();
	}
	
		
	}
					  
	}catch(PDOException $e)
    {
    header("location:../register.php?p=$role&r=4568");
    }
}

function register_as_employee() {

    $mail = new PHPMailer(true);

try {
	require '../constants/db_config.php';
	require '../constants/uniques.php';
	$role = 'employee';
    $account_type = $_POST['acctype'];
    $last_login = date('d-m-Y h:m A [T P]');
	$member_no = 'EM'.get_rand_numbers(9).'';
    $fname = ucwords($_POST['fname']);
    $lname = ucwords($_POST['lname']);
    $email = $_POST['email'];
    $login = md5($_POST['password']);

    $Checkemail="northsouth.edu";
	$emailR= explode("@",$email);
	if(strcmp($emailR[1],$Checkemail)==0){

        $v_code=bin2hex(random_bytes(16));
        $is_verified=0;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO tbl_users (first_name, last_name, email, last_login, login, role, member_no,v_code,is_verified) 
        VALUES (:fname, :lname, :email, :lastlogin, :login, :role, :memberno, :v_code, :is_verified)");
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':lastlogin', $last_login);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':memberno', $member_no);
        $stmt->bindParam(':v_code', $v_code);
        $stmt->bindParam(':is_verified', $is_verified);
        $add = $stmt->execute();

        

        if($add){

                
      
            $mail->IsSMTP();

            $mail->SMTPDebug  = 3;  
            $mail->SMTPAuth   = TRUE;
           
            $mail->Port       = 465; 
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "nsu.jobscopes@gmail.com"; 
            $mail->Password   = "xhkkiwmalaorrrhc";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   

            $mail->AddAddress($_POST['email']);
            // $mail->AddAddress("abdullah.shafi1@northsouth.edu");
            $mail->SetFrom("nsu.jobscopes@gmail.com", "NSU Job Scopes");
            $mail->AddReplyTo("nsu.jobscopes@gmail.com");
            $mail->IsHTML(true);
            $mail->Subject = "Registration Successfull ";
            // $content =' "Hello" . $fname . "Thank you for Joining NSU Job Scopes" ' ;
            $mail->Body    = "Hello " . $fname . " Thank you for Joining NSU Job Scopes.Please Click the link bellow to
            verify the email address <a href='http://localhost/Nsujobscopes/System/verifyemail.php?email=$email&v_code=$v_code' >Verify Your Email</a>" ;
            $mail->send();
 	         echo 'Message has been sent';
            
            


        }
            

        header("location:../register.php?p=Employee&r=1123");
    }else{
        header("location:../register.php?p=Employee&r=0001"); 
    }			  
	}catch(PDOException $e)
    {
    header("location:../register.php?p=Employee&r=4568");
    }	
	
}

function register_as_employer() {
    $mail = new PHPMailer(true);
try {
	require '../constants/db_config.php';
	require '../constants/uniques.php';
	$role = 'employer';
    $account_type = $_POST['acctype'];
    $last_login = date('d-m-Y h:m A [T P]');
    $comp_no = 'CM'.get_rand_numbers(9).'';
    $cname = ucwords($_POST['company']);
    $ctype = ucwords($_POST['type']);
    $email = $_POST['email'];
    $login = md5($_POST['password']);
	

    $Checkemail="northsouth.edu";
	$emailR= explode("@",$email);
    if(strcmp($emailR[1],$Checkemail)==0){

        $v_code=bin2hex(random_bytes(16));
        $is_verified=0;

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("INSERT INTO tbl_users (first_name, title, email, last_login, login, role, member_no,v_code,is_verified) 
        VALUES (:fname, :title, :email, :lastlogin, :login, :role, :memberno, :v_code, :is_verified)");
        $stmt->bindParam(':fname', $cname);
        $stmt->bindParam(':title', $ctype);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':lastlogin', $last_login);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':memberno', $comp_no);
        $stmt->bindParam(':v_code', $v_code);
        $stmt->bindParam(':is_verified', $is_verified);
        $add1 = $stmt->execute();

        

        if($add1){

                
      
            $mail->IsSMTP();

            $mail->SMTPDebug  = 3;  
            $mail->SMTPAuth   = TRUE;
           
            $mail->Port       = 465;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "nsu.jobscopes@gmail.com"; 
            $mail->Password   = "xhkkiwmalaorrrhc";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   

            $mail->AddAddress($_POST['email']);
            // $mail->AddAddress("abdullah.shafi1@northsouth.edu");
            $mail->SetFrom("nsu.jobscopes@gmail.com", "NSU Job Scopes");
            $mail->AddReplyTo("nsu.jobscopes@gmail.com");
            $mail->IsHTML(true);
            $mail->Subject = "Registration Successfull ";
            // $content =' "Hello" . $fname . "Thank you for Joining NSU Job Scopes" ' ;
            $mail->Body    = "Hello " . $fname . " Thank you for Joining NSU Job Scopes.Please Click the link bellow to
            verify the email address <a href='http://localhost/Nsujobscopes/System/verifyemail.php?email=$email&v_code=$v_code' >Verify Your Email</a>" ;
            $mail->send();
 	         echo 'Message has been sent';

        }

        header("location:../register.php?p=Employer&r=1123");
    }else{
        header("location:../register.php?p=Employer&r=0001");   
    }			  
	}catch(PDOException $e)
    {
    header("location:../register.php?p=Employer&r=4568");
    }	
	
}

?>
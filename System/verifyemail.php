<?php
require 'constants/db_config.php';
if(isset($_GET['email'])&& isset($_GET['v_code'])){
    $email = $_GET['email'];
    $v_code =$_GET['v_code'];
   try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = :email AND v_code = :v_code");
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':v_code', $v_code);
    $stmt->execute();
    $result = $stmt->fetchAll();
	$rec = count($result);


    if ($rec == "0") {
        echo "<script>
        alert('No user Found');
        window.location.href='index.php';
        </script>";
    }else{
        $status=0;
        foreach($result as $row)
        {
            $status = $row['is_verified'];
        }

        if($status==1){
            echo "<script>
            alert('User Already Verified');
            window.location.href='index.php';
            </script>";

        }else{

            
        $is_verified=1;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            
            $stmt = $conn->prepare("UPDATE tbl_users SET is_verified = :is_verified WHERE email= :email");
            $stmt->bindParam(':is_verified', $is_verified);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            echo "<script>
            alert('Successfully Verfied');
            window.location.href='login.php';
            </script>";
                         
            }catch(PDOException $e)
            {
        
            }

        }


         
    }


   }catch(PDOException $e)
    {

    } 
}
?>
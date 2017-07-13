<?php
  session_start();
  include('config_db.php');
  $user=$_POST["nick"];
  $accepted=$_POST["accept"];
$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);  
//$con = mysqli_connect ("localhost","root","","marinemammalformulary_");  

if (mysqli_connect_errno ($con)){
   echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
}

$sql1="SELECT * FROM User WHERE user_name='$user'";
$result1=mysqli_query($con,$sql1) or die(mysqli_error());
while ($row=mysqli_fetch_row($result1)) { 
        $email = $row[6];
        $com_code = md5(uniqid(rand()));
        $to = $email;

		if($accepted){
			 $subject = "Message from Marine Mammals Formmulary to $user";
			 $header = "Marine Mammals Formmulary: Confirmation from Marine Mammals Formmulary";
			 $message = "Thank you for registering with us.\n";
			 $message.= "Please click the link below to verify and activate your account.\n";
			 $message.= "http://www.marinemammalformulary.com/confirm_user.php?passkey=$com_code";
			 //$message .= "http://localhost/formmulary/confirm_user.php?passkey=$com_code";
			 //$sentmail = mail("majuma22@hotmail.com",$subject,$message,$header);
			 $sentmail = mail($to,$subject,$message,$header);
			 if($sentmail){
			  // $sql2 = "UPDATE user SET verif_email='$com_code', checked='1' WHERE user_name='$user'";
			  $sql2 = "UPDATE User SET verif_email='$com_code' WHERE user_name='$user'";
			  //$result2 = mysql_query($sql2,$con) or die(mysql_error());
			  $result2 = mysqli_query($con,$sql2) or die(mysqli_error());
			  echo "A Confirmation Link Has Been Sent To The User's Email.";
			}
			else{
			  echo "Cannot send Confirmation link to your e-mail address";
			}
        }
		else{
			
			$subject = "Message from Marine Mammals Formmulary to $user";
			$header = "Marine Mammals Formmulary: Message from Marine Mammals Formmulary";
			$message = "Unfortunately, your registration request has been declined. Please contact us by email at info@marinemammalformulary.com\n";
			$sentmail = mail($to,$subject,$message,$header);
			if($sentmail){
				$sql2 = "UPDATE User SET verif_email='$com_code' WHERE user_name='$user'";
			    $result2 = mysqli_query($con,$sql2) or die(mysqli_error());
			    echo "An Email Has Been Sent To The User.";
			}
			else {
			    echo "Cannot send Confirmation link to your e-mail address";
			}
		}
    }
?>
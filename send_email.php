<?php
  session_start();
  include('config_db.php');
  $username=$_SESSION['username'];
  $user=$_POST["user"];
  $subject=$_POST["subject"];
  $header=$_POST["header"];
  $message=$_POST["message"];
  $to=$_POST["to"];
  
$con = mysqli_connect ("localhost","ForMMulary","wfGr42&7","marinemammalformulary_",3306);  
//$con = mysqli_connect ("localhost","root","","marinemammalformulary_");  

if (mysqli_connect_errno ($con)){
   echo "No se pudo conectar a MySQL: " . mysqli_connect_error ();
}

//if the error exist, we will go to registration form
    // if(isset($_SESSION['error'])){
    //   header("Location: register.php");
    //   exit;
    // }
    // else{
      //$sql1="SELECT * FROM user WHERE user_name='$user'";
      // $result1=mysql_query($sql1,$con) or die(mysql_error());
      // while ($row=mysql_fetch_row($result1)) {

      $sql1="SELECT * FROM User WHERE user_name='$user'";
      $result1=mysqli_query($con,$sql1) or die(mysqli_error());
      while ($row=mysqli_fetch_row($result1)) { 
      	if(empty($to)){
        	$to = $row[6];
        }
        /*else{
        	$email = $to;
        }*/
      // $password = $_POST['password'];
      // $first_name= $_POST['first_name'];
      // $last_name=$_POST['last_name'];
      // $prof=$_POST['profession'];
      // $country=$_POST['country'];
        //$com_code = md5(uniqid(rand()));
        //$to = $email;
		//if($accept){
			 /*$subject = "Message from Marine Mammals Formmulary to $user";
			 $header = "Marine Mammals Formmulary: Rejection from Marine Mammals Formmulary";
			 $message = "The drug you have created is not correct.\n";
			 $message.= "Please contact us by email at info@marinemammalformulary.com\n";*/
			 //$message .= "http://localhost/formmulary/confirm_user.php?passkey=$com_code";
			 //$sentmail = mail("majuma22@hotmail.com",$subject,$message,$header);
			 $sentmail = mail("majuma22@hotmail.com",$subject,$message,$header);
			 if($sentmail){
			  // $sql2 = "UPDATE user SET verif_email='$com_code', checked='1' WHERE user_name='$user'";
			  //$sql2 = "UPDATE User SET verif_email='$com_code' WHERE user_name='$user'";
			  //$result2 = mysql_query($sql2,$con) or die(mysql_error());
			  //$result2 = mysqli_query($con,$sql2) or die(mysqli_error());
			  echo "An Email Has Been Sent To The User.";
			}
			else{
			  echo "Failed To Send Email";
			}
        /*}
		else{
			$subject = "Message from Marine Mammals Formmulary to $user";
			$header = "Marine Mammals Formmulary: Message from Marine Mammals Formmulary";
			$message = "Unfortunately your registration request has been declined. Please contact us by email at info@marinemammalformulary.com\n";
			$sentmail = mail($to,$subject,$message,$header);
			if($sentmail){
				$sql2 = "UPDATE User SET verif_email='$com_code' WHERE user_name='$user'";
			    $result2 = mysqli_query($con,$sql2) or die(mysqli_error());
			    echo "An Email Has Been Sent To The User.";
			}
			else{
			    echo "Cannot send Confirmation link to your e-mail address";
			}
		}*/
    }
?>
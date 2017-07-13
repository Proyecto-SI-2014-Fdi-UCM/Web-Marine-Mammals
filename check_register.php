<?php
session_start();
include('config_db.php');

$messageHeader="<div class=\"col-xs-6 col-md-4 col-xs-offset-3 col-md-offset-4 message_error\">";
$html="";
   //if first name is blank
    if($_POST['first_name']==''){
      $_SESSION['error']['first_name']="First Name is required.";
      //echo "First Name is required";
      //echo "<div class=\"col-xs-6 col-md-4 col-xs-offset-3 col-md-offset-4 message_error\" >First Name is required</div>";
      $html=$html."First Name is required.<br>";
    }
    //if last name is blank
    if($_POST['last_name']==''){
      $_SESSION['error']['last_name']="Last Name is required.";
      //echo "Last Name is required";
      $html=$html."Last Name is required.<br>";
    }
    //if profession is blank
    if($_POST['prof']==''){
      $_SESSION['error']['profession']="Profession is required.";
      //echo "Profession is required";
      $html=$html."Profession is required.<br>";
    }
    //if the email is blank
    if($_POST['country'] == ''){
      $_SESSION['error']['country'] = "Country is required.";
      //echo "Country is required";
      $html=$html."Country is required.<br>";
    }
    //if the username is blank
    if($_POST['username'] == ''){
      $_SESSION['error']['username'] = "User Name is required.";
      //echo "User Name is required";
      $html=$html."User Name is required.<br>";
    }
    //checking if user already exists
    else{
      $user=$_POST['username'];
      $sql="SELECT * FROM User WHERE user_name='$user'";
      /*$result=mysql_query($sql,$con);
      if(mysql_num_rows($result)>0){*/
      $result=mysqli_query($con,$sql);
      if(mysqli_num_rows($result)>0){
          $_SESSION['error']['user']="This user name is already used.";
          //echo "This user name is already used.";
          $html=$html."This user name is already used.<br>";
      }
    }
    //if email is blank
    if($_POST['email']==''){
      $_SESSION['error']['email']="Email is required.";
      //echo "Email is required.";
      $html=$html."Email is required.<br>";
    }
    else{
      //if the email format is correct
      if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9._-]+)+$/", $_POST['email'])){
        //if it has the correct format whether the email has already exist
        $email= $_POST['email'];
        $sql1 = "SELECT * FROM User WHERE email = '$email'";
        // $result1 = mysql_query($sql1,$con) or die(mysql_error());
        // if (mysql_num_rows($result1) > 0){
        $result1 = mysqli_query($con,$sql1) or die(mysqli_error());
        if (mysqli_num_rows($result1) > 0){
        
          $_SESSION['error']['email'] = "This Email is already used.";
          //echo "This Email is already used";
          $html=$html."This Email is already used.<br>";
        }
      }
      else{
        //this error will set if the email format is not correct
        $_SESSION['error']['email'] = "Your email is not valid.";
        //echo "Your email is not valid";
        $html=$html."Your email is not valid.<br>";
      }    
    }
    
    //if the password is blank
    if($_POST['password'] == ''){
      $_SESSION['error']['password'] = "Password is required.";
      //echo "Password is required";
      $html=$html."Password is required.<br>";
    }
              
    if($_POST['conf_pasword'] == ''){
      $_SESSION['error']['conf_pasword'] = "Confirm Password is required.";
      //echo "Confirm Password is required";
      $html=$html."Confirm Password is required.<br>";
    }
    else{
      //if both password are the same
      if($_POST['conf_pasword'] != $_POST['password']){
        $_SESSION['error']['conf_pasword'] = "Password is not the same.";
        //echo "Password is not the same";
        $html=$html."Password is not the same.<br>";
      }
    }
    $messageFooter="</div>";
    if($html!=""){
      echo $messageHeader.$html.$messageFooter;
    }
    
?>
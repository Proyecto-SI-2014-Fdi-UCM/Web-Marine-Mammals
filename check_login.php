<?php
/*start the session*/
session_start();
include('config_db.php');

//Info sent from server
$username=$_POST['username'];
$password=$_POST['password'];

//run the query
$sql = "SELECT * FROM User WHERE user_name='$username' and password='$password'";
$result=mysqli_query($con,$sql);

//Counting table rows
$count=mysqli_num_rows($result);


//Parte común servidor y local host
//Is result matched
if($count==1){
	//$_SESSION['first_time']=1;
	$sql1 = "SELECT * FROM User WHERE user_name='$username' and password='$password' and checked=1";
	$result1=mysqli_query($con,$sql1);
	$count1=mysqli_num_rows($result1);
	//$perfil=$result1['perfil'];
	//while ($fila = mysqli_fetch_row($resultado)) {
	while($rows=mysqli_fetch_row($result1)){ 
		//Se guarda el campo perfil para pasarlo a forMMulary.php
		$profile=$rows[9];
	}
	if($count1==1){		
		//Se pasan datos de sesión
		$_SESSION['loggedin']=true;
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['start']=time();
		$_SESSION['expire']=$_SESSION['start']+(20*60);
		/*if ($username == 'administrator') {
			echo '<script>generate_navbar_admin()</script>';
		}*/

		echo '<script>location.href = "forMMulary.php"</script>';
		//echo "<script>location.href = \"forMMulary.php?perfil=".$perfil."\"</script>";
			//header("location: forMMulary_admin.php");
		/*}
		else{
			//header("location: forMMulary.php");
			echo '<script>location.href = "forMMulary.php"</script>';
		}*/
	}
	else{
		echo "<div class=\"col-xs-6 col-md-4 col-xs-offset-3 col-md-offset-4 message_error\" >You are not yet user</div>";	
	}
}
else{
	echo "<div class=\"col-xs-6 col-md-4 col-xs-offset-3 col-md-offset-4 message_error\" >User name or  password is incorrect</div>";
	
}
?>
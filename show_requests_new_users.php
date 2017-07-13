<?php
/*start the session*/
session_start();
include('config_db.php');

$sql = "SELECT * FROM User WHERE checked ='0'";
//$result=mysql_query($sql,$con);
$result=mysqli_query($con,$sql);
$contador=5;
$count=mysqli_num_rows($result);
//echo "<table class=\"table table-hover\">";
if ($count>0) {
echo "<table class=\"table table-hover\">";
echo "<thead>";
echo "<tr>";
echo "<td class=\"name\">Full Name</td>";
echo "<td class=\"profession\">Profession</td>";
echo "<td class=\"country\">Country</td>";
echo "<td class=\"user\">User Name</td>";
echo "<td class=\"email\">Email</td>";
//echo "<td class=\"icons\">Actions</td>";
echo "<td class=\"actions\">Actions</td>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
while ($row=mysqli_fetch_row($result)){  
	$contador=$contador+6;
	$user=$row[0];
	echo "<tr>";
    echo "<td class=\"name\">".$row[2]." ".$row[3]."</td>";
    echo "<td class=\"profession\">".$row[4] ."</td>";
    echo "<td class=\"country\">".$row[5]."</td>";
    echo "<td id=\"user".$contador."\" class=\"user\">".$row[0]."</td>";
    echo "<td class=\"email\">".$row[6]."</td>";
    /*echo "<td id=\"accept".$contador."\" class=\"icons\"><a class=\"edit-drug\" name==\"view".$contador."\" href=\"javascript:save_changes(".$contador.")\"><span class=\"glyphicon glyphicon-edit\"></span></a>";*/
	echo "<td class=\"icons\"><a class=\"btn\" onclick=\"javascript:accept_request('".$row[0]."')\"><span class=\"glyphicon glyphicon-ok\"></span></a>";
	echo "<td class=\"icons\"><a class=\"btn\" onclick=\"javascript:reject_request('".$row[0]."')\"><span class=\"glyphicon glyphicon-remove\"></span></a>";

	// echo "<td class=\"icons switch-toggle well\"><input id=\"accept\" name=\"view\" type=\"radio\" checked> <label for=\"accept\" onclick=\"\">Accept</label>";
	// echo "<td class=\"icons switch-toggle well\"><input id=\"reject\" name=\"view\" type=\"radio\"> <label for=\"reject\" onclick=\"\">Reject</label>";
    

    // echo "<td class=\"icons\"><a class=\"btn btn-primary pull-right add\" onclick=\"javascript:confirm_user('".$row[0]."')\">Accept</a>";
    // echo "<td class=\"icons\"><a class=\"btn btn-primary pull-right add\" >Reject</a>";   
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";   
}
?>
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
// while ($row=mysql_fetch_row($result)) {	
while ($row=mysqli_fetch_row($result)){  
	$contador=$contador+6;
	echo "<tr>";
    echo "<td class=\"name\">".$row[2]." ".$row[3]."</td>";
    echo "<td class=\"profession\">".$row[4] ."</td>";
    echo "<td class=\"country\">".$row[5]."</td>";
    echo "<td id=\"user".$contador."\" class=\"user\">".$row[0]."</td>";
    echo "<td class=\"email\">".$row[6]."</td>";
    //echo "<a class=\"btn btn-primary pull-right add\" href=\"./general.php\">Acept</a>";
    //echo "<td class=\"icons\"><a class=\"edit-drug\" href=\"./general.php?option=Edit&&drug_name=" . $row[0] . "\"><span class=\"glyphicon glyphicon-edit\"></span></a>";
   	//echo "<td class=\"actions  switch-toggle switch-3 well\" >";
    echo "<td class=\"actions\">";
   	echo "<div id=\"myswitch\" class=\"switch-toggle switch-3 well\">";
   	echo "<input id=\"accept".$contador."\" name=\"view".$contador."\" type=\"radio\" >";
  	echo "<label for=\"accept".$contador."\" onclick=\"\">Accept</label>";
  	echo "<input id=\"reject".$contador."\" name=\"view".$contador."\" type=\"radio\">";
  	echo "<label for=\"reject".$contador."\" onclick=\"\">Reject</label>";
  	echo "<input id=\"ignore".$contador."\" name=\"view".$contador."\" type=\"radio\" checked>";
  	echo "<label for=\"ignore".$contador."\" onclick=\"\" >Ignore</label>";
  	echo "<a class=\"btn btn-primary\"></a>";
	echo "</div>";

	// echo "<td class=\"icons switch-toggle well\"><input id=\"accept\" name=\"view\" type=\"radio\" checked> <label for=\"accept\" onclick=\"\">Accept</label>";
	// echo "<td class=\"icons switch-toggle well\"><input id=\"reject\" name=\"view\" type=\"radio\"> <label for=\"reject\" onclick=\"\">Reject</label>";
    

    // echo "<td class=\"icons\"><a class=\"btn btn-primary pull-right add\" onclick=\"javascript:confirm_user('".$row[0]."')\">Accept</a>";
    // echo "<td class=\"icons\"><a class=\"btn btn-primary pull-right add\" >Reject</a>";   
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";   
// echo "</div>";
// echo "</div>";
// echo "<div>";
//echo "<button id=\"submit\" onclick=\"javascript:save_changes(".$contador.")\">Save changes</button>";
echo "<div class=\"text-center\">";
echo "<a class=\"btn btn-primary\" onclick=\"javascript:save_changes(".$contador.")\">Save changes</a>";
echo "</div>";
}
?>
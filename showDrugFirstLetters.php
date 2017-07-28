<?php
/*start the session*/
session_start();
include('config_db.php');
$letter=$_POST["letter"];
$username=$_SESSION['username'];
$password=$_SESSION['password'];

//$perfil=$_POST["perfil"];

if (!strcmp($letter, "ALL")) {
	$sql = "SELECT * FROM DRUG";
}
else {
	$sql = "SELECT * FROM DRUG WHERE drug_name LIKE '$letter%'";
}

$result=mysqli_query($con,$sql);
$contador=0;
$count=mysqli_num_rows($result);
if($count>0){
echo "<table class=\"table table-hover\">";
echo "<thead>";
echo "<tr>";
echo "<td class=\"drug_name\">Name</td>";
echo "<td class=\"drug_description\">Description</td>";
echo "<td class=\"icons\">Actions</td>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";        


while ($row=mysqli_fetch_row($result)) {
    $contador=$contador+3;
	echo "<tr>";
    echo "<td class=\"drug_name\">".$row[0]."</td>";
    echo "<td class=\"drug_description\">".$row[1] ."</td>";
    echo "<td class=\"icons\"><a class=\"edit-drug\" href=\"./general.php?option=Edit&&drug_name=" . $row[0] . "\"><span class=\"glyphicon glyphicon-edit\"></span></a>";
    //if($_SESSION['username']=='administrator'){
    //if(!strcmp($perfil, "A")){
    $sql1 = "SELECT perfil FROM User WHERE user_name='$username' and password='$password' and checked=1";
  $result1=mysqli_query($con,$sql1);
  $perfil=mysqli_fetch_row($result1);
  if(!strcmp($perfil[0], "A")) {

        //echo "<a class=\"remove-drug\" href=\"#\" onclick=\"javascrip:deleteDrug('".$contador."')\"><span class=\"glyphicon glyphicon-remove\"></span></a>";
        echo "<a class=\"remove-drug\" href=\"#note_window".$contador."\" data-toggle=\"modal\"><span class=\"glyphicon glyphicon-remove\"></span></a>";
        echo '<script>generate_navbar_admin();</script>';
    }
    echo "<div class=\"modal fade\" id=\"note_window".$contador."\">";
        echo "<div class=\"modal-dialog\">";
        echo "<div class=\"modal-content\">";
        echo "<div class=\"modal-header\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>";
        echo "<h2 class=\"modal-title\"><strong>Are you sure?</strong></h2>";
        echo "</div>";
        //Sin utilizar
        /*echo "<div class=\"modal-body\">";
        echo "<p>You have selected to delete this drug</p>";
        echo "<p>If this was the action that you wanted to do, please confirm your choice.</p>";
        echo "</div>";*/
        echo "<div class=\"modal-footer\">";
        echo "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\" >No</button>";
        echo "<button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\" onclick=\"javascrip:deleteDrug('".$contador."')\">Yes</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
}

// echo "</tbody>";
// echo "</table>";
//$_SESSION['first_time']=0;
?>
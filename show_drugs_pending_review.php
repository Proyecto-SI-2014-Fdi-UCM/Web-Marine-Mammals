<?php
/*start the session*/
session_start();
include('config_db.php');
$username=$_SESSION['username'];
$password=$_SESSION['password'];

//$perfil=$_POST["perfil"];

$sql = "SELECT * FROM DRUG WHERE co_state ='RV'";
$result=mysqli_query($con,$sql);
$contador=0;
$count=mysqli_num_rows($result);
if($count>0){
    echo "<table class=\"table table-hover\">";
    echo "<thead>";
    echo "<tr>";
    echo "<td class=\"drug_name\">Name</td>";
    echo "<td class=\"user\">User</td>";
    echo "<td class=\"icons\">Actions</td>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";        


    while ($row=mysqli_fetch_row($result)) {
        $contador=$contador+3;
        echo "<tr>";
        echo "<td class=\"drug_name\">".$row[0]."</td>";
        echo "<td class=\"user\">".$row[7] ."</td>";
        echo "<td class=\"icons\"><a class=\"edit-drug\" href=\"./general.php?option=Edit&&drug_name=" . $row[0] . "\"><span class=\"glyphicon glyphicon-eye-open\"></span></a>";
        //if($_SESSION['username']=='administrator'){
        //if(!strcmp($perfil, "A")){
        //$sql1 = "SELECT profile FROM USER WHERE user_name='$username' and password='$password' and checked=1";
        $sql1 = "SELECT profile FROM User WHERE user_name='$username' and password='$password' and checked=1";
        $result1=mysqli_query($con,$sql1);
        $profile=mysqli_fetch_row($result1);
        echo "<a class=\"accept-drug\" href=\"#\" ><span class=\"glyphicon glyphicon-ok\"></span></a>";
        echo "<a class=\"reject-drug\" href=\"#\" ><span class=\"glyphicon glyphicon-remove\"></span></a>";
        echo '<script>generate_navbar_admin();</script>';
        
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
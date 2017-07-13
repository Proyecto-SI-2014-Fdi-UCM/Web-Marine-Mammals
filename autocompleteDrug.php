<?php
include('config_db.php');

/*$search = $_POST['drug'];

$sql = "SELECT * FROM DRUG WHERE drug_name LIKE '%$search%'";
$query_search = mysqli_query($con, $sql);

while ($row=mysqli_fetch_row($query_search)) {
    echo '<div class="suggest-element"><a data="'.$row['drug_name'].'" id="Drug'.$row['drug_name'].'">'.utf8_encode($row['drug_name']).'</a></div>';
}*/

//if(isset($_POST['drug'])) {    
  $drugs = array();  
  $sql = "SELECT * FROM DRUG WHERE drug_name = 'Gentamicin'";
  $query_search = mysqli_query($con, $sql);  
  while ($row=mysqli_fetch_row($query_search)) {  
      $drugs[] = array(  
        'label' => $row['drug_name'],  
        'value' => $row['drug_name']  
      );  
  }
  echo json_encode($drugs);
//}  
?>
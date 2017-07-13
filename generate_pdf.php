<?php
session_start();
include('config_db.php');
require('fpdf.php');


$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',18);
$sql = "SELECT * FROM DRUG";
$result=mysqli_query($con,$sql);
$pdf->cell(0,15,'DRUGS DATABASE',0,1,C);
//margen (salto de línea) desde titulo a la lista de medicamentos
$pdf->cell(0,15,'',0,1);

//Volver a fuente normal
$pdf->SetFont('Arial','',12);
while ($row=mysqli_fetch_row($result)) {
	$pdf->Cell(50,8, $row[0],0,1,L);
}
//abre el pdf en el navegador para que el usuario lo pueda guardar
//$pdf->Output('drugs.pdf',I);

//fuerza la descarga del pdf
$pdf->Output('drugs.pdf',D);

?>
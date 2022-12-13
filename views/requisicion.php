<?php
session_start();
error_reporting(0);
	$varsesion = $_SESSION['usuario'];
    


include "../includes/db.php";
include "../fpdf/fpdf.php";

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetFont('Arial','B',20 );    

$pdf->setY(12);
$pdf->setX(80);
// Agregamos los datos de la empresa
$pdf-> image('../img/logo.png', 5, 1, 40);  // X, Y, Tamaño
$pdf->Cell(60,4,'REQUISICION DE ALMACEN',0,1,'C');
$pdf->SetFont('Arial','',15);    
$pdf->setY(20);$pdf->setX(80);
$pdf->Cell(60,4,'HOTEL LIVE AQUA CANCUN',0,1,'C');

$sql = "SELECT u.id, u.nombre, u.usuario, u.password, u.fecha, u.estado,
p.rol,d.descripcion FROM user u LEFT JOIN permisos p ON u.rol_id = p.id LEFT JOIN departamentos d
ON u.id_depa = d.id WHERE usuario ='$varsesion'";
$usuarios = mysqli_query($conexion, $sql);
if($usuarios -> num_rows > 0){
foreach($usuarios as $key => $fila ){

$pdf->SetFont('Arial','',10); 
$pdf->Ln(5);
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(60,4,'Departamento: ' .utf8_decode($fila['descripcion']),0,1,'C');

$pdf->setY(40);$pdf->setX(60);
$pdf->Cell(60,4,'Fecha: ',0,1,'C');

$pdf->setY(40);$pdf->setX(100);
$pdf->Cell(60,4,'Usuario: '.utf8_decode($fila['usuario']),0,1,'C');

$pdf->setY(40);$pdf->setX(150);
$pdf->Cell(60,4,'Folio: ',0,1,'C');
}
}

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("Codigo", "Descripcion","UND","PU","Total", "Cantidad");

//// Arrar de Productos
$products = array(
    
	array("0010", "Producto 1",2,120,0),
	array("0024", "Producto 2",5,80,0),
	array("0001", "Producto 3",1,40,0),
	array("0001", "Producto 3",5,80,0),
	array("0001", "Producto 3",4,30,0),
	array("0001", "Producto 3",7,80,0),
);

    // Column widths
    $w = array(20, 70, 20, 25, 25, 20);
    
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],2);
    $pdf->Ln();
    // Data
    $total = 0;
    foreach($products as $fila)
    {
        $pdf->Cell($w[0],6,$fila[0],2);
        $pdf->Cell($w[1],6,$fila[1],2);
        $pdf->Cell($w[2],6,number_format($fila[2]),2);
        $pdf->Cell($w[3],6,"$ ".number_format($fila[3],2,".",","),2);
        $pdf->Cell($w[4],6,"$ ".number_format($fila[3]*$fila[2],2,".",","),2);
        $pdf->Cell($w[5],6,"$ ".number_format($fila[3]*$fila[2],2,".",","),2);
        $pdf->Ln();
        $total+=$fila[3]*$fila[2];

    }
/////////////////////////////
//// Apa


$pdf->setY(150);
$pdf->setX(10);

/////////////////////////////
$header = array("", "");
$data2 = array(

	array("Total:", $total),
);
    // Column widths
    $w2 = array(40, 40);
    // Header


    // Data
    foreach($data2 as $fila)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$fila[0],2);
        $pdf->Cell($w2[1],6,"$ ".number_format($fila[1], 2, ".",","),2);

  
    }
/////////////////////////////


$pdf->SetFont('Arial','B',10);    

$pdf->setY(150);
$pdf->setX(10);
$pdf->Cell(60,4,'Articulos en lista',0,1,'C');


/////////////////////////////

$pdf->SetFont('Arial','B',10);    
$pdf->setY(-50);
$pdf->setX(-190);
$pdf->Cell(60,4,"SOLICITANTE");

$pdf->SetFont('Arial','B',10);    
$pdf->setY(-50);
$pdf->setX(-140);
$pdf->Cell(60,4,"AUTORIZADO");

$pdf->SetFont('Arial','B',10);    
$pdf->setY(-50);
$pdf->setX(-90);
$pdf->Cell(60,4,"RECIBIDO");

$pdf->SetFont('Arial','B',10 );    
$pdf->setY(-50);
$pdf->setX(-50);
$pdf->Cell(60,4,"ENTREGADO");

$pdf->output();
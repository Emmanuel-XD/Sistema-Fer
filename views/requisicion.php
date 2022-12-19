<?php
session_start();
error_reporting(0);
	$varsesion = $_SESSION['usuario'];

if (!isset($_GET["id"])) {
    exit("No hay id");
}
$id = $_GET["id"];
include_once "../includes/base.php";
$sentencia = $base_de_datos->prepare("SELECT id, fecha, total, usuario, departamento, folio FROM compras WHERE id = ?");
$sentencia->execute([$id]);
$compra = $sentencia->fetchObject();
if (!$compra) {
    exit("No existe venta con el id proporcionado");
}

$sentenciaProductos = $base_de_datos->prepare("SELECT a.id, a.codigo, a.descripcion,a.precio, a.unidad, at.cantidad
FROM articulos a
LEFT JOIN 
art_vendidos at
ON a.id = at.id_articulo
WHERE at.id_compra = ?");
$sentenciaProductos->execute([$id]);
$articulos = $sentenciaProductos->fetchAll();
if (!$articulos) {
    exit("No hay productos");
}


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


$pdf->SetFont('Arial','',10); 
$pdf->Ln(5);
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(60,4,'Departamento: '. utf8_decode($compra->departamento) ,0,1,'C');

$pdf->setY(40);$pdf->setX(60);
$pdf->Cell(60,4,'Fecha: ' . utf8_decode($compra->fecha),0,1,'C');

$pdf->setY(40);$pdf->setX(110);
$pdf->Cell(60,4,'Usuario: ' . utf8_decode($compra->usuario),0,1,'C');

$pdf->setY(40);$pdf->setX(150);
$pdf->Cell(60,4,'Folio: ' . utf8_decode($compra->folio),0,1,'C');



/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
/////////////////////////////
//// Array de Cabecera
$header = array("Codigo", "Descripcion","Unidad","Precio","SubTotal", "Cantidad");

//// Arrar de Productos
$products = array(
    
	array(" ", " ",2,120,0),

);

    // Column widths
    $w = array(35, 70, 20, 25, 25, 20);
    
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],2);
    $pdf->Ln();
    // Data
  
$total = 0;
foreach ($articulos as $articulo) {
    $subtotal = $articulo->precio * $articulo->cantidad;
    $total += $subtotal;
    {
        $pdf->Cell($w[0],6, utf8_decode($articulo->codigo),2);
        $pdf->Cell($w[1],6,utf8_decode($articulo->descripcion),2);
        $pdf->Cell($w[2],6,utf8_decode($articulo->unidad),2);
        $pdf->Cell($w[3],6,"$ ".utf8_decode($articulo->precio),2);
        $pdf->Cell($w[4],6,"$ ".utf8_decode($articulo->cantidad * $articulo->precio),2);
        $pdf->Cell($w[5],6,utf8_decode($articulo->cantidad),2);
        $pdf->Ln();
      

    }
}
/////////////////////////////
//// Apa


$pdf->setY(150);
$pdf->setX(10);


/////////////////////////////
$header = array("", "");
$data2 = array(

    
	array("Total:", utf8_decode($compra->total)),
);
    // Column widths
    $w2 = array(40, 40);
    // Header


    require_once("../includes/db.php");

    $SQL = "SELECT id, sum(id) as total FROM art_vendidos  ";
    $dato = mysqli_query($conexion, $SQL);
    if ($dato->num_rows > 0) {
      while ($filas = mysqli_fetch_array($dato)) {
    // Data
    foreach($data2 as $fila)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$fila[0],2);
        $pdf->Cell($w2[1],6,"$ ".number_format($compra->total),2);

  
    }
/////////////////////////////


$pdf->SetFont('Arial','B',10);    

$pdf->setY(150);
$pdf->setX(10);
$pdf->Cell(60,4,'Articulos en lista: '.utf8_decode($filas['total']),0,1,'C');

}
}
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
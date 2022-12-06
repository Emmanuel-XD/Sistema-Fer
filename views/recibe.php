<?php
include "../includes/db.php";


if(isset($_POST['buscador']))
{
	$codigo = $_POST['codigo'];

	$consulta = "SELECT * FROM articulos WHERE codigo = '$codigo'"; 
	$resultado = mysqli_query($conexion, $consulta);
	$map_result = mysqli_num_rows($resultado);
	if($map_result){
		while ($dato = mysqli_fetch_assoc($resultado)){
			$datos[] = $dato;
		}
		echo json_encode($datos);
	} else{
        echo "<script language='JavaScript'>
        alert('No existe ese codigo en la db');
        location.assign('compras.php');
        </script>";
	}
}





?>
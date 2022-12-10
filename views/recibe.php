<?php
include "../includes/db.php";


if(isset($_POST['buscador']))
{
	$codigo = $_POST['codigo'];
	$descripcion = $_POST['descripcion'];
	$consulta = "SELECT * FROM articulos WHERE UPPER(codigo) LIKE '%$codigo%' OR descripcion LIKE '%$descripcion%' LIMIT 5"; 
	$resultado = mysqli_query($conexion, $consulta);
	$map_result = mysqli_num_rows($resultado);
	if($map_result){
		while ($dato = mysqli_fetch_assoc($resultado)){
			$datos[] = $dato;
		}
		echo json_encode($datos);
	} else{
       echo json_encode("error");
	}
}





?>
<?php



	$id = $_GET['id'];
	require_once ("db.php");
	$query = mysqli_query($conexion,"DELETE FROM departamentos WHERE id = '$id'");
	
	header ('Location: ../views/departamentos.php?m=1');
?>


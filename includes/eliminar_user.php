<?php


	$id = $_GET['id'];
	require_once ("db.php");
	$query = mysqli_query($conexion,"DELETE FROM user WHERE id = '$id'");
	
	header ('Location: ../views/usuarios.php?m=1');
?>


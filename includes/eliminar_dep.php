<?php

session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
	if($varsesion== null || $varsesion= ''){

	    header("Location:sesion/login.php");
		die();
	}
	$id = $_GET['id'];
	require_once ("db.php");
	$query = mysqli_query($conexion,"DELETE FROM departamentos WHERE id = '$id'");
	
	header ('Location: ../views/departamentos.php?m=1');
?>


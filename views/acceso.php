<?php 
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];

	if($varsesion== null || $varsesion= ''){

	header("Location:../includes/sesion/login.php");
		die();
	}


echo "<script language='JavaScript'>
alert('Necesitamos validar que eres Administrador para acceder a esta vista!!Vuelve a Iniciar Sesion');
location.assign('../includes/sesion/cerrarSesion.php');
</script>"

?>
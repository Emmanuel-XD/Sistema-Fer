<?php 



include_once "../includes/header.php";
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];

	if($varsesion== null || $varsesion= ''){

	header("Location:../includes/sesion/login.php");
		die();
	}
?>
      

      
      <div class="container is-fluid">
	<h1 class="title">Home</h1>
	<h2 class="subtitle">¡Welcome !</h2>
<br>
<br>
 <!-- Content Row -->
 <div class="row">

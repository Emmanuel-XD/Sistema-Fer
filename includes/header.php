<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];

	if($varsesion== null || $varsesion= ''){

	header("Location:./sesion/login.php");

	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Sistema</title>


	<link rel="stylesheet" href="../css/fontawesome-all.min.css">

	<link rel="stylesheet" href="../css/estilo.css">
	<link rel="stylesheet" href="../css/es.css">
</head>

<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
<div class="container px-4">
<a class="navbar-brand" href="../views/index.php">Portal Requisiciones</a>

				 	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

				 <div class="collapse navbar-collapse" id="navbarResponsive">
				 <ul class="navbar-nav ms-auto">

		 <li class="nav-item"><a class="nav-link" href="../views/departamentos.php">Departamentos </a></li>
		 <li class="nav-item"><a class="nav-link"href="../views/compras.php">Compras </a></li>
		 <li class="nav-item"><a class="nav-link"href="../views/articulos.php">Articulos </a></li>
		 <li class="nav-item"><a class="nav-link"href="../views/acceso.php" >Usuarios </a><li>
		 <li class="nav-item"><a class="nav-link"href="../views/ceco.php" >CeCo </a><li>
		 <li class="nav-item"><a class="nav-link"href="#" > <?php echo $_SESSION['usuario']; ?> </a><li>
		
				</ul>

             
	<ul class="navbar-nav flex-row">
    <li class="nav-item me-3 me-lg-1">
    <a class="nav-link d-sm-flex align-items-sm-center" href="#"> 
	<span class="mr-2 d-none d-lg-inline text-gray-600 small">  
	<strong class="d-none d-sm-block ms-1"><?php  ?></strong>
        </a>
      </li>
      

	  <li class="nav-item"><a class="nav-link" href="../includes/sesion/cerrarSesion.php">Log Out </a><li>		
      
	</div>
		</div>
	</nav>
	
	<div class="container">
		<div class="row">
           <script src="../js/contenido.js"></script>
	

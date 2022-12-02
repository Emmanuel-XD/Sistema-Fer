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


	
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="../css/prueba.css">
    <script src="../js/jquery.min.js"></script>

    <script src="../js/resp/bootstrap.min.js"></script>
  
    <title></title>
</head>

<div class="container is-fluid">
<div class="col-xs-12">
		<h1>Lista de Departamentos</h1>
    <br>
		<div>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#dep">
				<span class="glyphicon glyphicon-plus"></span> Agregar departamento </a></button>
    </div>
		<br>
		<style>
  
  #m {  color: #FF0000;  }
  #b {  color: #FFA500;  }
  a { text-decoration: none; 
	  } 
	table.dataTable thead th, table.dataTable tfoot th {
        font-weight: bold;
        color: white;
    }
  </style>
        
        <table class="table table-striped"  id= "table_id">

                   
                         <thead>    
                         <tr class="bg-dark">
                        <th>Id</th>
                        <th>CeCo</th>
                        <th>Descripcion</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
         
                        </tr>
                        </thead>
                        <tbody>

				<?php

require_once ("../includes/db.php");             
$result=mysqli_query($conexion,"SELECT * FROM departamentos");
while ($fila = mysqli_fetch_assoc($result)):
    
?>
<tr>
<td><?php echo $fila['id']; ?></td>
<td><?php echo $fila['nombre']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['estado']; ?></td>
<td><?php echo $fila['fecha']; ?></td>

<td>
<a class="btn btn-warning" href="../includes/editar_dep.php?id=<?php echo $fila['id']?> ">
editar</a>
<a href="../includes/eliminar_dep.php?id=<?php echo $fila['id']?> " class="btn btn-danger btn-del" >
eliminar</a></button>
</td>
</tr>


<?php endwhile;?>


	</body>
  <style>


</style>
  </table>
   <script>
  $('.btn-del').on('click', function(e){
e.preventDefault();
const href = $(this).attr('href')

Swal.fire({
  title: 'Estas seguro de eliminar este usuario?',
  text: "¡No podrás revertir esto!!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar!', 
  cancelButtonText: 'Cancelar!', 
}).then((result)=>{
    if(result.value){
        if (result.isConfirmed) {
    Swal.fire(
      'Eliminado!',
      'El usuario fue eliminado.',
      'success'
    )
  }

        document.location.href= href;
    }   
})

    })


</script>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script src="../package/jquery-3.6.0.min.js"></script>

  <script type="text/javascript" src="../DataTables/js/datatables.min.js"></script>
  <script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script>
  <script src="../DataTables/js/dataTables.bootstrap4.min.js"></script>
<script src="../js/user.js"></script>
  

  <?php include("../includes/dep.php"); ?>
</html>

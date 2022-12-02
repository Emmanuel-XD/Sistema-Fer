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

  
    <title></title>
</head>

<div class="container is-fluid">
<div class="col-xs-12">
		<h1>Lista de Articulos</h1>
    <br>
		<div>
        
        
    </div>
    <?php

include_once '../includes/db.php';
// alertas de mensaje
if(!empty($_GET['status'])){
  switch($_GET['status']){
      case 'succ':
          $estado= 'alert-success';
          $mensaje = 'Importacion correcta de CSV ';
          break;
      case 'err':
          $estado = 'alert-danger';
          $mensaje = 'Ocurrio un problema. Intentalo de nuevo';
          break;
      case 'invalid_file':
          $estado = 'alert-danger';
          $mensaje = 'Cargue un archivo CSV valido.';
          break;
      default:
          $estado = '';
          $mensaje = '';
  }
}

?>
<!-- mostrar alerta -->
<?php if(!empty($mensaje)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $estado; ?>"><?php echo $mensaje; ?></div>
</div>
<?php } ?>


<div class="row">
    <!-- con esto importamos el archivo csv xd -->
    <div class="col-md-12 head">
        <div class="float-right"></div>
            <a href="javascript:void(0);" class="btn btn-success" 
            onclick="formToggle('importFrm');"><i class="plus"></i> Importar CSV</a>
            <!-- aqui se puede agregar otro boton -->
        </div>
    </div>
    <br>
    <!-- Aqui se carga el archvio -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="../includes/subir.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importar" value="Subir CSV">
        </form>
    </div>
    

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
                        <th>Codigo</th>
                        <th>Estado</th>
                        <th>Descripcion</th>
                        <th>Unidad</th>
                        <th>PrecioUnit</th>
                        <th>SubInventario</th>
                        <th>Proveedor</th>
                
                        <th>Acciones</th>
         
                        </tr>
                        </thead>
                        <tbody>

				<?php

require_once ("../includes/db.php");             
$result=mysqli_query($conexion,"SELECT * FROM articulos");
while ($fila = mysqli_fetch_assoc($result)):
    
?>
<tr>
<td><?php echo $fila['codigo']; ?></td>
<td><?php echo $fila['estado']; ?></td>
<td><?php echo $fila['descripcion']; ?></td>
<td><?php echo $fila['unidad']; ?></td>
<td><?php echo $fila['precio']; ?></td>
<td><?php echo $fila['inventario']; ?></td>
<td><?php echo $fila['proveedor']; ?></td>


<td>
<a class="btn btn-warning" href="../includes/editar_art.php?id=<?php echo $fila['id']?> ">
editar</a>
<a href="../includes/eliminar_art.php?id=<?php echo $fila['id']?> " class="btn btn-danger btn-del" >
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

<!-- Se oculta y muestra el form-->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script src="../package/jquery-3.6.0.min.js"></script>

  <script type="text/javascript" src="../DataTables/js/datatables.min.js"></script>
  <script type="text/javascript" src="../DataTables/js/jquery.dataTables.min.js"></script>
  <script src="../DataTables/js/dataTables.bootstrap4.min.js"></script>
<script src="../js/user.js"></script>
  

  <?php include("../includes/art.php"); ?>
</html>

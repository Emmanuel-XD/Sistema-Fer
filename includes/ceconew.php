
  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("db.php");
if(isset($_POST)){
  if (strlen($_POST['descripcion']) >= 1 && strlen($_POST['estado']) >= 1) {
       

        $descripcion = trim($_POST['descripcion']);
        $estado = trim($_POST['estado']);


  $consulta = "INSERT INTO ceco (descripcion, estado)
        VALUES ( '$descripcion', '$estado')";
   $resultado=mysqli_query($conexion, $consulta);

      if($resultado){
echo'El registro fue guardado correctamente';
    
      }else{
          echo 'Error al guardar los datos';
      }
}else{
  echo 'No data';
}
}




  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("db.php");
if(isset($_POST)){
  if (strlen($_POST['id_ceco']) >= 1 && strlen($_POST['descripcion']) >= 1 && strlen($_POST['estado']) >= 1) {
       
        $id_ceco = trim($_POST['id_ceco']);
        $descripcion = trim($_POST['descripcion']);
        $estado = trim($_POST['estado']);


  $consulta = "INSERT INTO departamentos (id_ceco, descripcion, estado)
        VALUES ('$id_ceco', '$descripcion', '$estado')";
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



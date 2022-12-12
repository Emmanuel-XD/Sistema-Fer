
  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("db.php");
if(isset($_POST)){
  if (strlen($_POST['centro']) >= 1 && strlen($_POST['estado']) >= 1) {
       

        $centro = trim($_POST['centro']);
        $estado = trim($_POST['estado']);


  $consulta = "INSERT INTO ceco (centro, estado)
        VALUES ( '$centro', '$estado')";
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



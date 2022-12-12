
  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("../db.php");
if(isset($_POST)){
  if (strlen($_POST['usuario']) >= 1 && strlen($_POST['nombre']) >= 1 && strlen($_POST['password']) >= 1 
  && strlen($_POST['id_depa']) >= 1 && strlen($_POST['estado']) >= 1 && strlen($_POST['rol_id']) >= 1) {
        $usuario = trim($_POST['usuario']);
        $nombre = trim($_POST['nombre']);
        $password = trim($_POST['password']);
        $id_depa = trim($_POST['id_depa']);
        $estado= trim($_POST['estado']);
        $rol_id= trim($_POST['rol_id']);


  $consulta = "INSERT INTO user (usuario, nombre, password, id_depa, estado, rol_id)
        VALUES ('$usuario', '$nombre', '$password', '$id_depa', '$estado','$rol_id')";
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








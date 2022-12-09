
  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("db.php");
if(isset($_POST)){
  if (strlen($_POST['fecha']) >= 1 && strlen($_POST['ceco']) >= 1 && strlen($_POST['monto']) >= 1 
 && strlen($_POST['porcentaje']) >= 1 && strlen($_POST['extra']) >= 1 ) {
       
        $fecha = trim($_POST['fecha']);
        $ceco = trim($_POST['ceco']);
        $monto = trim($_POST['monto']);
        $porcentaje = trim($_POST['porcentaje']);
        $extra = trim($_POST['extra']);
       

  $consulta = "INSERT INTO catalogo (fecha, ceco, monto, porcentaje, extra)
        VALUES ('$fecha', '$ceco', '$monto', '$porcentaje', '$extra')";
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



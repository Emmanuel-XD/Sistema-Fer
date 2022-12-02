
  
  <?php


/**
 * Parte de registro de usuarios
 */

require_once ("db.php");
if(isset($_POST)){
  if (strlen($_POST['codigo']) >= 1 && strlen($_POST['estado']) >= 1 && strlen($_POST['descripcion']) >= 1 
 && strlen($_POST['unidad']) >= 1 && strlen($_POST['precio']) >= 1 && strlen($_POST['inventario']) >= 1 
 && strlen($_POST['proveedor']) >= 1) {
       
        $codigo = trim($_POST['codigo']);
        $estado = trim($_POST['estado']);
        $descripcion = trim($_POST['descripcion']);
        $unidad = trim($_POST['unidad']);
        $precio = trim($_POST['precio']);
        $inventario = trim($_POST['inventario']);
        $proveedor = trim($_POST['proveedor']);


  $consulta = "INSERT INTO articulos (codigo, estado, descripcion, unidad, precio, inventario, proveedor)
        VALUES ('$codigo', '$estado', '$descripcion', '$unidad', '$precio', '$inventario', '$proveedor')";
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



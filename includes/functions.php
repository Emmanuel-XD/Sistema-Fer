<?php
   



if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'editar_registro':
            editar_registro();
            break; 

            case 'editar_art':
                editar_art();
                break; 

    
            case 'editar_dep';
            editar_dep();

            case 'editar_ceco';
            editar_ceco();
    
            break;

            case 'acceso_user';
            acceso_user();
            break;

            case 'get-article':
            get_article();
            break;

		}

	}

    function editar_art() {
		require_once ("db.php");

		extract($_POST);
		$consulta="UPDATE articulos SET codigo = '$codigo', estado = '$estado', descripcion = '$descripcion', 
        precio = '$precio',  inventario = '$inventario', proveedor = '$proveedor' WHERE id = '$id' ";
        $resultado=mysqli_query($conexion, $consulta);

       if($resultado){
            echo "<script language='JavaScript'>
            alert('El registro fue actualizado correctamente');
            location.assign('../views/articulos.php');
           </script>";
       } else{
       echo "<script language='JavaScript'>
      alert('Uy no! ya valio hablale al ing :v');
      location.assign('../views/articulos.php');
      </script>";
}

}

    function editar_registro() {
		require_once ("db.php");
		extract($_POST);
		$consulta="UPDATE user SET usuario = '$usuario' , nombre = '$nombre', password = '$password',
		departamento ='$departamento', estado ='$estado' WHERE id = '$id' ";
		$resultado=mysqli_query($conexion, $consulta);

       if($resultado){
            echo "
            <script language='JavaScript'>
            alert('El registro fue actualizado correctamente');
            location.assign('../views/usuarios.php');
            </script>";
       } else{
             echo "<script language='JavaScript'>
             alert('Uy no! ya valio hablale al ing :v');
             location.assign('../views/usuarios.php');
             </script>";
}

}

function editar_dep() {
    require_once ("db.php");
    extract($_POST);
    $consulta="UPDATE departamentos SET nombre = '$nombre', descripcion='$descripcion', 
    estado='$estado' WHERE id = '$id' ";
    $resultado=mysqli_query($conexion, $consulta);

   if($resultado){
        echo "
        <script language='JavaScript'>
        alert('El registro fue guardado correctamente');
        location.assign('../views/departamentos.php');
        </script>";
   } else{
         echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/departamentos.php');
         </script>";
}

}

function editar_ceco() {
    require_once ("db.php");
    extract($_POST);
    $consulta="UPDATE ceco SET  descripcion='$descripcion', 
    estado='$estado' WHERE id = '$id' ";
    $resultado=mysqli_query($conexion, $consulta);

   if($resultado){
        echo "
        <script language='JavaScript'>
        alert('El registro fue guardado correctamente');
        location.assign('../views/ceco.php');
        </script>";
   } else{
         echo "<script language='JavaScript'>
         alert('Uy no! ya valio hablale al ing :v');
         location.assign('../views/ceco.php');
         </script>";
}

}

function acceso_user(){

  
		extract($_POST);
        require_once ("db.php");
        $usuario= $conexion->real_escape_string($_POST['usuario']);
        $password= $conexion->real_escape_string($_POST['password']);
        session_start();
        $_SESSION['usuario']=$usuario;
        //$_SESSION['rol_id']=$rol_id;
    
        
        $consulta="SELECT*FROM user where usuario='$usuario' and password='$password'";
        $resultado=mysqli_query($conexion,$consulta);
        $filas=mysqli_fetch_array($resultado);
        

        if(isset($filas['rol_id'])==1){

            header('Location: ../views/usuarios.php');


            if($filas['rol_id']==2){ //empleado
         
      
                header('Location: ../views/index.php');

        }
        

    } else{
            
           
        echo "<script language='JavaScript'>
        alert('Usuario o Contraseña Incorrecta');
        location.assign('./sesion/login.php');
        </script>";
            session_destroy();
        }
}
function get_article(){
require_once ("db.php");
extract($_POST);
$consulta = "SELECT * FROM articulos WHERE id = $id";
$resultado=mysqli_query($conexion,$consulta);
if (mysqli_num_rows($resultado)>0)
    {    
        while ($dato = mysqli_fetch_assoc($resultado) ){
         $datos[] = $dato;
    }
    echo json_encode($datos);
    }
    else {
    echo json_encode('error');
    }

}
?>

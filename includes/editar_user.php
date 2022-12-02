<?php 

session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];

	if($varsesion== null || $varsesion= ''){

	    header("Location:./sesion/login.php");
		die();
	}


////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$id = $_GET['id'];
include_once "header.php";
require_once ("db.php");
$consulta = "SELECT * FROM user WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$usuario = mysqli_fetch_assoc($resultado);

////////////////// VARIABLES DE CONSULTA////////////////////////////////////
?>


<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>

    <link rel="stylesheet" href="../../css/fontawesome-all.min.css">

	<link rel="stylesheet" href="../../css/estilo.css">
</head>

<body>



    <form  action="functions.php" method="POST">

        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                     
                            <h3 class="text-center">Editar el registro de <?php echo $usuario ['usuario']; ?></h3>
                            
                            <div class="form-group">
                                <label for="password">Usuario:</label><br>
                                <input type="usuario" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario ['usuario']; ?>">
                            </div>
                            
                            <div class="form-group">
                            <label for="nombre" class="form-label">Nombre *</label>
                            <input type="text"  id="nombre" name="nombre" class="form-control" value="<?php echo $usuario ['nombre']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Contraseña:</label><br>
                                <input type="password" name="password" id="password" class="form-control" value="<?php echo $usuario ['password']; ?>">
                            </div>
                            <div class="form-group">
                                  <label for="departamento" class="form-label">Departamento:</label>
                                  <select name="edepartamento" id="departamento" class="form-control" required >
                                  <option <?php echo $usuario ['departamento']==='Sistemas' ? "selected='selected' ": "" ?> value="Sistemas">Sistemas</option>
                                  <option <?php echo $usuario ['departamento']==='Empleado' ? "selected='selected' ": "" ?> value="Empleado">Empleado</option>
                                 
                                  </select>
                            </div>
                            
                                <div class="form-group">
                                  <label for="estado" class="form-label">Estado:</label>
                                  <select name="estado" id="estado" class="form-control" required >
                                  <option <?php echo $usuario ['estado']==='1' ? "selected='selected' ": "" ?> value="1">Activo</option>
                                  <option <?php echo $usuario ['estado']==='2' ? "selected='selected' ": "" ?> value="2">Inactivo</option>

                                  <input type="hidden" name="accion" value="editar_registro">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                               </select>
                            </div>
                           
                               <br>
                                <div class="mb-3">
                                    
                                <button type="submit" class="btn btn-success" >Editar</button>
                               <a href="../views/usuarios.php" class="btn btn-danger">Cancelar</a>
                               
                            </div>
                            </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
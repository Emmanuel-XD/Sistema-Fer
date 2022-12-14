<?php 


?>


<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros</title>
    <link rel="stylesheet" href="../package/dist/sweetalert2.css">
    
</head>

<body id="page-top">
    <div class="modal fade" id="dep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h3 class="modal-title" id="exampleModalLabel">Nuevo Departamento</h3>
                       <button type="button" class="btn btn-primary" data-dismiss="modal">
					<i class="fa fa-times" aria-hidden="true"></i></button>

                </div>
                <div class="modal-body">

<form  action="artnew.php" method="POST">
                            
<div class="form-group">
                            <label for="" class="form-label">CeCo*</label>
                            <select name="id_ceco" id="id_ceco" required="true" class="form-control">
							  <option value="0">--Selecciona una opcion--</option>
                                <?php

                                include ("db.php");
                                //Codigo para mostrar categorias desde otra tabla
                                $sql="SELECT * FROM ceco ";
                                $resultado=mysqli_query($conexion, $sql);
                                while($consulta=mysqli_fetch_array($resultado)){
                                    echo '<option value="'.$consulta['id'].'">'.$consulta['centro'].'</option>';
                                }

                                ?>

				
		                      </select>
                            </div>

                            <div class="form-group">
                                <label for="desc">Descripcion:</label><br>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                            </div>

                            
      
                            <div class="form-group">
                                  <label for="dep" class="form-label">Estado:</label>
                                  <select name="estado" id="estado" class="form-control" required>
                                  <option value="">--Selecciona una opcion--</option>
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                               </select>
                            </div>
                           
                        
                      <br>

                                <div class="mb-3">
                                    
                               <input type="submit" value="Guardar" id="register" class="btn btn-success" 
                               name="registrar">
                               <a href="departamentos.php" class="btn btn-danger">Cancelar</a>
                               
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
    


<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){

            var id_ceco = $('#id_ceco').val();
			var descripcion = $('#descripcion').val();
            var estado 	= $('#estado').val();

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: '../includes/depnew.php',
					data: {id_ceco: id_ceco,descripcion: descripcion, estado: estado },
					success: function(data){
					Swal.fire({
								'title': '??Mensaje!',
								'text': data,
                                'icon': 'success',
                                'type': 'success',
                                'showConfirmButton': 'false',
                                'timer': '1500'
								}).then(function() {
                window.location = "departamentos.php";
            });
							
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Error',
								'text': 'Hubo problemas al guardar los datos',
								'type': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
	
</script>
</body>
</html>
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



    <script src="../js/jquery.min.js"></script>

  
    <title></title>
</head>

<div class="container is-fluid">
<div class="col-xs-12">
		<h1>Compras</h1>
    <br>
		<div>
            <label for="">Folio</label>
   <input type="text" class="">
   <label for="">Departamento</label>
   <input type="text" class="">
   <label for="">Comentarios</label>
   <input type="text" class="">
    </div>
    <br>

    <div >
        <p>Articulos</p>
    <label for="">Codigo</label>
    <input type="text" class="searchbox" name="codigo" id="codigo">
        <input type="submit" class="btn btn-outline-secondary" name="buscar" id="buscar" value="BUSCAR">
        <form action="POST" id="formulario">

</form>

 
   </div>
   
   <script>
        $(document).ready(function(){
            $('#buscar').click(function(e){
                e.preventDefault();

                var codigo = $('input[name=codigo]').val();
                $.ajax({
                    type: "POST",
                    url: "recibe.php",
                    data:{
                        "buscador": 1,
                        "codigo": codigo,

                    },
                    dataType:"text",
                    success: function(response){
                        $('#formulario').html(response); 
                    }
                });
            });
          
        });
    </script>

		<br>
		
        
        <table class="table table-striped"  >

                   
                         <thead>    
                         <tr class="bg-dark" style="color: white;">
                        <th >Id</th>
                        <th>Codigo</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>PrecioUnit</th>
                        <th>Total   </th>
         
                        </tr>
                        </thead>
                        <tbody>

			



	</body>
  <style>


</style>
  </table>
  <br>
  <br>
  <br>
  <br>

  <label for="">Requisicion Actual</label>
  <input type="text">
  <label for="">Limite de Monto</label>
  <input type="text">
  <label for="">Total Requesiciones</label>
  <input type="text">

  

</html>

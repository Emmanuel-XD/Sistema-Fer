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
 
    <div class="modal-buy" id="test">
        <div class="modal-content-buy">
            <div class="product-form-buy">
            <form action="POST" id="formulario">
                <p>Articulos</p>
                <label for="">Codigo</label>
                <input type="text" class="searchbox" name="codigo" id="codigo" required>
                <label for="quant">Cantidad</label>
                <input type="number" class="searchbox" name="quant" id="quantity" required>
                <input type="submit" class="btn btn-outline-secondary" name="buscar" id="buscar" value="BUSCAR">
              </form>
            </div>
        </div>
   </div>
   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
  Imprimir esta requisicion...
</button>
   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <div class=" modal-body">
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
   
   <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
 Buscar Requisicion...
</button>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

   <script>
        $(document).ready(function(){
            $('#buscar').click(function(e){
                e.preventDefault();
                var code = document.getElementById("codigo").value
                var quant = document.getElementById("quantity").value
                var formularioDatos = new FormData()
                formularioDatos.append('buscador', 'buscador')
                formularioDatos.append('codigo',  code)
                fetch('recibe.php', {
                    method: 'POST',
                    body: formularioDatos
                }).then((res) => res.json()).then((Response) => {
                    let html = ``
                    Response.map(function(a){
                        html += `
                                            <tr> 
                        <td>${a.id}</td>
                        <td>${a.codigo}</td>
                        <td>${quant}</td>
                        <td>${a.unidad}</td>
                        <td>${a.precio}</td>
                        <td>${quant * a.precio}</td>
                        </tr>
                                            
                                            
                        `;

                    })
                    const dtable = document.getElementById("formtable")
                    dtable.innerHTML += html;
                })
            });
          
        });
        
     /*    let modalBtns = [...document.querySelectorAll(".button")];
        modalBtns.forEach(function (btn) {
            btn.onclick = function () {
            let modal = btn.getAttribute("data-modal");
            document.getElementById(modal).style.display = "block";
            };
        });
        let closeBtns = [...document.querySelectorAll(".close")];
      closeBtns.forEach(function (btn) {
        btn.onclick = function () {
          let modal = btn.closest(".modal-buy");
          modal.style.display = "none";
        };
      }); */
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
                        <tbody id="formtable">

                        </tbody>

			



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


<script src="../js/bootstrap.min.js"></script>
<!-- <script src="../js/jquery.min.js"></script> -->


</html>

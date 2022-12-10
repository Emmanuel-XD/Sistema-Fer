<?php
include_once "../includes/header.php";
include_once "../includes/db.php";
?>
<?php
error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];

if($varsesion == null || $varsesion == ''){


}
?>
<?php

$sql = "SELECT * FROM user WHERE usuario ='$varsesion'";
$usuarios = mysqli_query($conexion, $sql);
if($usuarios -> num_rows > 0){
foreach($usuarios as $key => $fila ){

?>


<?php
}
}
?>


<div class="container is-fluid">
<div class="col-xs-12">
		<h1>Compras</h1>
    <br>
		<div>
            <label for="">Folio</label>
   <input type="text" class="">
   <label for="">Departamento</label>
   <input type="text" class="" value="<?php echo $fila['departamento']; ?> ">
   <label for="">Comentarios</label>
   <input type="text" class="">
    </div>
    <br>

 
<!--     <div class="modal-buy" id="test">
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
   </div> -->
   <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
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
   </div> -->
   
   <!-- Button to Open the Modal -->
<!--  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
 Buscar Requisicion...
</button> -->
  <!--
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Modal body..
      </div>

   
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div> -->
<div class="container is-fluid">
<div class="row">
<div class="wrapper col-sm-6">
<div class="search-input ">
  <div>
        <a href="" target="_blank" hidden></a>
        <input type="text" placeholder="Escribe el codigo del producto...">
        <div class="autocom-box">
        </div>
        <div class="icon btn btn-dark"><i class=" fa-solid fa-list"></i></div>
  </div>
  </div>
</div>
	<div class="col-sm-6">
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
        </table>
  </div>
  </div>
  </div>
  <label for="">Requisicion Actual</label>
  <input type="text">
  <label for="">Limite de Monto</label>
  <input type="text">
  <label for="">Total Requesiciones</label>
  <input type="text">

</body>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/compras.js"></script>
<!-- <script src="../js/jquery.min.js"></script> -->


</html>

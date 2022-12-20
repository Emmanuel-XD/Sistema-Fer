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

$sql = "SELECT u.id, u.nombre, u.usuario, u.password, u.fecha, u.estado,
p.rol,d.descripcion FROM user u LEFT JOIN permisos p ON u.rol_id = p.id LEFT JOIN departamentos d
ON u.id_depa = d.id WHERE usuario ='$varsesion'";
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
		<center><h1>COMPRAS</h1></center>
    <br>
		<div class="row">
      <div class="col-sm-2">
    <label for="">Folio</label>
   <input id="folio" type="text" class="control">
   </div>
   <div class="col-sm-8">

   </div>
   <div class="col-sm-2">
   <label for="">Departamento</label>
   <input id="depto" type="text" class="control" readonly value="<?php echo $fila['descripcion']; ?> ">
   </div>
    </div>
    <br> 

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
        <table id="tablecont" class="table table-striped"  >
                         <thead>    
                         <tr class="bg-dark" style="color: white;">
                        <th >Id</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>PrecioUnit</th>
                        <th>Total </th>
                        </tr>
                        </thead>
                        <tbody id="formtable">
                        </tbody>
        </table>
  </div>
  </div>
  </div>
  <br>
  <br>
  <?php

$sql = "SELECT cat.id, cat.fecha,  cat.monto, cat.porcentaje, c.centro, d.descripcion, u.usuario
FROM catalogo cat INNER JOIN ceco c ON cat.id_ceco = c.id
INNER JOIN departamentos d ON cat.id_ceco = d.id_ceco 
INNER JOIN user u ON u.id_depa = d.id  WHERE usuario ='$varsesion' ORDER BY cat.fecha DESC ";
$usuarios = mysqli_query($conexion, $sql);
if($usuarios -> num_rows > 0){
foreach($usuarios as $key => $fila ){

?>


<?php
}
}
?>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
  <button id="viewHist" class="form-control btn btn-warning">Ver historial</button>
      </div>
      <div class="col-sm-3">
  <button  id="save-btn" class="form-control btn btn-success">Guardar compra</button>
      </div>
      <div class="col-sm-2">
        
      </div>
      <div class="col-sm-2">
          <div class="alert alert-success" role="alert">
          Limite de compra: <h4 id="top-total"><?php echo $fila['monto']; ?>
          </h4>
          MXN
          </div>
      </div>
      <div class="col-sm-2">
      <div  class="alert alert-dark" role="alert">
  Total actual:<h4 id="sumatotal">0</h4>MXN
</div>
      </div>
   </div>
  </div>

  <input type="hidden" class="control" readonly>
  <input type="hidden" id="monto" class="hidden control" value="<?php echo $fila['monto']; ?>" readonly>
  <input type="hidden" class="control" readonly>
  <input  id="user" type="hidden" class=" control"  value="<?php echo $varsesion?>" readonly>

</body>
<script src="../js/compras.js"></script>
<script src="../js/bootstrap.min.js"></script>

<!-- <script src="../js/jquery.min.js"></script> -->


</html>

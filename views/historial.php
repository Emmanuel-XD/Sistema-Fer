<?php
include_once "../includes/header.php";
include_once "../includes/base.php";


$sentencia = $base_de_datos->query("SELECT compras.total, compras.folio, compras.fecha, compras.id, compras.usuario,compras.departamento,
GROUP_CONCAT(	articulos.codigo, '..',  articulos.descripcion,  '..', art_vendidos.cantidad, '..',  art_vendidos.precio  
SEPARATOR '__') AS articulos FROM compras LEFT JOIN art_vendidos
ON art_vendidos.id_compra = compras.id LEFT JOIN articulos ON
 articulos.id = art_vendidos.id_articulo GROUP BY compras.id ORDER BY compras.id;");
$compras = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>


<br>
<br>
<br>
<br>
<div class="col-xs-12">
	<h1>Historial de compras</h1>
	

	<br>

	<style>
		.table thead th {
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
			color: white;
		}
	</style>
	<table class=" table table-striped" id="table_id">
		<thead>
			<tr class="bg-dark">
				<th>ID</th>
				<th>Folio</th>
				<th>Fecha</th>
				<th>Articulos</th>
				<th>Total</th>
				<th>PDF</th>
				<th>Usuario</th>
                <th>Departamento</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($compras as $compra) { ?>
			
				<tr>
				<td><b><?php echo $compra->id ?></td></b>
				<td><?php echo $compra->folio ?></td>
					<td><?php echo $compra->fecha; ?></td>
					<td>
						<table class="table table-striped" id="table_id">
							<thead>
								<tr class="bg-dark">
									<th>Codigo</th>
									<th>Descripcion</th>
									<th>Cantidad</th>
                                    <th>Precio</th>
								

								</tr>
							</thead>
							<tbody>
							<?php foreach (explode("__", $compra->articulos) as $productosConcatenados) {
									$articulo = explode("..", $productosConcatenados)
								?>
									<tr>
										<td><?php echo $articulo[0] ?></td>
										<td><?php echo $articulo[1] ?></td>
										<td><?php echo $articulo[2] ?></td>
										<td><?php echo '$'.$articulo[3] ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo  '$', $compra->total ?></td>
					
					<td><a class="btn btn-outline-danger" target="_blank" href="<?php echo "requisicion.php?id=" . $venta->id ?>"><i class="fa fa-print"></i></a></td>
					<td><?php echo $compra->usuario ?></td>
					<td><?php echo $compra->departamento ?></td>
				</tr>
			<?php } ?>

		</tbody>
	</table>






</div>
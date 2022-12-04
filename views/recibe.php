<?php
include "../includes/db.php";


if(isset($_POST['buscador']))
{
	$codigo = $_POST['codigo'];

	$consulta = "SELECT * FROM articulos WHERE codigo = '$codigo'"; 
	$resultado = mysqli_query($conexion, $consulta);

	if($resultado){

		while ($fila = mysqli_fetch_array($resultado))
		{
			?>
			<br>
            <label for="">codigo</label> 
			<input type="hidden" class="text" name="id" id="id" value="<?php echo $fila['codigo'];?>">
			
            <label for="">descripcion</label> 
				<input type="text" class="text" readonly name="descripcion" id="descripcion" value="<?php echo $fila['descripcion'];?>">

                <label for="">Cantidad</label> 
				<input type="text" class="text" name="cantidad" id="cantidad" >
			
            <label for="">Unidad</label> 
				<input type="text" class="text" readonly  name="unidad" id="unidad" value="<?php echo $fila['unidad'];?>">
			
		
            <label for="">PrecioUnit</label> 
				<input type="text" class="text" readonly name="precio" id="precio" value="<?php echo $fila['precio'];?>">
		
                
                <label for="">Total</label> 
				<input type="text" class="text" readonly name="total" id="total" >
                <button id="agregar" name="agregar" class="btn btn-primary">Agregar</button>

			<?php

		}
	} else{
        echo "<script language='JavaScript'>
        alert('No existe ese codigo en la db');
        location.assign('compras.php');
        </script>";
	}
}





?>
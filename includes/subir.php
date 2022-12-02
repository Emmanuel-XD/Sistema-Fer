<?php

include_once 'db.php';

if(isset($_POST['importar'])){
    
    // extenciones permitidas
    $csvtipos = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // validacion de si es un csv
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvtipos)){
        
        // validar si el archivo esta subido
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // se abre, lee y carga el archivo CSV
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // salto de linea
            fgetcsv($csvFile);
            
            // Revisar los datos linea por linea
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $codigo   = $line[0];
                $estado  = $line[1];
                $descripcion  = $line[2];
                $unidad = $line[3];
                $precio = $line[4];
                $inventario = $line[5];
                $proveedor = $line[6];
                
                // Revisar si el el campo ya existe con el mismo nombre
                $consulta = "SELECT id FROM articulos WHERE codigo = '".$line[0]."'";
                $resultado = $conexion->query($consulta);
                
                if($resultado->num_rows > 0){
                    // Actualizar datos
                    $conexion->query("UPDATE articulos SET codigo = '".$codigo."', estado = '".$estado."', descripcion = '".$descripcion."', 
                    unidad = '".$unidad."', precio = '".$precio."', inventario = '".$inventario."', proveedor = '".$proveedor."' WHERE codigo = '".$codigo."'");
                }else{
                    // Iinsertamos los datos a la db
                    $conexion->query("INSERT INTO articulos (codigo, estado, descripcion, unidad, precio, inventario, proveedor)
                    VALUES ('$codigo', '$estado', '$descripcion', '$unidad', '$precio', '$inventario', '$proveedor')");
                }
            }
            
            // se cierra el csv abierto
            fclose($csvFile);
            
            $alerta = '?status=succ';
        }else{
            $alerta = '?status=err';
        }
    }else{
        $alerta = '?status=invalid_file';
    }
}

//redireccionamos a los articulos para verlos en pantalla
header("Location: ../views/articulos.php".$alerta);
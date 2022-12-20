<?php
      require_once ("db.php");
    $payload = file_get_contents('php://input');
     if(isset($payload[0])){
        $json_array  = json_decode($payload, true);
        $COUNT = count($json_array[0]);

        $total = $json_array[1][2];
                $depto = $json_array[1][1];
                $folio = $json_array[1][0];
                $user = $json_array[1][3];
                $monto = $json_array[1][4];
                $newpresu = $monto - $total;
                echo $newpresu;
            $sql1 = "INSERT INTO compras (total, usuario, departamento, folio) VALUES ('$total', '$user', '$depto','$folio')";
            $resultado=mysqli_query($conexion, $sql1);
        
            $sql = "SELECT id_ceco FROM departamentos where descripcion = '$depto'";
            $resultado = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_array($resultado);
            $idceco = $row['id_ceco'];
            echo $idceco;
            $sql = "SELECT id FROM compras ORDER BY id DESC LIMIT 0, 1";
        $resultado=mysqli_query($conexion, $sql);
        $row= mysqli_fetch_array($resultado);
        $idcomp = $row['id'];
        
        $sql32 = "UPDATE catalogo SET monto = '$newpresu'  WHERE id_ceco = '$idceco' ";
        $resultado=mysqli_query($conexion, $sql32);
        
        
        for($i= 0; $i < $COUNT; $i++) {
        $id = $json_array[0][$i];
        $cant =$json_array[2][$i];
  
        $sql = "SELECT * FROM articulos WHERE id = '$id'";
        $resultado=mysqli_query($conexion, $sql);
        $row= mysqli_fetch_array($resultado);
        $idart = $row['id'];
        $unidad = $row['unidad'];
        $precio = $row['precio'];
        if($resultado){


        $sql = "INSERT INTO art_vendidos (id_articulo, cantidad, unidad, precio, id_compra) values ('$idart', '$cant', '$unidad', '$precio', '$idcomp')";
        $resultado=mysqli_query($conexion, $sql);
    }
         }
    header('Location: ../views/historial.php');
    } 
    ?>
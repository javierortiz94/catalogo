<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';
 
    $pedido=$_REQUEST['idPedido'];
    $usuario=($_REQUEST['usuario']);
    if(!$pedido==""&&!$usuario==""){
        $verEncabezado = ejecutarSQL::consultar("SELECT * FROM venta as v where v.NumPedido='$pedido'  and NIT = '$usuario'");
        $verDetalle = ejecutarSQL::consultar("select p.NombreProd,p.Precio,p.Imagen,d.CantidadProductos from producto as p, detalle as d where p.CodigoProd = d.CodigoProd and d.NumPedido ='$pedido'");
        while($encabezado = mysql_fetch_array($verEncabezado)) {
            echo "<tr><td>".$encabezado['NumPedido']."</td><td>".$encabezado['Fecha']."</td> <td>".$encabezado['TotalPagar']."</td><td>".$encabezado['Estado']."</td></tr>";
        }
        while($detalle = mysql_fetch_array($verDetalle)){
            echo "<tr><td>".$detalle['NombreProd']."</td><td>".$detalle['Precio']."</td> <td>".$detalle['Imagen']."</td><td>".$detalle['CantidadProductos']."</td></tr>";
        }
    }else{
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
    }
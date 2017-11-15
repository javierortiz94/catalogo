<?php
    session_start();
    include '../library/configServer.php';
    include '../library/consulSQL.php';
    $granTotal = 0;
    $pedido=$_REQUEST['idPedido'];
    $usuario=($_REQUEST['usuario']);
    if(!$pedido==""&&!$usuario==""){
        $verEncabezado = ejecutarSQL::consultar("SELECT * FROM venta as v where v.NumPedido='$pedido'  and NIT = '$usuario'");
        $verDetalle = ejecutarSQL::consultar("select p.CodigoProd,p.NombreProd,p.Precio,p.Imagen,d.CantidadProductos from producto as p, detalle as d where p.CodigoProd = d.CodigoProd and d.NumPedido ='$pedido'");
 
        while($encabezado = mysql_fetch_array($verEncabezado)) {
            echo"<div class='modal-content'>";
            echo"<div class='modal-header'>";
            echo"<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                echo "<div class='panel panel-default'>";
                echo "<div class='panel-heading text-center'><h4>   Pedido : ".$encabezado['NumPedido']."</h4>";
                echo "<div class='text-left'  ><h5>Fecha : ".$encabezado['Fecha']."</h5></div>";
                echo "<div class='text-right'  ><h5>Status : ".$encabezado['Estado']."</h5></div>";
                echo "</div>";
            echo"</div>";
            
            echo "<div class='modal-body'>";

            echo "<div class='panel-body'>";
            echo "<table class='table borderless'>";
            echo "<thead>";
            echo "<tr>";
            echo "<td><strong>Venta: # 4</strong></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo " <td></td>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
        }
        while($detalle = mysql_fetch_array($verDetalle)){
            echo "<tr>";
            echo "<td class='col-md-3'>";
            echo "    <div class='media'>";
            echo "            <a class='thumbnail pull-left' > <img class='media-object' src='assets/img-products/".$detalle['Imagen']."' style='width: 72px; height: 72px;'> </a>";
            echo "            <div class='media-body'>";
            echo "                <h5 class='media-heading'>".$detalle['NombreProd']."</h5>";
            echo "                <h5 class='media-heading'>".$detalle['CodigoProd']."</h5>";
            echo "            </div>";
            echo "    </div>";
            echo "</td>";
            echo "<td class='text-center'>".$detalle['Precio']."</td>";
            echo "<td class='text-center'>".$detalle['CantidadProductos']."</td>";
            $granTotal = $granTotal + ($detalle['Precio'] * $detalle['CantidadProductos']);
            echo "<td class='text-right'>$ ".$detalle['Precio'] * $detalle['CantidadProductos'] ."</td>";
            echo "</tr>";
        }
          
        echo "</tbody>";
        echo "</table> ";
        echo "<div class='text-right'><h5>Total: ".$granTotal."</h5></div>";
        echo "</div>";
        echo "</div>";

        echo "</div>";

        echo "<div class='modal-footer'>";
        echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
        echo "</div>";
        echo "</div>";
        
    }else{
        echo '<img src="assets/img/error.png" class="center-all-contens"><br>Error campo vacío<br>Intente nuevamente';
    }
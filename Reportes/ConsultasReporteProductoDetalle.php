<?
    include "../coneccion.php";
	include "../checar_sesion_admin.php";
	$idU=$_SESSION['idU'];
	$idA=$_SESSION['idA'];
    $idSuc=$_SESSION['idSuc'];
    
    /*Recibir variables de busqueda.*/
    $Buscar=$_GET['buscar'];
    $Desde=$_GET['desde'];
    $Hasta=$_GET['hasta'];
    $producto = $_GET['producto'];
    switch ($Buscar) {
        case 1:
            if ($producto!=0) {
                $and = "and dv.id_producto=$producto";
            }
            $Resultado=0;
            $ConsultadetalleProductos = "SELECT DATE_FORMAT(v.fecha,'%Y-%m-%d') AS fecha, p.nombre, dv.cantidad, p.id_producto, dv.mayoreo AS mayoreo FROM ventas v INNER JOIN detalle_ventas dv ON v.id_ventas=dv.id_ventas INNER JOIN productos p ON dv.id_producto=p.id_producto WHERE DATE_FORMAT(v.fecha,'%Y-%m-%d') BETWEEN '$Desde' AND '$Hasta' $and ORDER BY DATE_FORMAT(v.fecha,'%Y-%m-%d')";
            $Resultado = mysql_query($ConsultadetalleProductos) or print("Fallo: $ConsultadetalleProductos ".mysql_error());
            if (mysql_num_rows($Resultado)>=1) {
                while ($Productos = mysql_fetch_assoc($Resultado)) {
                    $ConsultaPrecio = "SELECT precio,mayoreo FROM productos WHERE id_producto=".$Productos['id_producto'];
                    $ResPrecio = mysql_query($ConsultaPrecio) or print("Fallo: $ConsultaPrecio ".mysql_error());
                    $PrecioProducto = mysql_fetch_assoc($ResPrecio);
                    $Precio = $PrecioProducto['precio'];
                    $Mayoreo="";
                    if ($Productos['mayoreo']==1) {
                        $Mayoreo="<i class='fas fa-check-circle'></i>";
                        $Precio =$PrecioProducto['mayoreo'];
                    }
                    if ($producto!=0) {
                        $sumaPrecio = $sumaPrecio+$Precio;
                        $sumaCantidad = $sumaCantidad+$Productos['cantidad'];
                        $tr = "<tr><td>--</td><td>".$Productos['nombre']."</td><td>".$sumaCantidad."</td><td>".$sumaPrecio."</td><td>--</td></tr>";
                    }else {
                        $tr = $tr."<tr><td>".$Productos['fecha']."</td><td>".$Productos['nombre']."</td><td>".$Productos['cantidad']."</td><td>".$Precio."</td><td>".$Mayoreo."</td></tr>";
                    }
                    
                }
                echo $tr;
            }else {
                echo $tr = "<tr><td colspan='5'>No ahi registros</td></tr>";;
            }
        break;
        
        case 2:
 header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Content-Disposition: filename=ProductosDetalle_$Desde_$Hasta.xls");
        break;

        default:
            echo $Buscar;
        break;
    }
    
?>
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
    
    $Resultado=0;
    $ConsultadetalleProductos = "SELECT DATE_FORMAT(v.fecha,'%Y-%m-%d') AS fecha, p.nombre, dv.cantidad, p.id_producto, dv.mayoreo AS mayoreo FROM ventas v INNER JOIN detalle_ventas dv ON v.id_ventas=dv.id_ventas INNER JOIN productos p ON dv.id_producto=p.id_producto WHERE DATE_FORMAT(v.fecha,'%Y-%m-%d') BETWEEN '$Desde' AND '$Hasta' ORDER BY DATE_FORMAT(v.fecha,'%Y-%m-%d')";
    $Resultado = mysql_query($ConsultadetalleProductos) or print("Fallo: $ConsultadetalleProductos ".mysql_error());
    if (mysql_num_rows($Resultado)>=1) {
        while ($Productos = mysql_fetch_assoc($Resultado)) {
            $ConsultaPrecio = "SELECT precio,mayoreo FROM productos WHERE id_producto=".$Productos['id_producto'];
            $ResPrecio = mysql_query($ConsultaPrecio) or print("Fallo: $ConsultaPrecio ".mysql_error());
            $PrecioProducto = mysql_fetch_assoc($ResPrecio);
            $Precio = $PrecioProducto['precio'];
            $Mayoreo="";
            if ($Productos['mayoreo']==1) {
                $Mayoreo="Mayoreo";
                $Precio =$PrecioProducto['mayoreo'];
            }
            $tr = $tr."<tr><td>".$Productos['fecha']."</td><td>".$Productos['nombre']."</td><td>".$Productos['cantidad']."</td><td>".$Precio."</td><td>".$Mayoreo."</td></tr>";                    
        }
    }else {
        $tr = "<tr><td colspan='5'>No ahi registros</td></tr>";;
    }
?>
    <table border="1">
		<thead class="pink darken-4 white-text">
		    <tr border="1">
		        <th bgcolor="#CCCCCC">Fecha de venta</th>
                <th bgcolor="#CCCCCC">Producto</th>
		        <th bgcolor="#CCCCCC">Cantidad</th>
			    <th bgcolor="#CCCCCC">Precio</th>
			    <th bgcolor="#CCCCCC">Mayoreo</th>
			</tr>
		</thead>

		<tbody border="1">
            <? echo $tr;?>
		</tbody>
    </table>
<?
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Disposition: filename=ProductoDetalle_".$Desde."_".$Hasta.".xls");
?>
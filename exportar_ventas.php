<?php
session_start();
include "coneccion.php";
include "checar_sesion.php";
include "checar_sesion_admin.php";

$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
$id=$_GET['id'];
$sucur=$_GET['suc'];
$usu=$_GET['usu'];
$tot=$_GET['tot'];
$fech=$_GET['f'];

$consulta="SELECT v.*,c.nombres,c.ap_paterno,c.ap_materno
from ventas v 
join clientes c on v.id_cliente=c.id_cliente 
where v.id_ventas=$id";
$resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
$res=mysql_fetch_assoc($resultado);

	 

setlocale(LC_TIME, 'spanish');  
$fecha=mb_convert_encoding (strftime("%A %d de %B del %Y"), 'utf-8');

$hora=date("h:i A");

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Disposition: filename=ventas.xls");
?>   
       <table  border="1">
         <tbody>
           <tr>
             <td bgcolor="#CCCCCC">Sucursal</td>
             <td bgcolor="#CCCCCC">Usuario</td>
             <td bgcolor="#CCCCCC">Total</td>
             <td bgcolor="#CCCCCC">Fecha</td>
           </tr>
		   <tr>
             <td> <? echo $sucur; ?></td>
             <td> <? echo $usu; ?></td>
             <td> <? echo $tot; ?></td>
             <td> <? echo $fech; ?></td>
           </tr>
		 </tbody> 
    </table>  
	 <table border="1">
		  <tr>
		   <td bgcolor="#CCCCCC">Cliente:<? echo $res['nombres']." ".$res['ap_paterno']." ".$res['ap_materno'];?></td>
		  </tr>
		 </table>
		 <table border="1">
		  <tr>
		   <td bgcolor="#CCCCCC">Producto</td>
		   <td bgcolor="#CCCCCC">Descripcion</td>
		   <td bgcolor="#CCCCCC">Precio</td>
		   <td bgcolor="#CCCCCC">Cantidad</td>
		   <td bgcolor="#CCCCCC">Efectivo</td>
		   <td bgcolor="#CCCCCC">Cambio</td>
		   <td bgcolor="#CCCCCC">Tipo De Venta</td>
		   <td bgcolor="#CCCCCC">Abono</td>
		  </tr>
		  <?
		   $consulta2="SELECT dv.*,(p.nombre)producto,p.descripcion,p.precio,v.abono,v.efectivo,v.cambio,(tv.nombre) as tventa 
		  from detalle_ventas dv 
		  join productos p on dv.id_producto=p.id_producto
		  join ventas v on dv.id_ventas=v.id_ventas
		  join tipo_ventas tv on v.id_tipo_ventas=tv.id_tipo_ventas
		  where dv.id_ventas='$id'";
$resultado2 = mysql_query($consulta2) or die("La consulta fallo: $consulta".mysql_error());
while($res2 = mysql_fetch_assoc($resultado2)){
		  ?>
		  <tr>
		    <td><? echo $res2['producto']; ?></td>
			<td><? echo $res2['descripcion']; ?></td>
			<td><? echo $res2['precio']; ?></td>
			<td><? echo $res2['cantidad']; ?></td>
			<td><? echo $res2['efectivo']; ?></td>
			<td><? echo $res2['cambio']; ?></td>
			<td><? echo $res2['tventa']; ?></td>
		    <td><? echo $res2['abono'];?></td>
		  </tr>	  
		  <? } ?>
		 </table>
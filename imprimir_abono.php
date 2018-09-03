<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
//include "SimpleImage.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$usuario=$idU;

$Cliente=$_POST['cli'];
$Sucursal=$_POST['sucur'];
$Vendedor=$_POST['vendedor'];
//$Pago=$_POST['pago'];
//$Total=$_POST['total'];
//$Efectivo=$_POST['efectivo'];
//$Cambio=$_POST['cambio'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tienda</title>
 <!--Import Google Icon Font-->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <!--Import materialize.css-->
 <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
 <!--Let browser know website is optimized for mobile-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body MARGINHEIGHT="0" MARGINWIDTH="0" TOPMARGIN="0" RIGHTMARGIN="0" BOTTOMMARGIN="0" LEFTMARGIN="0">
   <div class="row">
    <div class="col s3 m3 l3 xl3">
<table>
	  <td>
	    Bela "Providing Beauty"<br />
	    Sucursal: <? echo $Sucursal;?><br />
	    Vendedor: <? echo $Vendedor;?><br />
	    Cliente: <? echo $Cliente;?>
		</td>
	 </tbody>
</table>
<table>	 
	  <thead>
	   <th>producto</th>
	   <th>Cantidad</th>
	   <th>Total</th>
	   <th>Adeudo</th>
	   <th>Abono</th>
	  </thead>
	  <?
	  // if( $_POST['imp']=="Imprimir"){
	    $idproducto =$_POST['idproducto'];
		$nombre =$_POST['nombre'];
		$cantidad =$_POST['cantidad'];
		$total =$_POST['total'];
		$adeudo=$_POST['adeudo'];
		$id_ventas=$_POST['pro'];
		$count=0;
		  if(sizeof($idproducto)>0) //si no tiene productos
			{
			 	foreach($idproducto as $a)
				{
			      $query="SELECT p.*,v.id_ventas,v.abono FROM productos p 
				  join detalle_ventas dv on p.id_producto=dv.id_producto
				  join ventas v on dv.id_ventas=v.id_ventas
				  WHERE p.id_producto=$a
				  and v.id_ventas='$id_ventas[$count]'";
				  $result = mysql_query($query) or print("error $query".mysql_error());
			      while($res_marca = mysql_fetch_assoc($result)){
	  ?>
	  <tbody>
	   <td><? echo $res_marca['nombre']; ?></td>
	   <td><? echo $cantidad[$count]; ?></td>
	   <td><? echo $total[$count]; ?></td>
	   <td><? echo $adeudo[$count]; ?></td>
	   <td><? echo $res_marca['abono']; ?></td>
	  </tbody>
	  <?
	  $count++;
	} 
	 }
	  }
	//   }
	  ?>
</table>
<table>
     <tbody>
	  <td>
		"Gracias por Visitarnos"<br />
		</td>
	 </tbody>
</table>
    </div>
 </div>  
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>

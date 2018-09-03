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
$Pago=$_POST['pago'];
$Total=$_POST['total'];
$Efectivo=$_POST['efectivo'];
$Cambio=$_POST['cambio'];

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
<script>
function imprimir(){
if (window.print)
window.print();
else
alert("Disculpe, su navegador no soporta esta opción.");
}

function re(){
location.href = "http://bluewolf.com.mx/bela/cajap.php"
}
</script>
</head>

<body MARGINHEIGHT="0" MARGINWIDTH="0" TOPMARGIN="0" RIGHTMARGIN="0" BOTTOMMARGIN="0" LEFTMARGIN="0" onLoad="imprimir();">
   <div class="row">
    <div class="col s3 m3 l3 xl3">
<table>
	  <td>
	    Bela "Productos de Belleza"<br />
	    Sucursal: <? echo $Sucursal;?><br />
	    Vendedor: <? echo $Vendedor;?><br />
	    Cliente: <? echo $Cliente;?><br />
	    Tipo de Pago: <? echo $Pago;?>
		</td>
	 </tbody>
</table>
<table>	 
	  <thead>
      <th>producto</th>
	   <th>precio</th>
	   <th>Cantidad</th>
	   <th>Subtotal</th>
	  </thead>
	  <?
	 //  if( $_POST['venta']=="Venta"){
	    $idproducto =$_POST['idproducto'];
		$precio =$_POST['precio'];
		$cantidad =$_POST['cantidad_d'];
		$monto =$_POST['monto'];
		$count=0;
		  if(sizeof($idproducto)>0) //si no tiene productos
			{
			 	foreach($idproducto as $a)
				{
			      $query="SELECT * FROM productos 
				  
				  WHERE id_producto=$a";
				  $result = mysql_query($query) or print("error $query".mysql_error());
			      while($res_marca = mysql_fetch_assoc($result)){
	  ?>
	  <tbody>
      <td><? echo $res_marca['nombre']; ?></td>
	   <td><? echo $precio[$count]; ?></td>
	   <td><? echo $cantidad[$count]; ?></td>
	   <td><? echo $monto[$count]; ?></td>
	  </tbody>
	  <?
	  $count++;
	} 
	 }
	  }
	 //  }
	  ?>
</table>
<table>
	  <td>
	    Total: <? echo $Total;?><br />
	    Efectivo: <? echo $Efectivo;?><br />
	    Cambio: <? echo $Cambio;?><br />
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

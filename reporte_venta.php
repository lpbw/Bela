<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
 // 1admin 2 cliente

date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'es_ES.UTF-8');

$fecha=date('Y-m-d');
$hora=date('H:i:s');

if($idA=="1" || $idA=="2")
{
$usuario=$idU;
$idA=$idA;
$idSuc=$idSuc;


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

?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<title>Tienda</title>
 <!--Import Google Icon Font-->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <!--Import materialize.css-->
 <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <!--Let browser know website is optimized for mobile-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<script>
//suma las monedas
function sumaM(){
 document.form1.totalm.value=(document.form1.m20.value*20*1+document.form1.m10.value*10*1+document.form1.m5.value*5*1+document.form1.m2.value*2*1+document.form1.m1.value*1*1+document.form1.mp5.value*.5*1);
}
//fin suma monedas

//Suma los billetes
function sumaP(){
document.form1.totalb.value=(document.form1.b1000.value*1000*1+document.form1.b500.value*500*1+document.form1.b200.value*200*1+document.form1.b100.value*100*1+document.form1.b50.value*50*1+document.form1.b20.value*20*1)
}
//fin suma de billetes
</script>
</head>

<body class="black">
<div class="container"><!--contenedor-->
   <div class="row" id="modal1"><!--filas-->
   
   <!--navegador-->
	   <nav class="col s12 m12 l12 xl12 cyan darken-4">
	    <div class="nav-wrapper cyan darken-4">
	   <!--menu-->
	    <a class="brand-logo center">Venta</a>
		</div>
       </nav>
	<!--fin navegador-->
      <div class="col s12 m12 12 xl12">
	   <section>
	     <table>
		  <thead>
		   <th class="white-text">Cliente:<? echo $res['nombres']." ".$res['ap_paterno']." ".$res['ap_materno'];?></th>
		  </thead>
		 </table>
		 <table class="bordered white-text">
		  <thead>
		   <th>Producto</th>
		   <th>Descripcion</th>
		   <th>Precio</th>
		   <th>Cantidad</th>
		   <th>Efectivo</th>
		   <th>Cambio</th>
		   <th>Tipo De Venta</th>
		   <th>Abono</th>
		  </thead>
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
		  <tbody class="white-text">
		    <td><? echo $res2['producto']; ?></td>
			<td><? echo $res2['descripcion']; ?></td>
			<td><? echo $res2['precio']; ?></td>
			<td><? echo $res2['cantidad']; ?></td>
			<td><? echo $res2['efectivo']; ?></td>
			<td><? echo $res2['cambio']; ?></td>
			<td><? echo $res2['tventa']; ?></td>
		    <td><? echo $res2['abono'];?></td>
	
		  </tbody>	  
		  		<?
		  }
		  ?>
		 </table>
		  <a href="exportar_ventas.php?id=<? echo $id; ?>&suc=<? echo $sucur ?>&usu=<? echo $usu ?>&tot=<? echo $tot ?>&f=<? echo $fech ?>" class="red-text"><b>Exportar</b></a>
	   </section>
	  </div>
	    
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>
<? 
}else
{
echo"<script>window.location=\"login.php\"</script>";
}
?>
<?
session_start();
include "coneccion.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$usuario=$idU;
$id=$_GET['id'];//id del cliente
$vendedor=$_GET['ve'];//vendedor
$sucursal=$_GET['su'];//sucursal

$queryc = "SELECT * FROM clientes WHERE id_cliente='$id'";
$resultc = mysql_query($queryc) or print("<option value=\"ERROR\">".mysql_error()."</option>");
$res_cli = mysql_fetch_assoc($resultc)

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
 <!--Let browser know website is optimized for mobile-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <script>
 function borrar(id,nombre,foto){
        if(confirm('Deseas eliminar el producto '+nombre+'?')){
            var elem = document.createElement('input');
            elem.name='id';
            elem.value = id;
            elem.type = 'hidden';
            $("#form1").append(elem);
			
			var elem = document.createElement('input');
            elem.name='foto';
            elem.value = foto;
            elem.type = 'hidden';
            $("#form1").append(elem);
			
			
            $("#form1").attr('action','elimina_producto.php');
            $("#form1").submit();
        }
    }
function imprim()
{  	
            $("#form1").attr('action','imprimir_abono.php');
            $("#form1").submit();
}
</script>
</head>
<?
if( $_POST['abonar']=="Abonar")
{	
 $abono=$_POST['abono'];
 $idventa=$_POST['pro'];
 $total=$_POST['total'];
 $adeudo=$_POST['adeudo'];
 $count=0;
  if(sizeof($idventa)>0) //si no tiene productos
			{		
  foreach($idventa as $a){
 $consulta2="UPDATE ventas SET abono=$abono[$count],adeudo=adeudo-$abono[$count]
             WHERE id_ventas=$a";
 $resultado2 = mysql_query($consulta2) or die("Error en operacion2:$consulta2 " . mysql_error());
 
 $consulta3="INSERT INTO pagos (id_usuarios,id_venta,id_cliente,pago,fecha) values('$usuario','$a','$id','$abono[$count]',now())";
  $resultado3 = mysql_query($consulta3) or die("Error en operacion3:$consulta3 " . mysql_error());
 $count++;
  }
  echo"<script>alert(\"Abono Realizado!!\");</script>";

}else
 {
  echo"<script>alert(\"No ahi producto en apartado\");</script>";
 }
 }
?>
<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--navegador-->
	   <nav class="col s12 m12 l12 xl12 cyan darken-4">
	    <div class="nav-wrapper cyan darken-4">
	   <!--menu-->
	    <a class="brand-logo center">Apartado</a>
		<a class="right">Cliente:<? echo $res_cli['nombres']?></a>
		</div>
       </nav>
	<!--fin navegador-->
 
	
   <!--tabla-->
     <div class="col s12 xl12 white-text">
	 <form  id="form1" name="form1" method="post">
	     <table class="centered bordered white-text">
		    <thead>
			  <tr>
			    <th>Producto</th>
				<th>Precio</th>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Adeudo</th>
				<th>Abono</th>
			  </tr>
			</thead>
			<tbody>
	<? $query = "SELECT v.*,dv.id_producto,dv.cantidad,p.nombre,p.descripcion,p.precio,p.foto,p.codigo_barras,c.* FROM ventas v JOIN detalle_ventas dv ON v.id_ventas=dv.id_ventas
JOIN productos p ON dv.id_producto=p.id_producto
JOIN clientes c ON v.id_cliente=c.id_cliente
where v.id_cliente='$id'
and v.id_tipo_ventas=2
and v.adeudo>=1";
       $result = mysql_query($query) or die("La consulta fall&oacute;P1:$query " . mysql_error());
       while($res_prod = mysql_fetch_assoc($result))
	   {   
	?>		
          <tr>
            <td><? echo $res_prod['nombre']?><input name="nombre[]"  type="hidden" value="<? echo $res_prod['nombre']?>"></td>
            <td><? echo $res_prod['precio']?><input name="precio[]"  type="hidden" value="<? echo $res_prod['precio']?>"></td>
			<td><? echo $res_prod['descripcion']?><input name="descripcion[]" type="hidden" value="<? echo $res_prod['descripcion']?>"></td>
			<td><? echo $res_prod['cantidad']?><input name="cantidad[]"  type="hidden" value="<? echo $res_prod['cantidad']?>"/></td>
			<td id="total"><? echo $res_prod['total']?><input name="total[]"  type="hidden" value="<? echo $res_prod['total']?>"></td>
			<td id="adeudo"><? echo $res_prod['adeudo']?><input name="adeudo[]"  type="hidden" value="<? echo $res_prod['adeudo']?>"></td>
			<td class="col s5 m5 l5 xl5 offset-m3 offset=l3 offset-xl3"><input name="abono[]" type="number"   step="0.01"   class="validate" min="0" value="0"></td>
			<td><input name="pro[]" id="prov" type="hidden"    class="validate" value="<? echo $res_prod['id_ventas']?>">
			<input name="idproducto[]" id="idproducto" type="hidden"    class="validate" value="<? echo $res_prod['id_producto']?>">
			</td>
          </tr>
       
		 <?
		   }
		 ?>
		  </tbody>
		 </table>
		 	  <!--boton guardar-->
	 <div class="col s6 m6 l6 xl6 offset-l5 offset-xl5">		  
      <input class="btn" name="abonar" type="submit" id="abonar"  value="Abonar">
	  <input class="btn" name="imp" type="button" id="imp"  value="Imprimir" onclick="return imprim();" />
	 </div>
	 <!--fin boton guardar-->
	 <input name="sucur" id="sucur" value="<? echo $sucursal;?>" type="hidden" /><!--vendedor para ticket-->
	  <input name="vendedor" id="vendedor" value="<? echo $vendedor;?>" type="hidden" /><!--vendedor para ticket-->
	  <input name="cli" id="cli" value="<? echo $res_cli['nombres']?>" type="hidden" /><!--cliente para ticket-->
	</form> 
	<!--fin tabla-->
		 
	 </div>
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>

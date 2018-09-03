<?
session_start();
include "coneccion.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA']; // 1-admin 2-supervisor
$idSuc=$_SESSION['idSuc'];


if($idA=="1" || $idA=="2" || $idA=="3")
{
$usuario=$idU;
$idA=$idA;
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<title></title><meta name="DESCRIPTION" content="">
<meta name="KEYWORDS" content="">
<meta name="GENERATOR" content="Parallels Plesk Sitebuilder 4.5.0">
<link href="css/styles.css?template=xeug-03&colorScheme=green&header=headers2&button=buttons1" rel="stylesheet" type="text/css">
 <!--Let browser know website is optimized for mobile-->
<!--link rel="stylesheet" href="thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery-1[1].3.2.js"></script> 
<script type="text/javascript" src="thickbox.js"></script-->
<link rel="stylesheet" href="colorbox.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<style type="text/css">
<!--
.style2 {font-size: 36px}
.style5 {color: #FFFFFF; font-weight: bold; font-size: 12px;}
.style6 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>

</head>
<BODY MARGINHEIGHT="0" MARGINWIDTH="0" TOPMARGIN="0" RIGHTMARGIN="0" BOTTOMMARGIN="0" LEFTMARGIN="0" onLoad="document.header2.barras.focus();">
<table width="516" border="0" align="center" cellpadding="2" cellspacing="4" bgcolor="#FFFFFF">
  <tr>
    <td width="583" height="26" background="images/barra_titulos_chica.jpg" class="sm" style="font-size: 20px;">Leer producto</td>
    <td width="197" background="images/barra_titulos_chica.jpg" class="sm" style="font-size: 20px;">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" class="sm"><form action="" method="post" id="header2" name="header2">
      <table width="100%" border="0" cellpadding="0">
        <tr>
          <td width="35%"  scope="row"><table width="100%" border="0" cellpadding="0">
            <tr>
              <td width="9%" bgcolor="#CCCCCC"><span class="style5">Cantidad</span></td>
              <td width="48%" bgcolor="#CCCCCC"><span class="style5">Codigo
                <input name="id" type="hidden" id="id" value="<%=suc%>">
              </span></td>
              <td width="15%" bgcolor="#CCCCCC">&nbsp;</td>
              <td colspan="3" bgcolor="#CCCCCC">&nbsp;</td>
            </tr>
            <tr>
              <td><div  align="center">
                <input name="cantidad" type="text" id="cantidad" value="1" size="4" maxlength="3">
              </div></td>
              <td><input name="barras" type="text" id="barras" size="30" maxlength="30"></td>
              <td>&nbsp;</td>
              <td colspan="3"><span class="style2">
                <input name="agregar" type="submit" id="agregar"  value=".">
              </span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td id="descripcion2" ></td>
              <td id="inv2" ></td>
              <td width="7%" ><div align="right">$</div></td>
              <td width="7%"  id="precio2"><div align="left"></div></td>
              <td width="14%" >&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>

<script>
//funcion inrow llena tabla
function insRow(cadena)
{
if(cadena!="0")
{
elementos= cadena.split("|");
var descri="";

var x=document.getElementById('myTable').insertRow(0);
var y=x.insertCell(0);//cantidad
var z=x.insertCell(1);//nombre
var z1=x.insertCell(2);//precio
var z2=x.insertCell(3);//subtotal
var z3=x.insertCell(4);//eliminar

var m=document.getElementById('monto')
//var monto=m.innerHTML;
var monto=document.header.total.value;
var cantidad=document.header.cantidad.value;
var sub=0;
var precio=0;

	sub=cantidad*1*elementos[2]*1;
	precio=elementos[2];

monto=monto*1+sub*1;

//m.innerHTML=monto;
document.header.total.value=monto;
x.id="p"+elementos[0];
y.innerHTML="<center>"+document.header.cantidad.value+"</center>";
y.className="style6";
z.innerHTML=elementos[1];
z.className="style6";
z1.innerHTML="$"+precio;
z1.className="style6";
z2.innerHTML="$"+sub;
z2.className="style6";
z3.innerHTML="<input name=\"precio[]\"  type=\"hidden\" value=\""+precio+"\" /><input name=\"mayoreo[]\"  type=\"hidden\" value=\"0\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\""+elementos[0]+"\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\""+document.header.cantidad.value+"\" /><input name=\"monto[]\"  type=\"hidden\" value=\""+sub+"\" /><input name=\"descripcion[]\"  type=\"hidden\" value=\""+descri+"\" /><img src=\"images/close.gif\" alt=\"Eliminar Producto\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this,"+sub+")\"/>";
//document.header.may.checked=false;
document.header.cuantos.value=document.header.cuantos.value+1;
document.header.desc.value=""	;
document.header.precio2.value=""	;
}
}
//fin funcion inrow

//funcion para mostrar precio,descripcion y codigo
 function showDes(cadena)
{	
if(cadena!="0")
{
elementos= cadena.split("|");

	    
	     var precio=document.getElementById('precio2')
		 precio.innerHTML=elementos[2];//muestra precio en label con id=precio
		 var desc=document.getElementById('descripcion2')
		 desc.innerHTML=elementos[1];//muestra descripcion en label con id=descripcion
		// document.getElementsByName('codigo')[0].value=elementos[4];//muestra codigo de barras en input con id=codigo	
	
 }
}
//fin funcion ShowDes

<?

if( $_POST['agregar']==".")
{	
	$barras= $_POST['barras'];
	
	$tipo="";
	$dato="";
				
	$query = "SELECT * FROM productos where codigo_barras='$barras' and precio!='0'";
	$result = mysql_query($query) or print("error $query".mysql_error());
	if($res_marca = mysql_fetch_assoc($result)){
		$dato=$res_marca['id_producto']."|".$res_marca['nombre']."|".$res_marca['precio']."|".$res_marca['descripcion']."|".$res_marca['cantidad'];		
				
		echo"showDes('$dato');parent.insRow('$dato');";
	}
	else
	{
		echo"alert(\"No se encontro producto\");";
	}
			
	
}

?>



function showVen(cadena)
{
	if(cadena!="0")
	{
	elementos= cadena.split("|");
	
	
	
	var m=document.getElementById('nom')
	var n=document.getElementById('dire')
	var i=document.getElementById('tel')
	var o=document.getElementById('saldo')
	
	m.innerHTML=elementos[1];
	n.innerHTML=elementos[2];
	i.innerHTML=elementos[3];
	o.innerHTML=elementos[4];
	document.header.idcliente.value=elementos[0];
	}
}
function valida()
{
	var ss=document.header.clientes.value.split("|");
	document.header.idcliente.value=ss[0];
	if(document.header.efectivo.value=="")
	{
		 alert("Capture efectivo");
		 document.header.efectivo.focus();
	 	return false;
	}else
	{
	if(document.header.credito.checked && ss[0]=="0")
	{
	 alert("Seleccione un cliente para venta a credito");
	 return false;
	}
	if(!document.header.idproducto)
	{
	 alert("Seleccione al menos un producto");
	 return false;
	}
	}
	document.header.venta.disabled = true;
	document.header.venta1.value="Venta";
	document.header.submit();
}/*
$(document).ready(function() {  
    $.fn.colorbox({ iframe:true, width:"500", height:"300", href:"midirectorio/index.html", open:true });  
});*/
function abrir()
{
var ir=document.header.idcliente.value;
$(document).ready(function() {  
    $.fn.colorbox({ iframe:true, width:"600", height:"500", href:"abono.jsp?idcli="+ir+"", open:true });  
});
}
function verExistencia()
{

var ir=document.header.lista_productos.value;
elementos= ir.split("|");
$(document).ready(function() {  
    $.fn.colorbox({ iframe:true, width:"600", height:"500", href:"verExi.jsp?id="+elementos[0]+"", open:true });  
});
/*
var ir=document.header.idcliente.value;
$.colorbox({iframe:true,href:"abono.jsp?idcli="+ir+"",width:"600", height:"353",transition:"fade", scrolling:false, opacity:0.5, open:true});
*/}

$('#header').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});
</script>
</BODY>

</HTML>
<? 
}else
{
echo"<script>window.location=\"index.php\"</script>";
}
?>

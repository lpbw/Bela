<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];	

$usuario=$idU;
$idA=$idA;
$idSuc=$idSuc;

$consulta_suc  = "select * from sucursales where id_sucursal=$idSuc";
$resultado_suc = mysql_query($consulta_suc) or die("La consulta fall&oacute;P1:$consulta_suc " . mysql_error());
$res_suc=mysql_fetch_assoc($resultado_suc);

$consulta_p  = "select * from productos where mas=1";
$resultado_p = mysql_query($consulta_p) or die("La consulta fall&oacute;P1:$consulta_p " . mysql_error());
//$res_p=mysql_fetch_assoc($resultado_p);
//$pref=$res_p['pref'];

$consulta_us = "select * from usuarios where id_usuarios=$idU";
$resultado_us = mysql_query($consulta_us) or die("La consulta fall&oacute;P1:$consulta_us " . mysql_error());
$res_us=mysql_fetch_assoc($resultado_us);
if( $_POST['venta']=="Venta")
{
 $cliente=$_POST['idcliente'];
 $id_tipo_venta =$_POST['id_tventa'];
 $precio =$_POST['precio'];
 $total=$_POST['total'];
 $efectivo=$_POST['efectivo'];
 $cambio=$_POST['cambio'];
 $idproducto =$_POST['idproducto'];
 $cantidad =$_POST['cantidad_d'] ;
 $count=0;
   
			if(sizeof($idproducto)>0) //si no tiene productos
			{		
				
				$tipo="";
				$max_venta="";
				$consulta  = "insert into ventas (id_usuarios,id_cliente,id_tipo_ventas,abono,fecha,total,efectivo,cambio,adeudo) values                               ($usuario,$cliente,$id_tipo_venta,0,now(),$total,$efectivo,$cambio,$total)";
				$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
				$id_venta=mysql_insert_id();
				
				foreach($idproducto as $a)
				{
					
					$consulta  = "insert into detalle_ventas (id_ventas,id_producto,cantidad) values($id_venta,$a, '$cantidad[$count]')";
				    $resultado = mysql_query($consulta) or die("Error en operacion1: $consulta " . mysql_error());
					
					
					/*$consulta2  = "update inventario set cantidad=cantidad-$cantidad[$count] 
					               where id_producto=$a
								   AND id_sucursal=$idSuc";
					$resultado2 = mysql_query($consulta2) or die("Error en operacion2:$consulta2 " . mysql_error());*/
					$count++;
				}
				echo"<script>alert(\"Compra realizada con Exito!!\");</script>";
			
}else
 {
  echo"<script>alert(\"Venta debe tener al menos un producto\");</script>";
 }
}
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
 <link href="css/styles.css?template=xeug-03&colorScheme=green&header=headers2&button=buttons1" rel="stylesheet" type="text/css">
 <!--Let browser know website is optimized for mobile-->
 <link rel="stylesheet" href="colorbox.css" />
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>


<link href='https://fonts.googleapis.com/css?family=Roboto:500,400,300,100&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<!--<script src="https://code.jquery.com/jquery-2.1.4.js"></script>-->

<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style>
.centrar{text-align:center;}



::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}
::-webkit-scrollbar-track {
    background: transparent;
}
::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0, 0.2);
    border-radius: 1px;
}
::-webkit-scrollbar-thumb:hover {
    background-color: rgba(0,0,0, 0.3);
}

*{box-sizing:border-box; -webkit-box-sizing:border-box;}
html, body{height:100%; margin:0;}

body{
  font: 16px/24px Roboto, sans-serif;
  background: #fafafa;
}


/*
MAD-SELECT by Roko CB
*/
.mad-select .material-icons{
  vertical-align: middle;
}
.mad-select{
  position:relative;
  display:inline-block;
  vertical-align:middle;
  /*border-bottom: 1px solid rgba(0,0,0,0.12);*/
  padding-right: 8px;
	border:none;
}
.mad-select ul {
  list-style: none;
  display:inline-block;
  margin:0; padding:0;
}
.mad-select li{
  vertical-align: middle;
  white-space: nowrap;
  height:24px;
  line-height:24px;
  display: none;
  padding: 8px 16px;
  margin:0;
  box-sizing: initial;
}
.mad-select > ul:first-of-type{
   max-width:120px; /* COMMENT FOR AUTO WIDTH */
}
.mad-select > ul:first-of-type li.selected{
  display: inline-block;
  height: 24px;
  max-width: calc(100% - 24px);
  overflow: hidden;
  text-overflow: ellipsis;
}
.mad-select i.material-icons{
  opacity: 0.5;
  margin:0;
  padding:0;
}
/*jQ*/
.mad-select ul.mad-select-drop{
  position: absolute;
  z-index: 9999;
  visibility: hidden; opacity:0;
  background: #fff;
  box-shadow: 0 1px 4px rgba(0,0,0,0.2);
  top: 0;
  left: 0;
  transition: 0.24s;
  max-height: 0;
  overflow: hidden;
  overflow-y: auto;
}
.mad-select ul.mad-select-drop.show{
  visibility: visible; opacity: 1;
  max-height: 160px; /* COMMENT IF YOU DON?T NEED MAX HEIGHT */
}
.mad-select ul.mad-select-drop li{
  display: block;
  transition: background 0.24s;
  cursor: pointer;
}
.mad-select ul.mad-select-drop li.selected{
  background: rgba(0,0,0,0.07);
}
.mad-select ul.mad-select-drop li:hover{
  background: rgba(0,0,0,0.04);
}
</style>
 <script>
 //funcion de prefijos
 function insRow2(id)
 {
 	//alert('id= '+id);
	 if( $('#mayoreo').prop('checked') ) {
		 var precio=parseInt(document.getElementById('m'+id).value);
	}
	else
	{
		  var precio=parseInt(document.getElementById('p'+id).value);
	}
 	
	var des=document.getElementById('n'+id).value;
	//alert('precio= '+precio);
	//alert('descripcion= '+des);
	var can2=parseInt(document.getElementById('cantidad').value);
	//alert('cantidad= '+can2);
	var subt=can2*precio;
	//alert('subtotal= '+subt);
	var monto=document.header.total.value;
	var x=document.getElementById('myTable').insertRow(0);
	var y=x.insertCell(0);
	var z=x.insertCell(1);
	var z1=x.insertCell(2);
	var z2=x.insertCell(3);
	var z3=x.insertCell(4);
	
document.header.total.value=monto;
monto=monto*1+subt*1;
document.header.total.value=monto;
x.id="p"+id;
y.innerHTML="<center>"+can2+"</center>";
y.className="style6 white-text";
z.innerHTML="<center>"+des+"</center>";
z.className="style6 white-text";
z1.innerHTML="$"+precio;
z1.className="style6 white-text";
z2.innerHTML="$"+subt;
z2.className="style6 white-text";
z3.innerHTML="<input name=\"precio[]\"  type=\"hidden\" value=\""+precio+"\" /><input name=\"mayoreo[]\"  type=\"hidden\" value=\"0\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\""+id+"\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\""+can2+"\" /><input name=\"monto[]\"  type=\"hidden\" value=\""+subt+"\" /><input name=\"descripcion[]\"  type=\"hidden\" value=\""+des+"\" /><img src=\"images/close.gif\" alt=\"Eliminar Producto\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this,"+subt+")\"/>";
document.header.cantidad.value="1";
//document.header.desc.value=""	;
$('#mayoreo').prop('checked',false);
document.getElementById('cant').value=can-1;


 }
 
function hacer_click()
{ 
 var idtventa=document.getElementById('id_tventa');
  if(idtventa.value!="2"){
   var t=document.getElementById('total');
   if(t.value!="0"){
    var e=document.getElementById('efectivo');
    if(e.value!="0"){
     var t=document.getElementById('total');
     var e=document.getElementById('efectivo');
     var c=document.getElementById('cambio');
     //alert("total"+t.value+"efectivo"+e.value+"cambio"+(e.value-t.value));
     document.header.cambio.value=(e.value-t.value);
    }else{
	   alert("Agrege el efectivo recibido");
	   document.header.efectivo.focus();
	   document.header.cambio.value=0;
	}
  }else{
    alert("Seleccione almenos un producto");
	document.header.total.focus();
	document.header.cambio.value=0;
  }
 }else{
  //el campo de cambio deve estar vacio
   document.header.cambio.value=0;
  }
}



//funcion para iframe
$(document).ready(function(){
		$(".iframe").colorbox({iframe:true,width:"550", height:"300",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe2").colorbox({iframe:true,width:"550", height:"680",transition:"fade", scrolling:true, opacity:0.1});
		$(".iframe3").colorbox({iframe:true,width:"800", height:"600",transition:"fade", scrolling:true, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
	
function cerrarV()
{

$.colorbox.close();

}
function deleteRow(r,quita)
{
var i=r.parentNode.parentNode.rowIndex;
document.getElementById('myTable').deleteRow(i);
var m=document.getElementById('monto');
var monto=document.header.total.value;

var can=document.getElementById('cant').value;
document.header.cant.value=parseInt(can)+1;
var can=document.getElementById('cant').value;


monto=monto*1-quita*1;
document.header.total.value=monto;
document.header.cuantos.value=document.header.cuantos.value-1;
}
//funcion inrow llena tabla
function insRow(cadena)
{


if(cadena!="")
{
document.getElementById('agregar').disabled=false;
elementos= cadena.split("|");
var descri="";
//if(can.value!=0){
var can=parseInt(document.getElementById('cant').value);
document.getElementById('cant').value=can;
var can2=parseInt(document.getElementById('cantidad').value);

//if(can<can2){--------------------------------------------------------
//alert('La cantidad que desea agregar no esta disponible en stock'); agregarlo despues
//}--------------------------------------------------------------------

var x=document.getElementById('myTable').insertRow(0);
var y=x.insertCell(0);
var z=x.insertCell(1);
var z1=x.insertCell(2);
var z2=x.insertCell(3);
var z3=x.insertCell(4);
var m=document.getElementById('monto');
//var monto=m.innerHTML;
var monto=document.header.total.value;
var cantidad=document.header.cantidad.value;
var sub=0;
var precio=0;
	
	if( $('#mayoreo').prop('checked') ) {
	precio=elementos[8];
	sub=cantidad*1*elementos[8]*1;
	}
	else
	{
	precio=elementos[2];
	sub=cantidad*1*elementos[2]*1;
	}
monto=monto*1+sub*1;

//m.innerHTML=monto;
document.header.total.value=monto;
x.id="p"+elementos[0];
y.innerHTML="<center>"+document.header.cantidad.value+"</center>";
y.className="style6 white-text";
z.innerHTML="<center>"+elementos[1]+"</center>";
z.className="style6 white-text";
z1.innerHTML="$"+precio;
z1.className="style6 white-text";
z2.innerHTML="$"+sub;
z2.className="style6 white-text";
z3.innerHTML="<input name=\"precio[]\"  type=\"hidden\" value=\""+precio+"\" /><input name=\"mayoreo[]\"  type=\"hidden\" value=\"0\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\""+elementos[0]+"\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\""+document.header.cantidad.value+"\" /><input name=\"monto[]\"  type=\"hidden\" value=\""+sub+"\" /><input name=\"descripcion[]\"  type=\"hidden\" value=\""+descri+"\" /><img src=\"images/close.gif\" alt=\"Eliminar Producto\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this,"+sub+")\"/>";

//document.header.desc.value=""	;
$('#mayoreo').prop('checked',false);
var cad=document.header.lista_productos.value;
showDes(cad);
document.getElementById('cant').value=can-1;
document.header.cuantos.value=parseInt(document.header.cuantos.value)+1;
document.header.cantidad.value=1;

  }
  else
  {
  document.getElementById('agregar').disabled=true;
  alert('Seleccione un producto');
  }
 }
//fin funcion inrow


//funcion para mostrar precio,descripcion y codigo
function showDes(cadena)
{	
if(cadena!="0")
{
elementos= cadena.split("|");
if(elementos[0]!="")
	{    
	    document.getElementById('cant').value=elementos[4];
		var cant=parseInt(document.getElementById('cant').value);
		//document.header.cant.value=elementos[4];
		var ma=elementos[6];
		var mi=parseInt(elementos[7]);
		
	//  if(cant!=0){ agregar	
	     var precio=document.getElementById('precio');
		 if( $('#mayoreo').prop('checked') ) {
			precio.innerHTML=elementos[8];//muestra precio de mayoreo en label con id=precio
		 }
		 else
		 {
		  precio.innerHTML=elementos[2];//muestra precio en label con id=precio
		 }
		 var desc=document.getElementById('descripcion');
		 desc.innerHTML=elementos[1];//muestra descripcion en label con id=descripcion
		 //document.getElementsByName('codigo')[0].value=elementos[4];//muestra codigo de barras en input con id=codigo
		 document.getElementById('agregar').disabled=false;
		// } agregar
		// else agregar
		// { agregar
		 // document.getElementById('agregar').disabled=true; agregar
		 //} agregar
	}else
	{	
		
		document.header.precio.style.visibility="visible";
	}
	}
	else
	{
	
		 var desc=document.getElementById('descripcion');
		 desc.innerHTML="";
		  var precio=document.getElementById('precio');
		  precio.innerHTML="";
		  document.getElementById('agregar').disabled=true;
	}
  
}
//fin funcion ShowDes

function showtv(cadena)
{
	if(cadena!="0")
	{
	elementos= cadena.split("|");
	document.header.id_tventa.value=elementos[0];
	document.header.pago.value=elementos[1];
	}
}

//funcion select cliente
function showVen(cadena)
{
	if(cadena!="0")
	{
	elementos= cadena.split("|");
	
	
	
	var cliente=document.getElementById('cliente');
	var cli=document.getElementById('cli');
	cliente.innerHTML=elementos[1];
	document.header.cli.value=elementos[1];
	//n.innerHTML=elementos[2];
	//i.innerHTML=elementos[3];
	//o.innerHTML=elementos[4];
	document.header.idcliente.value=elementos[0];
	}
}
//fin funcion select cliente

//funcion valida en botor cobrar
 function valida(e)
{
 var ss=document.header.lista_cliente.value.split("|");
 document.header.idcliente.value=ss[0]; 
 var idtventa=document.getElementById('id_tventa');
  if(idtventa.value!="2"){
     if(document.header.efectivo.value=="0"){
	   alert("Capture efectivo");
	   document.header.efectivo.focus();
	   return false;
	 }else{}
  }else{
   //el efectivo deve ser 0
    if(document.header.idcliente.value=="1")
	{
	 alert("seleccione un cliente");
	 return false;
	}else{
      document.header.efectivo.value=0;
	  }
  }  
	
	//alert(document.header.idcliente.value+document.header.efectivo.value+document.header.cuantos.value)
	if(document.header.cuantos.value==0)
	{
	 alert("Seleccione al menos un producto");
	 e.preventDefault();
	 return false;
	}
	
}
//fin funcion valida


/*function cambiarurl() {  
       var ir=document.header.idcliente.value;
        //URLURL = URL.replace(/=[0-9][0-9]/, "=" + value);  
        document.getElementById("cli").href = "producto_apartado.php?id="+ir;  
    }  
	*/
function abrir2()
{
var ir=document.header.idcliente.value;
var ven=document.header.vendedor.value;
var su=document.header.sucur.value;
$.colorbox({iframe:true,href:"producto_apartado.php?id="+ir+"&ve="+ven+"&su="+su,width:"800", height:"650",transition:"fade", scrolling:true, opacity:0.7});
	
}	

$('#header').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});

function imprim()
{  	
            $("#header").attr('action','imprimir_venta.php');
            $("#header").submit();
}

function precio_mayoreo()
{
	var cadena=document.header.lista_productos.value;
	
	showDes(cadena);
}

window.onload=function() {
			var cadena=document.header.lista_productos.value;
	
	showDes(cadena);
		}
		
		
		
		
		jQuery(function($){
  // /////
  // MAD-SELECT
  var madSelectHover = 0;
  $(".mad-select").each(function() {
    var $input = $(this).find("input"),
        $ul = $(this).find("> ul"),
        $ulDrop =  $ul.clone().addClass("mad-select-drop");
    $(this)
      .append('<i class="material-icons">arrow_drop_down</i>', $ulDrop)
      .on({
      hover : function() { madSelectHover ^= 1; },
      click : function() { $ulDrop.toggleClass("show"); }
    });
    // PRESELECT
    $ul.add($ulDrop).find("li[data-value='"+ $input.val() +"']").addClass("selected");
    // MAKE SELECTED
    $ulDrop.on("click", "li", function(evt) {
      evt.stopPropagation();
      $input.val($(this).data("value")); // Update hidden input value
      $ul.find("li").eq($(this).index()).add(this).addClass("selected")
        .siblings("li").removeClass("selected");
    });
    // UPDATE LIST SCROLL POSITION
    $ul.on("click", function() {
      var liTop = $ulDrop.find("li.selected").position().top;
      $ulDrop.scrollTop(liTop + $ulDrop[0].scrollTop);
    });
  });
  // CLOSE ALL OPNED
  $(document).on("mouseup", function(){
    if(!madSelectHover) $(".mad-select-drop").removeClass("show");
  });
});

function Estilo()
{
	$('#efectivo').val('');
}
</script>
</head>

<body class="black">
 <div class="container"><!--contenedor-->
  <div class="row"><!--filas-->
  
   <!--navegador-->
	 <div class="col s12 m12 l12 xl12 cyan darken-4">
	   <nav class="col s12 m12 l12 xl12 cyan darken-4">
	   <!--menu-->
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
         <a href="cambia_pass.php" class="right">Cambiar mi password</a>
		 <ul class="left hide-on-med-and-down">
		 <? if($idA==1 || $idA==2)
		  {
		 ?>
		  <li><a href="principal.php"><i class="fa fa-arrow-left fa-2x"></i></a></li>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Administracion
		  <i class="material-icons right">arrow_drop_down</i>
		  </a>
		  </li>
		  <?
		  }
		  ?>
		  <li><a href="corte.php"><i class="fa fa-money"></i>Corte</a></li>
          <li><a href="logout.php"><i class="fa fa-sign-out"></i>Salir</a></li>
         </ul>
		 
		 <!--lista dropdwon-->
		 <ul id="dropdown1" class="dropdown-content">
          <li><a href="producto.php">Productos</a></li>
		  <li class="divider"></li>
          <li><a href="usuarios.php">Usuarios</a></li>
          <li class="divider"></li>
		  <li><a href="inventario.php">Inventario</a></li>
          <li class="divider"></li>
		  <li><a href="proveedores.php">Proveedores</a></li>
          <li class="divider"></li>
          <li><a href="principal.php">Administraci�n</a></li>
         </ul>
        <!--fin lista dropdown-->
       </nav>
     </div>
	<!--fin navegador-->
	
    <!--encabezado-->
    <header>
      <div class="col s12 m12 x12 xl12 cyan darken-4">
	  <? $ss=0; while($res_p = mysql_fetch_assoc($resultado_p)){$ss++?>
	  	<div class="col s1 m1 chip white-text pink darken-4 centrar" id="<? echo "pref".$ss; ?>" onClick="insRow2('<? echo $ss;?>')">
			<? echo $res_p['descripcion'];?>
			<input type="hidden" id="idpref<? echo $ss; ?>" name="idpref<? echo $ss; ?>" value="<? echo $ss;?>" />
			<input type="hidden" id="p<? echo $ss; ?>" name="p<? echo $ss;?>" value="<? echo $res_p['precio'];?>" />
			<input type="hidden" id="m<? echo $ss; ?>" name="m<? echo $ss;?>" value="<? echo $res_p['mayoreo'];?>" />
			<input type="hidden" id="d<? echo $ss; ?>" name="d<? echo $ss;?>" value="<? echo $res_p['descripcion'];?>" />
			<input type="hidden" id="n<? echo $ss; ?>" name="n<? echo $ss;?>" value="<? echo $res_p['nombre'];?>" />
		</div>
		<? } ?>
	  </div>
    </header>
	<!--fin encabezado-->
	
	<nav>
		<div class="col s12 m12 x12 xl12 cyan darken-4">
			<div class="col s3 m3 l3 xl3 white-text">
				Sucursal: <? echo $res_suc['nombre'];?>
			</div>
			<div class="col s3 m3 l3 xl3 white-text">
				Vendedor: <? echo $res_us['nombre'];?><br>
				<iframe src="sesionActiva.php" width="200" height="25" scrolling="no" style="display:none"></iframe>
			</div>
			<div class="col s3 m3 l3 xl3 white-text">
			<a href="cajap.php" target="_blank">Nueva Caja</a><a href="http://bluewolf.com.mx/bela/cajap.php" target="_blank" class="fa fa-window-restore"></a>
			</div>
			<div class="col s3 m3 l3 xl3 white-text">
				<input class="filled-in" type="checkbox" name="mayoreo" id="mayoreo" onClick="precio_mayoreo()"/><label for="mayoreo" style="color:#FFFFFF; margin-top:15px;">Mayoreo</label>
			</div>
		</div> 
	</nav>
	<!--seccion-->
	<section>
	  <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="header" name="header" method="post" enctype="multipart/form-data">
	   
	   <div class="row"><!--fila de seleccion del producto-->
		<div><!--seleccion del producto-->	  
		  <div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
	       Cantidad
          </div>
          <div class="col s4 m4 l4 xl4 white-text pink darken-4 centrar">
	       Productos
          </div>
          <div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
	       Descripcion
          </div>
          <div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
	       Precios
          </div>
          <div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
	       Codigo Barras
          </div>
		  <div class="input-field col s2 m2 l2 xl2 white-text centrar">
	       <input name="cantidad" type="number" id="cantidad" value="1" size="4" maxlength="3" min="1" class="validate centrar" required/>
          </div>
          <div class="input-field col s4 m4 l4 xl4 white-text " >
            <select class="mad-select cyan darken-4" name="lista_productos" id="lista_productos" onChange="showDes(lista_productos.value)">
              <option value="0" class="centrar">---- Seleccione Producto -----</option>
              <? $query = "SELECT 
			              inv.id_inventario
                         ,inv.id_sucursal
                         ,inv.id_producto
                         ,inv.cantidad
                         ,inv.minimo
                         ,inv.maximo
                         ,pro.id_proveedor
                         ,pro.id_tipo_producto
                         ,pro.nombre
                         ,pro.descripcion
                         ,pro.precio
						 ,pro.mayoreo
						 ,pro.pref as prefijo
                         ,pro.foto
                         ,pro.codigo_barras
                         ,pro.costo
                         FROM inventario inv 
                         JOIN productos pro ON inv.id_producto=pro.id_producto 
						 WHERE inv.id_sucursal=$idSuc
						 ORDER BY pro.pref";//AND inv.cantidad>=1 ponerlo cuando el inventario este bien
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_prod = mysql_fetch_assoc($result)){?>
              <option  value="<? echo $res_prod['id_producto']//0?>
		    |<? echo $res_prod['nombre']//1?>
		    |<? echo $res_prod['precio']//2?>
		    |<? echo $res_prod['descripcion']//3?>
			|<? echo $res_prod['cantidad']//4?>
			|<? echo $res_prod['id_inventario']//5?>
			|<? echo $res_prod['maximo']//6?>
			|<? echo $res_prod['minimo']//7?>
			|<? echo $res_prod['mayoreo']//8?>
		    |0"><? echo $res_prod['prefijo']." | ".$res_prod['nombre']?> </option>
              <?
               }
             ?>
            </select>
          
          </div>
					 <input name="cant" type="hidden" id="cant" value="0"/> 
		  <div class="input-field col s2 m2 l2 xl2 white-text">
           <label id="descripcion" class="white-text"></label>
          </div>
          <div class="input-field col s2 m2 l2 xl2 white-text">
	       <i class="fa fa-usd prefix white-text"></i>
           <label id="precio" name="precio" class="white-text">0</label>
          </div>
		  <div class="input-field col s2 m2 l2 xl2 white-text">
		   <a href="captura.php" class="iframe">
		   <i class="fa fa-barcode fa-3x"></i>
		   </a>
          </div>
          <div class="input-field col s2 offset-s4 xl2 offset-xl3">
           <input class="btn pink darken-4" name="agregar" type="button" id="agregar" onClick="insRow(lista_productos.value)" value="Agregar">
          </div>
   
	    </div><!--fin seleccion del producto-->
	  </div><!--fin fila de seleccion del producto-->
	  	
	  <div class="row"><!--fila productos--> 	
		<div class="col s6 m6 l6 xl6">
		 <article>
		   <table width="50%" border="0" cellpadding="0" >
            <tr>
              <td width="5%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Cant</div></td>
              <td width="25%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Descripcion</div></td>
              <td width="6%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Precio</div></td>
              <td width="6%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Subtotal</div></td>
              <td width="8%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center"></div></td>
            </tr>
		   </table>
		   <table width="50%" border="0" cellpadding="0" id="myTable">
            <tr>
              <td width="5%" class="style6"><div align="center"></div></td>
              <td width="25%" class="style6">&nbsp;</td>
              <td width="6%" class="style6">&nbsp;</td>
              <td width="6%" class="style6">&nbsp;</td>
              <td width="8%"><div align="center"></div></td>
            </tr>
           </table>
		 </article>
		</div>
	  
	    <div class="col s6 m6 l6 xl6 cyan darken-4">
		 <article>
		  <div class="col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text pink darken-4">
	       <label class="white-text">Cliente</label>
          </div>
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text">
	       <select class="mad-select cyan darken-4" name="lista_cliente" id="lista_cliente" onChange="showVen(this.value)">
		    <? 
			  $queryc2 = "SELECT id_cliente,nombres FROM clientes WHERE id_cliente=1";
              $resultc2 = mysql_query($queryc2) or print("<option value=\"ERROR\">".mysql_error()."</option>");
              while($res_cli2 = mysql_fetch_assoc($resultc2)){?>
           <option value="<? echo $res_cli2['id_cliente']?>|<? echo $res_cli2['nombres']?>"  selected><? echo $res_cli2['nombres']?></option>
		    <? }?>
			<? 
			  $queryc = "SELECT * FROM clientes 
			             WHERE id_cliente>=2
			             order by nombres";
              $resultc = mysql_query($queryc) or print("<option value=\"ERROR\">".mysql_error()."</option>");
              while($res_cli = mysql_fetch_assoc($resultc)){?>
               <option  value="<? echo $res_cli['id_cliente']?>|<? echo $res_cli['nombres']?>|<? echo $res_cli['ap_paterno']?>|<? echo $res_cli['ap_materno']?>|<? echo $res_cli['calle']?>|0"><? echo $res_cli['nombres']." ".$res_cli['ap_paterno']." ".$res_cli['ap_materno']?></option>
            <?
              }
            ?>
           </select>
	       <input name="idcliente" type="hidden" id="idcliente" value="1"/> 
          </div>
		  <div class="col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text pink darken-4">
	       <label class="white-text">Tipo De Venta</label>
          </div>
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text left">
	       <select class="mad-select cyan darken-4" name="lista_tipo_ventas" id="lista_tipo_ventas" onChange="showtv(this.value)">
		   <? 
			  $querytv2 = "SELECT * FROM tipo_ventas WHERE id_tipo_ventas=1";
              $resultv2 = mysql_query($querytv2) or print("<option value=\"ERROR\">".mysql_error()."</option>");
              while($res_tv2 = mysql_fetch_assoc($resultv2)){?>
           <option value="<? echo $res_tv2['id_tipo_ventas']?>|<? echo $res_tv2['nombre']?>"  selected><? echo $res_tv2['nombre']?></option>
		   <? }?>
		     <? 
			  $querytv = "SELECT * FROM tipo_ventas WHERE id_tipo_ventas>=2";
              $resultv = mysql_query($querytv) or print("<option value=\"ERROR\">".mysql_error()."</option>");
              while($res_tv = mysql_fetch_assoc($resultv)){?>
            <option  value="<? echo $res_tv['id_tipo_ventas']?>|<? echo $res_tv['nombre']?>">
			 <? echo $res_tv['nombre']?>
	        </option>
             <?
               }
             ?>
           </select>
	       <input name="id_tventa" type="hidden" id="id_tventa" value="1"/>
		   Nuevo Cliente <a class="iframe3" href="nuevo_cliente.php"><i class="fa fa-plus-circle"></i></a>
          </div>
		  <div class="col s10 m10 l9 xl9 offset-l3 offset-xl3 white-text white-text pink darken-4">
           Cliente:
           <label id="cliente" name="cliente" class="white-text">Mostrador</label>
		   <input class="btn" name="abonar" type="button" id="abonar" value="Abonar" onClick="abrir2()"/>
		<!-- <a href="producto_apartado.php" id="cli" class="iframe2" onclick="cambiarurl();">Producto Apartado</a>--> 
          </div>
		  
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
		   Total:
	       <input name="total" type="number" id="total" step="0.01" class="validate" readonly="true" value="0" required>
          </div>
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
		   Efectivo:
	       <input name="efectivo" type="number" id="efectivo"  step="0.01"  onchange="hacer_click()" class="validate" value="0" onfocus="Estilo()"  required>
          </div>
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
		   Cambio:
	       <input name="cambio" type="number" id="cambio" step="0.01"  class="validate" value="0"            readonly>
          </div>
		   <div class="col s8 m8 l8 xl8 offset-l4 offset-xl4 white-text">
	       <input  class="btn pink darken-4" name="venta" type="submit" onClick="return valida(e);" value="Venta">
		<!--   <input  class="btn pink darken-4" name="imp" type="button" onClick="return imprim();" value="Ticket">-->
		   <input name="cuantos" type="hidden" id="cuantos" value="0">
          </div>
		 </article>
		</div>
		
	  </div><!--fin fila productos-->
	  <input name="sucur" id="sucur" value="<? echo $res_suc['nombre'];?>" type="hidden" /><!--sucursal para ticket-->
	  <input name="vendedor" id="vendedor" value="<? echo $res_us['nombre'];?>" type="hidden" /><!--vendedor para ticket-->
	  <input name="cli" id="cli" value="Mostrador" type="hidden" /><!--cliente para ticket-->
	  <input name="pago" type="hidden" id="pago" value="Efectivo"/><!--pago para ticket-->
	  </form>
	</section>
    <!-- fin seccion-->
	
	  
  </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
	<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize2.js"></script>
</body>
</html>
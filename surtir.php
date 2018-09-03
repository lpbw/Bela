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

$consulta_us = "select * from usuarios where id_usuarios=$idU";
$resultado_us = mysql_query($consulta_us) or die("La consulta fall&oacute;P1:$consulta_us " . mysql_error());
$res_us=mysql_fetch_assoc($resultado_us);


if( $_POST['venta']=="Surtir")
{

 $id_prov =$_POST['prov'];
 
$coment=$_POST['comentario'];
 $idproducto =$_POST['idproducto'];
 $cantidad =$_POST['cantidad_d'] ;
 $idsucursal=$_POST['sucursal'];
 $count=0;
   
			if(sizeof($idproducto)>0) //si no tiene productos
			{		
			
				$consulta  = "insert into surtido (id_usuarios,id_proveedor,fecha,comentario) values ('$usuario','$id_prov',now(),'$coment')";
				$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
				$id_surt=mysql_insert_id();
				
				foreach($idproducto as $a)
				{
					
					$consulta  = "insert into detalle_surtido (id_surtido,id_producto,cantidad,id_sucursal) values($id_surt,$a,'$cantidad[$count]','$idSuc') ";
				    $resultado = mysql_query($consulta) or die("Error en operacion1: $consulta " . mysql_error());
					
					
					$consulta2  = "update inventario set cantidad=cantidad+$cantidad[$count] 
					               where id_producto=$a
								   AND id_sucursal=$idsucursal";
					$resultado2 = mysql_query($consulta2) or die("Error en operacion2:$consulta2 " . mysql_error());
					$count++;
				}
				echo"<script>alert(\"Surtido Realizado con Exito!!\");</script>";
			
}else
 {
  echo"<script>alert(\"Debe tener al menos un producto en la tabla\");</script>";
 }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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

<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

 <script>
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
var m=document.getElementById('monto')
var monto=document.header.total.value;

var can=document.getElementById('cant')
document.header.cant.value=parseInt(can.value)+1;
var can=document.getElementById('cant')


monto=monto*1-quita*1;
document.header.total.value=monto;
document.header.cuantos.value=document.header.cuantos.value-1;
}
//funcion inrow llena tabla
function insRow(cadena,c)
{
if(cadena!="0")
{
elementos= cadena.split("|");
var descri="";

var x=document.getElementById('myTable').insertRow(0);
var y=x.insertCell(0);
var z=x.insertCell(1);
var z1=x.insertCell(2);
var z2=x.insertCell(3);
var z3=x.insertCell(4);
var m=document.getElementById('monto')
//var monto=m.innerHTML;
var monto=document.header.total.value;
document.header.c.value=c;//cuando es por  codigo
if(document.header.c.value=="0" || document.header.c.value=="undefined"){

}else{
document.header.cantidad.value=document.header.c.value;
}
var cantidad=document.header.cantidad.value;
var sub=0;
var precio=0;
	sub=cantidad*1*elementos[5]*1;
	precio=elementos[5];
monto=monto*1+sub*1;
//m.innerHTML=monto;
document.header.total.value=monto;
x.id="p"+elementos[0];
y.innerHTML="<center>"+document.header.cantidad.value+"</center>";
y.className="style6 white-text";
z.innerHTML=elementos[2];
z.className="style6 white-text";
z1.innerHTML="$"+precio;
z1.className="style6 white-text";
z2.innerHTML="$"+sub;
z2.className="style6 white-text";
z3.innerHTML="<input name=\"precio[]\"  type=\"hidden\" value=\""+precio+"\" /><input name=\"mayoreo[]\"  type=\"hidden\" value=\"0\" /> <input name=\"idproducto[]\"  type=\"hidden\" value=\""+elementos[0]+"\" /><input name=\"cantidad_d[]\"  type=\"hidden\" value=\""+document.header.cantidad.value+"\" /><input name=\"monto[]\"  type=\"hidden\" value=\""+sub+"\" /><input name=\"descripcion[]\"  type=\"hidden\" value=\""+descri+"\" /><img src=\"images/close.gif\" alt=\"Eliminar Producto\" name=\"Image50\"  border=\"0\"  id=\"Image50\" onclick=\"deleteRow(this,"+sub+")\"/>";

document.header.cuantos.value=parseInt(document.header.cuantos.value)+1;

//reinicio de seleccion.
document.header.cantidad.value=1;
//var precio=document.getElementById('costo');
//precio.innerHTML=0;
//var desc=document.getElementById('descripcion');
//desc.innerHTML="";
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
	   
			
	     var precio=document.getElementById('costo')
		 precio.innerHTML=elementos[5];//muestra costo del producto en label con id=costo
		 var desc=document.getElementById('descripcion')
		 desc.innerHTML=elementos[2];//muestra descripcion en label con id=descripcion
		 //document.getElementsByName('codigo')[0].value=elementos[4];//muestra codigo de barras en input con id=codigo
		 document.header.prov.value=elementos[8];
	}else
	{	
		document.header.precio.style.visibility="visible"	;
	}
  }
}
//fin funcion ShowDes

function showtv(cadena)
{
	if(cadena!="0")
	{
	elementos= cadena.split("|");
	document.header.id_tventa.value=elementos[0];
	}
}


//funcion valida en botor cobrar
 function valida()
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
$.colorbox({iframe:true,href:"producto_apartado.php?id="+ir,width:"800", height:"650",transition:"fade", scrolling:true, opacity:0.7});
	
}	

$('#header').one('submit', function() {
    $(this).find('input[type="submit"]').attr('disabled','disabled');
});
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
		 <li><a href="principal.php"><i class="fa fa-arrow-left fa-2x"></i></a></li>
		 <? if($idA==1 || $idA==2)
		  {
		 ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Administracion
		  <i class="material-icons right">arrow_drop_down</i>
		  </a>
		  </li>
		  <?
		  }
		  ?>
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
          <li><a href="principal.php">Administración</a></li>
         </ul>
        <!--fin lista dropdown-->

		 <!--fin menu-->
		 
		 <!--menu mobil
		 <ul id="mobile-demo" class="side-nav cyan lighten-2" >
		   <ul class="collapsible" data-collapsible="accordion">
            <li>
              <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
              <div class="collapsible-body"><ul>
			   <li>uno</li>
			  </ul></div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
           </li>
           <li>
             <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
             <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
           </li>
          </ul>
        </ul>
        fin menu mobil-->
       </nav>
     </div>
	<!--fin navegador-->
	
    <!--encabezado-->
    <header>
      <div class="col s12 m12 x12 xl12 pink darken-4">
	    <img class="col s6 m6 x6 xl6 offset-l3 offset-xl3" src="images/logo_bela.jpeg" width="650" height="150"/>
      </div>
    </header>
	<!--fin encabezado-->
	
	 <nav>
	  <div class="col s12 m12 x12 xl12 cyan darken-4">
	   <div class="col s4 m4 l4 xl4 white-text">
	    <h4>Surtir</h4>
       </div>
       <div class="col s4 m4 l4 xl4 white-text">
	    Sucursal: <? echo $res_suc['nombre'];?>
       </div>
       <div class="col s4 m4 l4 xl4 white-text">
	    Usuario: <? echo $res_us['nombre'];?><br>
	    <iframe src="sesionActiva.php" width="200" height="25" scrolling="no"></iframe>
       </div>
	  </div> 
	 </nav>
	<!--seccion-->
	<section>
	  <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="header" name="header" method="post" enctype="multipart/form-data">
	   
	   <div class="row"><!--fila de seleccion del producto-->
		<div><!--seleccion del producto-->	  
		  <div class="col s2 m2 l2 xl2 white-text pink darken-4">
	       Cantidad
          </div>
          <div class="col s4 m4 l4 xl4 white-text pink darken-4">
	       Productos
          </div>
          <div class="col s2 m2 l2 xl2 white-text pink darken-4">
	       Descripcion
          </div>
          <div class="col s2 m2 l2 xl2 white-text pink darken-4">
	       Costo
          </div>
          <div class="col s2 m2 l2 xl2 white-text pink darken-4">
	       Codigo Barras
          </div>
		  <div class="input-field col s2 m2 l2 xl2 white-text">
	       <input name="cantidad" type="number" id="cantidad" value="1" size="4" maxlength="3" min="1" class="validate" required>
		   <input name="c" type="hidden" id="c" value="0">
          </div>
          <div class="input-field col s4 m4 l4 xl4 white-text">
            <select class="icons" name="lista_productos" id="lista_productos" onchange="showDes(lista_productos.value)">
              <option value="0" id="default" selected>---- Seleccione Producto -----</option>
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
                         ,pro.foto
                         ,pro.codigo_barras
                         ,pro.costo
                         FROM inventario inv 
                         JOIN productos pro ON inv.id_producto=pro.id_producto 
						 WHERE inv.id_sucursal=$idSuc
						 ORDER BY pro.nombre";
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_prod = mysql_fetch_assoc($result)){?>
              <option data-icon="<? echo "images/"."{$res_prod['foto']}"?>" class="circle" value="<? echo $res_prod['id_producto']//0?>
		    |<? echo $res_prod['nombre']//1?>
		    |<? echo $res_prod['descripcion']//2?>
			|<? echo $res_prod['cantidad']//3?>
			|<? echo $res_prod['id_inventario']//4?>
			|<? echo $res_prod['costo']//5?>
			|<? echo $res_prod['maximo']//6?>
			|<? echo $res_prod['minimo']//7?>
			|<? echo $res_prod['id_proveedor']//8?>
		    |0"><? echo "{$res_prod['nombre']}"?> </option>
              <?
               }
             ?>
            </select>
            <input name="cant" type="hidden" id="cant" value="0">
			<input name="prov" type="hidden" id="prov" value="0">  
          </div>
		  <div class="input-field col s2 m2 l2 xl2 white-text">
           <label id="descripcion" class="white-text"></label>
          </div>
          <div class="input-field col s2 m2 l2 xl2 white-text">
	       <i class="fa fa-usd prefix white-text"></i>
           <label id="costo" name="costo" class="white-text">0</label>
          </div>
		  <div class="input-field col s2 m2 l2 xl2 white-text">
		   <a href="captura_surtir.php" class="iframe">
		   <i class="fa fa-barcode fa-3x"></i>
		   </a>
          </div>
          <div class="input-field col s2 offset-s4 xl2 offset-xl5">
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
              <td width="6%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Costo</div></td>
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

		  
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
		    <select class="icons" name="sucursal" id="sucursal">
              <option value="0" disabled selected>---- Seleccione Sucursal -----</option>
              <? $querys = "SELECT *
                         FROM sucursales";
                $results = mysql_query($querys) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_prods = mysql_fetch_assoc($results)){?>
              <option   value="<? echo $res_prods['id_sucursal']//0?>"><? echo "{$res_prods['nombre']}"?> </option>
              <?
               }
             ?>
            </select>
	       <input name="total" type="hidden" id="total" step="0.01" class="validate" readonly="true" value="0" required>
          </div>
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
		
	       <input name="efectivo" type="hidden" id="efectivo"  step="0.01"   class="validate" value="0"  required>
          </div>
		  <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
		 
	       <input name="cambio" type="hidden" id="cambio" step="0.01" onclick="hacer_click()" class="validate" value="0"            readonly>
          </div>
		   <div class="col s6 m6 l6 xl6 offset-l4 offset-xl4 white-text">
	       <input  class="btn pink darken-4" name="venta" type="submit" onClick="return valida();" value="Surtir">
		   <input name="cuantos" type="hidden" id="cuantos" value="0">
          </div>
		    <div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
			Comentario:
	      <textarea id="comentario" class="materialize-textarea white-text" name="comentario"></textarea>
          </div>
		 </article>
		</div>
		
	  </div><!--fin fila productos-->
	  </form>
	</section>
    <!-- fin seccion-->
	
	  
  </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>
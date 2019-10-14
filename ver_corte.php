<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$fecha=date('Y-m-d');
$fecha2=date('Y-m-d');
$hora=date('H:i:s');
$usuario=$idU;
$consulta_suc  = "select * from sucursales where id_sucursal=$idSuc";
$resultado_suc = mysql_query($consulta_suc) or die("La consulta fall&oacute;P1:$consulta_suc " . mysql_error());
$res_suc=mysql_fetch_assoc($resultado_suc);

$consulta_us = "select * from usuarios where id_usuarios=$idU";
$resultado_us = mysql_query($consulta_us) or die("La consulta fall&oacute;P1:$consulta_us " . mysql_error());
$res_us=mysql_fetch_assoc($resultado_us);



if( $_POST['buscar']=="Buscar")
{
	
	$fecha=$_POST['desde'];
	$fecha2=$_POST['hasta'];
	
			
}
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

  <link href="css/styles.css?template=xeug-03&colorScheme=green&header=headers2&button=buttons1" rel="stylesheet" type="text/css">
 <!--Let browser know website is optimized for mobile-->
 <link rel="stylesheet" href="colorbox.css" />
  
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 		  <SCRIPT>
            $(function() {
                $( "#hasta" ).datepicker({ dateFormat: 'yy-mm-dd' });
                $( "#desde" ).datepicker({ dateFormat: 'yy-mm-dd' });
            });
			</script>
<script>

			
$(document).ready(function(){
		$(".iframe").colorbox({iframe:true,width:"550", height:"400",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe2").colorbox({iframe:true,width:"450", height:"380",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe3").colorbox({iframe:true,width:"500", height:"500",transition:"fade", scrolling:false, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});

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
function abrir2()
{
var ir=document.header.idcliente.value;
$.colorbox({iframe:true,href:"producto_apartado.php?id="+ir,width:"800", height:"650",transition:"fade", scrolling:true, opacity:0.7});
	
}

 function Eliminar(id){
        if(confirm('Deseas eliminar el Corte?')){
            var elem = document.createElement('input');
            elem.name='idc';
            elem.value = id;
            elem.type = 'hidden';
            $("#form1").append(elem);
			
            $("#form1").attr('action','elimina_corte.php');
            $("#form1").submit();
			
			alert('Corte eliminado');
        }
    }
</script>
</head>

<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--navegador-->
	   <nav class="col s12 m12 l12 xl12 cyan darken-4">
	    <div class="nav-wrapper cyan darken-4">
	   <!--menu-->
	    <a class="brand-logo center">Reporte Corte </a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
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
		  <li><a href="cajap.php">Caja</a></li>
		  <li class="divider"></li>
          <li><a href="inventario.php">Inventario</a></li>
		  <li class="divider"></li>
          <li><a href="usuarios.php">Usuarios</a></li>
          <li class="divider"></li>
		  <li><a href="proveedores.php">Proveedores</a></li>
          <li class="divider"></li>
          <li><a href="principal.php">Administraci�n</a></li>
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
		</div>
       </nav>
	<!--fin navegador-->

	
   <!--tabla-->
     <div class="col s12 m12 l12 xl12 white-text"> 
	 <form action="" id="form1" name="form1" method="post">
	   <table class="bordered">
         <thead>
           <tr>
             <th></th>
			 <th></th>
			 <th></th>
			 <th></th>
			 <th></th>
           </tr>
		    <tr>
			 <td class="white-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Desde:</td>
             <td class="input-field">
			    <input name="desde" type="text" class="datepicker" id="desde" size="10" maxlength="10" readonly value="<? echo"$fecha";?>"/>
			 </td>
			 <td>Hasta:</td>
             <td class="input-field">
			    <input name="hasta" type="text" class="datepicker" id="hasta" size="10" maxlength="10" readonly value="<? echo"$fecha2";?>"/>
			 </td>
             <td class="white-text"><select class="white-text" name="sucursal" id="sucursal" required>
            <option value="0" selected>Sucursal</option>
             <? $query = "SELECT * FROM sucursales";
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_suc = mysql_fetch_assoc($result)){?>
		    <option value="<? echo $res_suc['id_sucursal']?>"><? echo $res_suc['nombre']?></option>
		     <?
               }
             ?>
			
          </select></td>
		  <td><input class="btn" type="submit" name="buscar" value="Buscar" id="buscar"></td>
			</tr>
         </thead>
         <tbody>
           <tr>
             <td class="pink darken-4 white-text">Sucursal</td>
             <td class="pink darken-4 white-text">Usuario</td>
             <td class="pink darken-4 white-text">Fondo</td>
             <td class="pink darken-4 white-text">Total Monedas</td>
             <td class="pink darken-4 white-text">Total Billetes</td>
             <td class="pink darken-4 white-text">Total Ventas</td>
			 <td class="pink darken-4 white-text">Fecha</td>
           </tr>
		   <?
		    if( $_POST['buscar']=="Buscar")
			{    
			   $suc=$_POST['sucursal'];
			    if($fecha!="" and $fecha2!="" and $suc!=0){
				 $and=" where c.fecha>='$fecha 00:00:00' and c.fecha_fin<='$fecha2 23:59:59' and c.id_sucursal='$suc'";
				}
				else
				{
				    if($fecha!="" and $fecha2!=""){
					  $and=" where c.fecha>='$fecha 00:00:00' and c.fecha_fin<='$fecha2 23:59:59'";
					}
					else{
					   if($suc!=0){
				         $and=" where c.id_sucursal='$suc'";
				       }else{
				         $and=" where c.id_sucursal=0";
				       }
					}
				}
			    
				
				$query = "select c.*,u.nombre,(s.nombre) as sucursal from corte c join usuarios u on u.id_usuarios=c.id_usuarios
				join sucursales s on c.id_sucursal=s.id_sucursal".$and;
		$result = mysql_query($query) or print("$query ".mysql_error()."");
		while($res_marca = mysql_fetch_assoc($result)){
	?>
		   
           <tr>
             <td>
			    <a href="reporte_corte.php?id=<? echo $res_marca['id_corte']?>&suc=<? echo $res_marca['sucursal'] ?>&usu=<? echo $res_marca['nombre'] ?>&fon=<? echo $res_marca['fondo'] ?>&tm=<? echo $res_marca['total_monedas'] ?>&tb=<? echo $res_marca['total_billetes'] ?>&tot=<? echo $res_marca['ventas'] ?>&f=<? echo $res_marca['fecha'] ?>" class="iframe3"><? echo $res_marca['sucursal']?></a></td>
             <td class="input-type">
			    <a href="reporte_corte.php?id=<? echo $res_marca['id_corte']?>&suc=<? echo $res_marca['sucursal'] ?>&usu=<? echo $res_marca['nombre'] ?>&fon=<? echo $res_marca['fondo'] ?>&tm=<? echo $res_marca['total_monedas'] ?>&tb=<? echo $res_marca['total_billetes'] ?>&tot=<? echo $res_marca['ventas'] ?>&f=<? echo $res_marca['fecha'] ?>" class="iframe3"><? echo $res_marca['nombre']?></a>
			 </td>
             <td class="input-type"><? echo $res_marca['fondo']?></td>
             <td class="input-type"><? echo $res_marca['total_monedas']?></td>
             <td class="input-type"><? echo $res_marca['total_billetes']?></td>
             <td class="input-type"><? echo $res_marca['ventas']?></td>
			 <td class="input-type"><? echo $res_marca['fecha']?></td>
			 <td class="input-type"><a style="cursor:pointer;" onclick="Eliminar('<? echo $res_marca['id_corte']?>');">Eliminar</a></td>
           </tr>
         </tbody>
		 <?
		   }
		 }
		 ?>
       </table>
	 </form> 
	 </div>
	 <!--fin tabla-->
	 
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>


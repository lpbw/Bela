<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$fecha=date('Y-m-d');
$hora=date('H:i:s');
$usuario=$idU;
$consulta_suc  = "select * from sucursales where id_sucursal=$idSuc";
$resultado_suc = mysql_query($consulta_suc) or die("La consulta fall&oacute;P1:$consulta_suc " . mysql_error());
$res_suc=mysql_fetch_assoc($resultado_suc);

$consulta_us = "select * from usuarios where id_usuarios=$idU";
$resultado_us = mysql_query($consulta_us) or die("La consulta fall&oacute;P1:$consulta_us " . mysql_error());
$res_us=mysql_fetch_assoc($resultado_us);



if( $_POST['guardar']=="Guardar")
{
	
	$b1000=$_POST['b1000'];
	$b500=$_POST['b500'];
	$b200=$_POST['b200'];
	$b100 =$_POST['b100'] ;
	$b50 =$_POST['b50'] ;
	$b20 =$_POST['b20'] ;
	$m20=$_POST['m20'];
	$m10=$_POST['m10'];
	$m5=$_POST['m5'];
	$m2 =$_POST['m2'] ;
	$m1 =$_POST['m1'] ;
	$mp5 =$_POST['mp5'] ;
	$totalm =$_POST['totalm'];
	$totalb=$_POST['totalb'];
	$total=$_POST['total'];
	$fondo=$_POST['fondo'];
	$sumtotal=$totalm+$totalb+$fondo;
	$tefectivo=$_POST['totalefectivo'];
	$tapartado=$_POST['totalapartado'];
	$ttarjeta=$_POST['totaltarjeta'];
	$fecha=$_POST['fecha'];
	$consulta="insert into corte(id_usuarios,b20,b50,b100,b200,b500,b1000,m20,m10,m5,m2,m1,mp5,fondo,total_monedas,total_billetes,ventas,id_sucursal,fecha,total_efectivo,total_apartado,total_tarjeta)values('$usuario','$b20','$b50','$b100','$b200','$b500','$b1000','$m20','$m10','$m5','$m2','$m1','$mp5','$fondo','$totalm','$totalb','$total','$idSuc','$fecha','$tefectivo','$tapartado','$ttarjeta')";
	$resultado = mysql_query($consulta) or die("Error en operacion3: $consulta" . mysql_error());
	if($sumtotal<$total){
		$faltante=$total-$sumtotal;
		echo"<script>alert(\"Te ha faltado $faltante de efectivo\");</script>";
	}
	
	echo"<script>alert(\"Corte realizada con Exito!!\");</script>";
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
     $(function() {
     $( "#fecha" ).datepicker({ dateFormat: 'yy-mm-dd' });
     
       });
//fin suma de billetes
</script>
</head>

<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--navegador-->
	   <nav class="col s12 m12 l12 xl12 cyan darken-4">
	    <div class="nav-wrapper cyan darken-4">
	   <!--menu-->
	    <a class="brand-logo center">Corte De Caja </a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		 <ul class="left hide-on-med-and-down">
		  <li><a href="cajap.php"><i class="fa fa-arrow-left fa-2x"></i></a></li>
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
	   <table>
         <thead>
           <tr>
             <th>Caja</th>
			 <th>Sucursal: <? echo $res_suc['nombre'];?></th>
			 <th>Usuario: <? echo $res_us['nombre'];?></th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td class="pink darken-4 white-text">Billetes</td>
             <td class="pink darken-4 white-text">$1000</td>
             <td class="pink darken-4 white-text">$500</td>
             <td class="pink darken-4 white-text">$200</td>
             <td class="pink darken-4 white-text">$100</td>
             <td class="pink darken-4 white-text">$50</td>
             <td class="pink darken-4 white-text">$20</td>
           </tr>
           <tr>
             <td>No.Billetes</td>
             <td class="input-type">
			 <input name="b1000" type="number" id="b1000" step="1" class="validate" onChange="sumaP();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="b500" type="number" id="b500" step="1" class="validate" onChange="sumaP();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="b200" type="number" id="b200" step="1" class="validate" onChange="sumaP();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="b100" type="number" id="b100" step="1" class="validate" onChange="sumaP();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="b50" type="number" id="b50" step="1" class="validate" onChange="sumaP();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="b20" type="number" id="b20" step="1" class="validate" onChange="sumaP();" value="0" required/>
             </td>
           </tr>
		    <tr>
             <td class="pink darken-4 white-text">Monedas</td>
             <td class="pink darken-4 white-text">$20</td>
             <td class="pink darken-4 white-text">$10</td>
             <td class="pink darken-4 white-text">$5</td>
             <td class="pink darken-4 white-text">$2</td>
             <td class="pink darken-4 white-text">$1</td>
             <td class="pink darken-4 white-text">$.50</td>
           </tr>
           <tr>
             <td>No.Monedas</td>
             <td class="input-type">
			 <input name="m20" type="number" id="m20" step="1" class="validate" onChange="sumaM();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="m10" type="number" id="m10" step="1" class="validate" onChange="sumaM();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="m5" type="number" id="m5" step="1" class="validate" onChange="sumaM();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="m2" type="number" id="m2" step="1" class="validate" onChange="sumaM();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="m1" type="number" id="m1" step="1" class="validate" onChange="sumaM();" value="0" required/>
             </td>
             <td class="input-type">
			 <input name="mp5" type="number" id="mp5" step="1" class="validate" onChange="sumaM();" value="0" required/>
             </td>
           </tr>
           <tr>
		   <tr>
		     <td class="white-text"></td>
			 <td class="pink darken-4 white-text">Total Billetes</td>
			 <td class="pink darken-4 white-text">Total Monedas</td>
			 <td class="pink darken-4 white-text">Fondo</td>
			 <td class="pink darken-4 white-text">Fecha de corte</td>
		   </tr>
			 <?
		$querytotal = "select COALESCE(sum(total),0) as total from ventas
JOIN usuarios ON ventas.id_usuarios=usuarios.id_usuarios
where ventas.fecha>='$fecha 00:00:01' and ventas.fecha<='$fecha 23:59:59' and usuarios.id_sucursal=$idSuc";
		 //echo $query;
		$result = mysql_query($querytotal) or print("$$queryefectivo ".mysql_error()."");
		$res_total = mysql_fetch_assoc($result);	
			 
		$queryefectivo = "select COALESCE(sum(total),0) as total from ventas
JOIN usuarios ON ventas.id_usuarios=usuarios.id_usuarios
where ventas.fecha>='$fecha 00:00:01' and ventas.fecha<='$fecha 23:59:59' and usuarios.id_sucursal=$idSuc and ventas.id_tipo_ventas=1";
		 //echo $query;
		$result = mysql_query($queryefectivo) or print("$$queryefectivo ".mysql_error()."");
		$res_efectivo = mysql_fetch_assoc($result);
		
				$queryapartado = "select COALESCE(sum(efectivo),0) as total from ventas
JOIN usuarios ON ventas.id_usuarios=usuarios.id_usuarios
where ventas.fecha>='$fecha 00:00:01' and ventas.fecha<='$fecha 23:59:59' and usuarios.id_sucursal=$idSuc and ventas.id_tipo_ventas=2";
		 //echo $query;
		$resultap = mysql_query($queryapartado) or print("$$queryefectivo ".mysql_error()."");
		$res_apartado = mysql_fetch_assoc($resultap);
		
						$querytarjeta= "select COALESCE(sum(total),0) as total from ventas
JOIN usuarios ON ventas.id_usuarios=usuarios.id_usuarios
where ventas.fecha>='$fecha 00:00:01' and ventas.fecha<='$fecha 23:59:59' and usuarios.id_sucursal=$idSuc and ventas.id_tipo_ventas=3";
		 //echo $query;
		$resultat = mysql_query($querytarjeta) or print("$$queryefectivo ".mysql_error()."");
		$res_tarjeta = mysql_fetch_assoc($resultat);
			?>
			<tr>
			<td class="white-text"></td>

          
			
			   <td class="input-type">
			 <input name="totalb" type="number" id="totalb"  class="validate" value="0" onChange="sumaP();" readonly="true" required/>
			 </td>
			   <td class="input-type">
			 <input name="totalm" type="number" id="totalm"  class="validate" value="0" onChange="sumaM();" readonly="true" required/>
			 </td>
			 <td class="input-type">
			 <input name="fondo" type="number" id="fondo"  class="validate" step="0.01" value="0"  required/>
			 <input name="total" type="hidden" id="total"  class="validate" step="0.01" value="<? echo $res_total['total']?>"/>
			 <input name="totalefectivo" type="hidden" id="totalefectivo"  class="validate" value="<? echo $res_efectivo['total']?>"/>
			  <input name="totalapartado" type="hidden" id="totalapartado"  class="validate" value="<? echo $res_apartado['total']?>"/>
			  <input name="totaltarjeta" type="hidden" id="totaltarjeta"  class="validate" value="<? echo $res_tarjeta['total']?>"/>
			 </td>
			 <td class="input-type">
		  		<input type="text" name="fecha" id="fecha" class="datepicker" value="<? echo $fecha;?>" readonly>
			 </td>
           </tr>
         </tbody>
       </table>
	   
			<?
			if($idA==1 or $idA==2){
			?>	   
	   <table>
	   	<thead>
<td class="pink darken-4 white-text">Total Efectivo</td>
			 <td class="pink darken-4 white-text">Total Apartado</td>
			 <td class="pink darken-4 white-text">Total Tarjeta</td>
		</thead>
		<tbody>
   <td class="input-type">
			 <input name="totalefectivo" type="text" id="totalefectivo"  class="validate" value="<? echo $res_efectivo['total']?>" readonly="true"/>
			 </td>
			 <td class="input-type">
			 <input name="totalapartado" type="text" id="totalapartado"  class="validate" value="<? echo $res_apartado['total']?>" readonly="true"/>
			 </td>
			  <td class="input-type">
			 <input name="totaltarjeta" type="text" id="totaltarjeta"  class="validate" value="<? echo $res_tarjeta['total']?>" readonly="true"/>
			 </td>
		</tbody>
	   </table>
	    <?
			 }
			 ?>
	   	  <div class="row">
        <div class="input-field col s4 m4 l4 xl4 offset-s4 xl2 offset-xl5">
          <button class="btn waves-effect waves-light cyan darken-4" type="submit" name="guardar" id="guardar" value="Guardar"><i class="fa fa-floppy-o"></i>Guardar
          </button>
        </div>
      </div>
	 </form> 
	 </div>
	 <!--fin tabla-->
	 
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>

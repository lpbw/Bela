<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$idsuc=0;
$idprov=0;
if( $_POST['buscar']=="Buscar")
{
$idprov=$_POST['proveedor'];
$idsuc=$_POST['sucursal'];
$idprod=$_POST['producto'];
$_SESSION['idprov']=$idprov;

$_SESSION['idsuc2']=$idsuc;
$_SESSION['idprod']=$idprod;
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
 <!--Let browser know website is optimized for mobile-->
  <!-- <link href="css/styles.css?template=xeug-03&colorScheme=green&header=headers2&button=buttons1" rel="stylesheet" type="text/css"> -->
 <!--Let browser know website is optimized for mobile-->
 <link rel="stylesheet" href="colorbox.css" />
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>

<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <script>
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
function abrir2(id,idprov,idsuc,idprod)
{
$.colorbox({iframe:true,href:"editar_inventario.php?id="+id+"&idprov="+idprov+"&idsuc="+idsuc+"&idprod="+idprod,width:"600", height:"500",transition:"fade", scrolling:false, opacity:0.7});	
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
	    <a class="brand-logo center">Inventario</a>
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
          <li><a href="producto.php">Productos</a></li>
		  <li class="divider"></li>
          <li><a href="usuarios.php">Usuarios</a></li>
		  <li class="divider"></li>
          <li><a href="proveedores.php">Proveedores</a></li>
          <li class="divider"></li>
		   <li><a href="surtir.php">Surtir</a></li>
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
  <!--filtros-->
   <div class="col s12 xl12 white-text"> 
  <form name="form2" id="form2" method="post">
       <!--inicio select sucursal-->
	    <div class="input-field col s4 m4 l4 xl4">
          <select class="white-text" name="sucursal" id="sucursal"/>
            <option value="0" selected>Selecciona una sucursal</option>
             <? $query = "SELECT * FROM sucursales";
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_suc = mysql_fetch_assoc($result)){?>
		    <option value="<? echo $res_suc['id_sucursal']?>"<? echo $_SESSION['idsuc2']==$res_suc['id_sucursal']?"selected":""; ?>><? echo $res_suc['nombre']?></option>
		     <?
               }
             ?>
			
          </select>
          <label for="sucursal">Sucursal</label>
		   <input  class="btn-large" name="buscar" id="buscar" type="submit"  value="Buscar">  
         </div>
		 <!--fin select sucursal-->
		 
		 <!--inicio select proveedor-->
	    <div class="input-field col s4 m4 l4 xl4">
          <select class="white-text" name="proveedor" id="proveedor" />
            <option value="0" selected>Selecciona un proveedor</option>
             <?
			 $sucursal=""; 
			 if($idsuc!=0){
			 $sucursal=" WHERE s.id_sucursal=$idsuc";
			 }
			 
			 $query = "SELECT DISTINCT pr.id_proveedor, pr.nombres,pr.ap_paterno,pr.ap_materno FROM inventario i 
			 JOIN productos p ON i.id_producto=p.id_producto
			 JOIN sucursales s ON i.id_sucursal=s.id_sucursal 
			 JOIN proveedores pr ON p.id_proveedor=pr.id_proveedor".$sucursal;
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_suc = mysql_fetch_assoc($result)){?>
		    <option value="<? echo $res_suc['id_proveedor']?>"<? echo $_SESSION['idprov']==$res_suc['id_proveedor']?"selected":""; ?>><? echo $res_suc['nombres']." ".$res_suc['ap_paterno']." ".$res_suc['ap_materno']?></option>
		     <?
               }
             ?>
			
          </select>
          <label for="sucursal">Proveedor</label> 
         </div>
		 <!--fin select sucursal-->
		 
		 <!--inicio select producto-->
		<div class="input-field col s4 m4 l4 xl4">
         	<select class="white-text" name="producto" id="producto"/>
		    	<option value="0" selected>Seleccione Producto</option>
             		<? 
				$p=""; 
			 if($idprov!=0){
			 $p=" WHERE p.id_proveedor=$idprov";
			 }
					$query = "SELECT * FROM productos p JOIN proveedores pr ON p.id_proveedor=pr.id_proveedor".$p;
                	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                	while($res_suc = mysql_fetch_assoc($result)){?>
		    	<option value="<? echo $res_suc['id_producto'];?>"<? echo $_SESSION['idprod']==$res_suc['id_producto']?"selected":""; ?>><? echo $res_suc['nombre'];?></option>
		     		<?
               		}
             		?>
          	</select>
          	<label for="sucursal">Productos</label>  
    	</div>
	<!--fin select sucursal-->
		 
  </form>
  </div>
<!--fin filtros-->	
   <!--tabla-->
     <div class="col s12 xl12 white-text">
	 <form action="" id="form1" name="form1" method="post">
	     <table class="centered bordered white-text">
		    <thead>
			  <tr>
			    <th>Sucursal</th>
				<th>Proveedor</th>
				<th>Cantidad</th>
				<th>Producto</th>
				<th>Descripcion</th>
				<th>Precio</th>
				<th>Costo</th>
				<th>Maximo</th>
				<th>Minimo</th>
				<th>Codigo De Barras</th>
				<th>Foto</th>
			  </tr>
			</thead>
			<tbody>
	<? 
			if($_SESSION['idprov']!="" && $_SESSION['idsuc2']!="" && $_SESSION['idprod']!="")
			{
				$idprov = $_SESSION['idprov'];
				$idsuc= $_SESSION['idsuc2'];
				$idprod = $_SESSION['idprod'];
			}


	   if($idprov!=0 and $idsuc!=0 and $idprod!=0){
       $sucursal1=" WHERE p.id_proveedor=$idprov AND i.id_sucursal=$idsuc AND p.id_producto=$idprod";
	   }else if($idprov!=0 and $idsuc!=0){
	   $sucursal1=" WHERE i.id_sucursal=$idsuc AND p.id_proveedor=$idprov";
	   }else if($idprov!=0 and $idprod!=0){
	   $sucursal1=" WHERE p.id_proveedor=$idprov AND p.id_producto=$idprod";
	   }else if($idsuc!=0){
	   $sucursal1=" WHERE i.id_sucursal=$idsuc";
	   }else if($idprov!=0){
	   $sucursal1=" WHERE p.id_proveedor=$idprov";
	   }else if($idprod!=0){
	   $sucursal1=" WHERE p.id_producto=$idprod";
	   }else{
	   $sucursal1=" WHERE i.id_sucursal=0";
	   }
	   
	
	
	
	$query = ("SELECT i.*,p.id_proveedor,p.nombre,p.descripcion,p.precio,p.foto,p.codigo_barras,p.costo,(s.nombre) as sucursal,s.direccion,s.ciudad,pr.nombres,pr.ap_paterno,pr.ap_materno FROM inventario i
JOIN productos p ON i.id_producto=p.id_producto
JOIN sucursales s ON i.id_sucursal=s.id_sucursal
JOIN proveedores pr ON p.id_proveedor=pr.id_proveedor"
.$sucursal1);


       $result = mysql_query($query) or die("La consulta fall&oacute;P1:$query " . mysql_error());
       while($res_prod = mysql_fetch_assoc($result))
	   {   
	?>		
          <tr>
					<input type="hidden" name="IdProveedor" id="IdProveedor" value="<? echo $idprov;?>"/>
					<input type="hidden" name="IdSucursal" id="IdSucursal" value="<? echo $idsuc;?>"/>
					<input type="hidden" name="IdProducto" id="IdProducto" value="<? echo $idprod;?>"/>
            <td><? echo $res_prod['sucursal']?></td>
			<td><? echo $res_prod['nombres']." ".$res_prod['ap_paterno']." ".$res_prod['ap_materno']?></td>
            <td><? echo $res_prod['cantidad']?></td>
			<td><? echo $res_prod['nombre']?></td>
			<td><? echo $res_prod['descripcion']?></td>
			<td><? echo $res_prod['precio']?></td>
			<td><? echo $res_prod['costo']?></td>
			<td><? echo $res_prod['maximo']?></td>
			<td><? echo $res_prod['minimo']?></td>
			<td><? echo $res_prod['codigo_barras']?></td>
			 <td><? if($res_prod['foto']!=""){?><img src="images/<? echo $res_prod['foto']; ?>" width="90" height="90" /><? }?></td>
			  <td><a href="javascript:abrir2(<? echo $res_prod['id_inventario']?>,<? echo $idprov;?>,<?echo $idsuc;?>,<?echo $idprod;?>)"><i class="fa fa-pencil fa-lg"></i></a></td>
          </tr>
       
		 <?
		   }
		 ?>
		  </tbody>
		 </table>
	</form> 
	<!--fin tabla-->
		 
	 </div>
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->

 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>


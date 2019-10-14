<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];

$idprov=0;
$idprod=0;
$nombrep="Selecciona un Producto";

	/**Cuando se acaba de modificar el producto */
	if($_SESSION['idprov1']!=0 && $_SESSION['idprod1']!=0)
	{
		$idprov = $_SESSION['idprov1'];
		$idprod = $_SESSION['idprod1'];
		if ($_SESSION['idprov1']!=0 && $_SESSION['idprod1']==0) {
			$idprov = $_SESSION['idprov1'];
		}
	}
	/***************************************** */
if ($idprov==0 && $idprod==0) {
	$_SESSION['idprov1']=0;
	$_SESSION['idprod1']=0;
}
if( $_POST['proveedor']!=0)
{	
$idprod=$_POST['producto'];	
$idprov=$_POST['proveedor'];
$_SESSION['idprov1']=$idprov;
$_SESSION['idprod1']=$idprod;
}
if( $_POST['producto']!=0)
{	
$idprod=$_POST['producto'];	
$idprov=$_POST['proveedor'];
$_SESSION['idprov1']=$idprov;
$_SESSION['idprod1']=$idprod;
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
		
		function buscarproducto()
		{
				document.form2.submit();
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
	    <a class="brand-logo center">Productos</a>
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
		</div>
       </nav>
	<!--fin navegador-->
	
   <!--filtros-->
   <div class="col s12 xl12 white-text"> 
  <form name="form2" id="form2" method="post">
  
	<!--inicio select proveedor-->
		<div class="input-field col s4 m4 l4 xl4">
        	<select class="white-text" name="proveedor" id="proveedor" onChange="buscarproducto();"/>
            	<option value="0" selected>Selecciona un proveedor</option>
             		<? $query = "SELECT * FROM proveedores";
                	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                	while($res_suc = mysql_fetch_assoc($result)){?>
		    	<option value="<? echo $res_suc['id_proveedor']?>" <? echo $_SESSION['idprov1']==$res_suc['id_proveedor']?"selected":""; ?>><? echo $res_suc['nombres']." ".$res_suc['ap_paterno']." ".$res_suc['ap_materno']?></option>
		     		<?
               		}
             		?>	
          </select>
          <label for="sucursal">Proveedor</label> 
    	</div>
	<!--fin select proveedor-->
		
	<!--inicio select producto-->
		<div class="input-field col s4 m4 l4 xl4">
         	<select class="white-text" name="producto" id="producto"/>
		    	<option value="0" selected>Seleccione Producto</option>
             		<? $query = "SELECT * FROM productos p JOIN proveedores pr ON p.id_proveedor=pr.id_proveedor WHERE p.id_proveedor=$idprov";
                	$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                	while($res_suc = mysql_fetch_assoc($result)){?>
		    	<option value="<? echo $res_suc['id_producto'];?>"<? echo $_SESSION['idprod1']==$res_suc['id_producto']?"selected":""; ?>><? echo $res_suc['nombre'];?></option>
		     		<?
               		}
             		?>
          	</select>
          	<label for="sucursal">Productos</label>
		   	<input  class="btn-large" name="buscar" id="buscar" type="submit"  value="Buscar">  
    	</div>
	<!--fin select sucursal-->
		 

  </form>
  </div>
	
   <!--tabla-->
     <div class="col s12 xl12 white-text">
	 <form action="" id="form1" name="form1" method="post">
	 <?
	 	if($idprod!=0)
		{
	 ?>
	 <div class="col s3 xl3 offset-s6 offset-xl6 white-text">
	 <? echo $nombrep;?>
	 </div>
	 <?
	 	}
	 ?>
	     <table class="centered bordered white-text">
		    <thead>
			  <tr>
			    <th>Nombre</th>
				<th>Mas vendido</th>
				<th>Precio</th>
				<th>Descripcion</th>
				<th>Foto</th>
				<th>Proveedor</th>
				<th colspan="3"><a href="nuevo_producto.php" ><i class="fa fa-plus"></i> Nuevo producto</a></th>
			  </tr>
			</thead>
			<tbody>
	<?
			if($_SESSION['idprov1']!=0 && $_SESSION['idprod1']!=0)
			{
				$idprov = $_SESSION['idprov1'];
				$idprod = $_SESSION['idprod1'];
			}
		 if($idprov!=0 and $idprod!=0)
		 {
			$producto1=" WHERE pro.id_proveedor=$idprov AND p.id_producto=$idprod";
		 }
		 else
		 {
			if($idprod!=0)
			{
	     $producto1=" WHERE p.id_producto=$idprod";
			}
			else
			{
				if($idprov!=0)
				{
	        $producto1=" WHERE pro.id_proveedor=$idprov";
				}
				else
				{
		    	$producto1=" WHERE p.id_proveedor=0";
	      }
	    }
	   }
	

	 $query = "SELECT * FROM productos p LEft JOIN proveedores pro ON p.id_proveedor=pro.id_proveedor".$producto1." ORDER BY p.nombre ASC";
       $result = mysql_query($query) or die("La consulta fall&oacute;P1:$query " . mysql_error());
       while($res_prod = mysql_fetch_assoc($result))
	   {   
	?>		
          <tr>
            <td><? echo $res_prod['nombre']?></td>
			<td><? echo $res_prod['mas']==1?"<i class=\"fa fa-check fa-lg\"></i>":"";?> </td>
            <td><? echo $res_prod['precio']?></td>
			<td><? echo $res_prod['descripcion']?></td>
			 <td><? if($res_prod['foto']!=""){?><img src="images/<? echo $res_prod['foto']; ?>" width="90" height="90" /><? }?></td>
			 <td><?echo $res_prod['id_proveedor']==0?"Falta proveedor": $res_prod['nombres']." ".$res_prod['ap_paterno']." ".$res_prod['ap_materno'];?></td>
			  <td><a href="editar_producto.php?id=<? echo $res_prod['id_producto'];?>"><i class="fa fa-pencil fa-lg"></i></a></td>
			<td><a href="alta_fotos.php?id=<? echo $res_prod['id_producto']?>" ><i class="fa fa-camera-retro fa-lg"></i></a></td></td>
	<td><a href="javascript:borrar(<? echo $res_prod['id_producto']?>, '<? echo $res_prod['nombre']?>', '<? echo $res_prod['foto']?>');">
	             <i class="fa fa-trash-o fa-lg"></i></a></td>
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
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>

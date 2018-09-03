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
 function borrar(id, nombre){
        if(confirm('Deseas eliminar al proveedor: '+nombre+'?')){
            var elem = document.createElement('input');
            elem.name='id';
            elem.value = id;
            elem.type = 'hidden';
            $("#form1").append(elem);

            $("#form1").attr('action','eliminar_proveedor.php');
            $("#form1").submit();
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
	    <a class="brand-logo center">Proveedores</a>
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
          <li><a href="inventario.php">Inventario</a></li>
          <li class="divider"></li>
		  <li><a href="usuarios.php">Usuarios</a></li>
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
		</div>
       </nav>
	<!--fin navegador-->
	
   
   <!--bucador
    <div class="col s12 xl12">
	  <header>
		<nav>
         <div class="nav-wrapper cyan lighten-2">
          <a class="brand-logo center">Usuarios</a>
          
       <form method="post">
        <div class="input-field">
          <input id="buscar" type="search" name="buscar" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
        
         </div>
        </nav>
	  </header>
	</div>
   fin buscador-->
 
	
   <!--tabla-->
     <div class="col s12 m12 l12 xl12">
	 <form action="" id="form1" name="form1" method="post">
	     <table class="centered bordered highlight white-text">
		    <thead>
			  <tr>
			    <th>Nombre</th>
				<th>Empresa</th>
				<th>Dirección</th>
				<th>Numero Exterior</th>
				<th>Telefono</th>
				<th colspan="2"><a href="nuevo_proveedor.php" ><i class="fa fa-plus"></i> Nuevo Proveedor</a></th>
			  </tr>
			</thead>
			<tbody>
	<? $query = "SELECT *
	             FROM proveedores";
       $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
       while($res_prod = mysql_fetch_assoc($result))
	   {   
	?>		
          <tr>
            <td><? echo $res_prod['nombres']." ".$res_prod['ap_paterno']." ".$res_prod['ap_materno']?></td>
            <td><? echo $res_prod['empresa']?></td>
			<td><? echo $res_prod['direccion']?></td>
			 <td><? echo $res_prod['num_ext']?></td>
			 <td><? echo $res_prod['telefono']?></td>
			 <td><a href="editar_proveedor.php?id=<? echo $res_prod['id_proveedor'];?>">
			 <i class="fa fa-pencil fa-lg"></i></a></td>
	<td><a href="javascript:borrar(<? echo $res_prod['id_proveedor']?>, '<? echo "{$res_prod['nombres']}"." "."{$res_prod['ap_paterno']}"." "."{$res_prod['ap_materno']}"?>');">
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



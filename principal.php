<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];

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
</head>

<body class="black">
 <div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <div class="s12 m12 l12 xl12 grey lighten-5">
    <header>
	   <h3 class="center">Administraci�n</h3>
	</header>
   </div>
   
   <div class="col s12 m6 l6 xl6">
   <section>
    <ul class="collection">
     <li class="collection-item dismissable">
	  <div>Caja<a href="cajap.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
	 <li class="collection-item dismissable">
	  <div>Productos<a href="producto.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
     <li class="collection-item dismissable">
	  <div>Usuarios<a href="usuarios.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
	 <li class="collection-item dismissable">
	  <div>Inventario<a href="inventario.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
	  <li class="collection-item dismissable">
	  <div>Proveedores<a href="proveedores.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
     <li class="collection-item dismissable">
	  <div>Salir<a href="logout.php" class="secondary-content"><i class="fa fa-sign-out fa-2x"></i></a></div>
	 </li>
      </ul>
	 </section> 
   </div>     
	 
    <div class="col s12 m6 l6 xl6">
   <section>
    <ul class="collection">
     <li class="collection-item dismissable">
	  <div>Reporte De Corte<a href="ver_corte.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
	 <li class="collection-item dismissable">
	  <div>Reporte De Ventas<a href="ver_venta.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
	 <li class="collection-item dismissable">
	  <div>Reporte De Ventas Detallado<a href="Reportes/ReporteProductosDetalle.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
     <li class="collection-item dismissable">
	  <div>Surtir<a href="surtir.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
	 <li class="collection-item dismissable">
	  <div>Clientes<a href="clientes.php" class="secondary-content"><i class="fa fa-arrow-right fa-2x"></i></a></div>
	 </li>
      </ul>
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

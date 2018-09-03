<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
//include "SimpleImage.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$usuario=$idU;
$id=$_GET['id'];

$consulta="SELECT * from proveedores where id_proveedor='$id'";
$resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
$res=mysql_fetch_assoc($resultado);
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
</head>

<!--inicio agregar nuevo producto-->
<?
$nombre=$_POST['nombres'];
if($nombre!="")
{
$dir=$_POST['direccion'];
$tel=$_POST['tel'];
$appaterno=$_POST['appaterno'];
$apmaterno=$_POST['apmaterno'];
$empresa=$_POST['empresa'];
$codigo=$_POST['codigobarras'];
$numext=$_POST['numext'];


 		  $consulta = "update proveedores set nombres='$nombre',ap_paterno='$appaterno',ap_materno='$apmaterno',empresa='$empresa'
,direccion='$dir',num_ext='$numext',telefono='$tel',codigo_barras='$codigo',id_alta_usuarios='$usuario',fecha=now()
WHERE id_proveedor=$id";
          $resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
				   echo"<script>alert(\"Proveedor Actualizado.\");</script>";
echo"<script>parent.location=\"proveedores.php\"; parent.cerrarV(); </script>";

}
?>
<!--fin agregrar nuevo producto-->


<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--inicio form--> 
   <div class="row">
    <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
	<a href="proveedores.php"><i class="fa fa-arrow-left fa-2x white-text"></i></a>
	<h4 align="center" class="center white-text">Editar Proveedor</h4>
	
	<!--campo nombre y direccion-->
      <div class="row">
        <div class="input-field col s4">
		  <i class="fa fa-user prefix white-text"></i>
          <input id="nombres" type="text"  name="nombres" class="validate white-text" value="<? echo $res['nombres'];?>" required>
          <label for="nombre" class="white-text">Nombres</label>
        </div>
		
		<div class="input-field col s4">
          <input id="appaterno" type="text" name="appaterno"  class="validate white-text" value="<? echo $res['ap_paterno'];?>" required>
          <label for="appaterno" class="white-text">Apellido Paterno</label>
        </div>
		       	  <!--inicio ap_materno-->
      <div class="input-field col s4">
          <input id="apmaterno" type="text" name="apmaterno"  class="validate white-text" value="<? echo $res['ap_materno'];?>" required>
          <label for="apmaterno" class="white-text">Apellido Materno</label>
        </div>
	   <!--fin campo ap_materno--> 
	  </div>
	  <!--fin campo nombre y direccion-->
	  

	 
	  <!--campo telefono y correo-->
	  <div class="row">

		
       <!--codigo telefono-->
        <div class="input-field col s6">
		  <i class="fa fa-phone prefix white-text"></i>
		  <input id="tel" type="text" name="tel" class="validate white-text" value="<? echo $res['telefono'];?>" required />
		  <label for="tel" class="white-text">Telefono</label>
        </div>
      <!--fin codigo telefono--> 
	  
	  	  <!--inicio direccion-->
	      <div class="input-field col s6">
          <input id="direccion" type="text" name="direccion"  class="validate white-text" value="<? echo $res['direccion'];?>" required>
          <label for="direccion" class="white-text">Dirección</label>
        </div>
	   <!--fin campo ap_materno-->
	  </div> 
	   <!--fin campo telefono y correo-->
      
	  <!--campo proveedor y costo-->
	  <div class="row">
	  
	
	    	  <!--inicio empresa-->
	      <div class="input-field col s4">
          <input id="empresa" type="text" name="empresa"  class="validate white-text" value="<? echo $res['empresa'];?>" required>
          <label for="empresa" class="white-text">Empresa</label>
        </div>
	   <!--fin campo empresa-->

	  
		
	     <!--inicio codigo_barras-->
		 <div class="input-field col s4">
          <input id="codigobarras" type="text" name="codigobarras" class="validate white-text"  value="<? echo $res['codigo_barras'];?>" required>
          <label for="codigobarras" class="white-text">Codigo De Barras</label>
        </div>
	   <!--fin campo password-->
	   
	    <div class="input-field col s4">
          <input id="numext" type="text" name="numext" class="validate white-text" value="<? echo $res['num_ext'];?>" required>
          <label for="numext" class="white-text">Numero Exterior</label>
        </div>
	  </div>

	  <!--boton guardar-->
      <div class="row">
        <div class="input-field col s2 offset-s4 xl2 offset-xl5">
          <button class="btn waves-effect waves-light teal" type="submit" name="enviar">Guardar
          </button>
        </div>
      </div>
     <!--fin boton guardar-->
  
    </form>
  </div>
  <!--fin form-->      
  
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>


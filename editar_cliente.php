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
	if($id!="")
	{
		$querycliente="select * from clientes where id_cliente='$id'";
		$result = mysql_query($querycliente) or print("<script>alert('Error al editar');</script>");
		$res=mysql_fetch_assoc($result);
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
</head>

<!--inicio agregar nuevo cliente-->
<?
$nombre=$_POST['nombre'];
if($nombre!="")
{
$apaterno=$_POST['apaterno'];
$amaterno=$_POST['amaterno'];
$calle=$_POST['calle'];
$col=$_POST['colonia'];
$num=$_POST['numext'];
$cod=$_POST['codpostal'];
$tel=$_POST['telcasa'];
$cel=$_POST['celular'];


$consulta = "UPDATE clientes SET nombres='$nombre',ap_paterno='$apaterno',ap_materno='$amaterno',calle='$calle',colonia='$col',num_ext='$num',cod_postal='$cod',tel_casa='$tel',tel_cel='$cel' where id_cliente='$id'";
          $resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
				   echo"<script>alert(\"Cliente Modificado.\");</script>";


}
?>
<!--fin agregrar nuevo producto-->


<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--inicio form--> 
   <div class="row">
    <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
	<h4 align="center" class="center white-text">Editar Cliente</h4>
	
	<!--campo nombre-->
      <div class="row">
        <div class="input-field col s4">
          <input id="nombre" type="text"  name="nombre" class="validate white-text" value="<? echo $res['nombres']?>" required>
          <label for="nombre">Nombre(s)</label>
		</div>
		  
		<div class="input-field col s4">
          <input id="apaterno" type="text"  name="apaterno" class="validate white-text" value="<? echo $res['ap_paterno']?>" required>
          <label for="nombre">Apellido Paterno</label>
		</div>
		  
		<div class="input-field col s4"> 
          <input id="amaterno" type="text"  name="amaterno" class="validate white-text" value="<? echo $res['ap_materno']?>" required>
          <label for="nombre">Apellido Materno</label>
        </div>
		
	  </div>
	  <!--fin campo nombre-->
	  
	  <!--datos direccion-->
	   <div class="row">
        <div class="input-field col s4">
          <input id="calle" type="text"  name="calle" class="validate white-text" value="<? echo $res['calle']?>" required>
          <label for="nombre">Calle</label>
		</div>
		  
		<div class="input-field col s4">
          <input id="colonia" type="text"  name="colonia" class="validate white-text" value="<? echo $res['colonia']?>" required>
          <label for="nombre">Colonia</label>
		</div>
		  
		<div class="input-field col s4"> 
          <input id="numext" type="text"  name="numext" class="validate white-text"  value="<? echo $res['num_ext']?>" required>
          <label for="nombre">Numero Exterior</label>
        </div>
		
	  </div>
	  <!--fin datos direccion-->
	  
	  	  <!--datos telefonos-->
	   <div class="row">
        <div class="input-field col s4">
          <input id="codpostal" type="text"  name="codpostal" class="validate white-text" value="<? echo $res['cod_postal']?>" required>
          <label for="nombre">Codigo Postal</label>
		</div>
		  
		<div class="input-field col s4">
          <input id="telcasa" type="text"  name="telcasa" class="validate white-text" value="<? echo $res['tel_casa']?>" required>
          <label for="nombre">Telefono Casa</label>
		</div>
		  
		<div class="input-field col s4"> 
          <input id="celular" type="text"  name="celular" class="validate white-text" value="<? echo $res['tel_cel']?>" required>
          <label for="nombre">Telefono Celular</label>
        </div>
		
	  </div>
	  <!--fin datos telefonos-->
	  
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

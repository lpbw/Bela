<?
session_start();
include "checar_sesion_admin.php";
include "coneccion.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$id=$idU;

if($_POST['button']=="Confirmar"){
	$contra=$_POST['nuevopass'];
	
	
		$pass= sha1($contra);
		
	$query="UPDATE usuarios SET password='$pass' where id_usuarios=$id";
	$consulta=mysql_query($query)or die("Error al actualizar password: ".mysql_error());
	if(mysql_affected_rows()>0){
		echo"<script>alert(\"El Password ha sido actualizado\");</script>";
		echo"<script>parent.location=\"cajap.php\";</script>";
		}
	else
		echo"<script>parent.location=\"cajap.php\";</script>";
}
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<title>bela</title>
<script>
	function validar(){
		if(document.form1.nuevopass.value!=document.form1.confirmarpass.value){
			alert("No coincide las contraseñas!\nFavor de ingresar nuevamente los datos.");
			document.form1.reset();
			document.form1.nuevopass.focus;
		}else
			document.form1.submit();
	}
</script>
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
   
      <div class="col s12 m12 l12 xl12">
	    <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
	      <h4 align="center" class="center white-text">Cambiar Password</h4>
		  
		  <!--inicio nuevo password-->
		 <div class="input-field col s6 m6 l6 xl6 offset-s3 offset-m3 offset-l3 offset-xl3">
		  <i class="material-icons prefix white-text">lock</i>
          <input id="nuevopass" type="password" name="nuevopass" class="validate">
          <label for="nuevopass" class="white-text">Nuevo password</label>
        </div>
	   <!--fin campo  nuevo password-->
	   
	   <!--inicio  confirmar password-->
		 <div class="input-field col s6 m6 l6 xl6 offset-s3 offset-m3 offset-l3 offset-xl3">
		  <i class="material-icons prefix white-text">lock</i>
          <input id="confirmarpass" type="password" name="confirmarpass" class="validate">
          <label for="confirmarpass" class="white-text">Confirmar password</label>
        </div>
	   <!--fin campo  confirmar password-->
	   
	   	  <!--boton guardar-->
      <div class="row">
        <div class="input-field col s2 offset-s4 xl2 offset-xl5">
          <input class="btn" name="button" type="submit" onclick="javascript:validar();" id="button" value="Confirmar" />
        </div>
      </div>
     <!--fin boton guardar-->
		</form>  
	  </div>
	  
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>

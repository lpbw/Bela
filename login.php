<?
session_start();
include "coneccion.php";
date_default_timezone_set("America/Chihuahua");
$date= date("Y/m/d H:i:s");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tienda</title>
 <!--Import Google Icon Font-->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <!--Import materialize.css-->
 <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <!--Let browser know website is optimized for mobile-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<!--verificar login-->
<?
$login=$_POST["login"];

if($login!=""){
		
		$pass=$_POST["pass"];
		$contra = sha1($pass);
		
		$consulta  = "SELECT * from usuarios where correo='$login' and password='$contra'";
		$resultado = mysql_query($consulta) or die("Error 1 $consulta <Br>".  mysql_error() );//. mysql_error()

		if(@mysql_num_rows($resultado)>=1){
                    $res=mysql_fetch_array($resultado,MYSQL_BOTH);
                    $_SESSION['usuario']=$res;
                    $_SESSION['idU']=$_SESSION['usuario']['id_usuarios'];
				
					$_SESSION['idA']=$_SESSION['usuario']['id_tipo_usuario'];
					$_SESSION['idSuc']=$_SESSION['usuario']['id_sucursal'];
            
						if($_SESSION['idA']=="1" || $_SESSION['idA']=="2"){	
						//Si el usuario es administrador o supervisor.
						echo"<script>window.location=\"principal.php\"</script>";
						}else
						{
						 //Si el usuario es cajero.
						 echo"<script>window.location=\"cajap.php\"</script>"; 
						}
					

		} else
                   { 
				   	echo"<script>alert(\"Usuario o password invalido\");</script>";
				   }
}
?>
<!--fin verificacion de login-->
<body class="teal">

  <div class="container"><!--contenedor-->
   <div class="row"><!--row login-->
   
   <form class="cyan lighten-2" id="form1" name="form1" method="post">
     <div class="row">
        <div class="input-field col s12  xl6 offset-xl4">
           <h4>Login to your account</h4>
        </div>
      </div>
	  
	 <div class="row"> 
        <div class="input-field col s6 offset-s2 xl4 offset-xl4">
		  <i class="material-icons prefix white-text">account_circle</i>
          <input id="email" type="text" name="login" class="validate">
          <label for="email" class="white-text">usuario</label>
        </div>
      </div>
	 
	<div class="row">
        <div class="input-field col s6 offset-s2 xl4 offset-xl4">
		  <i class="material-icons prefix white-text">lock</i>
          <input id="password" type="password" name="pass" class="validate">
          <label for="password" class="white-text">password</label>
        </div>
      </div>
	  
	  <div class="row">
        <div class="input-field col s4 m4 l4 xl4 offset-s4 xl2 offset-xl5">
          <button class="btn waves-effect waves-light teal" type="submit" name="enviar"><i class="fa fa-sign-in"></i>Login
          </button>
        </div>
      </div>
	  
	  <div class="row">
        <div class="input-field col s2 offset-s5 xl2 offset-xl5">
          
        </div>
      </div>
	 </form>
   </div><!--fin row login-->
  </div><!--fin contenedor-->
  
 <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>

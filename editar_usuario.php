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

$consulta="SELECT * from usuarios where id_usuarios='$id'";
$resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
$res=mysql_fetch_assoc($resultado);
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

<!--inicio agregar nuevo producto-->
<?
$nombre=$_POST['nombre'];
if($nombre!="")
{
$dir=$_POST['direccion'];
$tel=$_POST['tel'];
$correo=$_POST['email'];
$sucursal=$_POST['sucursal'];
$tipo=$_POST['tipo'];
$pass=$_POST['password'];
$contra = sha1($pass);


   /*     $busqueda="SELECT correo FROM usuarios WHERE correo='$correo'";
		$res = mysql_query($busqueda) or die("La consulta fallo: $busqueda".mysql_error());
		if(@mysql_num_rows($res)>0)
{
echo"<script>alert(\"EL correo ya esta en uso.\");</script>";
}
else{*/
		$consulta="UPDATE usuarios set id_sucursal='$sucursal',id_tipo_usuario='$tipo',correo='$correo',nombre='$nombre',direccion='$dir',telefono='$tel',id_alta_usuarios='$usuario',fecha=now()
where id_usuarios='$id'";

		$resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
          $resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
				   echo"<script>alert(\"Usuario Editado.\");</script>";
echo"<script>parent.location=\"usuarios.php\"; parent.cerrarV(); </script>";
/*}*/


}
?>
<!--fin agregrar nuevo producto-->


<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--inicio form--> 
   <div class="row">
    <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
	<a href="usuarios.php"><i class="fa fa-arrow-left fa-2x white-text"></i></a>
	<h4 align="center" class="center white-text">Editar Usuario</h4>
	
	<!--campo nombre y direccion-->
      <div class="row">
        <div class="input-field col s6">
		  <i class="fa fa-user prefix white-text"></i>
          <input id="nombre" type="text"  name="nombre" class="validate white-text" value="<? echo $res['nombre']; ?>" required>
          <label for="nombre">Nombre</label>
        </div>
		
		<div class="input-field col s6">
		  <i class="fa fa-address-book-o prefix white-text"></i>
          <input id="direccion" type="text" name="direccion"  class="validate white-text" value="<? echo $res['direccion']; ?>" required>
          <label for="direccion">Dirección</label>
        </div>
	  </div>
	  <!--fin campo nombre y direccion-->
	  
	  <!--campo telefono y correo-->
	  <div class="row">

       <!--codigo telefono-->
        <div class="input-field col s6">
		  <i class="fa fa-phone prefix white-text"></i>
		  <input id="tel" type="text" name="tel" class="validate white-text" value="<? echo $res['telefono']; ?>"required />
		  <label for="tel">Telefono</label>
        </div>
      <!--fin codigo telefono-->
	  
	  <!--inicio correo-->
		 <div class="input-field col s6">
		  <i class="fa fa-envelope-o prefix white-text"></i>
          <input id="email" type="email"  name="email" class="validate white-text" value="<? echo $res['correo']; ?>" required/>
          <label for="email">Correo</label>
        </div>
	   <!--fin campo correo-->
	   
	  </div> 
	   <!--fin campo telefono y correo-->
      
	  <!--campo proveedor y costo-->
	  <div class="row">
	  
	    <!--inicio select proveedor-->
	    <div class="input-field col s6">
          <select class="white-text" name="sucursal" id="sucursal" required>
		  <? $query1 = "SELECT * FROM usuarios 
		               join sucursales on usuarios.id_sucursal=sucursales.id_sucursal
					   where usuarios.id_usuarios='$id'";
                $result1 = mysql_query($query1) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_suc1 = mysql_fetch_assoc($result1)){?>
            <option value="<? echo $res_suc1['id_sucursal']; ?>" selected><? echo $res_suc1['nombre']?>(ACTUAL)</option>
			 <?
               }
             ?>
             <? $query = "SELECT * FROM sucursales";
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_suc = mysql_fetch_assoc($result)){?>
		    <option value="<? echo $res_suc['id_sucursal']?>"><? echo $res_suc['nombre']?></option>
		     <?
               }
             ?>
			
          </select>
          <label for="sucursal">Sucursal</label>
         </div>
		 <!--fin select proveedor-->
		 
		 
	      <!--campo proveedor y costo-->
	  <div class="row">
	  
	    <!--inicio select tipo usuario-->
	    <div class="input-field col s6">
          <select class="white-text" name="tipo" id="tipo" required>
		   <? $query2 = "SELECT * FROM usuarios
		       join tipo_usuario on usuarios.id_tipo_usuario=tipo_usuario.id_tipo_usuario
			   where usuarios.id_usuarios='$id'";
                $result2 = mysql_query($query2) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_suc2 = mysql_fetch_assoc($result2)){?>
            <option value="<? echo $res_suc2['id_tipo_usuario']; ?>" selected><? echo $res_suc2['nombre']?>(ACTUAL)</option>
              <?
               }
             ?>
			 
			 <? $query = "SELECT * FROM tipo_usuario";
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_suc = mysql_fetch_assoc($result)){?>
		    <option value="<? echo $res_suc['id_tipo_usuario']?>"><? echo $res_suc['nombre']?></option>
		     <?
               }
             ?>
			
          </select>
          <label for="tipo">Nivel Usuario</label>
         </div>
		 <!--fin select tipo usuario-->
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


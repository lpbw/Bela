<?
session_start();
include "coneccion.php";
//include "checar_sesion_admin.php";
include "SimpleImage.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$id=$_GET['id'];

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
<?

if($_FILES["file"]!="")
{

$consulta  = "SELECT id_producto FROM productos WHERE id_producto='$id'";
$resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
if(@mysql_num_rows($resultado)>=1){

	
				if ($_FILES["file"]["error"] > 0 )  {
  						echo "Error: " . $_FILES["file"]["error"] . "<br />";	
  				}else {	  
 	 					$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  					$nom="images/".$id."_".$_FILES["file"]["name"];
	 					$nom2="".$id."_".$_FILES["file"]["name"];
      					$image = new SimpleImage();
      					$image->load($_FILES["file"]["tmp_name"]);
      					$image->save($nom);	

						$consulta  = "update productos set foto='$nom2' where id_producto=$id";
						$resultado = mysql_query($consulta) or die("Error en operacion: " . mysql_error());		
  				}
				
				
     }				
  
				
echo"<script>alert(\"Producto actualizado.\");</script>";
echo"<script>parent.location=\"producto.php\"; parent.cerrarV(); </script>";
}

?>
<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--inicio form--> 
   <div class="row">
    <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
	<a href="producto.php"><i class="fa fa-arrow-left fa-2x white-text"></i></a>
	<h4 align="center" class="center white-text">Insertar Imagen a producto</h4>
	
	  <!--foto-->
      <div class="row">
       <div class="file-field input-field col s6">
        <div class="btn">
         <span><i class="fa fa-camera-retro fa-lg"></i></span>
         <input type="file"  required name="file" id="file" accept="image/jpg, image/jpeg, image/gif, image/png"/>
        </div>
	  </div>  
	 </div>
	 <!--fin foto-->
	
     <?	$query1="select foto from productos where id_producto=$id";
	    $resultad1= mysql_query($query1) or print("<option value=\"ERROR\">".mysql_error()."</option>");
		while($res3 = mysql_fetch_assoc($resultad1)){
		?>
		<img src="images/<? echo $res3['foto']?>" alt="" width="84" height="84">
		
	<? }?>
	  
     
	  
	  <!--boton guardar-->
      <div class="row">
        <div class="input-field col s2 offset-s4 xl2 offset-xl5">
          <button class="btn waves-effect waves-light teal" type="submit" name="enviar">Guardar Foto
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

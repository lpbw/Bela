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

$consulta="SELECT * from inventario where id_inventario='$id'";
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
 </script>
</head>

<!--inicio agregar nuevo producto-->
<?
$cantidad=$_POST['cantidad'];
if($cantidad!=0)
{
$minimo=$_POST['minimo'];
$maximo=$_POST['maximo'];

                
                       $consulta="UPDATE inventario SET cantidad='$cantidad',minimo='$minimo',maximo='$maximo' WHERE id_inventario='$id'";
                       $resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
					   if(mysql_affected_rows()>0){
				       echo"<script>alert(\"Inventario Actualizado.\");</script>";
                       echo"<script>parent.location=\"inventario.php\"; parent.cerrarV(); </script>";
					   }
	
}
?>
<!--fin agregrar nuevo producto-->


<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--inicio form--> 
   <div class="row">
    <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
	<h4 align="center" class="center white-text">Editar Inventario</h4>
	
	<!--campo nombre y precio-->
      <div class="row">
        <div class="input-field col s12">
		  <i class="fa fa-cubes prefix white-text"></i>
          <input id="cantidad" type="number"  name="cantidad" step="1" min="0" class="validate white-text" value="<? echo $res['cantidad']; ?>" required>
          <label for="nombre white-text">Cantidad</label>
        </div>
		
		<div class="input-field col s12">
		  <i class="fa fa-minus-square-o prefix white-text"></i>
          <input id="minimo" type="number" name="minimo" step="1" min="0" class="validate white-text" value="<? echo $res['minimo'];?>" required>
          <label for="precio white-text">Minimo</label>
        </div>
	  </div>
	  <!--fin campo nombre y precio-->
	  
	  <!--campo codigo de barras y costo-->
	  <div class="row">

       <!--codigo barras-->
        <div class="input-field col s12">
		  <i class="fa fa-plus-square-o prefix white-text"></i>
		  <input id="maximo" type="number" name="maximo" step="1" min="0" class="validate white-text" value="<? echo $res['maximo'];?>" required />
		  <label for="codigo white-text">Maximo</label>
        </div>
      <!--fin codigo barras-->
	  
	  <!--boton guardar-->
      <div class="row">
        <div class="input-field col s2 offset-s4 xl2 offset-xl5">
          <input class="btn" name="guardar" type="submit" id="guardar"  value="Guardar">
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


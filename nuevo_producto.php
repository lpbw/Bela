<?
session_start();
include "coneccion.php";
//include "checar_sesion_admin.php";
include "SimpleImage.php";

$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$usuario=$idU;
$ss=0;
$consulta_p  = "select * from productos where mas=1";
$resultado_p = mysql_query($consulta_p) or die("La consulta fall&oacute;P1:$consulta_p " . mysql_error());
while($res_p = mysql_fetch_assoc($resultado_p)){
$ss++;
}
if($ss==10){
echo"<script>alert('Actualmente ya tiene a diez productos en la lista de los mas vendidos, si desea agregar uno nuevo porfavor descarte uno antes');</script>";
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

<!--inicio agregar nuevo producto-->
<?
$nombre=$_POST['nombre'];
if($nombre!="")
{
$descripcion=$_POST['descripcion'];
//$tipo=$_POST['tipo'];
$precio=$_POST['precio'];
$proveedor=$_POST['proveedor'];
$codigo_barras=$_POST['codigo'];
$costo=$_POST['costo'];
$cantidad=$_POST['cantidad'];
$pref=$_POST['pref'];
$mas=$_POST['m'];
$m=0;

	if($mas=="on"){
	  if($ss<10){
		$m=1;
		}
	}
		$consulta  = "INSERT INTO productos(id_proveedor,nombre,descripcion,precio,codigo_barras,costo,id_usuarios,fecha,mas,pref)
		              VALUES('$proveedor','$nombre','$descripcion','$precio','$codigo_barras','$costo','$usuario',now(),$m,'$pref')";
		$resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
		$id=mysql_insert_id();//devuelve el id de lo que se acaba de insertar

	$consulta2  = "select * from sucursales order by id_sucursal";
	$resultado2 = mysql_query($consulta2) or die("La consulta fallo: $consulta2".mysql_error());
	while($res2=mysql_fetch_assoc($resultado2)){
	
		$consulta3= "INSERT INTO inventario(id_sucursal,id_producto,cantidad,minimo,maximo)
		              VALUES({$res2['id_sucursal']},'$id','$cantidad',0,0)";
		$resultado3 = mysql_query($consulta3) or die("La consulta fallo: $consulta3".mysql_error());
		
	}
	
				if ($_FILES["file"]["error"] > 0 )  {
  						echo "Error: " . $_FILES["file"]["error"] . "<br />";	
  				}else {	  
 	 					$allowed_ext = array("jpeg", "jpg", "gif", "png");
	  					$nom="images/".$id."_".$_FILES["file"]["name"];
	 					$nom2="".$id."_".$_FILES["file"]["name"];
      					$image = new SimpleImage();
      					$image->load($_FILES["file"]["tmp_name"]);
      					$image->save($nom);	

						$consulta4  = "update productos set foto='$nom2' where id_producto=$id";
						$resultado = mysql_query($consulta4) or die("Error en operacion: $consulta4" . mysql_error());		
  				}
				
  						
				
echo"<script>alert(\"Producto agregado.\");</script>";
echo"<script>parent.location=\"producto.php\"; parent.cerrarV(); </script>";
}
?>
<!--fin agregrar nuevo producto-->


<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--inicio form--> 
   <div class="row">
    <form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
	<a href="producto.php"><i class="fa fa-arrow-left fa-2x white-text"></i></a>
	<h4 align="center" class="center white-text">Nuevo producto</h4>
	
	<!--campo nombre y precio-->
      <div class="row">
        <div class="input-field col s6">
		  <i class="fa fa-product-hunt prefix white-text"></i>
          <input id="nombre" type="text"  name="nombre" class="validate white-text" required>
          <label for="nombre white-text">Nombre</label>
        </div>
		
		<div class="input-field col s6">
		  <i class="fa fa-usd prefix white-text"></i>
          <input id="precio" type="number" name="precio" step="0.01" min="1" class="validate white-text" required>
          <label for="precio white-text">Precio</label>
        </div>
	  </div>
	  <!--fin campo nombre y precio-->
	  
	  <!--campo codigo de barras y cantidad-->
	  <div class="row">

       <!--codigo barras-->
        <div class="input-field col s6">
		  <i class="fa fa-barcode prefix white-text"></i>
		  <input id="codigo" type="text" name="codigo" class="validate white-text" required />
		  <label for="codigo white-text">Codigo de barras</label>
        </div>
      <!--fin codigo barras-->
	  
	  <!--inicio cantidad-->
		 <div class="input-field col s6">
          <input id="cantidad" type="number"  min="1" name="cantidad" class="validate white-text" required/>
          <label for="cantidad white-text">Cantidad</label>
        </div>
	   <!--fin campo cantidad-->
	   
	  </div> 
	   <!--fin campo codigo de barras y cantidad-->
      
	  <!--campo proveedor y costo-->
	  <div class="row">
	  
	    <!--inicio select proveedor-->
	    <div class="input-field col s6">
          <select class="white-text" name="proveedor" id="proveedor" required>
            <option value="" selected>Selecciona un proveedor</option>
             <? $query = "CALL proveedor();";
                $result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_proveedor = mysql_fetch_assoc($result)){?>
		    <option value="<? echo $res_proveedor['id_proveedor']?>"><? echo $res_proveedor['nombre']?></option>
		     <?
               }
             ?>
			
          </select>
          <label>Proveedor</label>
         </div>
		 <!--fin select proveedor-->
		 
		 <!--inicio costo-->
		 <div class="input-field col s6">
		  <i class="fa fa-usd prefix white-text"></i>
          <input id="costo" type="number" step="0.01" min="1" name="costo" class="validate white-text" required/>
          <label for="costo white-text">Costo</label>
        </div>
		<!--fin costo-->
		
	  </div>
	  <!--fin campo proveedor y costo-->
	  
	  <!--campo tipo producto
	  <div class="row">
	    <div class="input-field col s12">
          <select>
            <option value="" disabled selected>Choose your option</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
          </select>
          <label>Materialize Select</label>
         </div>
	  </div>
	  fin campo tipo producto-->
	  
	  <!--foto-->
      <div class="row">
       <div class="file-field input-field col s1">
        <div class="btn">
         <span><i class="fa fa-camera-retro fa-lg"></i></span>
         <input type="file"  name="file" id="file" accept="image/jpg, image/jpeg, image/gif, image/png"/>
        </div>
	  </div>  
	 </div>
	 <!--fin foto-->
	

	  
       <!--campo descripcion-->
      <div class="row">
        <div class="input-field col s11 offset-s1">
          <textarea id="descripcion" class="materialize-textarea white-text" name="descripcion" required></textarea>
          <label for="descripcion white-text">Descripcion</label>
        </div>
      </div>
	  <!--fin campo descripcion-->
	  
	  <!--mas vendido-->
		<div class="row">
	  		<div class="col s2 m2">
				<input class="white-text" type="checkbox" name="m" id="m" />
				<label for="m">Mas vendido</label>
			</div>	
			<div class="col s2 m2 white-text">
				<label>Prefijo</label>
				<input type="text" name="pref" id="pref" maxlength="3"/>
				
			</div>
	    </div>
	  <!--fin mas vendido-->
	  
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

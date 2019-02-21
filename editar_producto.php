<?
  session_start();
  include "coneccion.php";
  include "checar_sesion_admin.php";

  $idU=$_SESSION['idU'];
  $idA=$_SESSION['idA'];
  $idSuc=$_SESSION['idSuc'];
  $usuario=$idU;
  $id=$_GET['id'];

  $ConsultaProductos="SELECT * from productos where id_producto='$id'";
  $ResultadoProductos = mysql_query($ConsultaProductos) or die("La consulta fallo: $ConsultaProductos".mysql_error());
  $res=mysql_fetch_assoc($ResultadoProductos);

  $ss=0;
  $consulta_p  = "select * from productos where mas=1";
  $resultado_p = mysql_query($consulta_p) or die("La consulta fall&oacute;P1:$consulta_p " . mysql_error());
  while($res_p = mysql_fetch_assoc($resultado_p))
  {
    $ss++;
  }
  if($ss==10)
  {
    echo"<script>alert('Actualmente ya tiene a diez productos en la lista de los mas vendidos, si desea agregar uno nuevo porfavor descarte uno antes');</script>";
  }
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
$nombre=$_POST['nombre'];
if($nombre!="")
{
$descripcion=$_POST['descripcion'];
//$tipo=$_POST['tipo'];
$precio=$_POST['precio'];
$proveedor=$_POST['proveedor'];
$codigo=$_POST['codigo'];
$costo=$_POST['costo'];
$cantidad=$_POST['cantidad'];
 $pref=$_POST['pref'];
$mas=$_POST['m'];
$m=0;
$Mayoreo = $_POST['mayoreo'];

	if($mas=="on"){
	  if($ss<10){
		$m=1;
		}
	}               
              $consulta="UPDATE productos set id_proveedor='$proveedor',nombre='$nombre',descripcion='$descripcion',precio='$precio',codigo_barras='$codigo',costo='$costo',id_usuarios='$usuario',fecha=now(),mas=$m,pref='$pref',mayoreo=$Mayoreo where id_producto='$id'";
              $resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
					    if(mysql_affected_rows()>0){
                $_SESSION['idprov1']=$proveedor;
                $_SESSION['idprod1']=$id;
				        echo"<script>alert(\"Producto Actualizado.\");</script>";
                echo"<script>parent.location=\"producto.php\"; parent.cerrarV(); </script>";
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
	<a href="producto.php"><i class="fa fa-arrow-left fa-2x white-text"></i></a>
	<h4 align="center" class="center white-text">Editar Producto</h4>
	
	<!--campo nombre y precio-->
      <div class="row">
        <div class="input-field col s6">
		  <i class="fa fa-product-hunt prefix white-text"></i>
          <input id="nombre" type="text"  name="nombre" class="validate white-text" value="<? echo $res['nombre']; ?>" required>
          <label for="nombre white-text">Nombre</label>
        </div>
		
		<div class="input-field col s6">
		  <i class="fa fa-usd prefix white-text"></i>
          <input id="precio" type="number" name="precio" step="0.01" min="1" class="validate white-text" value="<? echo $res['precio'];?>" required>
          <label for="precio white-text">Precio</label>
        </div>
	  </div>
	  <!--fin campo nombre y precio-->
	  
	  <!--campo codigo de barras y costo-->
	  <div class="row">

       <!--codigo barras-->
        <div class="input-field col s6">
		  <i class="fa fa-barcode prefix white-text"></i>
		  <input id="codigo" type="text" name="codigo" class="validate white-text" value="<? echo $res['codigo_barras'];?>"  />
		  <label for="codigo white-text">Codigo de barras</label>
        </div>
      <!--fin codigo barras-->
	   
	     		 <!--inicio costo-->
		 <div class="input-field col s6">
		  <i class="fa fa-usd prefix white-text"></i>
          <input id="costo" type="number" step="0.01" min="1" name="costo" class="validate white-text" value="<? echo $res['costo']; ?>" required/>
          <label for="costo white-text">Costo</label>
        </div>
		<!--fin costo-->
	  </div> 
	   <!--fin campo codigo de barras y costo-->
      
	
	  
	  
	  <!--campo proveedor-->
	  <div class="row">
	  
	    <!--inicio select proveedor-->
	    <div class="input-field col s6">
      <i class="fa fa-product-hunt prefix white-text"></i>
          <select class="white-text" name="proveedor" id="proveedor" required>
              <? 
                $query1 = "select * FROM proveedores";
                $result1 = mysql_query($query1) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                while($res_proveedor1 = mysql_fetch_assoc($result1))
                {
              ?>
                  <option value="<? echo $res_proveedor1['id_proveedor']?>" <?echo $res_proveedor1['id_proveedor']==$res['id_proveedor']?"selected":""; ?>><? echo $res_proveedor1['nombres']." ".$res_proveedor1['ap_paterno']." ".$res_proveedor1['ap_materno']?></option>
              <?
                }
              ?>	
          </select>
          <label>Proveedor</label>
         </div>
		 <!--fin select proveedor-->

       
       <!-- precio mayoreo	 -->
       <div class="input-field col s6">
		      <i class="fa fa-usd prefix white-text"></i>
            <input id="mayoreo" type="number" name="mayoreo" step="0.01" min="1" class="validate white-text" value="<? echo $res['mayoreo'];?>" required>
            <label for="mayoreo white-text">Precio Mayoreo</label>
          </div>
	      </div>
       <!---------------------->
	  
	  <!--fin campo proveedor-->
	  
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
	    
       <!--campo descripcion-->
      <div class="row">
        <div class="input-field col s10 offset-s1">
          <textarea id="descripcion" class="materialize-textarea white-text" name="descripcion" required><? echo $res['descripcion']; ?></textarea>
          <label for="descripcion white-text">Descripcion</label>
        </div>
      </div>
	  <!--fin campo descripcion-->
    
	    <!--mas vendido-->
		<div class="row">
	  		<div class="col s2 m2">
				<input class="white-text" type="checkbox" name="m" id="m" <? echo $res['mas']==1?"checked":""; ?> />
				<label for="m">Mas vendido</label>
			</div>	
			<div class="col s2 m2 white-text">
				<label>Prefijo</label>
				<input type="text" name="pref" id="pref" maxlength="5" value="<? echo $res['pref'];?>"/>
				
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

<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
$idprov=0;
$idprod=0;
if( $_POST['buscar']=="Buscar")
{
$idprov=$_POST['proveedor'];
$idprod=$_POST['producto'];

}


?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<title>Clientes</title>
 <!--Import Google Icon Font-->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <!--Import materialize.css-->
 <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <link href="css/styles.css?template=xeug-03&colorScheme=green&header=headers2&button=buttons1" rel="stylesheet" type="text/css">
 <!--Let browser know website is optimized for mobile-->
 <link rel="stylesheet" href="colorbox.css" />
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>

<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <script>
 function borrar(id,nombre){
        if(confirm('Deseas eliminar el Cliente '+nombre+'?')){
            var elem = document.createElement('input');
            elem.name='idc';
            elem.value = id;
            elem.type = 'hidden';
            $("#form1").append(elem);
			
            $("#form1").attr('action','elimina_cliente.php');
            $("#form1").submit();
			
			alert('Cliente eliminado');
        }
    }
	//funcion para iframe
$(document).ready(function(){
		$(".iframe").colorbox({iframe:true,width:"550", height:"300",transition:"fade", scrolling:false, opacity:0.1});
		$(".iframe2").colorbox({iframe:true,width:"550", height:"680",transition:"fade", scrolling:true, opacity:0.1});
		$(".iframe3").colorbox({iframe:true,width:"800", height:"600",transition:"fade", scrolling:true, opacity:0.1});
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>
</head>

<body class="black">
<div class="container"><!--contenedor-->
   <div class="row"><!--filas-->
   
   <!--navegador-->
	   <nav class="col s12 m12 l12 xl12 cyan darken-4">
	    <div class="nav-wrapper cyan darken-4">
	   <!--menu-->
	    <a class="brand-logo center">Clientes</a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		 <ul class="left hide-on-med-and-down">
		  
		  <li><a href="principal.php"><i class="fa fa-arrow-left fa-2x"></i></a></li>
		 <? if($idA==1 || $idA==2)
		  {
		 ?>
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Administracion
		  <i class="material-icons right">arrow_drop_down</i>
		  </a>
		  </li>
		  <?
		  }
		  ?>
          <li><a href="logout.php"><i class="fa fa-sign-out"></i>Salir</a></li>
         </ul>
		 
		 <!--lista dropdwon-->
		 <ul id="dropdown1" class="dropdown-content">
		  <li><a href="cajap.php">Caja</a></li>
		  <li class="divider"></li>
          <li><a href="inventario.php">Inventario</a></li>
		  <li class="divider"></li>
          <li><a href="usuarios.php">Usuarios</a></li>
          <li class="divider"></li>
		  <li><a href="proveedores.php">Proveedores</a></li>
          <li class="divider"></li>
          <li><a href="principal.php">Administración</a></li>
         </ul>
        <!--fin lista dropdown-->

		 <!--fin menu-->
		 
		 <!--menu mobil
		 <ul id="mobile-demo" class="side-nav cyan lighten-2" >
		   <ul class="collapsible" data-collapsible="accordion">
            <li>
              <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
              <div class="collapsible-body"><ul>
			   <li>uno</li>
			  </ul></div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
           </li>
           <li>
             <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
             <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
           </li>
          </ul>
        </ul>
        fin menu mobil-->
		</div>
       </nav>
	<!--fin navegador-->
   <!--filtros-->
   <div class="col s12 xl12 white-text"> 
  <form name="form2" id="form2" method="post">
<!--aqui va un buscador-->
  </form>
  </div>
	
   <!--tabla-->
     <div class="col s12 xl12 white-text">
	 <form action="" id="form1" name="form1" method="post">
	     <table class="centered bordered white-text">
		    <thead>
			  <tr>
			    <th>Nombre</th>
				<th>Apellido Paterno</th>
				<th>Apellido Materno</th>
				<th>Codigo Postal</th>
				<th>Telefono Casa</th>
				<th>Telefono Celular</th>
				<th colspan="3"><a class="iframe3" href="nuevo_cliente.php"><i class="fa fa-plus"></i> Nuevo Cliente</a></th>
			  </tr>
			</thead>
			<tbody>
	<?
	 $query = ("SELECT * FROM clientes");
       $result = mysql_query($query) or die("La consulta fall&oacute;P1:$query " . mysql_error());
       while($res_prod = mysql_fetch_assoc($result))
	   {   
	?>		
          <tr>
            <td><? echo $res_prod['nombres']?></td>
            <td><? echo $res_prod['ap_paterno']?></td>
			<td><? echo $res_prod['ap_materno']?></td>
			 <td><? echo $res_prod['cod_postal']?></td>
			 <td><? echo $res_prod['tel_casa']?></td>
			 <td><? echo $res_prod['tel_cel']?></td>
			  <td><a class="iframe3" href="editar_cliente.php?id=<? echo $res_prod['id_cliente'];?>"><i class="fa fa-pencil fa-lg"></i></a></td>
	<td><a href="javascript:borrar(<? echo $res_prod['id_cliente'];?>,'<? echo $res_prod['nombres'];?>');"><i class="fa fa-trash-o fa-lg"></i></a></td>
          </tr>
       
		 <?
		   }
		 ?>
		  </tbody>
		 </table>
	</form> 
	<!--fin tabla-->
		 
	 </div>
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->


 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>


<?
	session_start();
	include "coneccion.php";
	include "checar_sesion_admin.php";
	$idU=$_SESSION['idU'];
	$idA=$_SESSION['idA'];
	$idSuc=$_SESSION['idSuc'];

	/**Obtener informacion de la tabla sucursales */
	$consulta_suc  = "select id_sucursal,nombre,direccion,ciudad from sucursales where id_sucursal=$idSuc";
	$resultado_suc = mysql_query($consulta_suc) or die("La consulta fall&oacute;P1:$consulta_suc " . mysql_error());
	$res_suc=mysql_fetch_assoc($resultado_suc);
	/**********************************************/

	/**Obtener informacion del usuario ***********/
	$consulta_us = "select id_usuarios,id_sucursal,id_tipo_usuario,correo,password,nombre,direccion,telefono,id_alta_usuarios,fecha from usuarios where id_usuarios=$idU";
	$resultado_us = mysql_query($consulta_us) or die("La consulta fall&oacute;P1:$consulta_us " . mysql_error());
	$res_us=mysql_fetch_assoc($resultado_us);
	/****************************************** */

	/** Guardar productos vendidos **************/
	if( $_POST['venta']=="Venta")
	{
		$cliente=$_POST['idcliente'];
		$id_tipo_venta =$_POST['id_tventa'];
		$precio =$_POST['precio'];
		$total=$_POST['total'];
		$efectivo=$_POST['efectivo'];
		$cambio=$_POST['cambio'];
		$idproducto =$_POST['idproducto'];
		$cantidad =$_POST['cantidad_d'] ;
		$mayoreo =$_POST['mayoreo'] ;
		$count=0;
		
		if(sizeof($idproducto)>0) //si no tiene productos
		{
			$tipo="";
			$max_venta="";
			$consulta  = "insert into ventas (id_usuarios,id_cliente,id_tipo_ventas,abono,fecha,total,efectivo,cambio,adeudo) values('$idU','$cliente','$id_tipo_venta',0,now(),'$total','$efectivo','$cambio','$total')";
			$resultado = mysql_query($consulta) or die("La consulta fall&oacute;P1:$consulta " . mysql_error());
			$id_venta=mysql_insert_id();
				
			foreach($idproducto as $a)
			{
				$consulta  = "insert into detalle_ventas (id_ventas,id_producto,cantidad,mayoreo) values($id_venta,$a, '$cantidad[$count]','$mayoreo[$count]')";
				$resultado = mysql_query($consulta) or die("Error en operacion1: $consulta " . mysql_error());	
				$consulta2  = "update inventario set cantidad=cantidad-$cantidad[$count] where id_producto=$a AND id_sucursal=$idSuc";
				$resultado2 = mysql_query($consulta2) or die("Error en operacion2:$consulta2 " . mysql_error());
				$count++;
			}
			echo"<script>alert(\"Compra realizada con Exito!!\");</script>";			
		}else{
			echo"<script>alert(\"Venta debe tener al menos un producto\");</script>";
		}
	}
	/***************************************** */

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
	<!-- <link href="css/styles.css?template=xeug-03&colorScheme=green&header=headers2&button=buttons1" rel="stylesheet" type="text/css"> -->
	<!--Let browser know website is optimized for mobile-->
	<link rel="stylesheet" href="colorbox.css" />
	<link rel="stylesheet" href="css/style_cajap.css">
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

	<script src="colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="js/Funciones_CajaP.js"></script>

	<link href='https://fonts.googleapis.com/css?family=Roboto:500,400,300,100&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!--<script src="https://code.jquery.com/jquery-2.1.4.js"></script>-->

	<link type="text/css" href="css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	

	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	</head>

	<body class="black">
	<div class="container"><!--contenedor-->
		<div class="row"><!--filas-->
		
		<!--navegador-->
		<div class="col s12 m12 l12 xl12 cyan darken-4">
			<nav class="col s12 m12 l12 xl12 cyan darken-4">
			<!--menu-->
			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
					<a href="cambia_pass.php" class="right">Cambiar mi password</a>
			<ul class="left hide-on-med-and-down">
			<? if($idA==1 || $idA==2)
				{
			?>
				<li><a href="principal.php"><i class="fa fa-arrow-left fa-2x"></i></a></li>
						<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Administracion
				<i class="material-icons right">arrow_drop_down</i>
				</a>
				</li>
				<?
				}
				?>
				<li><a href="corte.php"><i class="fa fa-money"></i>Corte</a></li>
						<li><a href="logout.php"><i class="fa fa-sign-out"></i>Salir</a></li>
					</ul>
			
			<!--lista dropdwon-->
			<ul id="dropdown1" class="dropdown-content">
						<li><a href="producto.php">Productos</a></li>
				<li class="divider"></li>
						<li><a href="usuarios.php">Usuarios</a></li>
						<li class="divider"></li>
				<li><a href="inventario.php">Inventario</a></li>
						<li class="divider"></li>
				<li><a href="proveedores.php">Proveedores</a></li>
						<li class="divider"></li>
						<li><a href="principal.php">Administraci�n</a></li>
					</ul>
					<!--fin lista dropdown-->
				</nav>
			</div>
		<!--fin navegador-->
		
			<!--encabezado-->
			<header>
				<div class="col s12 m12 x12 xl12 cyan darken-4"><?
				/**consultar la tabla inventarios y producto mas vendidos*/
				$consulta_p  = "SELECT p.id_producto,p.precio,p.mayoreo,p.descripcion,p.nombre FROM inventario i INNER JOIN productos p ON i.id_producto=p.id_producto WHERE p.mas=1";
				$resultado_p = mysql_query($consulta_p) or die("La consulta fall&oacute;P1:$consulta_p " . mysql_error());
				$ss=0; 
				while($res_p = mysql_fetch_assoc($resultado_p))
				{
					$ss++
				?>
					<div class="col s1 m1 chip white-text pink darken-4 centrar" id="<? echo "pref".$ss; ?>" onClick="insRow2('<? echo $res_p['id_producto'];?>')" style="cursor:pointer;">
						<? echo $res_p['descripcion'];?>
						<input type="hidden" id="idpref<? echo $res_p['id_producto']; ?>" name="idpref<? echo $res_p['id_producto']; ?>" value="<? echo $res_p['id_producto'];?>" />
						<input type="hidden" id="p<? echo $res_p['id_producto']; ?>" name="p<? echo $res_p['id_producto'];?>" value="<? echo $res_p['precio'];?>" />
						<input type="hidden" id="m<? echo $res_p['id_producto']; ?>" name="m<? echo $res_p['id_producto'];?>" value="<? echo $res_p['mayoreo'];?>" />
						<input type="hidden" id="d<? echo $res_p['id_producto']; ?>" name="d<? echo $res_p['id_producto'];?>" value="<? echo $res_p['descripcion'];?>" />
						<input type="hidden" id="n<? echo $res_p['id_producto']; ?>" name="n<? echo $res_p['id_producto'];?>" value="<? echo $res_p['nombre'];?>" />
					</div>
			<?}?>
			</div>
			</header>
		<!--fin encabezado-->
		
		<nav>
			<div class="col s12 m12 x12 xl12 cyan darken-4">
				<div class="col s3 m3 l3 xl3 white-text">
					Sucursal: <? echo $res_suc['nombre'];?>
				</div>
				<div class="col s3 m3 l3 xl3 white-text">
					Vendedor: <? echo $res_us['nombre'];?><br>
					<iframe src="sesionActiva.php" width="200" height="25" scrolling="no" style="display:none"></iframe>
				</div>
				<div class="col s3 m3 l3 xl3 white-text">
				<a href="cajap.php" target="_blank">Nueva Caja</a><a href="http://bluewolf.com.mx/bela/cajap.php" target="_blank" class="fa fa-window-restore"></a>
				</div>
				<div class="col s3 m3 l3 xl3 white-text">
					<input class="filled-in" type="checkbox" name="mayoreo" id="mayoreo" onClick="precio_mayoreo()"/><label for="mayoreo" style="color:#FFFFFF; margin-top:15px;">Mayoreo</label>
				</div>
			</div> 
		</nav>
		<!--seccion-->
		<section>
			<form class="col s12 m12 l12 xl12 cyan darken-4" action="" id="header" name="header" method="post" enctype="multipart/form-data">
			
			<div class="row"><!--fila de seleccion del producto-->
			<div><!--seleccion del producto-->	  
				<div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
					Cantidad
						</div>
						<div class="col s4 m4 l4 xl4 white-text pink darken-4 centrar">
					Productos
						</div>
						<div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
					Descripcion
						</div>
						<div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
					Precios
						</div>
						<div class="col s2 m2 l2 xl2 white-text pink darken-4 centrar">
					Codigo Barras
						</div>
				<div class="input-field col s2 m2 l2 xl2 white-text centrar">
					<input name="cantidad" type="number" id="cantidad" value="1" size="4" maxlength="3" min="1" class="validate centrar" required/>
						</div>
						<div class="input-field col s4 m4 l4 xl4 white-text " >
							<select class="mad-select cyan darken-4" name="lista_productos" id="lista_productos" onChange="showDes(lista_productos.value)">
								<option value="0" class="centrar">---- Seleccione Producto -----</option>
								<? $query = "SELECT 
											inv.id_inventario
													,inv.id_sucursal
													,inv.id_producto
													,inv.cantidad
													,inv.minimo
													,inv.maximo
													,pro.id_proveedor
													,pro.id_tipo_producto
													,pro.nombre
													,pro.descripcion
													,pro.precio
							,pro.mayoreo
							,pro.pref as prefijo
													,pro.foto
													,pro.codigo_barras
													,pro.costo
													FROM inventario inv 
													JOIN productos pro ON inv.id_producto=pro.id_producto 
							WHERE inv.id_sucursal=$idSuc
							ORDER BY pro.pref";//AND inv.cantidad>=1 ponerlo cuando el inventario este bien
									$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
									while($res_prod = mysql_fetch_assoc($result)){?>
								<option  value="<? echo $res_prod['id_producto']//0?>
					|<? echo $res_prod['nombre']//1?>
					|<? echo $res_prod['precio']//2?>
					|<? echo $res_prod['descripcion']//3?>
				|<? echo $res_prod['cantidad']//4?>
				|<? echo $res_prod['id_inventario']//5?>
				|<? echo $res_prod['maximo']//6?>
				|<? echo $res_prod['minimo']//7?>
				|<? echo $res_prod['mayoreo']//8?>
					|0"><? echo $res_prod['prefijo']." | ".$res_prod['nombre']?> </option>
								<?
								}
							?>
							</select>
						
						</div>
						<input name="cant" type="hidden" id="cant" value="0"/> 
				<div class="input-field col s2 m2 l2 xl2 white-text">
						<label id="descripcion" class="white-text"></label>
						</div>
						<div class="input-field col s2 m2 l2 xl2 white-text">
					<i class="fa fa-usd prefix white-text"></i>
						<label id="precio" name="precio" class="white-text">0</label>
						</div>
				<div class="input-field col s2 m2 l2 xl2 white-text">
				<a href="captura.php" class="iframe">
				<i class="fa fa-barcode fa-3x"></i>
				</a>
						</div>
						<div class="input-field col s2 offset-s4 xl2 offset-xl3">
						<input class="btn pink darken-4" name="agregar" type="button" id="agregar" onClick="insRow(lista_productos.value)" value="Agregar">
						</div>
		
				</div><!--fin seleccion del producto-->
			</div><!--fin fila de seleccion del producto-->
				
			<div class="row"><!--fila productos--> 	
			<div class="col s6 m6 l6 xl6">
			<article>
				<table width="50%" border="0" cellpadding="0" >
							<tr>
								<td width="5%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Cant</div></td>
								<td width="25%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Descripcion</div></td>
								<td width="6%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Precio</div></td>
								<td width="6%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center" class="style10">Subtotal</div></td>
								<td width="8%" bgcolor="#CCCCCC" class="style5 pink darken-4"><div align="center"></div></td>
							</tr>
				</table>
				<table width="50%" border="0" cellpadding="0" id="myTable">
							<tr>
								<td width="5%" class="style6"><div align="center"></div></td>
								<td width="25%" class="style6">&nbsp;</td>
								<td width="6%" class="style6">&nbsp;</td>
								<td width="6%" class="style6">&nbsp;</td>
								<td width="8%"><div align="center"></div></td>
							</tr>
						</table>
			</article>
			</div>
			
				<div class="col s6 m6 l6 xl6 cyan darken-4">
			<article>
				<div class="col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text pink darken-4">
					<label class="white-text">Cliente</label>
						</div>
				<div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text">
					<select class="mad-select cyan darken-4" name="lista_cliente" id="lista_cliente" onChange="showVen(this.value)">
					<? 
					$queryc2 = "SELECT id_cliente,nombres FROM clientes WHERE id_cliente=1";
								$resultc2 = mysql_query($queryc2) or print("<option value=\"ERROR\">".mysql_error()."</option>");
								while($res_cli2 = mysql_fetch_assoc($resultc2)){?>
						<option value="<? echo $res_cli2['id_cliente']?>|<? echo $res_cli2['nombres']?>"  selected><? echo $res_cli2['nombres']?></option>
					<? }?>
				<? 
					$queryc = "SELECT id_cliente,nombres,ap_paterno,ap_materno,calle FROM clientes 
										WHERE id_cliente>=2
										order by nombres";
								$resultc = mysql_query($queryc) or print("<option value=\"ERROR\">".mysql_error()."</option>");
								while($res_cli = mysql_fetch_assoc($resultc)){?>
								<option  value="<? echo $res_cli['id_cliente']?>|<? echo $res_cli['nombres']?>|<? echo $res_cli['ap_paterno']?>|<? echo $res_cli['ap_materno']?>|<? echo $res_cli['calle']?>|0"><? echo $res_cli['nombres']." ".$res_cli['ap_paterno']." ".$res_cli['ap_materno']?></option>
							<?
								}
							?>
						</select>
					<input name="idcliente" type="hidden" id="idcliente" value="1"/> 
						</div>
				<div class="col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text pink darken-4">
					<label class="white-text">Tipo De Venta</label>
						</div>
				<div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text left">
					<select class="mad-select cyan darken-4" name="lista_tipo_ventas" id="lista_tipo_ventas" onChange="showtv(this.value)">
				<? 
					$querytv2 = "SELECT * FROM tipo_ventas WHERE id_tipo_ventas=1";
								$resultv2 = mysql_query($querytv2) or print("<option value=\"ERROR\">".mysql_error()."</option>");
								while($res_tv2 = mysql_fetch_assoc($resultv2)){?>
						<option value="<? echo $res_tv2['id_tipo_ventas']?>|<? echo $res_tv2['nombre']?>"  selected><? echo $res_tv2['nombre']?></option>
				<? }?>
					<? 
					$querytv = "SELECT * FROM tipo_ventas WHERE id_tipo_ventas>=2";
								$resultv = mysql_query($querytv) or print("<option value=\"ERROR\">".mysql_error()."</option>");
								while($res_tv = mysql_fetch_assoc($resultv)){?>
							<option  value="<? echo $res_tv['id_tipo_ventas']?>|<? echo $res_tv['nombre']?>">
				<? echo $res_tv['nombre']?>
						</option>
							<?
								}
							?>
						</select>
					<input name="id_tventa" type="hidden" id="id_tventa" value="1"/>
				Nuevo Cliente <a class="iframe3" href="nuevo_cliente.php"><i class="fa fa-plus-circle"></i></a>
						</div>
				<div class="col s10 m10 l9 xl9 offset-l3 offset-xl3 white-text white-text pink darken-4">
						Cliente:
						<label id="cliente" name="cliente" class="white-text">Mostrador</label>
				<input class="btn" name="abonar" type="button" id="abonar" value="Abonar" onClick="abrir2()"/>
			<!-- <a href="producto_apartado.php" id="cli" class="iframe2" onclick="cambiarurl();">Producto Apartado</a>--> 
						</div>
				
				<div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
				Total:
					<input name="total" type="number" id="total" step="0.01" class="validate" readonly="true" value="0" required>
						</div>
				<div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
				Efectivo:
					<input name="efectivo" type="number" id="efectivo"  step="0.01"  onchange="hacer_click()" class="validate" value="0" onfocus="Estilo();" onkeypress="return PresionaEnter(event);"  required>
						</div>
				<div class="input-field col s6 m6 l6 xl6 offset-l3 offset-xl3 white-text ">
				Cambio:
					<input name="cambio" type="number" id="cambio" step="0.01"  class="validate" value="0"  readonly>
						</div>
				<div class="col s8 m8 l8 xl8 offset-l4 offset-xl4 white-text">
					<input  class="btn pink darken-4" name="venta" id="venta" type="submit" onClick="return valida();" value="Venta">
			<!--   <input  class="btn pink darken-4" name="imp" type="button" onClick="return imprim();" value="Ticket">-->
				<input name="cuantos" type="hidden" id="cuantos" value="0">
						</div>
			</article>
			</div>
			
			</div><!--fin fila productos-->
			<input name="sucur" id="sucur" value="<? echo $res_suc['nombre'];?>" type="hidden" /><!--sucursal para ticket-->
			<input name="vendedor" id="vendedor" value="<? echo $res_us['nombre'];?>" type="hidden" /><!--vendedor para ticket-->
			<input name="cli" id="cli" value="Mostrador" type="hidden" /><!--cliente para ticket-->
			<input name="pago" type="hidden" id="pago" value="Efectivo"/><!--pago para ticket-->
			</form>
		</section>
			<!-- fin seccion-->
		
			
		</div><!--fin filas-->
	</div><!--fin contenedor-->
		<!--Import jQuery before materialize.js-->
		<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/materialize2.js"></script>
	</body>
</html>
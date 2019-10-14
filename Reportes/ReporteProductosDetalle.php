<?
		include "../coneccion.php";
		include "../checar_sesion_admin.php";
		$idU=$_SESSION['idU'];
		$idA=$_SESSION['idA'];
		$idSuc=$_SESSION['idSuc'];
		// fecha desde
		$fecha=date('Y-m-d');
		// fecha hasta
		$fecha2=date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Detalle Ventas</title>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<!-- font awesom icon -->
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="../colorbox.css" />
	<link rel="stylesheet" href="../css/style_cajap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="../colorbox/jquery.colorbox-min.js" type="text/javascript"></script>	
	<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>

<link type="text/css" href="../css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<script>
	$(document).ready(function() {
		$( "#hasta" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#desde" ).datepicker({ dateFormat: 'yy-mm-dd' });
		Consulta();
		Exportar();
	});
	function Consulta(){
		Exportar();
		var data={buscar:1,desde:$('#desde').val(),hasta:$('#hasta').val(),producto:$('#prod').val()};
		$.ajax({
			url: 'ConsultasReporteProductoDetalle.php',
			method: 'post',
			data: data,
			success: function(respuesta) {
				$('#TablaProductos').html(respuesta);
			},
			error: function() {
        console.log("No se ha podido obtener la información");
    	}
		});
	}
	function Exportar() {
		$("#exportar").attr("href", "ExportarProductoDetalle.php?desde="+$('#desde').val()+"&hasta="+$('#hasta').val()+"&producto="+$('#prod').val());
	}
</script>
</head>
<body class="black">
	<!--contenedor-->
	<div class="container">
		<div class="row">
			<!--navegador-->
			<nav class="col s12 m12 l12 xl12 cyan darken-4">
				<!--menu-->
				<div class="nav-wrapper cyan darken-4">
					<a class="brand-logo center">Reporte Productos Detalle</a>
					<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
						<ul class="left hide-on-med-and-down">
							<!-- Regresar a menu ----------------------->
							<li>
								<a href="../principal.php">
									<i class="fa fa-arrow-left fa-2x"></i>
								</a>
							</li>
							<!----------------------------------------->

							<!-- Validar que el usuario sea del tipo administrador -->
							<?
							if($idA==1 || $idA==2){
							?>
								<li>
									<a class="dropdown-button" href="#!" data-activates="dropdown1">
										Administración
										<i class="material-icons right">arrow_drop_down</i>
									</a>
								</li>
							<?
							}
							?>
							<!-- -------------------------------------------------- -->

							<!-- Boton para salir del sistema -->
							<li>
								<a href="../logout.php">
									<i class="fa fa-sign-out"></i>Salir
								</a>
							</li>
							<!-- ---------------------------- -->
						</ul>
			
						<!--lista dropdwon-->
						<ul id="dropdown1" class="dropdown-content">
							<li><a href="../cajap.php">Caja</a></li>
							<li class="divider"></li>
							<li><a href="../inventario.php">Inventario</a></li>
							<li class="divider"></li>
							<li><a href="../usuarios.php">Usuarios</a></li>
							<li class="divider"></li>
							<li><a href="../proveedores.php">Proveedores</a></li>
							<li class="divider"></li>
							<li><a href="../principal.php">Administración</a></li>
						</ul>
						<!--fin lista dropdown-->
					</div>
					<!--fin menu-->
				</nav>
				<!--fin navegador-->
		</div>
		<!-- fin row -->
		
		<!-- row buscador -->
		<div class="row white-text">
			<div class="col s12 m12 l12 xl12">
				<div class="col s12 m3 l3 xl3 input-field">
					<label for="desde">Desde:</label>
					<input name="desde" type="text" class="datepicker" id="desde" size="10" maxlength="10" readonly value="<? echo"$fecha";?>"/>
				</div>
				<div class="col s12 m3 l3 xl3  input-field">
					<label for="hasta">Hasta:</label>
					<input name="hasta" type="text" class="datepicker" id="hasta" size="10" maxlength="10" readonly value="<? echo"$fecha2";?>"/>
				</div>
				<div class="col s12 m2 l2 xl2">
					<select class="mad-select black white-text" name="prod" id="prod">
						<option value="0" class="centrar">---- Seleccione Producto -----</option>
						<?php 
							$query = "SELECT * FROM productos";
                			$result = mysql_query($query) or print("<option value=\"ERROR\">".mysql_error()."</option>");
                			while($res_suc = mysql_fetch_assoc($result)){
						?>
		    					<option class="centrar" value="<? echo $res_suc['id_producto'];?>"><? echo $res_suc['nombre'];?></option>
		     			<?php
               				}
             			?>
					</select>
				</div>
				<div class="col s12 m2 l2 xl2">
					<a class="btn-floating btn-large waves-effect waves-light" onclick="Consulta();" alt="Buscar" title="Buscar"><i class="material-icons">search</i></a>
				</div>
				<div class="col s12 m2 l2 xl2">
					<a class="btn-floating btn-large waves-effect waves-light" id="exportar" alt="Exportar" title="Exportar"><i class="far fa-file-excel"></i></a>
				</div>
			</div>
		</div>
		<!-- fin row buscador -->
		<!-- row tabla -->
		<div class="row white-text" id="Reporte">
			<div class="col s12 m12 l12 xl12">
				<table class="centered bordered">
					<thead class="pink darken-4 white-text">
						<tr>
								<th>Fecha de venta</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio</th>
								<th>Mayoreo</th>
						</tr>
					</thead>

					<tbody id="TablaProductos">
					</tbody>
      	</table>
			</div>
		</div>
		<!-- fin row tabla -->


	</div>
	<!--fin contenedor-->

	<!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="../js/materialize.min.js"></script>
</body>
</html>
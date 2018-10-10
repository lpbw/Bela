<?php

//include "checar_sesion_admin.php";
include "coneccion.php";




    $query = "DELETE FROM detalle_ventas WHERE id_ventas = {$_POST['IdVenta']}";
    $result = mysql_query($query) or print("<script>alert('Error al eliminar');</script>");
	
	$query1 = "DELETE FROM ventas WHERE id_ventas = {$_POST['IdVenta']}";
    $result = mysql_query($query1) or print("<script>alert('Error al eliminar');</script>");
	

?>
<script>
    window.location = '<? echo $_SERVER['HTTP_REFERER'];?>';
</script>
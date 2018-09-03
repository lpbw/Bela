<?php

//include "checar_sesion_admin.php";
include "coneccion.php";




    $query = "DELETE FROM productos WHERE id_producto = {$_POST['id']}";
    $result = mysql_query($query) or print("<script>alert('Error al eliminar');</script>");
	
	if($_POST['foto']!=""){
	$imagen="images/{$_POST['foto']}";
	unlink($imagen); 
	}

?>
<script>
    window.location = '<? echo $_SERVER['HTTP_REFERER'];?>';
</script>
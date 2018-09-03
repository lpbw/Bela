<?php

//include "checar_sesion_admin.php";
include "coneccion.php";




    $query = "DELETE FROM clientes WHERE id_cliente = {$_POST['idc']}";
    $result = mysql_query($query) or print("<script>alert('Error al eliminar $query');</script>");
	

?>
<script>
    window.location = '<? echo $_SERVER['HTTP_REFERER'];?>';
</script>
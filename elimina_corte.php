<?php

//include "checar_sesion_admin.php";
include "coneccion.php";




    $query = "DELETE FROM corte WHERE id_corte = {$_POST['idc']}";
    $result = mysql_query($query) or print("<script>alert('Error al eliminar $query');</script>");
	

?>
<script>
    window.location = '<? echo $_SERVER['HTTP_REFERER'];?>';
</script>
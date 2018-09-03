<?php

include "checar_sesion_admin.php";
include "coneccion.php";


 

    $query = "DELETE FROM usuarios WHERE id_usuarios = {$_POST['id']}";
    $result = mysql_query($query) or print("<script>alert('Error al eliminar');</script>");

?>
<script>
    window.location = '<? echo $_SERVER['HTTP_REFERER'];?>';
</script>
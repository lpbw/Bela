<?php
    session_start();
	include "coneccion.php";
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];

    $query = "SELECT total FROM ventas WHERE DATE_FORMAT(fecha,'%Y-%m-%d') BETWEEN '$desde' AND '$hasta'";
    $resultado = mysql_query($query) or die("Error $query <Br>".mysql_error());
    $ventas = 0;
    while($res = mysql_fetch_assoc($resultado)){
        
        $ventas = $ventas + $res['total'];
    }
    echo $ventas;
?>
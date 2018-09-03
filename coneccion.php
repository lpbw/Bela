<?
	$enlace = mysql_connect('localhost','bluewol5_tienda','Mytienda11!');
	mysql_set_charset('utf8',$enlace);	
	if (!$enlace) { 
    die('Could not connect: ' . mysql_error()); 
	} 

	mysql_select_db("bluewol5_tienda") or die("No pudo seleccionarse la BD.");
	
?>
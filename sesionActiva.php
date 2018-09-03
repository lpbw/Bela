<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML><head>
 <!--Import Google Icon Font-->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <!--Import materialize.css-->
 <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
</head>
<script>
function auto_reload()
{
	window.location = 'sesionActiva.php';
}
</script>
<BODY class="cyan lighten-2" onLoad="timer = setTimeout('auto_reload()',100000);">
<?

if($_SESSION['idU']!='' && $_SESSION['idU']!="0")
{

	echo"Sesion Activa..";
}else
{
	echo"Sesion Caducada";
}
?>

</BODY>
</HTML>

<?
session_start();
include "coneccion.php";
include "checar_sesion_admin.php";
$idU=$_SESSION['idU'];
$idA=$_SESSION['idA'];
$idSuc=$_SESSION['idSuc'];
 // 1admin 2 cliente

date_default_timezone_set("America/Chihuahua");
setlocale(LC_TIME, 'es_ES.UTF-8');
setlocale(LC_TIME, 'spanish');  
$fecha=mb_convert_encoding (strftime("%A %d de %B del %Y"), 'utf-8');
$fecha2=date('Y-m-d');
$hora=date('H:i:s');

if($idA=="1" || $idA=="2")
{
$usuario=$idU;
$idA=$idA;
$idSuc=$idSuc;


$id=$_GET['id'];
$sucur=$_GET['suc'];
$usu=$_GET['usu'];
$fon=$_GET['fon'];
$tb=$_GET['tm'];
$tm=$_GET['tm'];
$ventas=$_GET['tot'];
$fech=$_GET['f'];

$consulta="SELECT * from corte where id_corte=$id";
$resultado = mysql_query($consulta) or die("La consulta fallo: $consulta".mysql_error());
$res=mysql_fetch_assoc($resultado);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tienda</title>
 <!--Import Google Icon Font-->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
 <!--Import materialize.css-->
 <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <!--Let browser know website is optimized for mobile-->
 <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<script>
//suma las monedas
function sumaM(){
 document.form1.totalm.value=(document.form1.m20.value*20*1+document.form1.m10.value*10*1+document.form1.m5.value*5*1+document.form1.m2.value*2*1+document.form1.m1.value*1*1+document.form1.mp5.value*.5*1);
}
//fin suma monedas

//Suma los billetes
function sumaP(){
document.form1.totalb.value=(document.form1.b1000.value*1000*1+document.form1.b500.value*500*1+document.form1.b200.value*200*1+document.form1.b100.value*100*1+document.form1.b50.value*50*1+document.form1.b20.value*20*1)
}
//fin suma de billetes
</script>
</head>

<body class="black">
<div class="container"><!--contenedor-->
   <div class="row" id="modal1"><!--filas-->
   
   <!--navegador-->
	   <nav class="col s12 m12 l12 xl12 cyan darken-4">
	    <div class="nav-wrapper cyan darken-4">
	   <!--menu-->
	    <a class="brand-logo center">Corte</a>
		</div>
       </nav>
	<!--fin navegador-->

	
   <!--tabla-->
     <div class="col s12 m12 l12 xl12 white-text"> 
	 <form action="" id="form1" name="form1" method="post">
	   <table>
         <tbody>
           <tr>
             <td class="pink darken-4 white-text">Billetes</td>
             <td class="pink darken-4 white-text">$1000</td>
             <td class="pink darken-4 white-text">$500</td>
             <td class="pink darken-4 white-text">$200</td>
             <td class="pink darken-4 white-text">$100</td>
             <td class="pink darken-4 white-text">$50</td>
             <td class="pink darken-4 white-text">$20</td>
           </tr>
           <tr>
             <td>No.Billetes</td>
             <td class="white-text">
			   <? echo $res['b1000']?>
             </td>
             <td class="white-text">
			   <? echo $res['b500']?>
             </td>
			 <td class="white-text">
			   <? echo $res['b200']?>
             </td>
			 <td class="white-text">
			   <? echo $res['b100']?>
             </td>
			 <td class="white-text">
			   <? echo $res['b50']?>
             </td>
			 <td class="white-text">
			   <? echo $res['b20']?>
             </td>
           </tr>
		    <tr>
             <td class="pink darken-4 white-text">Monedas</td>
             <td class="pink darken-4 white-text">$20</td>
             <td class="pink darken-4 white-text">$10</td>
             <td class="pink darken-4 white-text">$5</td>
             <td class="pink darken-4 white-text">$2</td>
             <td class="pink darken-4 white-text">$1</td>
             <td class="pink darken-4 white-text">$.50</td>
           </tr>
           <tr>
             <td>No.Monedas</td>
                          <td class="white-text">
			   <? echo $res['m20']?>
             </td>
             <td class="white-text">
			   <? echo $res['m10']?>
             </td>
			 <td class="white-text">
			   <? echo $res['m5']?>
             </td>
			 <td class="white-text">
			   <? echo $res['m2']?>
             </td>
			 <td class="white-text">
			   <? echo $res['m1']?>
             </td>
			 <td class="white-text">
			   <? echo $res['mp5']?>
             </td>
           </tr>
         </tbody>
       </table>
	 </form> 
	 </div>
	 <a href="exportar_corte.php?id=<? echo $id; ?>&suc=<? echo $sucur ?>&usu=<? echo $usu ?>&fon=<? echo $fon ?>&tm=<? echo $tm ?>&tb=<? echo $tb ?>&tot=<? echo $ventas ?>&f=<? echo $fech ?>" class="red-text"><b>Exportar</b></a>
	 <!--fin tabla-->
	 
   </div><!--fin filas-->
 </div><!--fin contenedor-->
  <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script type="text/javascript" src="js/materialize.min.js"></script>
 <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>
<? 
}else
{
echo"<script>window.location=\"login.php\"</script>";
}
?>

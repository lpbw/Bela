<?php
session_start();
include "coneccion.php";
include "checar_sesion.php";
include "checar_sesion_admin.php";

$idU=$_SESSION['idU'];
$nombreU=$_SESSION['nombreU'];
$tipoU=$_SESSION['tipoU'];
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

setlocale(LC_TIME, 'spanish');  
$fecha=mb_convert_encoding (strftime("%A %d de %B del %Y"), 'utf-8');

$hora=date("h:i A");

header("Content-type: application/vnd.ms-excel; name='excel'");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Disposition: filename=corte.xls");
?>   
       <table border="1">
	     <tbody>
           <tr>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Sucursal</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Usuario</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Fondo</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Total Monedas</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Total Billetes</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Total Ventas</td>
			 <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Fecha</td>
           </tr>
		   <tr>
               <td>
			   <? echo $sucur; ?>
			  </td>
             <td class="">
			   <? echo $usu; ?>
			 </td>
             <td class=""> <? echo $fon; ?></td>
             <td class=""> <? echo $tm; ?></td>
             <td class=""> <? echo $tb; ?></td>
             <td class=""> <? echo $ventas; ?></td>
			 <td class=""> <? echo $fech; ?></td>
           </tr>
		  </tbody>
	   </table>
	   <table border="1">
         <tbody>
           <tr>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Billetes</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$1000</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$500</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$200</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$100</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$50</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$20</td>
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
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">Monedas</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$20</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$10</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$5</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$2</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$1</td>
             <td bgcolor="#CCCCCC" class="pink darken-4 white-text">$.50</td>
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
			  </table>

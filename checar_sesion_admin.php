<?
session_start();

if ($_SESSION['idU']=="" || !$_SESSION['idU'] ){
	include "login.php";
exit();
}
?>
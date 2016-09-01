<?php  	
	include("config_local.php");
	$db = mysql_connect($Servidor,$Usuario,$Password) or die ("Error al conectar con el servidor");
	mysql_select_db($BaseDeDatos)or die("Error al conectar con la base de datos"); 
	
	mysql_query("SET NAMES 'ISO 8859-1'");
?>

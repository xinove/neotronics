<?php
	$dbuser="root";
	$dbpass="toor";
	$dbname="neotronics_db";
	$database="neotronics_db";
	$chandle = mysql_connect("localhost:3308", $dbuser, $dbpass) or die("Error conectando a la BBDD");
	echo "Conectado correctamente";
	mysql_select_db($dbname, $chandle);
	echo "Base de datos " . $database . " seleccionada";
	mysql_close($chandle);
?>
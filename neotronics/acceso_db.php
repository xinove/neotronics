<?php
	$host_db = "localhost:3308"; // Host de la BD
	$usuario_db = "root"; // Usuario de la BD
	$clave_db = "toor"; // Contraseña de la BD
	$nombre_db = "neotronics_db"; // Nombre de la BD
	mysql_connect($host_db, $usuario_db, $clave_db);
	mysql_select_db($nombre_db);
?>
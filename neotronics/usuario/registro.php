
<script type="text/javascript" src="js/calendar-1.5.min.js">
var cal_1 = new Calendar({
        element: 'inlineCalendar',
        inline: true,
        months: 3,
        dateFormat: 'm/d/Y',
        onSelect: function (element, selectedDate, date, cell) {
                //do something
        }
});
</script>
<?php 
	require_once('classes/tc_date.php');
	require_once('classes/tc_calendar.php');
    include('acceso_db.php'); // incluimos el archivo de conexión a la Base de Datos 
    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos desde el formulario 
        // creamos una función que nos parmita validar el email 
        function valida_email($correo) { 
            
        	if (filter_var($correo, FILTER_VALIDATE_EMAIL)) 
   				return true;
            else 
            	return false;
            	 
        } 
        // Procedemos a comprobar que los campos del formulario no estén vacíos 
        $sin_espacios = count_chars($_POST['usuario_alias'], 1); 
        if(!empty($sin_espacios[32])) { // comprobamos que el campo usuario_alias no tenga espacios en blanco 
            echo "El campo <em>usuario_alias</em> no debe contener espacios en blanco. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif(empty($_POST['usuario_alias'])) { // comprobamos que el campo usuario_alias no esté vacío 
            echo "No haz ingresado tu usuario. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif(empty($_POST['usuario_clave'])) { // comprobamos que el campo usuario_clave no esté vacío 
            echo "No haz ingresado contraseña. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif($_POST['usuario_clave'] != $_POST['usuario_clave_conf']) { // comprobamos que las contraseñas ingresadas coincidan 
            echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>"; 
        }elseif(!valida_email($_POST['usuario_email'])) { // validamos que el email ingresado sea correcto 
            echo "El email ingresado no es válido.<a href='javascript:history.back();'>Reintentar</a>"; 
        }else { 
            // "limpiamos" los campos del formulario de posibles códigos maliciosos 
            $usuario_alias = mysql_real_escape_string($_POST['usuario_alias']); 
            $usuario_clave = mysql_real_escape_string($_POST['usuario_clave']); 
            $usuario_email = mysql_real_escape_string($_POST['usuario_email']); 
            $usuario_telefono = mysql_real_escape_string($_POST['$usuario_telefono']); 
            $usuario_nac = mysql_real_escape_string($_POST['$usuario_nac']); 
            $usuario_dni = mysql_real_escape_string($_POST['$usuario_dni']); 
            $usuario_sex = mysql_real_escape_string($_POST['$usuario_sex']); 
            $usuario_nombre = mysql_real_escape_string($_POST['$usuario_nombre']); 
            $usuario_apellidos = mysql_real_escape_string($_POST['$usuario_apellidos']); 
            $usuario_direccion = mysql_real_escape_string($_POST['$usuario_direccion']); 
            $usuario_pais = mysql_real_escape_string($_POST['$usuario_pais']); 
            // comprobamos que el usuario ingresado no haya sido registrado antes 
            $sql = mysql_query("SELECT usuario FROM usuarios WHERE usuario='".$usuario_alias."'"); 
            if(mysql_num_rows($sql) > 0) { 
                echo "El nombre usuario elegido ya ha sido registrado anteriormente. <a href='javascript:history.back();'>Reintentar</a>"; 
            }else { 
                $usuario_clave = md5($usuario_clave); // encriptamos la contraseña ingresada con md5 
                // ingresamos los datos a la BD 
                $today= date("Y-m-d H:i:s");  
                //$reg = mysql_query("INSERT INTO usuarios (usuario, password, email, fecha_alta, fecha_ult_acceso, id_grupo_fk) VALUES ('".$usuario_alias."', '".$usuario_clave."', '".$usuario_email."', '".$today."', '".$today."', 3)");
                $result = mysql_query("CALL hera_db.nuevoUsuario('".$usuario_nombre."','".$usuario_apellidos."', '".$usuario_alias."', '".$usuario_clave."','".$usuario_direccion."','"
                		.$usuario_telefono."','".$usuario_pais."', '".$usuario_email."', '".$usuario_nac."','".$usuario_dni."','".$usuario_sex."', 3)"); //or die("Query fail: " . mysqli_error());
                
                
                //loop the result set
                while ($row = mysqli_fetch_array($result)){
                	echo $row[0] . " - " . + $row[1];
                	$reg = $row[1];
                }
                if($reg) { 
                    echo "Datos ingresados correctamente."; 
                }else { 
                    echo "ha ocurrido un error y no se registraron los datos."; 
                }

            } 
        } 
    }else { 
?> 
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
    	<label>Nombre:</label><br /> 
        <input type="text" name="usuario_nombre" maxlength="30" /><br />
         <label>Apellidos:</label><br /> 
        <input type="text" name="usuario_apellidos" maxlength="30" /><br />
        <label>Usuario:</label><br /> 
        <input type="text" name="usuario_alias" maxlength="15" /><br /> 
        <label>Contraseña:</label><br /> 
        <input type="password" name="usuario_clave" maxlength="15" /><br /> 
        <label>Confirmar Contraseña:</label><br /> 
        <input type="password" name="usuario_clave_conf" maxlength="15" /><br /> 
        <label>Dirección:</label><br /> 
        <input type="text" name="$usuario_direccion" maxlength="80" /><br /> 
        <label>Fecha Nacimiento:</label><br /> 

<?php
	  $myCalendar = new tc_calendar("date5", true, false);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath("calendar/");
	  $myCalendar->setYearInterval(2000, 2015);
	  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
	  $myCalendar->setDateFormat('j F Y');
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
	  $myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
	  $myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
	  $myCalendar->writeScript();
	  ?>
	  
	  
        <label>DNI:</label><br /> 
        <input type="text" name="$usuario_dni" maxlength="15" /><br /> 
        <label>Sexo:</label><br /> 
        <input type="text" name="$usuario_sex" maxlength="15" /><br /> 
        <label>Email:</label><br /> 
        <input type="text" name="usuario_email" maxlength="50" /><br /> 
        <label>País:</label><br /> 
        <input type="text" name="usuario_email" maxlength="50" /><br /> 
        
        
        
        <input type="text" name="usuario_pais" maxlength="30" /><br />
        <label>Teléfono:</label><br /> 
        <input type="text" name="usuario_telefono" maxlength="30" /><br />
        <input type="submit" name="enviar" value="Registrar" /> 
        <input type="reset" value="Borrar" /> 
    </form> 
<?php 
    } 
?>
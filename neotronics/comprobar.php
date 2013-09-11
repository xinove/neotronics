<?php 
    session_start(); 
    include('acceso_db.php'); 
	if(isset($_POST['usuario_nombre']) || isset($_POST['usuario_clave'])){ // comprobamos que se hayan enviado los datos del formulario 
        // comprobamos que los campos usuarios_nombre y usuario_clave no estén vacíos 
        if(empty($_POST['usuario_nombre']) || empty($_POST['usuario_clave'])) { 
            echo "El usuario o la contraseña no han sido ingresados. <a href='javascript:history.back();'>Reintentar</a>"; 
        }else { 
            // "limpiamos" los campos del formulario de posibles códigos maliciosos 
            $usuario_nombre = mysql_real_escape_string($_POST['usuario_nombre']); 
            $usuario_clave = mysql_real_escape_string($_POST['usuario_clave']); 
            $usuario_clave = md5($usuario_clave); 
            // comprobamos que los datos ingresados en el formulario coincidan con los de la BD
            $sql = mysql_query("SELECT id_usuario, usuario, password FROM usuarios WHERE usuario='".$usuario_nombre."' AND password='".$usuario_clave."'"); 
            if($row = mysql_fetch_array($sql)) { 
                $_SESSION['usuario_id'] = $row['id_usuario']; // creamos la sesion "usuario_id" y le asignamos como valor el campo usuario_id 
                $_SESSION['usuario_nombre'] = $row["usuario"];
                // creamos la sesion "usuario_nombre" y le asignamos como valor el campo usuario_nombre 
                header("Location: acceso.php"); 
            }else { 
            	error_log("Oracle database not available! usuario: ".$usuario_nombre." contraseña:".$usuario_clave, 0);
?> 
                Error1, <a href="acceso.php">Reintentar </a> 
<?php 
            } 
        } 
    }else { 
         header("Location: acceso.php"); 
         header("Location: registro.php");
    	?>
    	Error2, <a href="acceso.php">Reintentar<?php $_POST['usuario_nombre']?></a> 
    	<?php 
    } 
?>
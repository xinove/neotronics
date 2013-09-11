<?php 
    include('acceso_db.php'); // incluímos los datos de acceso a la BD 
    if(isset($_POST['enviar'])) { // comprobamos que se han enviado los datos del formulario 
        if(empty($_POST['usuario_nombre'])) { 
           echo "No ha ingresado el usuario. <a href='javascript:history.back();'>Reintentar</a>"; 
        }else { 
            $usuario_nombre = mysql_real_escape_string($_POST['usuario_nombre']); 
            $usuario_nombre = trim($usuario_nombre); 
            echo "Usuario : ".$usuario_nombre;
            $sql = mysql_query("SELECT usuario, password, email FROM usuarios WHERE usuario='".$usuario_nombre."'"); 
           if(mysql_num_rows($sql)) { 
                $row = mysql_fetch_assoc($sql); 
                $num_caracteres = "10"; // asignamos el número de caracteres que va a tener la nueva contraseña 
                $nueva_clave = substr(md5(rand()),0,$num_caracteres); // generamos una nueva contraseña de forma aleatoria 
                $usuario_nombre = $row['usuario']; 
                $usuario_clave = $nueva_clave; // la nueva contraseña que se enviará por correo al usuario 
                $usuario_clave2 = md5($usuario_clave); // encriptamos la nueva contraseña para guardarla en la BD 
                $usuario_email = $row['email']; 
                // actualizamos los datos (contraseña) del usuario que solicitó su contraseña 
                mysql_query("UPDATE usuarios SET password='".$usuario_clave2."' WHERE nombre='".$usuario_nombre."'"); 
                // Enviamos por email la nueva contraseña 
                $remite_nombre = ""; // Tu nombre o el de tu página 
                $remite_email = ""; // tu correo 
                $asunto = "Recuperación de contraseña"; // Asunto (se puede cambiar) 
                $mensaje = "Se ha generado una nueva contraseña para el usuario <strong>".$usuario_nombre."</strong>. La nueva contraseña es: <strong>".$usuario_clave."</strong>."; 
                $cabeceras = "From: ".$remite_nombre." <".$remite_correo.">rn"; 
                 $cabeceras = $cabeceras."Mime-Version: 1.0n"; 
                $cabeceras = $cabeceras."Content-Type: text/html"; 
                $enviar_email = mail($usuario_email,$asunto,$mensaje,$cabeceras); 
                if($enviar_email) { 
                    echo "La nueva contraseña ha sido enviada al email asociado al usuario ".$usuario_nombre."."; 
                }else { 
                    echo "No se ha podido enviar el email. <a href='javascript:history.back();'>Reintentar</a>"; 
                } 
            }else { 
                echo "El usuario <strong>".$usuario_nombre."</strong> no está registrado. <a href='javascript:history.back();'>Reintentar</a>"; 
            } 
        } 
    }else { 
?> 
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post"> 
        <label>Usuario:</label><br /> 
        <input type="text" name="usuario_nombre" /><br /> 
        <input type="submit" name="enviar" value="Enviar" /> 
    </form> 
<?php 
    } 
?>
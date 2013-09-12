<?php 
    session_start(); 
    include_once("./constantes.php");
    include_once($root."acceso_db.php");
    $perfil = mysql_query("SELECT id_usuario, usuario, fecha_alta FROM usuarios WHERE usuario='".$_SESSION['usuario_nombre']."'"); 
    if(mysql_num_rows($perfil)) { // Comprobamos que exista el registro con la ID ingresada 
        $row = mysql_fetch_array($perfil); 
        $id = $row["id_usuario"]; 
        $nick = $row["usuario"]; 
        $fAlta = $row["fecha_alta"]; 
?> 
        <strong>Nick:</strong> <?=$nick?><br /> 
        <strong>Fecha de Alta:</strong> <?=$fAlta?><br /> 
<?php 
    }else { 
?> 
        <p>El perfil seleccionado no existe o ha sido eliminado.</p> 
<?php 
    } 
?>

<script>
function registro()
{
	
	document.getElementById("login").action = 'registro.php';
	document.getElementById("login").submit();
}
function ingresar()
{
	document.getElementById("login").action = 'comprobar.php';
	document.getElementById("login").submit();
}
function irPerfil()
{
	document.getElementById("conectado").action = 'usuario/perfil.php';
	document.getElementById("conectado").submit();
}
</script>
<?php 
    session_start(); 
    include_once ("constantes.php");
    include_once($root."acceso_db.php");
    
    if(empty($_SESSION['usuario_nombre'])) { // comprobamos que las variables de sesión estén vacías         
?> 
        <form id="login" action="comprobar.php" method="post"> 
            <label>Usuario:</label><br /> 
            <input type="text" name="usuario_nombre" /><br /> 
            <label>Contraseña:</label><br /> 
            <input type="password" name="usuario_clave" /><br /> 
            <a href="<?php echo $usuario?>"recuperar.php">¿Has olvidado la contraseña?</a><br/>
            <input type="button" name="enviar" value="Ingresar" onclick="ingresar()" /> 
            <input type="button" name="registrar" value="Registrar" onclick = "registro()"  /> 
        </form>                     
<?php 
    }else { 
?> 
	<form id="conectado" action="acceso.php" method="post"> 
        <p>Hola <strong><?=$_SESSION['usuario_nombre']?></strong> | <a href="logout.php">Salir</a></p>
        <input type="button" name="perfil" value="Perfil" onclick="irPerfil()" /> 
    </form>      
<?php 
    } 
?>

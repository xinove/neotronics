<?php 
session_start(); 
//con session_start() 
//creamos la sesi�n si 
//no existe o la retomamos 
//si ya ha sido creada 
extract($_GET); 
//Como antes, usamos 
//extract() por comodidad, 
//pero podemos no hacerlo 
//tranquilamente 
$carro=$_SESSION['carro']; 
//Asignamos a la variable 
//$carro los valores 
//guardados en la sessi�n 
unset($carro[md5($id)]); 
//la funci�n unset borra 
//el elemento de un array  
//que le pasemos por 
//par�metro. En este caso 
//la usamos para borrar el 
//elemento cuyo id le pasemos 
//a la p�gina por la url  
$_SESSION['carro']=$carro; 
//Finalmente, actualizamos 
//la sessi�n, como hicimos 
//cuando agregamos un producto 
//y volvemos al cat�logo 
header("Location:catalogo.php?".SID); 
?>
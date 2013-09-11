<?php  
	include('../acceso_db.php'); 

	ob_start("ob_gzhandler"); 
	//Las funciones ob_start y ob_end_flush te permiten escojer en qu� momento 
	//enviar el resultado de un script al navegador. Si no las utilizamos estamos obligados a que nuestra  
	//primera l�nea de c�digo sea session_start() u obtendremos un error 
	session_start(); 
	//conectamos a la base de datos 
	
	//rescatamos los valores guardados en la variable de sesi�n (si es que hay alguno, 
	//cosa que comprobamos con isset) y los asignamos a $carro. Si no existen valores, ponemos a false 
	//el valor de $carro 

	if(isset($_SESSION['carro'])) 
		$carro=$_SESSION['carro'];else $carro=false; 
		//y hacemos la consulta 
		$qry=mysql_query("select * from productos order by id_producto asc"); 
?> 
<html> 
<head> 
<title>CAT�LOGO</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 
<style type="text/css"> 
<!-- 
.catalogo { 
    font-family: Verdana, Arial, Helvetica, sans-serif; 
    font-size: 9px; 
    color: #333333; 
} 
--> 
</style> 
</head> 
<body> 
<table width="272" align="center" cellpadding="0" cellspacing="0" style="border: 1px solid #000000;">
<tr valign="middle" bordercolor="#FFFFFF" bgcolor="#DFDFDF" class="catalogo"> 
<td width="170"><strong>Producto</strong></td> 
<td width="77"><strong>Precio</strong></td> 
<td width="25" align="right"><a href="vercarrito.php?<?php echo SID ?>" title="Ver el contenido del carrito"> 
<img src="vercarrito.gif" width="25" height="21" border="0"></a></td> 
</tr> 
<?php 
//mostramos todos nuestros 
//art�culos, viendo si han 
//sido agregados o no a nuestro 
//carro de compra 
while($row=mysql_fetch_assoc($qry)){ 
?> 
<tr valign="middle" class="catalogo">  
<td><?php echo $row['prod_nombre'] ?></td> 
<td><?php echo $row['id_stock_fk'] ?></td> 
<td align="center"> 
<?php 
if(!$carro || !isset($carro[md5($row['id'])]['identificador']) || $carro[md5($row['id'])]['identificador']!=md5($row['id'])){ 
//si el producto no ha sido 
//agregado, mostramos la imagen 
//de no agregado, linkeada 
//a nuestra p�gina de agregar 
//producto y transmit��ndole a 
//dicha p�gina el id del art�culo 
//y el identificador de la sesi�n 
?> 
<a href="agregacar.php?<?php echo SID ?>&id=<?php echo $row['id']; ?>"> 
<img src="productonoagregado.gif" border="0" title="Agregar al Carrito"></a><?php }else 
//en caso contrario mostramos la 
//otra imagen linkeada., a la 
//p�gina que sirve para borrar el 
//art�culo del carro. 
{?><a href="borracar.php?<?php echo SID ?>&id=<?php echo $row['id']; ?>"> 
<img src="productoagregado.gif" border="0" title="Quitar del Carrito"></a><?php } ?></td> 
</tr><?php } ?> 
</table> 
</body> 
</html> 
<?php  
ob_end_flush(); 
?>
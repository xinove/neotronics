CREATE DATABASE gestion_db;

USE gestion_db;

show tables;

CREATE TABLE usuarios( 
	id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(30),
	apellidos VARCHAR(50),
	usuario VARCHAR(20),
	password VARCHAR(100),
	direccion VARCHAR(80),
	telefono VARCHAR(9),
	pais VARCHAR(80),
	email VARCHAR(50),
	fecha_nacimiento date,
	dni VARCHAR(9),
	sexo CHAR(1),
	estado INT,
	fecha_alta date,
	fecha_ult_acceso date,
	id_rol_fk INT
);


CREATE TABLE roles 
	id_rol INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre varchar(50),
	descripcion varchar(200),	
);

CREATE TABLE logs( 
	id_log INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	status VARCHAR(10),
	descripcion VARCHAR(200),
	observacion VARCHAR(200),
	fecha_log date
);

CREATE TABLE comercios( 
	id_comercio INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre varchar(50),
	id_compra_fk int,
	id_usuario_fk int	
);

CREATE TABLE clientes( 
	id_cliente INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre varchar(50),
	id_compra_fk int,
	id_usuario_fk int	
);

CREATE TABLE distribuidores( 
	id_distribuidor INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_usuario_fk int
);

CREATE TABLE ofertas( 
	id_oferta INT PRIMARY KEY,
	id_distribuidor date,
	id_provincia int, 
	poblacion varchar(100), 
	pos_x int, 
	pos_y int,
	estado INT,
	fecha_alta date,
	descripcion varchar(150)
);

CREATE TABLE compras(
	id_compra INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_oferta_fk INT,
	id_comercio_fk int,
	id_cliente_fk INT,
	id_cantidad_fk INT,
	estado INT,
	fecha_compra date,
	descripcion varchar(150)
);

CREATE TABLE tickets(
	id_ticket INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_compra_fk INT,
	cod_ticket varchar(10),
	fecha_ticket date
);

CREATE TABLE facturas(
	id_factura INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	id_compra_fk INT,
	cod_factura varchar(10),
	fecha_factura date
);

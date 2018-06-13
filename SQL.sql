CREATE DATABASE Aramark;
CREATE TABLE Cliente(
	id_cliente int,
    nombre char(40),
    rut char(15),
    PRIMARY KEY (id_cliente)	
);
CREATE TABLE Trabajador(
	rut char(15),
    nombre char(40),
    PRIMARY KEY (rut)
);
CREATE TABLE Producto(
	id_producto int AUTO_INCREMENT,
    nombre char(30),
    precio int,
    PRIMARY KEY (id_producto)
);
CREATE TABLE Lote(
    id_lote int,
    fecha_venc Date,
    fecha_elab Date,
    PRIMARY KEY (id_lote)
);
CREATE TABLE Proveedor(
	id_proveedor int,
    nombre char(20),
    correo char(30),
    telefono char(15),
    direccion char(50),
    PRIMARY KEY (id_proveedor)
);
CREATE TABLE Venta(
	id_venta int AUTO_INCREMENT,
    fecha Date,
    id_cliente int,
    rut char(15),
    PRIMARY KEY (id_venta),
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente),
    FOREIGN KEY (rut) REFERENCES Trabajador(rut)
);
CREATE TABLE Venta_Lote(
	id_lote int,
    id_venta int,
    cantidad int,
    PRIMARY KEY (id_lote, id_venta),
    FOREIGN KEY (id_lote) REFERENCES Lote(id_lote),
    FOREIGN KEY (id_venta) REFERENCES Venta(id_venta)
);
CREATE TABLE Compra(
	id_compra int AUTO_INCREMENT,
	id_proveedor int,
	fecha Date,
	cantidad int,
	id_lote int,
	PRIMARY KEY (id_compra, id_proveedor),
	FOREIGN KEY (id_proveedor) REFERENCES Proveedor(id_proveedor),
	FOREIGN KEY (id_lote) REFERENCES Lote(id_lote)
);
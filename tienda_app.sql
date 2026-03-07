DROP DATABASE tienda_app;
CREATE DATABASE tienda_app CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tienda_app;

SELECT * FROM usuarios;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    clave VARCHAR(255) NOT NULL,
    correo VARCHAR(100),
    rol VARCHAR(100) not null,
    estado VARCHAR(1) DEFAULT'A',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE productos (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    precio_compra DECIMAL(10,2) NOT NULL, -- 8 CIFRAS ENTERAS Y 2 DECIMALES
    precio_venta DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE inventarios (
    id_movimiento INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    tipo ENUM('entrada', 'salida') NOT NULL,
    cantidad INT NOT NULL,
    descripcion VARCHAR(255),
    fecha_movimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);

CREATE TABLE ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_usuario INT NOT NULL,
    cliente VARCHAR(150),
    total DECIMAL(10,2),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
CREATE TABLE detalle_ventas (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES ventas(id_venta),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto)
);


SELECT * FROM usuarios;

CREATE VIEW vista_ventas AS
SELECT v.id_venta, v.fecha, v.cliente, u.nombre AS vendedor, 
       v.total
FROM ventas v
JOIN usuarios u
 ON v.id_usuario = u.id_usuario;

CREATE VIEW vista_stock AS
SELECT p.id_producto, p.nombre,
       SUM(CASE WHEN i.tipo='entrada' THEN i.cantidad ELSE -i.cantidad END) AS stock_actual
FROM productos p
LEFT JOIN inventarios i ON p.id_producto = i.id_producto
GROUP BY p.id_producto;

-- Create Read Update Delete (CRUD) -- Mantenimiento 
USE tienda_app;
INSERT INTO productos (codigo,nombre, descripcion,precio_compra,precio_venta,stock,estado)
VALUES('REF01','COCA COLA 350 ml','Refresco con sabor a cola, carbonatado de 350ml',450,600,100,1),
('REF02','COCA COLA 1L','Refresco con sabor a cola, carbonatado de 1L, envase de vidrio',800,1000,100,1);

UPDATE productos
SET 
stock = 150,
precio_venta = 1100
WHERE
id_producto = 2;

INSERT INTO productos (codigo,nombre, descripcion,precio_compra,precio_venta,stock,estado)
VALUES('REF03','FANTA KOLITA 350 ml','Refresco con sabor a cola, carbonatado de 350ml',450,600,100,1);

DELETE FROM productos 
WHERE id_producto = 3;

INSERT INTO productos (codigo,nombre, descripcion,precio_compra,precio_venta,stock,estado)
VALUES('REF03','FRESCA 350 ml','Refresco con sabor a toronja, carbonatado de 350ml',450,600,100,1);

SELECT * FROM productos;
SELECT codigo,nombre,precio_venta FROM productos;

SELECT codigo,nombre,precio_venta 
FROM productos
WHERE id_producto = 5;

SELECT codigo,nombre,precio_venta, stock
FROM productos
WHERE stock <> 100
AND precio_venta > 50
AND estado = 1;

SELECT codigo,nombre,precio_venta, stock
FROM productos
WHERE nombre like 'COCA%';

SELECT codigo,nombre,precio_venta, stock
FROM productos
WHERE nombre like '%COCA';

SELECT codigo,nombre,precio_venta, stock
FROM productos
WHERE nombre like '%COLA%'
AND precio_venta >= 1000;

SELECT * FROM productos
WHERE date(fecha_registro) = '2025-11-14';

SELECT * FROM productos 
ORDER BY fecha_registro DESC;

SELECT COUNT(*) FROM productos;

SELECT SUM(stock), nombre from productos
GROUP BY nombre;

-- min() max() avg() 

-- SELECT
-- CAMPOS
-- FROM TABLAS
-- WHERE FILTROS
-- GROUP BY AGRUPAMIENTO
-- ORDER BY ORDENAMIENTO
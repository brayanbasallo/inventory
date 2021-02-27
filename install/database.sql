-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.0.19 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla software_proyecto.cargos
CREATE TABLE IF NOT EXISTS `cargos` (
  `id_cargo` int NOT NULL,
  `nombre_cargo` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.
INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES ('1', 'Administrador');
INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES ('2', 'Auxiliar');
INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES ('3', 'Admin');

-- Volcando estructura para tabla software_proyecto.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `descripcion` text CHARACTER SET latin1 COLLATE latin1_bin,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla software_proyecto.detalle_ventas
CREATE TABLE IF NOT EXISTS `detalle_ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_factura` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad_productos` int NOT NULL,
  `valor_total` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_ventas_facturas` (`id_factura`),
  KEY `detalle_ventas_productos` (`id_producto`),
  CONSTRAINT `detalle_ventas_facturas` FOREIGN KEY (`id_factura`) REFERENCES `facturas` (`id_factura`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_ventas_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla software_proyecto.facturas
CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` varchar(15) NOT NULL,
  `descuento` int NOT NULL,
  `id_usuario` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `saldo_total` int NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `fk_facturas_usuarios` (`id_usuario`),
  CONSTRAINT `fk_facturas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla software_proyecto.geo_estados
CREATE TABLE IF NOT EXISTS `geo_estados` (
  `id` int NOT NULL,
  `estado` varchar(60) DEFAULT NULL,
  `id_pais` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_paises` (`id_pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla software_proyecto.geo_municipio
CREATE TABLE IF NOT EXISTS `geo_municipio` (
  `id_mcpio` int NOT NULL,
  `nombre_mcpio` varchar(60) DEFAULT NULL,
  `id_dept` int NOT NULL,
  PRIMARY KEY (`id_mcpio`),
  KEY `fk_estado` (`id_dept`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla software_proyecto.geo_paises
CREATE TABLE IF NOT EXISTS `geo_paises` (
  `id` int NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para vista software_proyecto.listar_facturas
-- Creando tabla temporal para superar errores de dependencia de VIEW
CREATE TABLE `listar_facturas` (
	`id_factura` VARCHAR(15) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`nombre` VARCHAR(25) NOT NULL COLLATE 'latin1_bin',
	`fecha` DATETIME NOT NULL,
	`saldo_total` INT(10) NOT NULL,
	`descuento` INT(10) NOT NULL
) ENGINE=MyISAM;

-- Volcando estructura para tabla software_proyecto.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int NOT NULL,
  `lote` int NOT NULL,
  `stock` int NOT NULL,
  `nombre` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `precio_unitario` int NOT NULL,
  `id_categoria` int DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `estado` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_producto`),
  KEY `productos_categorias_idx` (`id_categoria`),
  CONSTRAINT `productos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para función software_proyecto.riesgo_de_escasez
DELIMITER //
CREATE FUNCTION `riesgo_de_escasez`(cantidad_stock int) RETURNS varchar(50) CHARSET utf8mb4
    DETERMINISTIC
BEGIN
declare salida varchar(50);
	if cantidad_stock < 10 then 
		set salida = "Hay escasez de productos";
	else
		set salida = "No hay escasez";
	end if;
    return salida;
END//
DELIMITER ;

-- Volcando estructura para tabla software_proyecto.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `documento` varchar(20) NOT NULL,
  `usuario` varchar(100) CHARACTER SET latin2 COLLATE latin2_bin NOT NULL,
  `nombre` varchar(25) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `id_cargo` int NOT NULL,
  `lugar_recidencia` int DEFAULT NULL,
  PRIMARY KEY (`documento`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `usuarios_cargos` (`id_cargo`),
  CONSTRAINT `usuarios_cargos` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para disparador software_proyecto.decrementar_producto_stock
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `decrementar_producto_stock` AFTER INSERT ON `detalle_ventas` FOR EACH ROW BEGIN
	UPDATE productos SET stock = stock - NEW.cantidad_productos WHERE NEW.id_producto = id_producto;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para vista software_proyecto.listar_facturas
-- Eliminando tabla temporal y crear estructura final de VIEW
DROP TABLE IF EXISTS `listar_facturas`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `listar_facturas` AS select `facturas`.`id_factura` AS `id_factura`,`usuarios`.`nombre` AS `nombre`,`facturas`.`fecha` AS `fecha`,`facturas`.`saldo_total` AS `saldo_total`,`facturas`.`descuento` AS `descuento` from (`facturas` join `usuarios`) where (`usuarios`.`documento` = `facturas`.`id_usuario`) order by `facturas`.`fecha` desc;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

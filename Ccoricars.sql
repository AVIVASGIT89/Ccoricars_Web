-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para brillocar
CREATE DATABASE IF NOT EXISTS `ccoricars` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ccoricars`;

-- Volcando estructura para función brillocar.INITCAP
DELIMITER //
CREATE FUNCTION `INITCAP`(x char(200)) RETURNS char(200) CHARSET utf8 COLLATE utf8_general_ci
BEGIN

DECLARE STR VARCHAR(200);
DECLARE L_STR VARCHAR(200);

SET STR='';
SET L_STR='';

WHILE x REGEXP ' ' DO
SELECT SUBSTRING_INDEX(x, ' ', 1) INTO L_STR;
SELECT SUBSTRING(x, LOCATE(' ', x)+1) INTO x;
SELECT CONCAT(STR, ' ', CONCAT(UPPER(SUBSTRING(L_STR,1,1)),LOWER(SUBSTRING(L_STR,2)))) INTO STR;
END WHILE;
RETURN LTRIM(CONCAT(STR, ' ', CONCAT(UPPER(SUBSTRING(x,1,1)),LOWER(SUBSTRING(x,2)))));
END//
DELIMITER ;

-- Volcando estructura para tabla brillocar.marca_vehiculo
CREATE TABLE IF NOT EXISTS `marca_vehiculo` (
  `ID_MARCA` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_MARCA` varchar(200) NOT NULL,
  `USUARIO_REGISTRO` varchar(50) DEFAULT NULL,
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_MARCA`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla brillocar.marca_vehiculo: ~5 rows (aproximadamente)
INSERT INTO `marca_vehiculo` (`ID_MARCA`, `NOMBRE_MARCA`, `USUARIO_REGISTRO`, `ESTADO_REGISTRO`) VALUES
	(1, 'Hyundai', 'admin', 1),
	(2, 'Toyota', 'admin', 1),
	(3, 'Nissan', 'admin', 1),
	(4, 'Renault', 'admin', 1),
	(5, 'Mazda', 'admin', 1);

-- Volcando estructura para tabla brillocar.modelo_vehiculo
CREATE TABLE IF NOT EXISTS `modelo_vehiculo` (
  `ID_MODELO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_MARCA` int(11) NOT NULL,
  `NOMBRE_MODELO` varchar(200) NOT NULL DEFAULT '',
  `USUARIO_REGISTRO` varchar(50) DEFAULT '',
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_MODELO`),
  KEY `FK_modelo_vehiculo_marca_vehiculo` (`ID_MARCA`),
  CONSTRAINT `FK_modelo_vehiculo_marca_vehiculo` FOREIGN KEY (`ID_MARCA`) REFERENCES `marca_vehiculo` (`ID_MARCA`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla brillocar.modelo_vehiculo: ~11 rows (aproximadamente)
INSERT INTO `modelo_vehiculo` (`ID_MODELO`, `ID_MARCA`, `NOMBRE_MODELO`, `USUARIO_REGISTRO`, `ESTADO_REGISTRO`) VALUES
	(1, 1, 'Tucson', 'admin', 1),
	(2, 1, 'Elantra', 'admin', 1),
	(3, 1, 'Accent', 'admin', 1),
	(4, 3, 'Sentra', 'admin', 1),
	(5, 3, 'Versa', 'admin', 1),
	(6, 3, 'Xtrail', 'admin', 1),
	(7, 2, 'Yaris', 'admin', 1),
	(8, 2, 'Corolla', 'admin', 1),
	(9, 2, 'Rav 4', 'admin', 1),
	(10, 2, 'Rush', 'admin', 1),
	(11, 4, 'Duster', 'admin', 1);

-- Volcando estructura para tabla brillocar.servicio
CREATE TABLE IF NOT EXISTS `servicio` (
  `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_VEHICULO` int(11) NOT NULL,
  `FECHA_INGRESO` datetime NOT NULL,
  `KM_INGRESO` int(11) NOT NULL,
  `FECHA_SALIDA` datetime DEFAULT NULL,
  `DETALLE_SERVICIO` text DEFAULT NULL,
  `USUARIO_INGRESO` varchar(50) NOT NULL,
  `USUARIO_SALIDA` varchar(50) DEFAULT NULL,
  `TOTAL_PRECIO_COSTO` decimal(20,2) NOT NULL DEFAULT 0.00,
  `TOTAL_PRECIO_VENTA` decimal(20,2) NOT NULL DEFAULT 0.00,
  `TOTAL_SERVICIO` decimal(20,2) NOT NULL DEFAULT 0.00,
  `ESTADO_SERVICIO` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Pendiente; 2 = Finalizado',
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_SERVICIO`),
  KEY `FK_servicio_vehiculo` (`ID_VEHICULO`),
  CONSTRAINT `FK_servicio_vehiculo` FOREIGN KEY (`ID_VEHICULO`) REFERENCES `vehiculo` (`ID_VEHICULO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla brillocar.servicio: ~5 rows (aproximadamente)
INSERT INTO `servicio` (`ID_SERVICIO`, `ID_VEHICULO`, `FECHA_INGRESO`, `KM_INGRESO`, `FECHA_SALIDA`, `DETALLE_SERVICIO`, `USUARIO_INGRESO`, `USUARIO_SALIDA`, `TOTAL_PRECIO_COSTO`, `TOTAL_PRECIO_VENTA`, `TOTAL_SERVICIO`, `ESTADO_SERVICIO`, `ESTADO_REGISTRO`) VALUES
	(1, 1, '2024-10-28 12:44:33', 12566, NULL, 'Mantenimiento', 'ADMIN', NULL, 0.00, 0.00, 0.00, 1, 1),
	(2, 3, '2024-10-28 12:45:13', 65983, NULL, 'Reparacion', 'ADMIN', NULL, 0.00, 0.00, 0.00, 1, 1),
	(3, 2, '2024-10-28 12:56:19', 9635, NULL, 'Otro', 'ADMIN', NULL, 100.00, 120.00, 120.00, 2, 1),
	(4, 1, '2024-10-29 11:28:00', 2015, NULL, NULL, 'admin', NULL, 0.00, 0.00, 0.00, 1, 1),
	(5, 2, '2024-10-29 11:32:00', 2563, NULL, 'preventivo', 'admin', NULL, 0.00, 0.00, 0.00, 1, 1),
	(6, 1, '2024-10-29 12:14:00', 36982, NULL, 'servicio', 'admin', NULL, 0.00, 0.00, 0.00, 1, 1);

-- Volcando estructura para tabla brillocar.servicio_detalle
CREATE TABLE IF NOT EXISTS `servicio_detalle` (
  `ID_DETALLE_SERVICIO` int(11) NOT NULL,
  `ID_SERVICIO` int(11) NOT NULL,
  `ITEM` text NOT NULL,
  `PRECIO_COSTO` double(20,2) NOT NULL DEFAULT 0.00,
  `PRECIO_VENTA` double(20,2) NOT NULL DEFAULT 0.00,
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_DETALLE_SERVICIO`),
  KEY `FK_servicio_detalle_servicio` (`ID_SERVICIO`),
  CONSTRAINT `FK_servicio_detalle_servicio` FOREIGN KEY (`ID_SERVICIO`) REFERENCES `servicio` (`ID_SERVICIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla brillocar.servicio_detalle: ~0 rows (aproximadamente)

-- Volcando estructura para tabla brillocar.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `USUARIO` varchar(50) NOT NULL,
  `CLAVE` varchar(50) NOT NULL,
  `NOMBRE_USUARIO` varchar(200) NOT NULL,
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_USUARIO`),
  UNIQUE KEY `USUARIO` (`USUARIO`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla brillocar.usuario: ~1 rows (aproximadamente)
INSERT INTO `usuario` (`ID_USUARIO`, `USUARIO`, `CLAVE`, `NOMBRE_USUARIO`, `ESTADO_REGISTRO`) VALUES
	(1, 'admin', 'admin', 'Administrador', 1);

-- Volcando estructura para tabla brillocar.vehiculo
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `ID_VEHICULO` int(11) NOT NULL AUTO_INCREMENT,
  `PLACA_VEHICULO` varchar(20) NOT NULL,
  `ID_MARCA` int(11) NOT NULL,
  `ID_MODELO` int(11) NOT NULL,
  `ANIO_FABRICACION` int(11) NOT NULL,
  `RESPONSABLE` text DEFAULT NULL,
  `FECHA_REGISTRO` datetime NOT NULL,
  `USUARIO_REGISTRO` varchar(50) NOT NULL DEFAULT '',
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_VEHICULO`),
  UNIQUE KEY `PLACA_VEHICULO` (`PLACA_VEHICULO`),
  KEY `FK_vehiculo_marca_vehiculo` (`ID_MARCA`),
  KEY `FK_vehiculo_modelo_vehiculo` (`ID_MODELO`),
  CONSTRAINT `FK_vehiculo_marca_vehiculo` FOREIGN KEY (`ID_MARCA`) REFERENCES `marca_vehiculo` (`ID_MARCA`),
  CONSTRAINT `FK_vehiculo_modelo_vehiculo` FOREIGN KEY (`ID_MODELO`) REFERENCES `modelo_vehiculo` (`ID_MODELO`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla brillocar.vehiculo: ~5 rows (aproximadamente)
INSERT INTO `vehiculo` (`ID_VEHICULO`, `PLACA_VEHICULO`, `ID_MARCA`, `ID_MODELO`, `ANIO_FABRICACION`, `RESPONSABLE`, `FECHA_REGISTRO`, `USUARIO_REGISTRO`, `ESTADO_REGISTRO`) VALUES
	(1, 'ABC123', 1, 2, 2017, 'Alexander Vivas', '2024-10-28 10:50:37', 'Admin', 1),
	(2, 'ERF653', 2, 9, 2019, NULL, '2024-10-28 10:50:52', 'Admin', 1),
	(3, 'GJH369', 1, 2, 2036, '', '2024-10-28 11:53:34', 'admin', 1),
	(4, 'POI321', 2, 8, 2013, 'Juan Carlos', '2024-10-28 11:54:53', 'admin', 1),
	(5, 'WER336', 2, 10, 2036, 'Jose Luis', '2024-10-28 12:01:10', 'admin', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

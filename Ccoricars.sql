-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.32-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para ccoricars
CREATE DATABASE IF NOT EXISTS `ccoricars` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `ccoricars`;

-- Volcando estructura para función ccoricars.INITCAP
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

-- Volcando estructura para tabla ccoricars.marca_vehiculo
CREATE TABLE IF NOT EXISTS `marca_vehiculo` (
  `ID_MARCA` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_MARCA` varchar(200) NOT NULL,
  `USUARIO_REGISTRO` varchar(50) DEFAULT NULL,
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_MARCA`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ccoricars.marca_vehiculo: ~5 rows (aproximadamente)
INSERT INTO `marca_vehiculo` (`ID_MARCA`, `NOMBRE_MARCA`, `USUARIO_REGISTRO`, `ESTADO_REGISTRO`) VALUES
	(1, 'Hyundai', 'admin', 1),
	(2, 'Toyota', 'admin', 1),
	(3, 'Nissan', 'admin', 1),
	(4, 'Renault', 'admin', 1),
	(5, 'Mazda', 'admin', 1);

-- Volcando estructura para tabla ccoricars.modelo_vehiculo
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

-- Volcando datos para la tabla ccoricars.modelo_vehiculo: ~11 rows (aproximadamente)
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

-- Volcando estructura para tabla ccoricars.rol_usuario
CREATE TABLE IF NOT EXISTS `rol_usuario` (
  `ID_ROL` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_ROL` text NOT NULL,
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_ROL`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ccoricars.rol_usuario: ~2 rows (aproximadamente)
INSERT INTO `rol_usuario` (`ID_ROL`, `NOMBRE_ROL`, `ESTADO_REGISTRO`) VALUES
	(1, 'Administrador', 1),
	(2, 'Operador', 1);

-- Volcando estructura para tabla ccoricars.servicio
CREATE TABLE IF NOT EXISTS `servicio` (
  `ID_SERVICIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_VEHICULO` int(11) NOT NULL,
  `FECHA_INGRESO` datetime NOT NULL,
  `USUARIO_INGRESO` varchar(50) NOT NULL,
  `KM_INGRESO` int(11) NOT NULL,
  `DETALLE_SERVICIO` text DEFAULT NULL,
  `ITEMS` int(11) NOT NULL DEFAULT 0 COMMENT '1 = Si cuenta con items de servicio',
  `TOTAL_BASE` decimal(20,2) NOT NULL DEFAULT 0.00,
  `TOTAL_UTILIDAD` decimal(20,2) NOT NULL DEFAULT 0.00,
  `TOTAL_SERVICIO` decimal(20,2) NOT NULL DEFAULT 0.00,
  `FECHA_SALIDA` datetime DEFAULT NULL,
  `USUARIO_SALIDA` varchar(50) DEFAULT NULL,
  `ESTADO_SERVICIO` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Pendiente; 2 = Finalizado',
  `FECHA_REGISTRO` datetime DEFAULT NULL,
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_SERVICIO`),
  KEY `FK_servicio_vehiculo` (`ID_VEHICULO`),
  CONSTRAINT `FK_servicio_vehiculo` FOREIGN KEY (`ID_VEHICULO`) REFERENCES `vehiculo` (`ID_VEHICULO`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ccoricars.servicio: ~13 rows (aproximadamente)
INSERT INTO `servicio` (`ID_SERVICIO`, `ID_VEHICULO`, `FECHA_INGRESO`, `USUARIO_INGRESO`, `KM_INGRESO`, `DETALLE_SERVICIO`, `ITEMS`, `TOTAL_BASE`, `TOTAL_UTILIDAD`, `TOTAL_SERVICIO`, `FECHA_SALIDA`, `USUARIO_SALIDA`, `ESTADO_SERVICIO`, `FECHA_REGISTRO`, `ESTADO_REGISTRO`) VALUES
	(1, 1, '2024-10-28 12:44:33', 'ADMIN', 12566, 'Mantenimiento', 1, 410.00, 85.00, 495.00, NULL, NULL, 1, NULL, 1),
	(2, 3, '2024-10-28 12:45:13', 'ADMIN', 65983, 'Reparacion', 0, 0.00, 0.00, 0.00, NULL, NULL, 1, NULL, 1),
	(3, 2, '2024-10-28 12:56:19', 'ADMIN', 9635, 'Otro', 1, 51.00, 92.00, 143.00, '2024-11-03 15:49:58', 'admin', 2, NULL, 1),
	(4, 1, '2024-10-29 11:28:00', 'admin', 2015, NULL, 0, 0.00, 0.00, 0.00, '2024-11-02 17:55:27', 'admin', 1, NULL, 1),
	(5, 2, '2024-10-29 11:32:00', 'admin', 2563, 'preventivo', 0, 0.00, 0.00, 0.00, NULL, NULL, 1, NULL, 1),
	(6, 1, '2024-10-29 12:14:00', 'admin', 36982, 'servicio', 1, 63.00, 34.00, 97.00, '2024-11-03 15:49:54', 'admin', 2, NULL, 1),
	(7, 1, '2024-10-31 14:21:00', 'admin', 5623, 'detalle', 1, 15.00, 56.00, 71.00, '2024-11-03 15:49:51', 'admin', 2, NULL, 1),
	(9, 2, '2024-10-29 15:30:00', 'admin', 0, '', 0, 0.00, 0.00, 0.00, NULL, NULL, 1, '2024-10-31 15:30:16', 1),
	(10, 1, '2024-11-01 13:00:00', 'admin', 2356, 'servicio', 0, 0.00, 0.00, 0.00, '2024-11-01 13:44:52', 'admin', 1, '2024-11-01 13:01:00', 1),
	(11, 3, '2024-11-01 13:01:00', 'admin', 565, 'asdasd', 1, 157.00, 102.00, 259.00, '2024-11-03 15:49:45', 'admin', 2, '2024-11-01 13:02:24', 1),
	(12, 1, '2024-11-03 13:34:00', 'admin', 0, '', 0, 0.00, 0.00, 0.00, NULL, NULL, 1, '2024-11-03 13:34:29', 1),
	(13, 7, '2024-11-04 18:00:00', 'admin', 50000, 'mantenimiento', 1, 380.00, 140.00, 520.00, '2024-11-03 18:11:51', 'admin', 2, '2024-11-03 18:01:30', 1),
	(14, 1, '2024-11-06 22:51:00', 'admin', 5623, 'servicio', 0, 0.00, 0.00, 0.00, NULL, NULL, 1, '2024-11-05 22:51:38', 1);

-- Volcando estructura para tabla ccoricars.servicio_detalle
CREATE TABLE IF NOT EXISTS `servicio_detalle` (
  `ID_DETALLE_SERVICIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SERVICIO` int(11) NOT NULL,
  `ITEM` text NOT NULL,
  `PRECIO_BASE` double(20,2) NOT NULL DEFAULT 0.00,
  `UTILIDAD` double(20,2) NOT NULL DEFAULT 0.00,
  `SUBTOTAL` double(20,2) NOT NULL DEFAULT 0.00,
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_DETALLE_SERVICIO`),
  KEY `FK_servicio_detalle_servicio` (`ID_SERVICIO`),
  CONSTRAINT `FK_servicio_detalle_servicio` FOREIGN KEY (`ID_SERVICIO`) REFERENCES `servicio` (`ID_SERVICIO`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ccoricars.servicio_detalle: ~35 rows (aproximadamente)
INSERT INTO `servicio_detalle` (`ID_DETALLE_SERVICIO`, `ID_SERVICIO`, `ITEM`, `PRECIO_BASE`, `UTILIDAD`, `SUBTOTAL`, `ESTADO_REGISTRO`) VALUES
	(1, 7, 'servicio', 23.00, 56.00, 0.00, 0),
	(2, 7, 'servicio', 23.00, 56.00, 0.00, 0),
	(3, 7, 'servicio', 23.00, 56.00, 0.00, 0),
	(4, 6, 'servivio', 50.00, 25.00, 0.00, 0),
	(5, 6, 'repuesto', 60.00, 85.00, 0.00, 0),
	(6, 11, 'servvio', 123.00, 12.00, 0.00, 0),
	(7, 7, 'Servicio', 15.00, 10.00, 25.00, 0),
	(8, 7, 'mantenimiento', 25.00, 5.00, 30.00, 0),
	(9, 1, 'repuesto', 30.00, 20.00, 50.00, 0),
	(10, 1, 'reparacion', 60.00, 15.00, 75.00, 0),
	(11, 11, 'uno', 10.00, 12.00, 22.00, 0),
	(12, 11, 'dos', 20.00, 25.00, 45.00, 0),
	(13, 11, 'tres', 56.00, 56.00, 112.00, 0),
	(14, 7, 'respuesto', 56.00, 56.00, 112.00, 0),
	(15, 6, 'otro', 63.00, 34.00, 97.00, 1),
	(16, 7, 'sin embargo', 15.00, 56.00, 71.00, 1),
	(17, 1, 'repuesto', 30.00, 20.00, 50.00, 0),
	(18, 1, 'reparacion', 60.00, 15.00, 75.00, 0),
	(19, 11, 'tres', 56.00, 56.00, 112.00, 0),
	(20, 11, 'tres', 56.00, 56.00, 112.00, 1),
	(21, 11, 'base', 45.00, 23.00, 68.00, 1),
	(22, 11, 'utilidad', 56.00, 23.00, 79.00, 1),
	(23, 3, 'servcio', 15.00, 23.00, 38.00, 1),
	(24, 3, 'otro', 36.00, 69.00, 105.00, 1),
	(25, 13, '4 bujias', 200.00, 50.00, 250.00, 1),
	(26, 13, 'escaneo', 100.00, 50.00, 150.00, 1),
	(27, 13, 'liquido de freno', 80.00, 40.00, 120.00, 1),
	(28, 1, 'repuesto', 30.00, 20.00, 50.00, 0),
	(29, 1, 'reparacion', 60.00, 15.00, 75.00, 0),
	(30, 1, 'bujias', 100.00, 20.00, 120.00, 0),
	(31, 1, 'aceite', 250.00, 50.00, 300.00, 0),
	(32, 1, 'pastillas', 180.00, 40.00, 220.00, 0),
	(33, 1, 'reparacion', 60.00, 15.00, 75.00, 1),
	(34, 1, 'bujias', 100.00, 20.00, 120.00, 1),
	(35, 1, 'aceite', 250.00, 50.00, 300.00, 1);

-- Volcando estructura para tabla ccoricars.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `ROL_USUARIO` int(11) NOT NULL DEFAULT 0,
  `USUARIO` varchar(50) NOT NULL,
  `CLAVE` varchar(200) NOT NULL,
  `NOMBRE_USUARIO` varchar(200) NOT NULL,
  `APELLIDO_USUARIO` varchar(200) DEFAULT NULL,
  `FECHA_REGISTRO` datetime NOT NULL DEFAULT current_timestamp(),
  `ESTADO_REGISTRO` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`ID_USUARIO`),
  UNIQUE KEY `USUARIO` (`USUARIO`),
  KEY `FK_usuario_rol_usuario` (`ROL_USUARIO`),
  CONSTRAINT `FK_usuario_rol_usuario` FOREIGN KEY (`ROL_USUARIO`) REFERENCES `rol_usuario` (`ID_ROL`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ccoricars.usuario: ~4 rows (aproximadamente)
INSERT INTO `usuario` (`ID_USUARIO`, `ROL_USUARIO`, `USUARIO`, `CLAVE`, `NOMBRE_USUARIO`, `APELLIDO_USUARIO`, `FECHA_REGISTRO`, `ESTADO_REGISTRO`) VALUES
	(1, 1, 'admin', '$2a$07$usesomesillystringforegFOeQOp8RK/V8Yn0LZIZwSlh5IkndD.', 'Administrador', '', '2024-11-22 10:18:24', 1),
	(2, 2, 'user1', '$2a$07$usesomesillystringforeRkC2As/LX6fwr8iiuRn4mkBqSzt5ERC', 'Usuario 1', '', '2024-11-22 10:49:06', 1),
	(4, 2, 'USER2', '$2a$07$usesomesillystringforeXEZvOxoDDdDlAZJTMRduyA8dkUvvqSS', 'Usuario 2', '', '2024-11-22 11:08:52', 0),
	(5, 2, 'USER3', '$2a$07$usesomesillystringforevEx13CqubO2No7zDxw9LXrckxZ6kOey', 'User 3', 'User 3', '2024-11-22 11:11:47', 1);

-- Volcando estructura para tabla ccoricars.vehiculo
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `ID_VEHICULO` int(11) NOT NULL AUTO_INCREMENT,
  `PLACA_VEHICULO` varchar(20) NOT NULL,
  `ID_MARCA` int(11) NOT NULL,
  `ID_MODELO` int(11) NOT NULL,
  `ANIO_FABRICACION` int(11) NOT NULL,
  `NRO_MOTOR` varchar(100) NOT NULL DEFAULT '',
  `COLOR` varchar(100) DEFAULT '',
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla ccoricars.vehiculo: ~8 rows (aproximadamente)
INSERT INTO `vehiculo` (`ID_VEHICULO`, `PLACA_VEHICULO`, `ID_MARCA`, `ID_MODELO`, `ANIO_FABRICACION`, `NRO_MOTOR`, `COLOR`, `RESPONSABLE`, `FECHA_REGISTRO`, `USUARIO_REGISTRO`, `ESTADO_REGISTRO`) VALUES
	(1, 'ABC123', 1, 2, 2017, '', '', 'Alexander Vivas', '2024-10-28 10:50:37', 'Admin', 1),
	(2, 'ERF653', 2, 9, 2019, '', '', NULL, '2024-10-28 10:50:52', 'Admin', 1),
	(3, 'GJH369', 1, 2, 2036, '', '', '', '2024-10-28 11:53:34', 'admin', 1),
	(4, 'POI321', 2, 8, 2013, '', '', 'Juan Carlos', '2024-10-28 11:54:53', 'admin', 1),
	(5, 'WER336', 2, 10, 2036, '', '', 'Jose Luis', '2024-10-28 12:01:10', 'admin', 1),
	(6, 'SDFSDF', 1, 2, 234, '', '', '', '2024-11-02 15:21:47', 'admin', 1),
	(7, 'ASD456', 3, 4, 2023, '', '', 'Dueño', '2024-11-02 15:25:28', 'admin', 1),
	(8, 'DFG365', 1, 3, 2013, 'DFDF1231', 'Rojo', 'Responesable', '2024-11-05 22:50:38', 'admin', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: localhost    Database: servicel
-- ------------------------------------------------------
-- Server version	5.7.30-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asistencias`
--

DROP TABLE IF EXISTS `asistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `aporte` varchar(200) NOT NULL,
  `fecha_asistencia` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_servicio` (`id_servicio`),
  CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `detservicio` (`idServ`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cambioEstados`
--

DROP TABLE IF EXISTS `cambioEstados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cambioEstados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(20) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `folio` int(11) NOT NULL,
  `falla` text,
  `bono` float NOT NULL DEFAULT '0',
  `solucion` text,
  `total` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `folio` (`folio`),
  CONSTRAINT `cambioEstados_ibfk_1` FOREIGN KEY (`folio`) REFERENCES `folios` (`folio`)
) ENGINE=InnoDB AUTO_INCREMENT=80435 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idCli` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(50) DEFAULT 'no tiene',
  `direccion` varchar(100) NOT NULL,
  `municipio` varchar(50) DEFAULT NULL,
  `estado` varchar(100) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idCli`)
) ENGINE=InnoDB AUTO_INCREMENT=50785 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` varchar(300) DEFAULT NULL,
  `emisor` varchar(100) DEFAULT NULL,
  `idServ` int(11) NOT NULL,
  `fecha_comentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comentario`),
  KEY `idServ` (`idServ`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`idServ`) REFERENCES `detservicio` (`idServ`)
) ENGINE=InnoDB AUTO_INCREMENT=57477 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comisiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) DEFAULT NULL,
  `comision` decimal(9,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_servicio` (`id_servicio`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `comisiones_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `detservicio` (`idServ`),
  CONSTRAINT `comisiones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=13051 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detalle_usuarios`
--

DROP TABLE IF EXISTS `detalle_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_usuarios` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `idsuc` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `idsuc` (`idsuc`),
  KEY `iduser` (`iduser`),
  CONSTRAINT `detalle_usuarios_ibfk_1` FOREIGN KEY (`idsuc`) REFERENCES `sucursal` (`idsuc`),
  CONSTRAINT `detalle_usuarios_ibfk_2` FOREIGN KEY (`iduser`) REFERENCES `usuarios` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detrefsuc`
--

DROP TABLE IF EXISTS `detrefsuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detrefsuc` (
  `cant` int(11) DEFAULT '0',
  `idsuc` int(11) NOT NULL,
  `idref` int(11) NOT NULL,
  KEY `idsuc` (`idsuc`),
  KEY `idref` (`idref`),
  CONSTRAINT `detrefsuc_ibfk_1` FOREIGN KEY (`idsuc`) REFERENCES `sucursal` (`idsuc`) ON UPDATE CASCADE,
  CONSTRAINT `detrefsuc_ibfk_2` FOREIGN KEY (`idref`) REFERENCES `refacciones` (`idref`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detservicio`
--

DROP TABLE IF EXISTS `detservicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detservicio` (
  `folio` int(11) NOT NULL,
  `idEq` int(11) NOT NULL,
  `idServ` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `falla` text NOT NULL,
  `cables` varchar(150) DEFAULT 'No contiene',
  `discos` varchar(150) DEFAULT 'No contiene',
  `accesorios` varchar(150) DEFAULT 'No contiene',
  `calcas` varchar(150) DEFAULT 'No contiene',
  `golpes` varchar(150) DEFAULT 'No contiene',
  `solucion` text NOT NULL,
  `atendio` varchar(100) NOT NULL,
  `entrego` varchar(100) NOT NULL,
  `chip` varchar(50) NOT NULL,
  `memoria` varchar(50) NOT NULL,
  `cotizacion` varchar(50) NOT NULL,
  `botones` varchar(200) NOT NULL,
  `tapa` varchar(50) NOT NULL,
  `charola` varchar(50) NOT NULL,
  `tipo_falla` varchar(30) NOT NULL,
  `camaras` varchar(200) DEFAULT NULL,
  `riesgo` varchar(500) DEFAULT NULL,
  `lapiz` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idServ`),
  KEY `folio` (`folio`),
  KEY `idEq` (`idEq`),
  CONSTRAINT `detservicio_ibfk_1` FOREIGN KEY (`folio`) REFERENCES `folios` (`folio`) ON UPDATE CASCADE,
  CONSTRAINT `detservicio_ibfk_2` FOREIGN KEY (`idEq`) REFERENCES `equipocliente` (`idEq`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74685 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `detservref`
--

DROP TABLE IF EXISTS `detservref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detservref` (
  `idref` int(11) NOT NULL,
  `idServ` int(11) NOT NULL,
  `cantV` int(11) NOT NULL DEFAULT '0',
  KEY `idRef` (`idref`),
  KEY `idServ` (`idServ`),
  CONSTRAINT `detservref_ibfk_1` FOREIGN KEY (`idref`) REFERENCES `refacciones` (`idref`) ON UPDATE CASCADE,
  CONSTRAINT `detservref_ibfk_2` FOREIGN KEY (`idServ`) REFERENCES `detservicio` (`idServ`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `idemp` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `domicilio` varchar(150) NOT NULL,
  `telefono` varchar(50) DEFAULT 'no tiene',
  `celular` varchar(50) DEFAULT 'no tiene',
  `tipo` varchar(30) NOT NULL,
  `idsuc` int(11) NOT NULL,
  PRIMARY KEY (`idemp`),
  KEY `idsuc` (`idsuc`),
  CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idsuc`) REFERENCES `sucursal` (`idsuc`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equipocliente`
--

DROP TABLE IF EXISTS `equipocliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipocliente` (
  `idEq` int(11) NOT NULL AUTO_INCREMENT,
  `idCli` int(11) NOT NULL,
  `nomEquipo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL DEFAULT 'no tiene',
  `modelo` varchar(50) NOT NULL DEFAULT 'no tiene',
  `numSerie` varchar(50) NOT NULL DEFAULT 'no tiene',
  `descripcion` varchar(250) NOT NULL DEFAULT 'esta en proceso',
  `color` varchar(50) DEFAULT NULL,
  `contraseña` varchar(30) NOT NULL DEFAULT 'no tiene',
  PRIMARY KEY (`idEq`),
  KEY `idCli` (`idCli`),
  CONSTRAINT `equipocliente_ibfk_1` FOREIGN KEY (`idCli`) REFERENCES `clientes` (`idCli`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71753 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `folios`
--

DROP TABLE IF EXISTS `folios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folios` (
  `folio` int(11) NOT NULL AUTO_INCREMENT,
  `idsuc` int(11) NOT NULL,
  `idCli` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `estadogeneral` varchar(50) CHARACTER SET utf8 DEFAULT 'pendiente',
  `total` float NOT NULL DEFAULT '0',
  `subtotal` float NOT NULL DEFAULT '0',
  `idEquipo` int(11) NOT NULL,
  `fecha_salida` datetime NOT NULL,
  `adelanto` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`folio`),
  KEY `idsuc` (`idsuc`),
  KEY `idCli` (`idCli`),
  CONSTRAINT `folios_ibfk_1` FOREIGN KEY (`idCli`) REFERENCES `clientes` (`idCli`) ON UPDATE CASCADE,
  CONSTRAINT `folios_ibfk_2` FOREIGN KEY (`idsuc`) REFERENCES `sucursal` (`idsuc`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=77786 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje_celular` varchar(500) NOT NULL,
  `mensaje_email` varchar(500) NOT NULL,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_orden` datetime DEFAULT NULL,
  `orden` varchar(300) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `estado` varchar(50) DEFAULT 'PENDIENTE',
  `anticipo` varchar(150) DEFAULT 'NO HAY',
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `refacciones`
--

DROP TABLE IF EXISTS `refacciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refacciones` (
  `idref` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAcc` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idref`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reparadores`
--

DROP TABLE IF EXISTS `reparadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reparadores` (
  `id_reparador` int(11) NOT NULL AUTO_INCREMENT,
  `fechaubicacion` datetime DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `folio` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reparador`),
  KEY `folio` (`folio`),
  CONSTRAINT `reparadores_ibfk_1` FOREIGN KEY (`folio`) REFERENCES `folios` (`folio`)
) ENGINE=InnoDB AUTO_INCREMENT=36765 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sucursal` (
  `idsuc` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(11) DEFAULT '1',
  `nombre` varchar(50) DEFAULT NULL,
  `localidad` varchar(50) NOT NULL,
  `domicilio` varchar(50) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `edo` varchar(50) NOT NULL,
  PRIMARY KEY (`idsuc`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_header` varchar(100) NOT NULL,
  `ticket_mensaje` varchar(250) NOT NULL DEFAULT '****************',
  `ticket_mensajet` varchar(250) NOT NULL DEFAULT 'gracias por su preferencia',
  `ticket_sitio` varchar(150) NOT NULL DEFAULT '--- --- ---',
  `ticket_logo` varchar(75) NOT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombre` varchar(100) DEFAULT NULL,
  `usuario_apellidop` varchar(50) DEFAULT NULL,
  `usuario_apellidom` varchar(50) DEFAULT NULL,
  `usuario_nickname` varchar(50) DEFAULT NULL,
  `usuario_correo` varchar(50) DEFAULT NULL,
  `usuario_fecha` date DEFAULT NULL,
  `usuario_pass` varchar(100) DEFAULT NULL,
  `usuario_tipo` int(11) DEFAULT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'usuario.png',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `utilidades`
--

DROP TABLE IF EXISTS `utilidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilidades` (
  `id_utilidad` int(11) NOT NULL AUTO_INCREMENT,
  `ut` int(11) NOT NULL DEFAULT '0',
  `categoria` varchar(100) DEFAULT NULL,
  `desde` float NOT NULL,
  `hasta` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_utilidad`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'servicel'
--
/*!50003 DROP FUNCTION IF EXISTS `adelanto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `adelanto`(`id` INT) RETURNS int(11)
BEGIN
	declare adelanto float;
    set adelanto=(select adelanto from folios where folio=id);
RETURN adelanto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getLastUbicacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `getLastUbicacion`(`pfolio` INT) RETURNS int(11)
    NO SQL
begin
	set @id=(select max(id_reparador) from reparadores where folio=pfolio);
    return @id;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `getNumIncompletos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `getNumIncompletos`(`pidsuc` INT) RETURNS int(11)
begin 
declare nume int;
set nume = (select count(folios.folio) as nume from folios left join detservicio on folios.folio=detservicio.folio left join equipocliente on equipocliente.idEq=detservicio.idEq where detservicio.folio is null or detservicio.idEq is null and idsuc=pidsuc);
return nume;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `modelo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `modelo`(`id` INT) RETURNS varchar(200) CHARSET latin1
BEGIN
declare cadena varchar(200);
set cadena = (select concat(marca,' ',modelo) from equipocliente where idEq=id );

RETURN cadena;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `numSalida` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `numSalida`(`f` INT) RETURNS int(11)
BEGIN
	declare num int default 0; 
    set num = (select count(folio) from cambioEstados where folio = f and state = 'Terminado' );
RETURN num ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `numSoporte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `numSoporte`(`pfolio` INT) RETURNS int(11)
BEGIN
	declare  numero int;
	set numero= (select count(id) from asistencias a 
    join detservicio d on a.id_servicio=d.idServ join folios f on f.folio=d.folio where f.folio=pfolio);
RETURN numero;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `numSoporteDado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `numSoporteDado`(`piduser` INT, `inicio` DATE, `fin` DATE) RETURNS int(11)
begin 
	declare numero int;
	set numero=(select count(id)  from asistencias a join detservicio d on a.id_servicio=d.idServ
    join folios f on d.folio=f.folio join usuarios u on a.id_usuario=u.iduser where 
    u.iduser=piduser and (date(a.fecha_asistencia) between date(inicio) and date(fin)));
    return numero;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `usuarioServicio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` FUNCTION `usuarioServicio`(`id` INT) RETURNS varchar(200) CHARSET latin1
BEGIN
	declare nickname varchar(200);
    set nickname = (select usuario_nickname from usuarios u join 
    cambioEstados c on u.iduser=c.id_usuario where c.folio=id and c.state= 'Terminado'
    order by 
    c.id desc limit 1 );
RETURN nickname;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addCliente` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addCliente`(IN `pnombre` VARCHAR(100), IN `ptelefono` VARCHAR(50), IN `pdireccion` VARCHAR(100), IN `pmunicipio` VARCHAR(50), INOUT `ban` INT)
begin
    start transaction;
    if not exists (select nombre from clientes where nombre=pnombre and direccion=pdireccion )then
            insert into clientes (nombre,telefono,direccion,municipio) values (pnombre,ptelefono
            ,pdireccion,pmunicipio);
            set ban=1; 
            commit;
    else 
        if (select activo from clientes where nombre=pnombre and direccion=pdireccion =0)then 
            set @id=(select idCli from clientes where nombre=pnombre and direccion=pdireccion);
            update clientes set activo=1, telefono=ptelefono,municipio=pmunicipio
            where idCli=@id;
            set ban=2; 
            commit;
        else 
            set ban=3; 
            rollback;
        end if;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addEmpleado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addEmpleado`(IN `pnombre` VARCHAR(100), IN `pdomicilio` VARCHAR(150), IN `ptelefono` VARCHAR(50), IN `pcelular` VARCHAR(50), IN `ptipo` VARCHAR(30), IN `pidsuc` INT, OUT `ban` INT)
BEGIN
	declare error integer default(0);
    declare continue handler for sqlexception set error:=1;
	start transaction;
		if exists(select idsuc from sucursal where idsuc=pidsuc)then
			if not exists(select * from empleados e inner join sucursal s on e.idsuc=s.idsuc where
						s.idsuc=pidsuc and e.nombre=pnombre and e.domicilio=pdomicilio)then
					insert into empleados values(null,pnombre,pdomicilio,ptelefono,pcelular,ptipo,pidsuc);
					set ban=1; 
			else
					set ban=2; 
			end if;
		else
			set ban=3; 
		end if;
	if(error=1)then
            rollback;
            set ban:=4;
        else
            commit;
        end if;
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addEquipo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addEquipo`(IN `pidCli` INT, IN `pnomEquipo` VARCHAR(50), IN `pmarca` VARCHAR(50), IN `pmodelo` VARCHAR(50), IN `pnumSerie` VARCHAR(50), IN `pdescripcion` VARCHAR(250), IN `pcolor` VARCHAR(50), IN `pcontraseña` VARCHAR(30), INOUT `ban` INT)
begin
    declare error integer default(0);
    declare continue handler for sqlexception set error:=1;
    start transaction;
        if exists (select idCli from clientes where idCli=pidCli)then
            if not exists (select idEq from equipocliente where marca=pmarca and modelo=pmodelo and numSerie=pnumSerie and idCli=pidCli)then
                insert into equipocliente (idCli,nomEquipo,marca,modelo,numSerie,descripcion,color,contraseña) values
                 (pidCli,pnomEquipo,pmarca,pmodelo,pnumSerie,pdescripcion,pcolor,pcontraseña);
                 set ban:=1;
            else 
                set ban:=2; 
            end if;
        else 
            set ban:=3; 
        end if;
       if(error=1)then
            rollback;
            set ban:=4;
        else
            commit;
        end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addFolio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addFolio`(IN `pidcli` INT, IN `pidsuc` INT, IN `pestado` VARCHAR(50), IN `pfecha` DATETIME, INOUT `ban` INT)
begin 
    declare error integer default(0);
    declare continue handler for sqlexception set error:=1;
    start transaction;
    if exists (select idcli from clientes where idCli=pidcli)then
        if exists (select idsuc from sucursal where idsuc=pidsuc)then 
            insert into folios (idsuc,idcli,fecha,estadogeneral) values (pidsuc,pidcli,pfecha,pestado);
            set ban:=1;
        else
            set ban:=2; 
        end if;
    else
        set ban:=3;
    end if;
    if (error=0)then 
        commit;
    else 
        rollback;
        set ban:=4;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addRefaccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addRefaccion`(IN `pidsuc` INT, IN `pnombreAcc` VARCHAR(100), IN `pmarca` VARCHAR(100), IN `pprecio` FLOAT, IN `pdescripcion` VARCHAR(100), IN `pcant` INT, INOUT `ban` INT)
begin
    declare error integer default (0);
    declare continue handler for sqlexception set error:=1;
    start transaction;
    if exists(select idSuc from sucursal where idSuc=pidsuc and estado=1)then
        if exists (select nombreAcc from sucursal join detrefsuc on sucursal.idSuc=detrefsuc.idSuc join refacciones
                on refacciones.idref=detrefsuc.idref where nombreAcc=pnombreAcc and marca=pmarca and sucursal.idSuc=pidSuc)then
            set @id=(select idref from refacciones where nombreAcc=pnombreAcc and marca=pmarca);
            set @cant=( select cant from sucursal join detrefsuc on sucursal.idSuc=detrefsuc.idSuc join refacciones
                        on refacciones.idref=detrefsuc.idref where refacciones.idref=@id and detrefsuc.idsuc=pidsuc);
            update detrefsuc set cant=@cant+pcant where idsuc=pidsuc and idref=@id;
            update refacciones set precio=pprecio, descripcion=pdescripcion where idref=@id;
        set ban:=1;
    else 
        if exists(select nombreAcc from sucursal join detrefsuc on sucursal.idSuc=detrefsuc.idSuc join refacciones
        on refacciones.idref=detrefsuc.idref where nombreAcc=pnombreAcc and marca=pmarca and sucursal.idSuc!=pidSuc)then
            set @id=(select idref from refacciones where nombreAcc=pnombreAcc and marca=pmarca);
            insert into detrefsuc (idref,idSuc,cant) values (@id,pidsuc,pcant);
            update refacciones set precio=pprecio,descripcion=pdescripcion where idref=@id;
            set ban:=2;
        else 
            insert into refacciones (nombreAcc,marca,precio,descripcion) values(pnombreAcc,pmarca,pprecio,pdescripcion);
            set @idr=(select max(idref) from refacciones where nombreAcc=pnombreAcc and marca=pmarca);
            insert into detrefsuc (cant,idsuc,idref) values(pcant,pidsuc,@idr);
            set ban:=3;
        end if;
    end if;
    else 
        set ban:=4; 
        rollback;
    end if;        
    if (error=0) then 
        commit;
    else 
        rollback; 
        set ban:=5;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addServicio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addServicio`(IN `pfolio` INT, IN `pidEq` INT, IN `ptipo` VARCHAR(30), IN `pfalla` TEXT, IN `pcables` VARCHAR(150), IN `pdiscos` VARCHAR(150), IN `paccesorios` VARCHAR(150), IN `pcalcas` VARCHAR(150), IN `pgolpes` VARCHAR(150), IN `patendio` VARCHAR(100), IN `pchip` VARCHAR(50), IN `pmemoria` VARCHAR(50), IN `pcotizacion` VARCHAR(50), INOUT `ban` INT, IN `pbotones` VARCHAR(200), IN `ptapa` VARCHAR(100), IN `pcharola` VARCHAR(100), IN `tipofalla` VARCHAR(30), IN `idusuario` INT, IN `pcamaras` VARCHAR(200), IN `plapiz` VARCHAR(200), IN `priesgo` VARCHAR(500))
begin 
    if exists (select folio from folios where folio=pfolio)then
        if exists(select idEq from equipocliente where idEq=pidEq)then
            if not exists (select idServ from detservicio where idEq=pidEq and folio=pfolio)then
                insert into detservicio (folio,idEq,tipo,falla,cables,discos,accesorios,calcas,golpes,atendio,memoria,chip,cotizacion,
                botones,tapa,charola,tipo_falla, camaras,lapiz,riesgo)
                values(pfolio,pidEq,ptipo,pfalla,pcables,pdiscos,paccesorios,
                pcalcas,pgolpes,patendio,pmemoria,pchip,pcotizacion,pbotones,ptapa,pcharola,tipofalla,pcamaras,plapiz,priesgo);
                set @id:=(select max(idServ) from detservicio);
                if(tipofalla = 'SOFTWARE')THEN
					insert into comisiones(id_servicio,id_usuario,comision) values (@id,idusuario,5);
                end if;
                set ban:=1;
            else
                set @id:=(select idServ from detservicio where idEq=pidEq and folio=pfolio);
                update detservicio set folio=pfolio,idEq=pidEq,tipo=ptipo,
                falla=pfalla,cables=pcables,discos=pdiscos,accesorios=paccesorios,
                calcas=pcalcas,golpes=pgolpes,atendio=patendio,memoria=pmemoria,
                chip=pchip,cotizacion=pcotizacion,botones=pbotones,tapa=ptapa,charola=pcharola,tipo_falla=tipofalla, camaras=pcamaras,
                lapiz=plapiz,riesgo=priesgo
                where idServ=@id;
                set ban:=2; 
            end if;
        else
            set ban:=3; 
        end if;
    else
        set ban:=4; 
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addSucursal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addSucursal`(IN `pnombre` VARCHAR(50), IN `plocalidad` VARCHAR(50), IN `pdomicilio` VARCHAR(50), IN `ptelefono` VARCHAR(50), IN `pedo` VARCHAR(50), INOUT `ban` INT)
BEGIN 
declare exit handler for sqlstate '23000' set ban=4;
start transaction;
if(select (select  nombre from sucursal where nombre=pnombre )is null)then
    if(select (select domicilio  from sucursal where domicilio=pdomicilio )is null)then
        insert into sucursal (nombre,domicilio,localidad,telefono,edo) values (pnombre,pdomicilio,plocalidad,ptelefono,pedo);
        set ban=1;
        commit;
    else 
        set ban=2;
        rollback;
    end if;
else    
    if(select estado from sucursal where nombre=pnombre=0)then
        set @id=(select idsuc from sucursal where nombre=pnombre);
        update sucursal set estado=1, nombre=pnombre, domicilio=pdomicilio, localidad=plocalidad,telefono=ptelefono, edo=pedo where idsuc=@id;
        set ban=1;
        commit;
    else 
        set ban=3;
        rollback;
    end if;
end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `addUsuario`(IN `pnombre` VARCHAR(100), IN `pap` VARCHAR(50), IN `pam` VARCHAR(50), IN `pnick` VARCHAR(50), IN `pcorreo` VARCHAR(100), IN `pass` VARCHAR(50), IN `ptipo` INT, IN `pidsuc` INT, OUT `ban` INT)
BEGIN

	declare error integer default(0);
    declare sucursal int;
	declare bandera int default 0;
	declare puntero cursor for select idsuc from sucursal;
	declare continue handler for not found set bandera=1;
	
	
	
		if exists(select idsuc from sucursal where idsuc=pidsuc)then
			if exists(select iduser from usuarios where usuarios.iduser in(select iduser from detalle_usuarios where idsuc=pidsuc) and 
usuarios.usuario_nickname=pnick) then
				set ban=1; 
			  else 
				if(ptipo=1)then
					insert into usuarios values(null,pnombre,pap,pam,pnick,pcorreo,now(),pass,ptipo,'usuario.png');
					set @id=(select max(iduser) from usuarios);
					open puntero;
					reed_loop:loop
					fetch  puntero into sucursal;
					if(bandera)then
						leave reed_loop;
					end if;
						insert into detalle_usuarios values(null,sucursal,@id);
					end loop;
					close puntero;
					set ban=3;
				else
					insert into usuarios values(null,pnombre,pap,pam,pnick,pcorreo,now(),pass,ptipo,'usuario.png');
					set @id=(select max(iduser) from usuarios);
					insert into detalle_usuarios values(null,pidsuc,@id);
					set ban=3; 
				end if;
			end if;
		else
			set ban=2; 
		end if;
	
	

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `comprobarEmail` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `comprobarEmail`(IN `pemail` VARCHAR(50), IN `pidsuc` INT, OUT `ban` INT)
BEGIN
	declare error integer default(0);
	declare continue handler for sqlexception set error:=1;
	start transaction;
	if(select CHARACTER_lENGTH(pemail))>0 then 
		if exists(select idsuc from sucursal where idsuc=pidsuc)then
				if exists(select * from usuarios u inner join sucursal s on u.idsuc=s.idsuc where
							s.idsuc=pidsuc and u.usuario_correo=pemail) then
					set ban=1; 
				else
					set ban=2; 
				end if;
		else
				set ban=3; 
		end if;
	else
		set ban=4; 
	end if;

	if(error)then
		rollback;
		set ban:=5;
	else
		commit;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `comprobarUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `comprobarUser`(IN `pnick` VARCHAR(50), IN `pidsuc` INT, OUT `ban` INT)
BEGIN
	declare error integer default(0);
	declare continue handler for sqlexception set error:=1;
	start transaction;
	if(select CHARACTER_lENGTH(pnick))>0 then 
		if exists(select idsuc from sucursal where idsuc=pidsuc)then
				if exists(select iduser from usuarios where usuarios.iduser in(select iduser from detalle_usuarios where idsuc=pidsuc) and 
							usuarios.usuario_nickname=pnick) then
					set ban=1; 
				else
					set ban=2; 
				end if;
		else
				set ban=3; 
		end if;
	else
		set ban=4; 
	end if;

	if(error)then
		rollback;
		set ban:=5;
	else
		commit;
	end if;
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `consultaExpirados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `consultaExpirados`(IN `pfecha` DATE, IN `uri` INT, IN `tope` INT)
begin
	select clientes.idcli, (select comentario from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=d.idServ)) as comentario,
    (select fechaubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as fechaubicacion,(select ubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as ubicacion,folios.folio,
    d.idServ,e.nomEquipo,subtotal ,d.entrego,date(folios.fecha) as fecha,estadogeneral,total,clientes.nombre,e.idEq,clientes.direccion,solucion from
    folios join clientes on folios.idCli=clientes.idCli join detservicio d on folios.folio=d.folio join equipocliente e on e.idEq=d.idEq where date(folios.fecha) < pfecha and folios.estadogeneral!='Entregado' order by folios.folio desc limit uri,tope;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `corte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `corte`(IN `inicio` DATE, IN `fin` DATE, IN `pidsuc` INT)
begin
   select f.folio,f.adelanto,modelo(d.idEq) as modelo,date(f.fecha_salida) as fecha_salida,usuarioServicio(f.folio) as usuario_nickname,f.estadogeneral,d.solucion,date(f.fecha) as fecha,s.nombre,f.total,
   f.subtotal,d.entrego,d.atendio,d.tipo  from  folios f  join detservicio d on d.folio=f.folio join sucursal s on 
   f.idsuc=s.idsuc where (s.idsuc=pidsuc and (f.estadogeneral='pendiente'
   or f.estadogeneral='Terminado') and (date(f.fecha) between inicio and fin)) OR
   (s.idsuc=pidsuc and f.estadogeneral='Entregado' and (date(f.fecha_salida) between inicio and fin))
   order by f.fecha desc ; 
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `corteTecnicos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `corteTecnicos`(IN `inicio` DATE, IN `fin` DATE, IN `usuario` VARCHAR(50))
begin
	select f.folio,f.fecha_salida,f.estadogeneral,date(f.fecha) as fecha,s.nombre,f.total,f.subtotal,d.tipo ,d.entrego from sucursal s join folios f on s.idsuc=
    f.idsuc join detservicio d on f.folio=d.folio where date(f.fecha_salida) BETWEEN inicio and fin and d.entrego=usuario and f.estadogeneral="Entregado" order by f.folio desc ;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `deletepermiso` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `deletepermiso`(IN `pidsuc` INT, IN `piduser` INT, OUT `ban` INT)
BEGIN
	declare error integer default(0);
	declare continue handler for sqlexception set error:=1;
	start transaction;
	if exists(select idsuc from sucursal where idsuc=pidsuc and estado=1)then
		if exists(select iduser from detalle_usuarios where idsuc=pidsuc and iduser=piduser)then
			delete from detalle_usuarios where idsuc=pidsuc and iduser=piduser;
			set ban:=1; 
		else
			set ban=2; 
		end if;
	else
		set ban=3; 
	end if;
	if(error=1)then
            rollback;
            set ban:=4; 
        else
            commit;
	end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliFolio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `eliFolio`(IN `pfolio` INT, INOUT `ban` INT)
BEGIN
    declare error integer default(0);
    declare continue handler for sqlexception set error:=1;
    start transaction;
    if not exists (select f.folio from folios f join detservicio s on f.folio=s.folio join detservref d on d.idServ=s.idServ  where f.folio=pfolio)then
        delete from detservicio where folio=pfolio;
       delete from folios where folio=pfolio;
       
        set ban:=1;
    else
        set ban:=2;
    end if;
   if(error=1)then
            rollback;
            set ban:=3;
        else
            commit;
        end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarCli` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `eliminarCli`(IN `pidCli` INT, INOUT `ban` INT)
begin 
    if exists (select idCli from clientes where idCli=pidCli) then
        update clientes set activo=0 where idCli=pidCli;
        set ban=1;
    else 
        set ban=2;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminarsuc` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `eliminarsuc`(IN `pidsuc` INT)
begin 
update sucursal set estado=0 where idsuc=pidsuc;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliRefaccion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `eliRefaccion`(IN `pidref` INT, IN `pidsuc` INT, INOUT `ban` INT)
begin 
    if(select idsuc from sucursal where idsuc=pidsuc)then
       update detrefsuc set cant=0 where idref=pidref and idsuc=pidsuc;
       set ban:=1;
    else
       set ban:=2;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `elminaUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `elminaUser`(IN `pidsuc` INT, IN `piduser` INT, OUT `ban` INT)
BEGIN
	declare error integer default(0);
	declare continue handler for sqlexception set error=1;
	start transaction;
		if exists(select * from sucursal where idsuc=pidsuc)then
			if exists(select * from usuarios where iduser=piduser)then
				
				delete from detalle_usuarios where iduser=piduser;
                delete from comisiones where id_usuario=piduser;
				delete from usuarios where iduser=piduser;
				set ban=1; 
			else
				set ban=3; 
			end if;

		else
			set ban=2; 
		end if;
	if(error)then
		rollback;
		set ban=4; 
	else
		commit;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `filasRendimientoGeneral` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `filasRendimientoGeneral`(IN `usuario` INT, IN `inicio` DATE, IN `fin` DATE)
begin
	select count(c.state) as numero from  cambioEstados c join folios f on c.folio=f.folio join usuarios u on u.iduser=c.id_usuario join 
    detservicio d on d.folio=f.folio where c.state='Terminado' and f.total>20 and 
                (date(c.fecha) between date(inicio) and date(fin) and u.iduser=usuario);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getComisionesUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getComisionesUser`(IN `id` INT, IN `inicio` DATE, IN `fin` DATE)
begin 
	select c.comision,c.id as id_comision,d.falla,d.solucion,f.total, c.id_usuario, d.idServ as id_servicio, u.usuario_nombre, u.usuario_apellidop,
		d.folio, d.falla, d.tipo_falla from comisiones c join usuarios u on c.id_usuario=u.iduser
        join detservicio d on d.idServ=c.id_servicio join folios f on d.folio=f.folio where c.id_usuario=id and f.total>20 and  (date(c.fecha) between date(inicio) and date(fin));
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getIncompletos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getIncompletos`(IN `pidsuc` INT)
begin
select equipocliente.idEq,(select emisor from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=detservicio.idServ)) as emisor,clientes.idcli,(select fechaubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as fechaubicacion,(select ubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as ubicacion,(select comentario from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=detservicio.idServ)) as comentario,folios.folio,
subtotal,solucion,clientes.nombre,clientes.idcli,date(folios.fecha) as fecha,equipocliente.nomEquipo,detservicio.idServ,estadogeneral,total,clientes.nombre,clientes.direccion  From folios left join detservicio on folios.folio=detservicio.folio left join equipocliente on equipocliente.idEq=detservicio.idEq left join clientes on clientes.idcli=folios.idcli where detservicio.folio is null or detservicio.idEq is null and idsuc=pidsuc;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getSalida` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getSalida`(IN `pfolio` INT)
begin
    prepare stmt from 'select *from detservicio join equipocliente on detservicio.idEq=equipocliente.idEq join 
                        clientes on clientes.idCli=equipocliente.idCli join folios on folios.folio=detservicio.folio where detservicio.folio=?;';
    set @folio:=pfolio;
    execute stmt using @folio;
    deallocate prepare stmt;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getServicio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getServicio`(IN `pidsuc` INT, IN `uri` INT, IN `tope` INT, IN `estado` VARCHAR(20))
begin
    prepare stmt from 'select 
    clientes.idcli,(select count(id_comentario) from comentarios where idServ=d.idServ) as num_comentario,folios.adelanto,d.tipo_falla, (select comentario from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=d.idServ)) as comentario,
    (select u.usuario_nickname from comentarios c left join usuarios u on c.emisor=u.iduser where id_comentario=(select max(id_comentario) from comentarios  where idServ=d.idServ)) as emisor,
    (select fechaubicacion 
    from reparadores where id_reparador=getLastUbicacion(folios.folio)) as fechaubicacion,(select ubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as ubicacion,folios.folio,d.idServ,e.nomEquipo,subtotal ,d.entrego,d.atendio,d.riesgo,d.lapiz,date(folios.fecha) as fecha,estadogeneral,total,clientes.nombre,e.idEq,clientes.direccion,solucion from
    folios join clientes on 
    folios.idCli=clientes.idCli join detservicio d on 
    folios.folio=d.folio join equipocliente e on 
    e.idEq=d.idEq where folios.idsuc=? and estadogeneral=? order by folios.folio desc limit ?,? ;';
    set @uri:=uri;
    set @edo:=estado;
    set @tope:=tope;
    set @id:=pidsuc;
    execute stmt using @id,@edo,@uri,@tope;
    deallocate prepare stmt;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getServicioFolio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getServicioFolio`(IN `pfolio` INT)
begin 
	select e.idEq,d.entrego,(select count(id_comentario) from comentarios where idServ=d.idServ) as num_comentario,d.atendio,folios.adelanto,d.riesgo,d.lapiz,d.tipo_falla,clientes.idcli,(select u.usuario_nickname from comentarios c left join usuarios u on c.emisor=u.iduser where id_comentario=(select max(id_comentario) from comentarios  where idServ=d.idServ)) as emisor,(select fechaubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as fechaubicacion,(select ubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as ubicacion,(select comentario from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=d.idServ)) as comentario,folios.folio,d.idServ,e.nomEquipo,subtotal ,date(folios.fecha) as fecha,estadogeneral,d.entrego,total,clientes.nombre,clientes.direccion,solucion
    from folios join clientes on folios.idCli=clientes.idCli join detservicio d on folios.folio=d.folio join equipocliente e on e.idEq=d.idEq
    where folios.folio=pfolio;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getServicioFolioEdo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getServicioFolioEdo`(IN `pfolio` INT, IN `edo` VARCHAR(50))
begin 
	select e.idEq ,(select count(id_comentario) from comentarios where idServ=d.idServ) as num_comentario,d.entrego,folios.adelanto,d.tipo_falla,d.lapiz,d.riesgo,d.riesgo,d.lapiz,d.atendio,clientes.idcli,(select u.usuario_nickname from comentarios c left join usuarios u on c.emisor=u.iduser where id_comentario=(select max(id_comentario) from comentarios  where idServ=d.idServ)) as emisor,(select fechaubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as fechaubicacion,(select ubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as ubicacion,(select comentario from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=d.idServ)) as comentario,folios.folio,d.idServ,e.nomEquipo,subtotal ,date(folios.fecha) as fecha,estadogeneral,d.entrego,total,clientes.nombre,clientes.direccion,solucion
    from folios join clientes on folios.idCli=clientes.idCli join detservicio d on folios.folio=d.folio join equipocliente e on e.idEq=d.idEq
    where folios.folio=pfolio and folios.estadogeneral=edo;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getServicioNombre` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getServicioNombre`(IN `nombrecliente` VARCHAR(100))
begin 
	set @nom=nombrecliente;
    
	select e.idEq ,(select count(id_comentario) from comentarios where idServ=d.idServ) as num_comentario,folios.adelanto,d.entrego,d.tipo_falla,d.atendio,
    (select u.usuario_nickname from comentarios c left join usuarios u on c.emisor=u.iduser where id_comentario=(select max(id_comentario) from comentarios  where idServ=d.idServ)) as emisor, clientes.idcli,(select fechaubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as fechaubicacion,(select ubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as ubicacion,(select comentario from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=d.idServ)) as comentario, folios.folio,d.idServ,e.nomEquipo,subtotal ,date(folios.fecha) as fecha,estadogeneral,d.entrego,total,clientes.nombre,clientes.direccion,solucion from
     folios join clientes on folios.idCli=clientes.idCli join detservicio d on folios.folio=d.folio join equipocliente e on e.idEq=d.idEq
    where (clientes.nombre like CONCAT('%', nombrecliente, '%') or concat_ws(e.modelo,e.marca) like @nom or concat_ws(e.marca,e.modelo) like @nom or
    d.falla like @nom) ;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getServicioNombreEdo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `getServicioNombreEdo`(IN `nombrecliente` VARCHAR(100), IN `edo` VARCHAR(50))
begin 
	set @nom=concat('%',nombrecliente,'%');
	select e.idEq ,(select count(id_comentario) from comentarios where idServ=d.idServ) as num_comentario,folios.adelanto,d.riesgo,d.lapiz,d.entrego,d.atendio,(select u.usuario_nickname from comentarios c left join usuarios u on c.emisor=u.iduser where id_comentario=(select max(id_comentario) from comentarios  where idServ=d.idServ)) as emisor, clientes.idcli,(select fechaubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as fechaubicacion,(select ubicacion from reparadores where id_reparador=getLastUbicacion(folios.folio)) as ubicacion,(select comentario from comentarios where id_comentario=(select max(id_comentario) from comentarios where idServ=d.idServ)) as comentario, folios.folio,d.idServ,e.nomEquipo,subtotal ,date(folios.fecha) as fecha,estadogeneral,total,clientes.nombre,clientes.direccion,solucion from
     folios join clientes on folios.idCli=clientes.idCli join detservicio d on folios.folio=d.folio join equipocliente e on e.idEq=d.idEq
    where (clientes.nombre like CONCAT ('%', nombrecliente, '%') or concat_ws(e.modelo,e.marca) like @nom or concat_ws(e.marca,e.modelo) like @nom or
    d.falla like @nom) and folios.estadogeneral=edo;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ingresoSistema` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `ingresoSistema`(IN `pnick` VARCHAR(100), IN `pcontraseña` VARCHAR(100), IN `pidsuc` INT, OUT `ban` INT, INOUT `tipo` INT)
BEGIN
	
	if exists(select idsuc from sucursal where idsuc=pidsuc)then
		if exists(select iduser from usuarios where iduser in(select detalle_usuarios.iduser from detalle_usuarios where detalle_usuarios.idsuc=pidsuc)
					and usuario_nickname=pnick and usuario_pass=pcontraseña)then
				set ban=1; 
        
					
		set tipo:=(select usuario_tipo from usuarios where usuario_nickname=pnick and 
					usuario_pass=pcontraseña);        
		else
				set ban=2; 
		end if;
	else 
      set ban=3; 
	end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `insertDetalleUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `insertDetalleUser`(IN `pidsuc` INT, IN `piduser` INT, OUT `ban` INT)
BEGIN
	declare error integer default(0);
	declare continue handler for sqlexception set error:=1;
	start transaction;
	if exists(select idsuc from sucursal where idsuc=pidsuc and estado=1)then
		if exists(select iduser from detalle_usuarios where idsuc=pidsuc and iduser=piduser)then
			update detalle_usuarios set idsuc=pidsuc,iduser=piduser where idsuc=pidsuc and iduser=piduser;
			set ban:=1;
		else
			insert into detalle_usuarios values(null,pidsuc,piduser);
			set ban:=2;
		end if;
	else
		set ban=3; 
	end if;
	if(error=1)then
            rollback;
            set ban:=4; 
        else
            commit;
	end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `menosDeVeinte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `menosDeVeinte`(IN `inicio` DATE, IN `fin` DATE, IN `usuario` INT)
begin
	select u.iduser,c.id,cl.nombre,e.numSerie,numSoporte(f.folio) as soporte,c.bono,e.modelo,e.marca,f.estadogeneral,u.iduser,f.folio,c.fecha,usuario_nombre,f.subtotal,f.total,d.solucion,
    usuario_apellidop, usuario_apellidom ,c.state from  cambioEstados c join folios f on c.folio=f.folio join usuarios u on u.iduser=c.id_usuario join 
    detservicio d on d.folio=f.folio join equipocliente e on e.idEq=d.idEq join clientes cl on cl.idCli=f.idCli where c.state='Terminado' and f.total between 0 and 20 and 
                (date(c.fecha) between date(inicio) and date(fin) and u.iduser=usuario)
    order by usuario_nombre asc;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `miSoporte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `miSoporte`(`piduser` INT, `inicio` DATE, `fin` DATE)
begin
	select a.fecha_asistencia,f.folio,u.usuario_apellidom,u.usuario_apellidop
    ,u.usuario_nombre, u.usuario_nickname,a.aporte from asistencias a join detservicio d on a.id_servicio=d.idServ
    join folios f on d.folio=f.folio join usuarios u on a.id_usuario=u.iduser where 
    u.iduser=piduser and (date(a.fecha_asistencia) between date(inicio) and date(fin));
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modiCli` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `modiCli`(IN `pidCli` INT, IN `pnombre` VARCHAR(100), IN `ptelefono` VARCHAR(50), IN `pdireccion` VARCHAR(100), IN `pmunicipio` VARCHAR(50), INOUT `ban` INT)
begin
    start transaction;
    if exists(select idCli from clientes where idCli=pidCli and activo=1)then
        if not exists (select nombre from clientes where nombre=pnombre and direccion=pdireccion  and idCli!=pidCli)then
            update clientes set nombre=pnombre, telefono=ptelefono, direccion=pdireccion
            ,municipio=pmunicipio where idCli=pidCli;
            set ban:=1; 
            commit;
        else
            set ban:=2; 
            rollback;
        end if;
    else
        set ban:=3; 
        rollback;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modiEquipo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `modiEquipo`(IN `pidServ` INT, IN `pidEq` INT, IN `pidCli` INT, IN `pnomEquipo` VARCHAR(50), IN `pmarca` VARCHAR(50), IN `pmodelo` VARCHAR(50), IN `pnumSerie` VARCHAR(50), IN `pdescripcion` VARCHAR(250), IN `pcolor` VARCHAR(50), IN `pcontraseña` VARCHAR(30), INOUT `ban` INT)
begin
   
    if not exists (select idEq from equipocliente where nomEquipo=pnomEquipo and marca=pmarca and modelo=pmodelo and numSerie=pnumSerie and idEq!=pidEq )then
        update equipocliente set nomEquipo=pnomEquipo,marca=pmarca,modelo=pmodelo,numSerie=pnumSerie,
        descripcion=pdescripcion,color=pcolor,contraseña=pcontraseña where idEq=pidEq;
        set ban=1;
    else
        set ban=2;
    end if;
   
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modificarEmp` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `modificarEmp`(IN `pid` INT, IN `pnom` VARCHAR(100), IN `pdomic` VARCHAR(150), IN `ptel` VARCHAR(50), IN `pcel` VARCHAR(50), IN `ptipo` VARCHAR(30), OUT `ban` INT)
BEGIN
	declare error integer default(0);
    declare continue handler for sqlexception set error:=1;
	start transaction;
	if exists(select idemp from empleados where idemp=pid)then
		if not exists(select * from empleados where nombre=pnom and domicilio=pdomic and 
					idemp!=pid)then
					update empleados set nombre=pnom ,domicilio=pdomic,telefono=ptel,
					celular=pcel,tipo=ptipo where idemp=pid;
					set ban:=1; 

		else
			if exists(select * from empleados where nombre=pnom and domicilio=pdomic and 
					idemp=pid)then
			update empleados set telefono=ptel,
					celular=pcel,tipo=ptipo where idemp=pid;
			set ban:=2; 
			else
				set ban:=3; 
			end if;
		end if;
	else
		set ban:=4;
	end if;
	if(error=1)then
            rollback;
            set ban:=5;
        else
            commit;
        end if;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modiRef` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `modiRef`(IN `pidref` INT, IN `pidsuc` INT, IN `pnombreAcc` VARCHAR(100), IN `pmarca` VARCHAR(100), IN `pprecio` FLOAT, IN `pdescripcion` VARCHAR(100), IN `pcant` INT, INOUT `ban` INT)
begin
declare error integer default(0);
declare continue handler for sqlexception set error:=1;
start transaction;
    if exists(select idsuc from sucursal where idsuc=pidsuc and estado=1)then
        if exists (select idref from refacciones where idref=pidref)then
            if exists (select idref from detrefsuc where idsuc=pidsuc and idref=pidref)then 
                if not exists (select idref from refacciones where nombreAcc=pnombreAcc and pmarca=marca and idref!=pidref)then
                   update refacciones set nombreAcc=pnombreAcc, marca=pmarca, precio=pprecio,descripcion=pdescripcion where
                           idref=pidref;     
                   update detrefsuc set cant=pcant where idref=pidref and idsuc=pidsuc;
                    set ban:=1;
                else 
                    set ban:=2; 
                end if;
            else 
                set ban:=3; 
            end if;
        else
            set ban:=4; 
        end if;
    else
        set ban:=5;
    end if;
    if (error=1)then
        set ban:=6; 
        rollback;
    else 
        commit;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modiServicio` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `modiServicio`(IN `pidserv` INT, IN `ptipo` VARCHAR(30), IN `pfalla` TEXT, IN `pcables` VARCHAR(150), IN `pdiscos` VARCHAR(150), IN `paccesorios` VARCHAR(150), IN `pcalcas` VARCHAR(150), IN `pgolpes` VARCHAR(150), IN `pchip` VARCHAR(50), IN `pmemoria` VARCHAR(50), IN `pcotizacion` VARCHAR(50), IN `pbotones` VARCHAR(500), IN `pcamaras` VARCHAR(200), OUT `ban` INT, IN `plapiz` VARCHAR(200), IN `priesgo` VARCHAR(500),in `pcharola` varchar(50), IN `ptapa` varchar(50))
begin
    if exists(select idServ from detservicio where idServ=pidserv)then
        update detservicio set riesgo=priesgo,lapiz=plapiz,tipo=ptipo,falla=pfalla,camaras=pcamaras,cables=pcables,discos=pdiscos,accesorios=paccesorios,
        calcas=pcalcas,golpes=pgolpes,charola=pcharola,tapa=ptapa,chip=pchip,memoria=pmemoria,cotizacion=pcotizacion ,botones=pbotones where idServ=pidserv;
        set ban:=1;
    else
        set ban:=2;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modisuc` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `modisuc`(IN `pnombre` VARCHAR(50), IN `plocalidad` VARCHAR(50), IN `pdomicilio` VARCHAR(50), IN `ptelefono` VARCHAR(50), IN `pedo` VARCHAR(50), IN `pidsuc` INT, INOUT `ban` INT)
begin 
    start transaction;
    if ( exists (select idsuc from sucursal where idsuc=pidsuc and estado=1))then
        if not exists (select nombre from sucursal where nombre=pnombre and idsuc!=pidsuc) then 
            if not exists (select domicilio from sucursal where domicilio=pdomicilio and idsuc!=pidsuc) then 
                set ban=1;
                update sucursal set nombre=pnombre, domicilio=pdomicilio,localidad=plocalidad,edo=pedo,telefono=ptelefono 
                where idsuc=pidsuc;
                commit;
            else 
                set ban=2; 
                rollback;
            end if;
        else 
            set ban=3; 
            rollback;
        end if;
    else
        set ban=4; 
        rollback;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mostrarCli` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `mostrarCli`(IN `uri` INT, IN `tope` INT)
begin 
prepare stmt from "select nombre,direccion,idCli from clientes where activo=1 limit ?,?";
set @uri:=uri;
set @tope:=tope;
execute stmt using @uri,@tope;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MostrarEmpleados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `MostrarEmpleados`(IN `suc` INT)
BEGIN
	if exists(select idsuc from sucursal where idsuc=suc)then
		select e.nombre as nombre, e.domicilio as domicilio , e.telefono as telefono ,e.celular,
				e.tipo,e.idemp ,s.nombre as nombresuc from empleados e 
				inner join sucursal s on s.idsuc=e.idsuc where s.idsuc=suc;
	end if;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mostrarRef` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `mostrarRef`(IN `id` INT, IN `uri` INT, IN `tope` INT)
begin
    prepare stmt from "select nombreAcc,precio,cant,marca,descripcion,refacciones.idref,sucursal.nombre,sucursal.idsuc from sucursal join detrefsuc
    on detrefsuc.idsuc=sucursal.idsuc join refacciones on refacciones.idref=detrefsuc.idref  where detrefsuc.idsuc=? and estado=1 limit ?,? ";
    set @uri:=uri;
    set @tope:=tope;
    set @ids:=id;
    execute stmt using @ids,@uri,@tope;
    deallocate prepare stmt;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `mostrarsuc` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `mostrarsuc`()
begin
select *from sucursal where estado=1;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MostrarUsuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `MostrarUsuarios`(IN `pidsuc` INT)
BEGIN
	if exists(select idsuc from sucursal where idsuc=pidsuc)then
		select u.usuario_nombre as nombre,s.idsuc, u.usuario_apellidop as ap , u.usuario_apellidom as am ,u.usuario_nickname 
				as nick,u.usuario_correo as correo, u.iduser as iduser , s.nombre as nombresuc from usuarios u join
                detalle_usuarios d on d.iduser=u.iduser join sucursal s on s.idsuc=d.idsuc order by usuario_nombre asc;
	end if;
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `numeroExpirados` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `numeroExpirados`(IN `pfecha` DATE)
begin 
select count(folios.folio) as nume from folios join clientes on folios.idCli=clientes.idCli join detservicio d on folios.folio=d.folio join equipocliente e on e.idEq=d.idEq where  date(folios.fecha) < pfecha and  folios.estadogeneral!='Entregado';
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `numero_servicios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `numero_servicios`(`pidsuc` INT)
begin
select count(f.folio) as numero from sucursal s join folios f on s.idsuc=f.idsuc join clientes c on f.idCli=c.idCli join 
detservicio fs on fs.folio=f.folio where s.idsuc=pidsuc;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `numFechas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `numFechas`(IN `inicio` DATETIME, IN `fin` DATETIME, IN `pidsuc` INT, INOUT `nume` INT)
begin 
    set nume:=(select count(f.folio) from sucursal s join folios f on s.idsuc=f.idsuc join 
    detservicio d on f.folio=d.folio where date(f.fecha) BETWEEN inicio and fin);
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `rendimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `rendimiento`(IN `inicio` DATE, IN `fin` DATE, IN `usuario` INT)
begin
	select u.iduser,cl.nombre,c.id,numSoporte(f.folio) as soporte,c.bono,e.modelo,e.numSerie,e.marca,f.estadogeneral,u.iduser,f.folio,c.fecha,usuario_nombre,f.subtotal,sum(f.total+f.adelanto) as total,d.solucion,
    usuario_apellidop, usuario_apellidom ,c.state from  cambioEstados c join folios f on c.folio=f.folio join usuarios u on u.iduser=c.id_usuario join 
    detservicio d on d.folio=f.folio join equipocliente e on e.idEq=d.idEq join clientes cl on cl.idCli=f.idCli  where c.state='Terminado' and f.total>20 and 
                (date(c.fecha) between date(inicio) and date(fin) and u.iduser=usuario)
    order by f.folio asc;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `rendimientoGeneral` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `rendimientoGeneral`(IN `inicio` DATE, IN `fin` DATE, IN `usuario` INT, IN `uri` INT, IN `tope` INT)
begin
	select u.iduser,(f.total+f.adelanto) as new_total,cl.nombre,e.numSerie,c.id,numSoporte(f.folio) as soporte,numSalida(f.folio) as num_salida,c.bono,e.modelo,e.marca,f.estadogeneral,u.iduser,f.folio,c.fecha,usuario_nombre,f.subtotal,f.total,d.solucion,
    usuario_apellidop, usuario_apellidom ,c.state from  cambioEstados c join folios f on c.folio=f.folio join usuarios u on u.iduser=c.id_usuario join 
    detservicio d on d.folio=f.folio join equipocliente e on e.idEq=d.idEq join clientes cl on cl.idCli=f.idCli where c.state='Terminado' and (f.total+f.adelanto)>20 and 
                (date(c.fecha) between date(inicio) and date(fin) and u.iduser=usuario)
    order by f.folio asc limit uri,tope;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `salida` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `salida`(IN `pfolio` INT, IN `pidserv` INT, IN `pestado` VARCHAR(50), IN `ptotal` FLOAT, INOUT `ban` INT, IN `psolucion` TEXT, IN `pentrego` VARCHAR(100), IN `id_user` INT)
begin 
     if exists (select folio from folios where folio=pfolio)then
        if exists(select idServ from detservicio where idServ=pidserv)then
            update  folios set  estadogeneral=pestado, total=ptotal where folio=pfolio;
            update detservicio set solucion=psolucion, entrego=pentrego where idServ=pidserv;
            insert into cambioEstados(id_usuario,state,folio,solucion,total) value (id_user,pestado,pfolio,psolucion,ptotal);
			if(ptotal<21)then 
				update comisiones set comision=0 
                where id_usuario=id_user and id_servicio=pidserv;
			end if;
            set ban:=1;
        else 
            set ban:=2;
        end if;
    else 
        set ban:=3;
    end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `servicios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `servicios`(`pidsuc` INT, `ini` INT, `fin` INT)
begin
select *from sucursal s join folios f on s.idsuc=f.idsuc join clientes c on f.idCli=c.idCli join 
detservicio fs on fs.folio=f.folio where s.idsuc=pidsuc  order by f.folio desc limit ini,fin;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ticket` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `ticket`(IN `pfolio` INT)
begin
  declare pidEquipo int;
    set pidEquipo =(select idEquipo from folios where folio=pfolio);
    if(pidEquipo=0)then 
		select f.folio,sum(f.total+f.subtotal) as new_total,f.adelanto,s.nombre as nombresuc,s.localidad,s.domicilio,s.telefono,s.edo,fecha,f.fecha_salida,f.estadogeneral,f.total,f.subtotal,d.solucion,d.cables,d.riesgo,d.lapiz,d.atendio,d.cotizacion,d.chip,d.memoria,d.entrego,d.discos,d.accesorios,d.calcas,d.golpes,d.botones,d.tapa,d.camaras,d.charola,e.marca,e.modelo,e.color,c.nombre,c.telefono as tel,e.contraseña as pass,e.nomEquipo,e.numSerie,d.tipo,d.falla from equipocliente e join clientes c on e.idCli=c.idCli join
		folios f on c.idCli=f.idCli join detservicio d on f.folio=d.folio join sucursal s on s.idsuc=f.idsuc where f.folio=pfolio;
	else
		select f.folio,f.adelanto,s.nombre as nombresuc,s.localidad,s.domicilio,s.telefono,s.edo,fecha,f.estadogeneral,f.fecha_salida,f.total,f.subtotal,d.solucion,d.cables,d.riesgo,d.lapiz,d.atendio,d.cotizacion,d.chip,d.memoria,d.entrego,d.discos,d.accesorios,d.calcas,d.golpes,d.botones,d.tapa,d.camaras,d.charola,e.contraseña as pass,e.marca,e.modelo,e.color,c.nombre,c.telefono as tel,e.nomEquipo,e.numSerie,d.tipo,d.falla from equipocliente e join clientes c on e.idCli=c.idCli join
		folios f on c.idCli=f.idCli join detservicio d on f.folio=d.folio join sucursal s on s.idsuc=f.idsuc where f.folio=pfolio and f.idEquipo=pidEquipo and d.folio=pfolio and e.idEq=pidEquipo;
	end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `updateUser` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `updateUser`(IN `piduser` INT, `pusuario_nombre` VARCHAR(100), IN `pusuario_apellidop` VARCHAR(50), IN `pusuario_apellidom` VARCHAR(50), IN `pusuario_nickname` VARCHAR(50), IN `pusuario_correo` VARCHAR(50), IN `pusuario_pass` VARCHAR(100), IN `pusuario_tipo` INT, `pidsuc` INT, `pid_detalle` INT, OUT `ban` INT)
BEGIN
	declare error integer default(0);
	declare continue handler for sqlexception set error:=1;
	start transaction;
	if exists(select iduser from usuarios where iduser=piduser)then
		update usuarios set usuario_nombre=pusuario_nombre,usuario_apellidop=pusuario_apellidop,usuario_apellidom=pusuario_apellidom,
				usuario_nickname=pusuario_nickname,usuario_correo=pusuario_correo,usuario_fecha=now(),
				usuario_pass=pusuario_pass,usuario_tipo=pusuario_tipo where iduser=piduser;
                if not exists (select id_detalle from detalle_usuarios where idsuc=pidsuc and iduser=piduser)then
					update detalle_usuarios set idsuc=pidsuc where id_detalle=pid_detalle;
                    set ban=1;
				else 
					set ban=4; 
				end if;
	else
		set ban=2; 

	end if;

	if(error=1)then
            rollback;
            set ban:=3; 
        else
            commit;
	end if;
	
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `venderRef` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`e8eeqfyek5yd`@`localhost` PROCEDURE `venderRef`(IN `pidref` INT, IN `pidServ` INT, IN `pidsuc` INT, IN `pcant` INT, IN `pprecio` FLOAT, INOUT `ban` INT)
begin 
    declare error integer default(0);
    declare continue handler for sqlexception set error:=1;
    start transaction;
    set @exist=(select cant from detrefsuc where idsuc=pidsuc and idref=pidref);
    set @subtotal=(select folios.subtotal from folios join detservicio on folios.folio=detservicio.folio where detservicio.idServ=pidServ);
    set @id=(select folios.folio from folios join detservicio on folios.folio=detservicio.folio where detservicio.idServ=pidServ);
    
    if exists (select idref from refacciones where idref=pidref)then
        if exists (select idServ from detservicio where idServ=pidServ)then
            if(@exist>pcant || @exist=pcant)then
                if exists(select idServ from detservref where idServ=pidServ and idref=pidref)then
                    set @cant=(select cantV from detservref where idref=pidref and idServ=pidServ);
                    update detservref set cantV=(@cant+pcant) where idref=pidref and idServ=pidserv;
                   
                    update folios set subtotal=@subtotal+(pcant*pprecio) where folio=@id;
                    update detrefsuc set cant=@exist-pcant where idsuc=pidsuc and idref=pidref;
                    set ban:=1;
                else
                    insert into detservref (idref,idServ,cantV) values(pidref,pidServ,pcant);
                    
                    update folios set subtotal=@subtotal+(pcant*pprecio) where folio=@id;
                    update detrefsuc set cant=@exist-pcant where idsuc=pidsuc and idref=pidref;            
                    set ban:=2;
                end if;
            else 
                set ban:=3; 
            end if;
        else 
            set ban:=4; 
        end if;
    else 
        set ban:=5; 
    end if;
     if(error=1)then
            rollback;
            set ban:=6;
        else
            commit;
        end if;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-02 18:32:29

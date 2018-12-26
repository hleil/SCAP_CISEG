-- MySQL dump 10.13  Distrib 8.0.13, for macos10.14 (x86_64)
--
-- Host: localhost    Database: SCAP
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CATCATESCAP`
--

DROP TABLE IF EXISTS `CATCATESCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATCATESCAP` (
  `idCATCATESCAP` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(100) NOT NULL,
  PRIMARY KEY (`idCATCATESCAP`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATCATESCAP`
--

LOCK TABLES `CATCATESCAP` WRITE;
/*!40000 ALTER TABLE `CATCATESCAP` DISABLE KEYS */;
INSERT INTO `CATCATESCAP` VALUES (1,'Vulnerabilidad'),(2,'Bug'),(3,'Punto crítico de seguridad'),(4,'Debilidad de diseño');
/*!40000 ALTER TABLE `CATCATESCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATESTATUSACTIVO`
--

DROP TABLE IF EXISTS `CATESTATUSACTIVO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATESTATUSACTIVO` (
  `idCATESTATUSACTIVO` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCATESTATUSACTIVO`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATESTATUSACTIVO`
--

LOCK TABLES `CATESTATUSACTIVO` WRITE;
/*!40000 ALTER TABLE `CATESTATUSACTIVO` DISABLE KEYS */;
INSERT INTO `CATESTATUSACTIVO` VALUES (1,'Activo'),(2,'Terminada');
/*!40000 ALTER TABLE `CATESTATUSACTIVO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATESTATUSCASOPRUEBA`
--

DROP TABLE IF EXISTS `CATESTATUSCASOPRUEBA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATESTATUSCASOPRUEBA` (
  `idCATESTATUSPRUEBA` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idCATESTATUSPRUEBA`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATESTATUSCASOPRUEBA`
--

LOCK TABLES `CATESTATUSCASOPRUEBA` WRITE;
/*!40000 ALTER TABLE `CATESTATUSCASOPRUEBA` DISABLE KEYS */;
INSERT INTO `CATESTATUSCASOPRUEBA` VALUES (1,'Activo'),(2,'En proceso'),(3,'Terminada'),(4,'Rechazada'),(5,'En validación');
/*!40000 ALTER TABLE `CATESTATUSCASOPRUEBA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATESTATUSPRUEBA`
--

DROP TABLE IF EXISTS `CATESTATUSPRUEBA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATESTATUSPRUEBA` (
  `idCATESTATUSPRUEBA` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idCATESTATUSPRUEBA`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATESTATUSPRUEBA`
--

LOCK TABLES `CATESTATUSPRUEBA` WRITE;
/*!40000 ALTER TABLE `CATESTATUSPRUEBA` DISABLE KEYS */;
INSERT INTO `CATESTATUSPRUEBA` VALUES (1,'Activo'),(2,'En proceso'),(3,'Terminada');
/*!40000 ALTER TABLE `CATESTATUSPRUEBA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATESTATUSUSR`
--

DROP TABLE IF EXISTS `CATESTATUSUSR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATESTATUSUSR` (
  `idCATESTATUSUSR` int(11) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idCATESTATUSUSR`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATESTATUSUSR`
--

LOCK TABLES `CATESTATUSUSR` WRITE;
/*!40000 ALTER TABLE `CATESTATUSUSR` DISABLE KEYS */;
INSERT INTO `CATESTATUSUSR` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `CATESTATUSUSR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATIPOREVCONFIGURACION`
--

DROP TABLE IF EXISTS `CATIPOREVCONFIGURACION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATIPOREVCONFIGURACION` (
  `idCATIPOREVCONFIGURACION` int(11) NOT NULL AUTO_INCREMENT,
  `revision` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCATIPOREVCONFIGURACION`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATIPOREVCONFIGURACION`
--

LOCK TABLES `CATIPOREVCONFIGURACION` WRITE;
/*!40000 ALTER TABLE `CATIPOREVCONFIGURACION` DISABLE KEYS */;
INSERT INTO `CATIPOREVCONFIGURACION` VALUES (1,'Firmware'),(2,'Sistema Operativo'),(3,'Gestor de base de datos'),(4,'Servidor HTTP');
/*!40000 ALTER TABLE `CATIPOREVCONFIGURACION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATMETODOLOGIA`
--

DROP TABLE IF EXISTS `CATMETODOLOGIA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATMETODOLOGIA` (
  `idCATMETODOLOGIA` int(11) NOT NULL AUTO_INCREMENT,
  `metodologia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCATMETODOLOGIA`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATMETODOLOGIA`
--

LOCK TABLES `CATMETODOLOGIA` WRITE;
/*!40000 ALTER TABLE `CATMETODOLOGIA` DISABLE KEYS */;
INSERT INTO `CATMETODOLOGIA` VALUES (1,'OWASP'),(2,'OSSTMM');
/*!40000 ALTER TABLE `CATMETODOLOGIA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATROL`
--

DROP TABLE IF EXISTS `CATROL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATROL` (
  `idCATROL` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idCATROL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATROL`
--

LOCK TABLES `CATROL` WRITE;
/*!40000 ALTER TABLE `CATROL` DISABLE KEYS */;
INSERT INTO `CATROL` VALUES (1,'Administrador'),(2,'Responsable de evaluación'),(3,'Evaluador'),(4,'Validador');
/*!40000 ALTER TABLE `CATROL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATSEVERSQSCAP`
--

DROP TABLE IF EXISTS `CATSEVERSQSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATSEVERSQSCAP` (
  `idCATSEVERSQSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSeveridad` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCATSEVERSQSCAP`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATSEVERSQSCAP`
--

LOCK TABLES `CATSEVERSQSCAP` WRITE;
/*!40000 ALTER TABLE `CATSEVERSQSCAP` DISABLE KEYS */;
INSERT INTO `CATSEVERSQSCAP` VALUES (1,'Informativa'),(2,'Menor'),(3,'Mayor'),(4,'Crítica'),(5,'Blocker');
/*!40000 ALTER TABLE `CATSEVERSQSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATTIPOAMESCAP`
--

DROP TABLE IF EXISTS `CATTIPOAMESCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATTIPOAMESCAP` (
  `idCATTIPOAMESCAP` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAmenaza` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCATTIPOAMESCAP`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATTIPOAMESCAP`
--

LOCK TABLES `CATTIPOAMESCAP` WRITE;
/*!40000 ALTER TABLE `CATTIPOAMESCAP` DISABLE KEYS */;
INSERT INTO `CATTIPOAMESCAP` VALUES (1,'Autenticación'),(2,'Autorización'),(3,'Administración de configuración'),(4,'Protección de datos y almacenamiento'),(5,'Validación de datos'),(6,'Manejo de errores y excepciones'),(7,'Administración de usuarios y sesiones'),(8,'Auditoria y login');
/*!40000 ALTER TABLE `CATTIPOAMESCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATTIPOPRUEBA`
--

DROP TABLE IF EXISTS `CATTIPOPRUEBA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATTIPOPRUEBA` (
  `idCATTIPOPRUEBA` int(11) NOT NULL AUTO_INCREMENT,
  `tipoPrueba` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idCATTIPOPRUEBA`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATTIPOPRUEBA`
--

LOCK TABLES `CATTIPOPRUEBA` WRITE;
/*!40000 ALTER TABLE `CATTIPOPRUEBA` DISABLE KEYS */;
INSERT INTO `CATTIPOPRUEBA` VALUES (1,'Revisión de configuraciones'),(2,'Seguridad y calidad');
/*!40000 ALTER TABLE `CATTIPOPRUEBA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATTIPOSCAP`
--

DROP TABLE IF EXISTS `CATTIPOSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CATTIPOSCAP` (
  `idCATTIPOSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `nombreTipo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCATTIPOSCAP`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATTIPOSCAP`
--

LOCK TABLES `CATTIPOSCAP` WRITE;
/*!40000 ALTER TABLE `CATTIPOSCAP` DISABLE KEYS */;
INSERT INTO `CATTIPOSCAP` VALUES (1,'Análisis estático de código'),(2,'Análisis de funcionalidad');
/*!40000 ALTER TABLE `CATTIPOSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CPE`
--

DROP TABLE IF EXISTS `CPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CPE` (
  `idCPE` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `part` varchar(1) DEFAULT NULL,
  `vendor` varchar(45) DEFAULT NULL,
  `product` varchar(150) DEFAULT NULL,
  `version` varchar(25) DEFAULT NULL,
  `update` varchar(80) DEFAULT NULL,
  `edition` varchar(80) DEFAULT NULL,
  `language` varchar(80) DEFAULT NULL,
  `softwareEdition` varchar(80) DEFAULT NULL,
  `targetSoftware` varchar(80) DEFAULT NULL,
  `targetHardware` varchar(80) DEFAULT NULL,
  `other` varchar(120) DEFAULT NULL,
  `idTarevconfiguracion` int(11) NOT NULL,
  PRIMARY KEY (`idCPE`),
  KEY `fk_CPE_TAREVCONFIGURACION1_idx` (`idTarevconfiguracion`),
  CONSTRAINT `fk_CPE_TAREVCONFIGURACION1` FOREIGN KEY (`idTarevconfiguracion`) REFERENCES `tarevconfiguracion` (`idtarevconfiguracion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CPE`
--

LOCK TABLES `CPE` WRITE;
/*!40000 ALTER TABLE `CPE` DISABLE KEYS */;
/*!40000 ALTER TABLE `CPE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REGLOGIN`
--

DROP TABLE IF EXISTS `REGLOGIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `REGLOGIN` (
  `idREGLOGIN` int(11) NOT NULL AUTO_INCREMENT,
  `login` datetime DEFAULT NULL,
  `idUsr` int(11) NOT NULL,
  PRIMARY KEY (`idREGLOGIN`),
  KEY `fk_REGLOGIN_TAUSRSCAP1_idx` (`idUsr`),
  CONSTRAINT `fk_REGLOGIN_TAUSRSCAP1` FOREIGN KEY (`idUsr`) REFERENCES `tausrscap` (`idtausrscap`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REGLOGIN`
--

LOCK TABLES `REGLOGIN` WRITE;
/*!40000 ALTER TABLE `REGLOGIN` DISABLE KEYS */;
INSERT INTO `REGLOGIN` VALUES (1,'2018-12-17 04:45:22',2),(2,'2018-12-17 04:48:07',3),(3,'2018-12-17 04:48:44',4),(4,'2018-12-17 04:49:21',7);
/*!40000 ALTER TABLE `REGLOGIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REGMOD`
--

DROP TABLE IF EXISTS `REGMOD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `REGMOD` (
  `idREGMOD` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(60) DEFAULT NULL,
  `valorAnterior` text,
  `valorActual` text,
  `idUsr` int(11) NOT NULL,
  PRIMARY KEY (`idREGMOD`),
  KEY `fk_REGMOD_TAUSRSCAP1_idx` (`idUsr`),
  CONSTRAINT `fk_REGMOD_TAUSRSCAP1` FOREIGN KEY (`idUsr`) REFERENCES `tausrscap` (`idtausrscap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REGMOD`
--

LOCK TABLES `REGMOD` WRITE;
/*!40000 ALTER TABLE `REGMOD` DISABLE KEYS */;
/*!40000 ALTER TABLE `REGMOD` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAACTIVOSCAP`
--

DROP TABLE IF EXISTS `TAACTIVOSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAACTIVOSCAP` (
  `idTAACTIVOSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `fInicio` date DEFAULT NULL,
  `fFin` date DEFAULT NULL,
  `propietarioActivo` varchar(80) DEFAULT NULL,
  `comentarios` text,
  `version` varchar(45) DEFAULT NULL,
  `fAlta` datetime DEFAULT NULL,
  `fMod` datetime DEFAULT NULL,
  `responsable` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`idTAACTIVOSCAP`),
  KEY `fk_TAACTIVOSCAP_TAUSRSCAP1_idx` (`responsable`),
  KEY `fk_TAACTIVOSCAP_CATESTATUSACTIVO1_idx` (`estatus`),
  CONSTRAINT `fk_TAACTIVOSCAP_CATESTATUSACTIVO1` FOREIGN KEY (`estatus`) REFERENCES `catestatusactivo` (`idcatestatusactivo`),
  CONSTRAINT `fk_TAACTIVOSCAP_TAUSRSCAP1` FOREIGN KEY (`responsable`) REFERENCES `tausrscap` (`idtausrscap`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAACTIVOSCAP`
--

LOCK TABLES `TAACTIVOSCAP` WRITE;
/*!40000 ALTER TABLE `TAACTIVOSCAP` DISABLE KEYS */;
INSERT INTO `TAACTIVOSCAP` VALUES (1,'SABER','2019-01-01','2019-02-01','CIC IPN','Evaluación anual 2018','3','2018-12-17 04:45:53',NULL,2,1);
/*!40000 ALTER TABLE `TAACTIVOSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TACASOPRUEBACONFSCAP`
--

DROP TABLE IF EXISTS `TACASOPRUEBACONFSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TACASOPRUEBACONFSCAP` (
  `idTACASOPRUEBASCAP` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(150) DEFAULT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `descripcion` text,
  `entrada` text,
  `resultado` text,
  `informacionComplementaria` text,
  `evidencias` text,
  `recomendacion` text,
  `resultadoPrueba` varchar(45) DEFAULT NULL,
  `contadorRevision` int(11) DEFAULT '0',
  `comentariosValidador` text,
  `fAlta` datetime DEFAULT NULL,
  `fMod` datetime DEFAULT NULL,
  `estatus` int(11) NOT NULL,
  `revConfiguracion` int(11) NOT NULL,
  PRIMARY KEY (`idTACASOPRUEBASCAP`),
  KEY `fk_TACASOPRUEBACONFSCAP_CATESTATUSCASOPRUEBA1_idx` (`estatus`),
  KEY `fk_TACASOPRUEBACONFSCAP_TAREVCONFIGURACION1_idx` (`revConfiguracion`),
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_CATESTATUSCASOPRUEBA1` FOREIGN KEY (`estatus`) REFERENCES `catestatuscasoprueba` (`idcatestatusprueba`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_TAREVCONFIGURACION1` FOREIGN KEY (`revConfiguracion`) REFERENCES `tarevconfiguracion` (`idtarevconfiguracion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TACASOPRUEBACONFSCAP`
--

LOCK TABLES `TACASOPRUEBACONFSCAP` WRITE;
/*!40000 ALTER TABLE `TACASOPRUEBACONFSCAP` DISABLE KEYS */;
INSERT INTO `TACASOPRUEBACONFSCAP` VALUES (1,'Configuración del sistema de archivos','Asegurar que el montaje de los sistemas de archivos cramfs esté deshabilitado','Verificar que el sistema operativo no tuviera montado el sistema de archivos cramfs.','$ modprobe -n -v freevxfs\r\n$ lsmod | grep freevxfs\r\n','','Los comandos no arrojaron alguna salida en consola, por lo cual el formato  cramfs está deshabilitado','','','Correcto',0,NULL,'2018-12-17 04:46:28','2018-12-17 04:48:25',5,1),(2,'Configuración del sistema de archivos','Asegurar que el montaje de los sistemas de archivos cramfs esté deshabilitado','Verificar que el sistema operativo no tuviera montado el sistema de archivos cramfs.','$ modprobe -n -v freevxfs\r\n$ lsmod | grep freevxfs\r\n','Ninguno','Al no tener ningún resultado en consola, el formato  cramfs está deshabilitado','','','Correcto',0,NULL,'2018-12-17 04:46:28','2018-12-17 04:49:03',5,1),(3,'Configuración del sistema de archivos','Asegurar que el montaje de los sistemas de archivos FAT esté deshabilitado','Verificar que el sistema operativo no tuviera montado el sistema de archivos fat.',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:46:43',NULL,1,1),(4,'Configuración del sistema de archivos','Asegurar que el montaje de los sistemas de archivos FAT esté deshabilitado','Verificar que el sistema operativo no tuviera montado el sistema de archivos fat.',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:46:43',NULL,1,1),(5,'Configuración del nivel del sistema operativo','Cuenta con privilegios mínimos dedicados','Verificar que el usuario para el sistema del SABER no tenga privilegios de administración sobre el gestor de la base de datos',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:47:07',NULL,1,2),(6,'Configuración del nivel del sistema operativo','Cuenta con privilegios mínimos dedicados','Verificar que el usuario para el sistema del SABER no tenga privilegios de administración sobre el gestor de la base de datos',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:47:07',NULL,1,2),(7,'Configuración del nivel del sistema operativo','Historial de comandos de MySQL','Verificar que no exista el archivo que guarda el historial de las sentencias ejecutadas en el gestor de la base de datos',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:47:18',NULL,1,2),(8,'Configuración del nivel del sistema operativo','Historial de comandos de MySQL','Verificar que no exista el archivo que guarda el historial de las sentencias ejecutadas en el gestor de la base de datos',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:47:18',NULL,1,2),(9,'Configuraciones Generales','Verificar que la base de datos “Test” no esté instalada','Verificar que la base de datos “Test” no estuviera dentro del gestor de base de datos',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:47:33',NULL,1,2),(10,'Configuraciones Generales','Verificar que la base de datos “Test” no esté instalada','Verificar que la base de datos “Test” no estuviera dentro del gestor de base de datos',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-17 04:47:33',NULL,1,2);
/*!40000 ALTER TABLE `TACASOPRUEBACONFSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TADETECCSCAP`
--

DROP TABLE IF EXISTS `TADETECCSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TADETECCSCAP` (
  `idTADETECCSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `regla` text,
  `contramedida` text,
  `idSeveridadSQ` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idRegla` int(11) NOT NULL,
  `idTipoAmenaza` int(11) NOT NULL,
  `idSegCal` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTADETECCSCAP`),
  KEY `fk_TASEGCALSCAP_CATSEVERSQSCAP1_idx` (`idSeveridadSQ`),
  KEY `fk_TASEGCALSCAP_CATCATESCAP1_idx` (`idCategoria`),
  KEY `fk_TASEGCALSCAP_CATTIPOAMESCAP1_idx` (`idTipoAmenaza`),
  KEY `fk_TADETECCSCAP_TASEGCALSCAP11_idx` (`idSegCal`),
  CONSTRAINT `fk_TADETECCSCAP_TASEGCALSCAP11` FOREIGN KEY (`idSegCal`) REFERENCES `tasegcalscap` (`idtasegcalscap`),
  CONSTRAINT `fk_TASEGCALSCAP_CATCATESCAP1` FOREIGN KEY (`idCategoria`) REFERENCES `catcatescap` (`idcatcatescap`),
  CONSTRAINT `fk_TASEGCALSCAP_CATSEVERSQSCAP1` FOREIGN KEY (`idSeveridadSQ`) REFERENCES `catseversqscap` (`idcatseversqscap`),
  CONSTRAINT `fk_TASEGCALSCAP_CATTIPOAMESCAP1` FOREIGN KEY (`idTipoAmenaza`) REFERENCES `cattipoamescap` (`idcattipoamescap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TADETECCSCAP`
--

LOCK TABLES `TADETECCSCAP` WRITE;
/*!40000 ALTER TABLE `TADETECCSCAP` DISABLE KEYS */;
/*!40000 ALTER TABLE `TADETECCSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TADIAGSCAP`
--

DROP TABLE IF EXISTS `TADIAGSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TADIAGSCAP` (
  `idTADIAGSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `Diagrama` blob NOT NULL,
  `idSegCal` int(11) NOT NULL,
  PRIMARY KEY (`idTADIAGSCAP`),
  KEY `fk_TADIAGSCAP_TASEGCALSCAP11_idx` (`idSegCal`),
  CONSTRAINT `fk_TADIAGSCAP_TASEGCALSCAP11` FOREIGN KEY (`idSegCal`) REFERENCES `tasegcalscap` (`idtasegcalscap`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TADIAGSCAP`
--

LOCK TABLES `TADIAGSCAP` WRITE;
/*!40000 ALTER TABLE `TADIAGSCAP` DISABLE KEYS */;
/*!40000 ALTER TABLE `TADIAGSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAPRUEBASCAP`
--

DROP TABLE IF EXISTS `TAPRUEBASCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAPRUEBASCAP` (
  `idTAPRUEBASCAP` int(11) NOT NULL AUTO_INCREMENT,
  `fInicio` date DEFAULT NULL,
  `fFin` date DEFAULT NULL,
  `fAlta` datetime DEFAULT NULL,
  `fMod` datetime DEFAULT NULL,
  `metodologia` int(11) NOT NULL,
  `tipoPrueba` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `idActivo` int(11) NOT NULL,
  PRIMARY KEY (`idTAPRUEBASCAP`),
  KEY `fk_TAPRUEBASCAP_CATMETODOLOGIA1_idx` (`metodologia`),
  KEY `fk_TAPRUEBASCAP_CATTIPOPRUEBA1_idx` (`tipoPrueba`),
  KEY `fk_TAPRUEBASCAP_CATESTATUSPRUEBA1_idx` (`estatus`),
  KEY `fk_TAPRUEBASCAP_TAACTIVOSCAP1_idx` (`idActivo`),
  CONSTRAINT `fk_TAPRUEBASCAP_CATESTATUSPRUEBA1` FOREIGN KEY (`estatus`) REFERENCES `catestatusprueba` (`idcatestatusprueba`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TAPRUEBASCAP_CATMETODOLOGIA1` FOREIGN KEY (`metodologia`) REFERENCES `catmetodologia` (`idcatmetodologia`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TAPRUEBASCAP_CATTIPOPRUEBA1` FOREIGN KEY (`tipoPrueba`) REFERENCES `cattipoprueba` (`idcattipoprueba`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TAPRUEBASCAP_TAACTIVOSCAP1` FOREIGN KEY (`idActivo`) REFERENCES `taactivoscap` (`idtaactivoscap`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAPRUEBASCAP`
--

LOCK TABLES `TAPRUEBASCAP` WRITE;
/*!40000 ALTER TABLE `TAPRUEBASCAP` DISABLE KEYS */;
INSERT INTO `TAPRUEBASCAP` VALUES (1,'2019-01-01','2019-02-01','2018-12-17 04:45:53',NULL,2,1,1,1);
/*!40000 ALTER TABLE `TAPRUEBASCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAREFERSCAP`
--

DROP TABLE IF EXISTS `TAREFERSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAREFERSCAP` (
  `idTAREFERSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `Ubicacion` varchar(150) DEFAULT NULL,
  `LineaCodigo` int(11) DEFAULT NULL,
  `Codigo` varchar(150) DEFAULT NULL,
  `idDeteccion` int(11) NOT NULL,
  PRIMARY KEY (`idTAREFERSCAP`),
  KEY `fk_TAREFERSCAP_TADETECCSCAP1_idx` (`idDeteccion`),
  CONSTRAINT `fk_TAREFERSCAP_TADETECCSCAP1` FOREIGN KEY (`idDeteccion`) REFERENCES `tadeteccscap` (`idtadeteccscap`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAREFERSCAP`
--

LOCK TABLES `TAREFERSCAP` WRITE;
/*!40000 ALTER TABLE `TAREFERSCAP` DISABLE KEYS */;
/*!40000 ALTER TABLE `TAREFERSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAREVCONFIGURACION`
--

DROP TABLE IF EXISTS `TAREVCONFIGURACION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAREVCONFIGURACION` (
  `idTAREVCONFIGURACION` int(11) NOT NULL AUTO_INCREMENT,
  `fabricante` varchar(80) DEFAULT NULL,
  `producto` varchar(80) DEFAULT NULL,
  `version` varchar(80) DEFAULT NULL,
  `edicion` varchar(80) DEFAULT NULL,
  `edicionSoftware` varchar(80) DEFAULT NULL,
  `comentarios` text,
  `idPrueba` int(11) NOT NULL,
  `tipoRevision` int(11) NOT NULL,
  PRIMARY KEY (`idTAREVCONFIGURACION`),
  KEY `fk_TAREVCONFIGURACION_TAPRUEBASCAP1_idx` (`idPrueba`),
  KEY `fk_TAREVCONFIGURACION_CATIPOREVCONFIGURACION1_idx` (`tipoRevision`),
  CONSTRAINT `fk_TAREVCONFIGURACION_CATIPOREVCONFIGURACION1` FOREIGN KEY (`tipoRevision`) REFERENCES `catiporevconfiguracion` (`idcatiporevconfiguracion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TAREVCONFIGURACION_TAPRUEBASCAP1` FOREIGN KEY (`idPrueba`) REFERENCES `tapruebascap` (`idtapruebascap`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAREVCONFIGURACION`
--

LOCK TABLES `TAREVCONFIGURACION` WRITE;
/*!40000 ALTER TABLE `TAREVCONFIGURACION` DISABLE KEYS */;
INSERT INTO `TAREVCONFIGURACION` VALUES (1,'Red Hat','Linux Server','7.5','Enterprise Edition','x86_64','Máquina Virtual',1,2),(2,'MariaDB Corporation','MariaDB','10.1','Distrib 15.1for Linux','x86_64','',1,3);
/*!40000 ALTER TABLE `TAREVCONFIGURACION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TASEGCALSCAP`
--

DROP TABLE IF EXISTS `TASEGCALSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TASEGCALSCAP` (
  `idTASEGCALSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `recomendacion` text,
  `contadorRevision` int(11) DEFAULT NULL,
  `comentarioValidador` text,
  `idPrueba` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`idTASEGCALSCAP`),
  KEY `fk_TASEGCALSCAP1_TAPRUEBASCAP1_idx` (`idPrueba`),
  KEY `fk_TASEGCALSCAP_CATTIPOSCAP1_idx` (`idTipo`),
  KEY `fk_TASEGCALSCAP_CATESTATUSCASOPRUEBA1_idx` (`estatus`),
  CONSTRAINT `fk_TASEGCALSCAP1_TAPRUEBASCAP1` FOREIGN KEY (`idPrueba`) REFERENCES `tapruebascap` (`idtapruebascap`),
  CONSTRAINT `fk_TASEGCALSCAP_CATESTATUSCASOPRUEBA1` FOREIGN KEY (`estatus`) REFERENCES `catestatuscasoprueba` (`idcatestatusprueba`),
  CONSTRAINT `fk_TASEGCALSCAP_CATTIPOSCAP1` FOREIGN KEY (`idTipo`) REFERENCES `cattiposcap` (`idcattiposcap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TASEGCALSCAP`
--

LOCK TABLES `TASEGCALSCAP` WRITE;
/*!40000 ALTER TABLE `TASEGCALSCAP` DISABLE KEYS */;
/*!40000 ALTER TABLE `TASEGCALSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAUSRCONFSCAP`
--

DROP TABLE IF EXISTS `TAUSRCONFSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAUSRCONFSCAP` (
  `idUSR` int(11) NOT NULL,
  `idCasoPruebaConf` int(11) NOT NULL,
  PRIMARY KEY (`idUSR`,`idCasoPruebaConf`),
  KEY `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TAUSRSCAP1_idx` (`idUSR`),
  KEY `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TACASOPRUEBACONFSCAP1_idx` (`idCasoPruebaConf`),
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TACASOPRUEBACONFSCAP1` FOREIGN KEY (`idCasoPruebaConf`) REFERENCES `tacasopruebaconfscap` (`idtacasopruebascap`) ON UPDATE CASCADE,
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TAUSRSCAP1` FOREIGN KEY (`idUSR`) REFERENCES `tausrscap` (`idtausrscap`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAUSRCONFSCAP`
--

LOCK TABLES `TAUSRCONFSCAP` WRITE;
/*!40000 ALTER TABLE `TAUSRCONFSCAP` DISABLE KEYS */;
INSERT INTO `TAUSRCONFSCAP` VALUES (3,1),(3,3),(3,5),(3,7),(3,9),(4,2),(4,4),(4,6),(4,8),(4,10);
/*!40000 ALTER TABLE `TAUSRCONFSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAUSRS_has_TACASOPRUEBACONFSCAP`
--

DROP TABLE IF EXISTS `TAUSRS_has_TACASOPRUEBACONFSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAUSRS_has_TACASOPRUEBACONFSCAP` (
  `idEvaluador` int(11) NOT NULL,
  `idCasoPrueba` int(11) NOT NULL,
  PRIMARY KEY (`idEvaluador`,`idCasoPrueba`),
  KEY `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TACASOPRUEBACONFSCAP1_idx` (`idCasoPrueba`),
  KEY `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TAUSRSCAP1_idx` (`idEvaluador`),
  CONSTRAINT `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TACASOPRUEBACONFSCAP1` FOREIGN KEY (`idCasoPrueba`) REFERENCES `tacasopruebaconfscap` (`idtacasopruebascap`),
  CONSTRAINT `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TAUSRSCAP1` FOREIGN KEY (`idEvaluador`) REFERENCES `tausrscap` (`idtausrscap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAUSRS_has_TACASOPRUEBACONFSCAP`
--

LOCK TABLES `TAUSRS_has_TACASOPRUEBACONFSCAP` WRITE;
/*!40000 ALTER TABLE `TAUSRS_has_TACASOPRUEBACONFSCAP` DISABLE KEYS */;
/*!40000 ALTER TABLE `TAUSRS_has_TACASOPRUEBACONFSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAUSRSCAP`
--

DROP TABLE IF EXISTS `TAUSRSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAUSRSCAP` (
  `idTAUSRSCAP` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contrasena` varchar(65) NOT NULL,
  `primerLogin` int(11) NOT NULL,
  `fAlta` datetime NOT NULL,
  `fMod` datetime DEFAULT NULL,
  `rol` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  PRIMARY KEY (`idTAUSRSCAP`),
  UNIQUE KEY `correo_UNIQUE` (`correo`),
  KEY `fk_TAUSRSCAP_CATROL_idx` (`rol`),
  KEY `fk_TAUSRSCAP_CATESTATUSUSR1_idx` (`estatus`),
  CONSTRAINT `fk_TAUSRSCAP_CATESTATUSUSR1` FOREIGN KEY (`estatus`) REFERENCES `catestatususr` (`idcatestatususr`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TAUSRSCAP_CATROL` FOREIGN KEY (`rol`) REFERENCES `catrol` (`idcatrol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAUSRSCAP`
--

LOCK TABLES `TAUSRSCAP` WRITE;
/*!40000 ALTER TABLE `TAUSRSCAP` DISABLE KEYS */;
INSERT INTO `TAUSRSCAP` VALUES (1,'Administrador','admin@admin.com','f7ca99e01b352fe0497674bde192879da301c5168074f1e933e6c81ff2dbc05e',0,'2018-12-17 04:44:57',NULL,1,1),(2,'Eleazar Aguirre Anaya','eaguirre@cic.ipn.mx','f7ca99e01b352fe0497674bde192879da301c5168074f1e933e6c81ff2dbc05e',0,'2018-12-17 04:44:57',NULL,2,1),(3,'Miguel Hernández Hernández','hegumi@hotmail.com','f7ca99e01b352fe0497674bde192879da301c5168074f1e933e6c81ff2dbc05e',0,'2018-12-17 04:44:57',NULL,3,1),(4,'Byron González Flores','byronemail7@gmail.com','f7ca99e01b352fe0497674bde192879da301c5168074f1e933e6c81ff2dbc05e',0,'2018-12-17 04:44:57',NULL,3,1),(5,'Luis Macedo Santiago','lumacs13@gmail.com','3772b212b455938bd052e58e11963a78fd0d2173005c9b69a18ebb571fcf2c4f',1,'2018-12-17 04:44:57',NULL,3,1),(6,'Armando Díaz Peláez','c.armando.diaz.p@gmail.com','3772b212b455938bd052e58e11963a78fd0d2173005c9b69a18ebb571fcf2c4f',1,'2018-12-17 04:44:57',NULL,3,1),(7,'Ivan Sánchez','isc.ivan.sanchez@gmail.com','f7ca99e01b352fe0497674bde192879da301c5168074f1e933e6c81ff2dbc05e',0,'2018-12-17 04:44:57',NULL,4,1),(8,'Antonio Ocampo','fenix@engineer.com','3772b212b455938bd052e58e11963a78fd0d2173005c9b69a18ebb571fcf2c4f',1,'2018-12-17 04:44:57',NULL,4,1);
/*!40000 ALTER TABLE `TAUSRSCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAUSRSCAP_TAPRUEBASCAP`
--

DROP TABLE IF EXISTS `TAUSRSCAP_TAPRUEBASCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAUSRSCAP_TAPRUEBASCAP` (
  `idUSR` int(11) NOT NULL,
  `idPrueba` int(11) NOT NULL,
  PRIMARY KEY (`idUSR`,`idPrueba`),
  KEY `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAPRUEBASCAP1_idx` (`idPrueba`),
  KEY `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAUSRSCAP1_idx` (`idUSR`),
  CONSTRAINT `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAPRUEBASCAP1` FOREIGN KEY (`idPrueba`) REFERENCES `tapruebascap` (`idtapruebascap`),
  CONSTRAINT `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAUSRSCAP1` FOREIGN KEY (`idUSR`) REFERENCES `tausrscap` (`idtausrscap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAUSRSCAP_TAPRUEBASCAP`
--

LOCK TABLES `TAUSRSCAP_TAPRUEBASCAP` WRITE;
/*!40000 ALTER TABLE `TAUSRSCAP_TAPRUEBASCAP` DISABLE KEYS */;
INSERT INTO `TAUSRSCAP_TAPRUEBASCAP` VALUES (7,1);
/*!40000 ALTER TABLE `TAUSRSCAP_TAPRUEBASCAP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TAUSRSCSCAP`
--

DROP TABLE IF EXISTS `TAUSRSCSCAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `TAUSRSCSCAP` (
  `idUSR` int(11) NOT NULL,
  `idCasoPruebaSC` int(11) NOT NULL,
  PRIMARY KEY (`idUSR`,`idCasoPruebaSC`),
  KEY `fk_TAUSRSCAP_has_TASEGCALSCAP_TASEGCALSCAP1_idx` (`idCasoPruebaSC`),
  KEY `fk_TAUSRSCAP_has_TASEGCALSCAP_TAUSRSCAP1_idx` (`idUSR`),
  CONSTRAINT `fk_TAUSRSCAP_has_TASEGCALSCAP_TASEGCALSCAP1` FOREIGN KEY (`idCasoPruebaSC`) REFERENCES `tasegcalscap` (`idtasegcalscap`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_TAUSRSCAP_has_TASEGCALSCAP_TAUSRSCAP1` FOREIGN KEY (`idUSR`) REFERENCES `tausrscap` (`idtausrscap`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TAUSRSCSCAP`
--

LOCK TABLES `TAUSRSCSCAP` WRITE;
/*!40000 ALTER TABLE `TAUSRSCSCAP` DISABLE KEYS */;
/*!40000 ALTER TABLE `TAUSRSCSCAP` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-17  4:54:06

-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema scap
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema scap
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `scap` DEFAULT CHARACTER SET utf8 ;
USE `scap` ;

-- -----------------------------------------------------
-- Table `scap`.`CATROL`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATROL` (
  `idCATROL` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(30) NULL,
  PRIMARY KEY (`idCATROL`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATESTATUSUSR`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATESTATUSUSR` (
  `idCATESTATUSUSR` INT NOT NULL AUTO_INCREMENT,
  `estatus` VARCHAR(10) NULL,
  PRIMARY KEY (`idCATESTATUSUSR`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATESTATUSPRUEBA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATESTATUSPRUEBA` (
  `idCATESTATUSPRUEBA` INT NOT NULL AUTO_INCREMENT,
  `estatus` VARCHAR(15) NULL,
  PRIMARY KEY (`idCATESTATUSPRUEBA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATMETODOLOGIA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATMETODOLOGIA` (
  `idCATMETODOLOGIA` INT NOT NULL AUTO_INCREMENT,
  `metodologia` VARCHAR(45) NULL,
  PRIMARY KEY (`idCATMETODOLOGIA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATTIPOPRUEBA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATTIPOPRUEBA` (
  `idCATTIPOPRUEBA` INT NOT NULL AUTO_INCREMENT,
  `tipoPrueba` VARCHAR(30) NULL,
  PRIMARY KEY (`idCATTIPOPRUEBA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAUSRSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAUSRSCAP` (
  `idTAUSRSCAP` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(80) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `contrasena` VARCHAR(65) NOT NULL,
  `primerLogin` INT NOT NULL,
  `fAlta` DATETIME NOT NULL,
  `fMod` DATETIME NULL,
  `rol` INT NOT NULL,
  `estatus` INT NOT NULL,
  PRIMARY KEY (`idTAUSRSCAP`),
  INDEX `fk_TAUSRSCAP_CATROL_idx` (`rol` ASC) VISIBLE,
  INDEX `fk_TAUSRSCAP_CATESTATUSUSR1_idx` (`estatus` ASC) VISIBLE,
  UNIQUE INDEX `correo_UNIQUE` (`correo` ASC) VISIBLE,
  CONSTRAINT `fk_TAUSRSCAP_CATROL`
    FOREIGN KEY (`rol`)
    REFERENCES `scap`.`CATROL` (`idCATROL`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TAUSRSCAP_CATESTATUSUSR1`
    FOREIGN KEY (`estatus`)
    REFERENCES `scap`.`CATESTATUSUSR` (`idCATESTATUSUSR`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATESTATUSCASOPRUEBA`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATESTATUSCASOPRUEBA` (
  `idCATESTATUSPRUEBA` INT NOT NULL AUTO_INCREMENT,
  `estatus` VARCHAR(15) NULL,
  PRIMARY KEY (`idCATESTATUSPRUEBA`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATESTATUSACTIVO`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATESTATUSACTIVO` (
  `idCATESTATUSACTIVO` INT NOT NULL AUTO_INCREMENT,
  `estatus` VARCHAR(45) NULL,
  PRIMARY KEY (`idCATESTATUSACTIVO`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAACTIVOSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAACTIVOSCAP` (
  `idTAACTIVOSCAP` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(80) NULL,
  `fInicio` DATE NULL,
  `fFin` DATE NULL,
  `propietarioActivo` VARCHAR(80) NULL,
  `comentarios` TEXT NULL,
  `version` VARCHAR(45) NULL,
  `fAlta` DATETIME NULL,
  `fMod` DATETIME NULL,
  `responsable` INT NOT NULL,
  `estatus` INT NOT NULL,
  PRIMARY KEY (`idTAACTIVOSCAP`),
  INDEX `fk_TAACTIVOSCAP_TAUSRSCAP1_idx` (`responsable` ASC) VISIBLE,
  INDEX `fk_TAACTIVOSCAP_CATESTATUSACTIVO1_idx` (`estatus` ASC) VISIBLE,
  CONSTRAINT `fk_TAACTIVOSCAP_TAUSRSCAP1`
    FOREIGN KEY (`responsable`)
    REFERENCES `scap`.`TAUSRSCAP` (`idTAUSRSCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TAACTIVOSCAP_CATESTATUSACTIVO1`
    FOREIGN KEY (`estatus`)
    REFERENCES `scap`.`CATESTATUSACTIVO` (`idCATESTATUSACTIVO`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAPRUEBASCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAPRUEBASCAP` (
  `idTAPRUEBASCAP` INT NOT NULL AUTO_INCREMENT,
  `fInicio` DATE NULL,
  `fFin` DATE NULL,
  `fAlta` DATETIME NULL,
  `fMod` DATETIME NULL,
  `metodologia` INT NOT NULL,
  `tipoPrueba` INT NOT NULL,
  `estatus` INT NOT NULL,
  `idActivo` INT NOT NULL,
  PRIMARY KEY (`idTAPRUEBASCAP`),
  INDEX `fk_TAPRUEBASCAP_CATMETODOLOGIA1_idx` (`metodologia` ASC) VISIBLE,
  INDEX `fk_TAPRUEBASCAP_CATTIPOPRUEBA1_idx` (`tipoPrueba` ASC) VISIBLE,
  INDEX `fk_TAPRUEBASCAP_CATESTATUSPRUEBA1_idx` (`estatus` ASC) VISIBLE,
  INDEX `fk_TAPRUEBASCAP_TAACTIVOSCAP1_idx` (`idActivo` ASC) VISIBLE,
  CONSTRAINT `fk_TAPRUEBASCAP_CATMETODOLOGIA1`
    FOREIGN KEY (`metodologia`)
    REFERENCES `scap`.`CATMETODOLOGIA` (`idCATMETODOLOGIA`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TAPRUEBASCAP_CATTIPOPRUEBA1`
    FOREIGN KEY (`tipoPrueba`)
    REFERENCES `scap`.`CATTIPOPRUEBA` (`idCATTIPOPRUEBA`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TAPRUEBASCAP_CATESTATUSPRUEBA1`
    FOREIGN KEY (`estatus`)
    REFERENCES `scap`.`CATESTATUSPRUEBA` (`idCATESTATUSPRUEBA`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TAPRUEBASCAP_TAACTIVOSCAP1`
    FOREIGN KEY (`idActivo`)
    REFERENCES `scap`.`TAACTIVOSCAP` (`idTAACTIVOSCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATIPOREVCONFIGURACION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATIPOREVCONFIGURACION` (
  `idCATIPOREVCONFIGURACION` INT NOT NULL AUTO_INCREMENT,
  `revision` VARCHAR(45) NULL,
  PRIMARY KEY (`idCATIPOREVCONFIGURACION`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAREVCONFIGURACION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAREVCONFIGURACION` (
  `idTAREVCONFIGURACION` INT NOT NULL AUTO_INCREMENT,
  `fabricante` VARCHAR(80) NULL,
  `producto` VARCHAR(80) NULL,
  `version` VARCHAR(80) NULL,
  `edicion` VARCHAR(80) NULL,
  `edicionSoftware` VARCHAR(80) NULL,
  `comentarios` TEXT NULL,
  `idPrueba` INT NOT NULL,
  `tipoRevision` INT NOT NULL,
  PRIMARY KEY (`idTAREVCONFIGURACION`),
  INDEX `fk_TAREVCONFIGURACION_TAPRUEBASCAP1_idx` (`idPrueba` ASC) VISIBLE,
  INDEX `fk_TAREVCONFIGURACION_CATIPOREVCONFIGURACION1_idx` (`tipoRevision` ASC) VISIBLE,
  CONSTRAINT `fk_TAREVCONFIGURACION_TAPRUEBASCAP1`
    FOREIGN KEY (`idPrueba`)
    REFERENCES `scap`.`TAPRUEBASCAP` (`idTAPRUEBASCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TAREVCONFIGURACION_CATIPOREVCONFIGURACION1`
    FOREIGN KEY (`tipoRevision`)
    REFERENCES `scap`.`CATIPOREVCONFIGURACION` (`idCATIPOREVCONFIGURACION`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TACASOPRUEBACONFSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TACASOPRUEBACONFSCAP` (
  `idTACASOPRUEBASCAP` INT NOT NULL AUTO_INCREMENT,
  `grupo` VARCHAR(150) NULL,
  `titulo` VARCHAR(150) NULL,
  `descripcion` TEXT NULL,
  `entrada` TEXT NULL,
  `resultado` TEXT NULL,
  `informacionComplementaria` TEXT NULL,
  `evidencias` TEXT NULL,
  `recomendacion` TEXT NULL,
  `resultadoPrueba` VARCHAR(45) NULL,
  `contadorRevision` INT NULL DEFAULT 0,
  `comentariosValidador` TEXT NULL,
  `fAlta` DATETIME NULL,
  `fMod` DATETIME NULL,
  `estatus` INT NOT NULL,
  `revConfiguracion` INT NOT NULL,
  PRIMARY KEY (`idTACASOPRUEBASCAP`),
  INDEX `fk_TACASOPRUEBACONFSCAP_CATESTATUSCASOPRUEBA1_idx` (`estatus` ASC) VISIBLE,
  INDEX `fk_TACASOPRUEBACONFSCAP_TAREVCONFIGURACION1_idx` (`revConfiguracion` ASC) VISIBLE,
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_CATESTATUSCASOPRUEBA1`
    FOREIGN KEY (`estatus`)
    REFERENCES `scap`.`CATESTATUSCASOPRUEBA` (`idCATESTATUSPRUEBA`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_TAREVCONFIGURACION1`
    FOREIGN KEY (`revConfiguracion`)
    REFERENCES `scap`.`TAREVCONFIGURACION` (`idTAREVCONFIGURACION`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`REGLOGIN`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`REGLOGIN` (
  `idREGLOGIN` INT NOT NULL AUTO_INCREMENT,
  `login` DATETIME NULL,
  `idUsr` INT NOT NULL,
  PRIMARY KEY (`idREGLOGIN`),
  INDEX `fk_REGLOGIN_TAUSRSCAP1_idx` (`idUsr` ASC) VISIBLE,
  CONSTRAINT `fk_REGLOGIN_TAUSRSCAP1`
    FOREIGN KEY (`idUsr`)
    REFERENCES `scap`.`TAUSRSCAP` (`idTAUSRSCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATSEVERSQSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATSEVERSQSCAP` (
  `idCATSEVERSQSCAP` INT NOT NULL AUTO_INCREMENT,
  `nombreSeveridad` VARCHAR(100) NULL,
  PRIMARY KEY (`idCATSEVERSQSCAP`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATCATESCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATCATESCAP` (
  `idCATCATESCAP` INT NOT NULL AUTO_INCREMENT,
  `nombreCategoria` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCATCATESCAP`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATTIPOAMESCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATTIPOAMESCAP` (
  `idCATTIPOAMESCAP` INT NOT NULL AUTO_INCREMENT,
  `nombreAmenaza` VARCHAR(100) NULL,
  PRIMARY KEY (`idCATTIPOAMESCAP`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CATTIPOSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CATTIPOSCAP` (
  `idCATTIPOSCAP` INT NOT NULL AUTO_INCREMENT,
  `nombreTipo` VARCHAR(100) NULL,
  PRIMARY KEY (`idCATTIPOSCAP`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TASEGCALSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TASEGCALSCAP` (
  `idTASEGCALSCAP` INT NOT NULL AUTO_INCREMENT,
  `recomendacion` TEXT NULL,
  `contadorRevision` INT NULL,
  `comentarioValidador` TEXT NULL,
  `idPrueba` INT NOT NULL,
  `idTipo` INT NOT NULL,
  `estatus` INT NOT NULL,
  PRIMARY KEY (`idTASEGCALSCAP`),
  INDEX `fk_TASEGCALSCAP1_TAPRUEBASCAP1_idx` (`idPrueba` ASC) VISIBLE,
  INDEX `fk_TASEGCALSCAP_CATTIPOSCAP1_idx` (`idTipo` ASC) VISIBLE,
  INDEX `fk_TASEGCALSCAP_CATESTATUSCASOPRUEBA1_idx` (`estatus` ASC) VISIBLE,
  CONSTRAINT `fk_TASEGCALSCAP1_TAPRUEBASCAP1`
    FOREIGN KEY (`idPrueba`)
    REFERENCES `scap`.`TAPRUEBASCAP` (`idTAPRUEBASCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TASEGCALSCAP_CATTIPOSCAP1`
    FOREIGN KEY (`idTipo`)
    REFERENCES `scap`.`CATTIPOSCAP` (`idCATTIPOSCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TASEGCALSCAP_CATESTATUSCASOPRUEBA1`
    FOREIGN KEY (`estatus`)
    REFERENCES `scap`.`CATESTATUSCASOPRUEBA` (`idCATESTATUSPRUEBA`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TADETECCSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TADETECCSCAP` (
  `idTADETECCSCAP` INT NOT NULL AUTO_INCREMENT,
  `regla` TEXT NULL,
  `contramedida` TEXT NULL,
  `idSeveridadSQ` INT NOT NULL,
  `idCategoria` INT NOT NULL,
  `idRegla` INT NOT NULL,
  `idTipoAmenaza` INT NOT NULL,
  `idSegCal` INT NOT NULL,
  `descripcion` VARCHAR(45) NULL,
  PRIMARY KEY (`idTADETECCSCAP`),
  INDEX `fk_TASEGCALSCAP_CATSEVERSQSCAP1_idx` (`idSeveridadSQ` ASC) VISIBLE,
  INDEX `fk_TASEGCALSCAP_CATCATESCAP1_idx` (`idCategoria` ASC) VISIBLE,
  INDEX `fk_TASEGCALSCAP_CATTIPOAMESCAP1_idx` (`idTipoAmenaza` ASC) VISIBLE,
  INDEX `fk_TADETECCSCAP_TASEGCALSCAP11_idx` (`idSegCal` ASC) VISIBLE,
  CONSTRAINT `fk_TASEGCALSCAP_CATSEVERSQSCAP1`
    FOREIGN KEY (`idSeveridadSQ`)
    REFERENCES `scap`.`CATSEVERSQSCAP` (`idCATSEVERSQSCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TASEGCALSCAP_CATCATESCAP1`
    FOREIGN KEY (`idCategoria`)
    REFERENCES `scap`.`CATCATESCAP` (`idCATCATESCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TASEGCALSCAP_CATTIPOAMESCAP1`
    FOREIGN KEY (`idTipoAmenaza`)
    REFERENCES `scap`.`CATTIPOAMESCAP` (`idCATTIPOAMESCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TADETECCSCAP_TASEGCALSCAP11`
    FOREIGN KEY (`idSegCal`)
    REFERENCES `scap`.`TASEGCALSCAP` (`idTASEGCALSCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TADIAGSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TADIAGSCAP` (
  `idTADIAGSCAP` INT NOT NULL AUTO_INCREMENT,
  `Diagrama` BLOB NOT NULL,
  `idSegCal` INT NOT NULL,
  PRIMARY KEY (`idTADIAGSCAP`),
  INDEX `fk_TADIAGSCAP_TASEGCALSCAP11_idx` (`idSegCal` ASC) VISIBLE,
  CONSTRAINT `fk_TADIAGSCAP_TASEGCALSCAP11`
    FOREIGN KEY (`idSegCal`)
    REFERENCES `scap`.`TASEGCALSCAP` (`idTASEGCALSCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAREFERSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAREFERSCAP` (
  `idTAREFERSCAP` INT NOT NULL AUTO_INCREMENT,
  `Ubicacion` VARCHAR(150) NULL,
  `LineaCodigo` INT NULL,
  `Codigo` VARCHAR(150) NULL,
  `idDeteccion` INT NOT NULL,
  PRIMARY KEY (`idTAREFERSCAP`),
  INDEX `fk_TAREFERSCAP_TADETECCSCAP1_idx` (`idDeteccion` ASC) VISIBLE,
  CONSTRAINT `fk_TAREFERSCAP_TADETECCSCAP1`
    FOREIGN KEY (`idDeteccion`)
    REFERENCES `scap`.`TADETECCSCAP` (`idTADETECCSCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`REGMOD`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`REGMOD` (
  `idREGMOD` INT NOT NULL AUTO_INCREMENT,
  `tabla` VARCHAR(60) NULL,
  `valorAnterior` TEXT NULL,
  `valorActual` TEXT NULL,
  `idUsr` INT NOT NULL,
  PRIMARY KEY (`idREGMOD`),
  INDEX `fk_REGMOD_TAUSRSCAP1_idx` (`idUsr` ASC) VISIBLE,
  CONSTRAINT `fk_REGMOD_TAUSRSCAP1`
    FOREIGN KEY (`idUsr`)
    REFERENCES `scap`.`TAUSRSCAP` (`idTAUSRSCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`CPE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`CPE` (
  `idCPE` INT NOT NULL AUTO_INCREMENT,
  `tipo` INT NULL,
  `part` VARCHAR(1) NULL,
  `vendor` VARCHAR(45) NULL,
  `product` VARCHAR(150) NULL,
  `version` VARCHAR(25) NULL,
  `update` VARCHAR(80) NULL,
  `edition` VARCHAR(80) NULL,
  `language` VARCHAR(80) NULL,
  `softwareEdition` VARCHAR(80) NULL,
  `targetSoftware` VARCHAR(80) NULL,
  `targetHardware` VARCHAR(80) NULL,
  `other` VARCHAR(120) NULL,
  `idTarevconfiguracion` INT NOT NULL,
  PRIMARY KEY (`idCPE`),
  INDEX `fk_CPE_TAREVCONFIGURACION1_idx` (`idTarevconfiguracion` ASC) VISIBLE,
  CONSTRAINT `fk_CPE_TAREVCONFIGURACION1`
    FOREIGN KEY (`idTarevconfiguracion`)
    REFERENCES `scap`.`TAREVCONFIGURACION` (`idTAREVCONFIGURACION`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAUSRSCSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAUSRSCSCAP` (
  `idUSR` INT NOT NULL,
  `idCasoPruebaSC` INT NOT NULL,
  PRIMARY KEY (`idUSR`, `idCasoPruebaSC`),
  INDEX `fk_TAUSRSCAP_has_TASEGCALSCAP_TASEGCALSCAP1_idx` (`idCasoPruebaSC` ASC) VISIBLE,
  INDEX `fk_TAUSRSCAP_has_TASEGCALSCAP_TAUSRSCAP1_idx` (`idUSR` ASC) VISIBLE,
  CONSTRAINT `fk_TAUSRSCAP_has_TASEGCALSCAP_TAUSRSCAP1`
    FOREIGN KEY (`idUSR`)
    REFERENCES `scap`.`TAUSRSCAP` (`idTAUSRSCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TAUSRSCAP_has_TASEGCALSCAP_TASEGCALSCAP1`
    FOREIGN KEY (`idCasoPruebaSC`)
    REFERENCES `scap`.`TASEGCALSCAP` (`idTASEGCALSCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAUSRS_has_TACASOPRUEBACONFSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAUSRS_has_TACASOPRUEBACONFSCAP` (
  `idEvaluador` INT NOT NULL,
  `idCasoPrueba` INT NOT NULL,
  PRIMARY KEY (`idEvaluador`, `idCasoPrueba`),
  INDEX `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TACASOPRUEBACONFSCAP1_idx` (`idCasoPrueba` ASC) VISIBLE,
  INDEX `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TAUSRSCAP1_idx` (`idEvaluador` ASC) VISIBLE,
  CONSTRAINT `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TAUSRSCAP1`
    FOREIGN KEY (`idEvaluador`)
    REFERENCES `scap`.`TAUSRSCAP` (`idTAUSRSCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TAUSRSCAP_has_TACASOPRUEBACONFSCAP_TACASOPRUEBACONFSCAP1`
    FOREIGN KEY (`idCasoPrueba`)
    REFERENCES `scap`.`TACASOPRUEBACONFSCAP` (`idTACASOPRUEBASCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAUSRCONFSCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAUSRCONFSCAP` (
  `idUSR` INT NOT NULL,
  `idCasoPruebaConf` INT NOT NULL,
  PRIMARY KEY (`idUSR`, `idCasoPruebaConf`),
  INDEX `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TAUSRSCAP1_idx` (`idUSR` ASC) VISIBLE,
  INDEX `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TACASOPRUEBACONFSCAP1_idx` (`idCasoPruebaConf` ASC) VISIBLE,
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TACASOPRUEBACONFSCAP1`
    FOREIGN KEY (`idCasoPruebaConf`)
    REFERENCES `scap`.`TACASOPRUEBACONFSCAP` (`idTACASOPRUEBASCAP`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_TACASOPRUEBACONFSCAP_has_TAUSRSCAP_TAUSRSCAP1`
    FOREIGN KEY (`idUSR`)
    REFERENCES `scap`.`TAUSRSCAP` (`idTAUSRSCAP`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scap`.`TAUSRSCAP_TAPRUEBASCAP`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `scap`.`TAUSRSCAP_TAPRUEBASCAP` (
  `idUSR` INT NOT NULL,
  `idPrueba` INT NOT NULL,
  PRIMARY KEY (`idUSR`, `idPrueba`),
  INDEX `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAPRUEBASCAP1_idx` (`idPrueba` ASC) VISIBLE,
  INDEX `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAUSRSCAP1_idx` (`idUSR` ASC) VISIBLE,
  CONSTRAINT `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAUSRSCAP1`
    FOREIGN KEY (`idUSR`)
    REFERENCES `scap`.`TAUSRSCAP` (`idTAUSRSCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TAUSRSCAP_has_TAPRUEBASCAP_TAPRUEBASCAP1`
    FOREIGN KEY (`idPrueba`)
    REFERENCES `scap`.`TAPRUEBASCAP` (`idTAPRUEBASCAP`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

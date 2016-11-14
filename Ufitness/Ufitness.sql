-- MySQL Script generated by MySQL Workbench
-- 11/14/16 20:08:14
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Ufitness
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `Ufitness` ;

-- -----------------------------------------------------
-- Schema Ufitness
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Ufitness` DEFAULT CHARACTER SET utf8 ;
USE `Ufitness` ;

-- -----------------------------------------------------
-- Table `Ufitness`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Usuario` (
  `Dni` VARCHAR(10) NOT NULL,
  `Usuario_Dni` VARCHAR(10) NULL,
  `rol` ENUM('administrador', 'entrenador', 'deportista') NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `edad` INT NOT NULL,
  PRIMARY KEY (`Dni`),
  INDEX `fk_Usuario_Usuario1_idx` (`Usuario_Dni` ASC),
  CONSTRAINT `fk_Usuario_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `Ufitness`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Actividad` (
  `idActividad` INT NOT NULL AUTO_INCREMENT,
  `Usuario_Dni` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `numPlazas` INT NOT NULL,
  `horario` DATETIME NOT NULL,
  `lugar` VARCHAR(45) NOT NULL,
  `tipoAct` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idActividad`),
  INDEX `fk_Actividad_Usuario1_idx` (`Usuario_Dni` ASC),
  CONSTRAINT `fk_Actividad_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `Ufitness`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Notificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Notificacion` (
  `idNotificacion` INT NOT NULL AUTO_INCREMENT,
  `Usuario_Dni` VARCHAR(10) NOT NULL,
  `Deportista_Usuario_Dni` VARCHAR(10) NOT NULL,
  `titulo` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idNotificacion`),
  INDEX `fk_Notificacion_Usuario1_idx` (`Usuario_Dni` ASC),
  CONSTRAINT `fk_Notificacion_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `Ufitness`.`Usuario` (`Dni`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Deportista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Deportista` (
  `DNI` VARCHAR(10) NOT NULL,
  `Usuario_Dni` VARCHAR(10) NOT NULL,
  `riesgos` VARCHAR(45) NOT NULL,
  `historialEntrenamiento` VARCHAR(45) NULL,
  `tipoDep` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`DNI`),
  CONSTRAINT `fk_Deportista_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `Ufitness`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Entrenamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Entrenamiento` (
  `idEntrenamiento` INT NOT NULL AUTO_INCREMENT,
  `Deportista_DNI` VARCHAR(10) NOT NULL,
  `duracion` DOUBLE NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `nivel` ENUM('principiante', 'intermedio', 'avanzado') NOT NULL,
  PRIMARY KEY (`idEntrenamiento`, `Deportista_DNI`),
  INDEX `fk_Entrenamiento_Deportista1_idx` (`Deportista_DNI` ASC),
  CONSTRAINT `fk_Entrenamiento_Deportista1`
    FOREIGN KEY (`Deportista_DNI`)
    REFERENCES `Ufitness`.`Deportista` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Reserva` (
  `idReserva` INT NOT NULL AUTO_INCREMENT,
  `Deportista_Usuario_Dni` VARCHAR(10) NOT NULL,
  `Actividad_idActividad` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `numero_Plazas_Reservadas` INT(2) NOT NULL,
  PRIMARY KEY (`idReserva`),
  INDEX `fk_Reserva_Actividad1_idx` (`Actividad_idActividad` ASC),
  INDEX `fk_Reserva_Deportista1_idx` (`Deportista_Usuario_Dni` ASC),
  CONSTRAINT `fk_Reserva_Actividad1`
    FOREIGN KEY (`Actividad_idActividad`)
    REFERENCES `Ufitness`.`Actividad` (`idActividad`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reserva_Deportista1`
    FOREIGN KEY (`Deportista_Usuario_Dni`)
    REFERENCES `Ufitness`.`Deportista` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Ejercicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Ejercicio` (
  `idEjercicio` INT NOT NULL AUTO_INCREMENT,
  `Usuario_Dni` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `tipoEjer` VARCHAR(45) NOT NULL,
  `maquina` VARCHAR(45) NULL,
  `grupoMuscular` VARCHAR(45) NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `imagen` BLOB NULL,
  `video` BLOB NULL,
  PRIMARY KEY (`idEjercicio`, `Usuario_Dni`),
  INDEX `fk_Ejercicio_Usuario1_idx` (`Usuario_Dni` ASC),
  CONSTRAINT `fk_Ejercicio_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `Ufitness`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Entrenamiento_has_Ejercicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Entrenamiento_has_Ejercicio` (
  `Entrenamiento_idEntrenamiento` INT NOT NULL,
  `Ejercicio_idEjercicio` INT NOT NULL,
  `series_repeticiones` VARCHAR(45) NOT NULL,
  `carga` FLOAT NULL,
  PRIMARY KEY (`Entrenamiento_idEntrenamiento`, `Ejercicio_idEjercicio`),
  INDEX `fk_Entrenamiento_has_Ejercicio_Ejercicio1_idx` (`Ejercicio_idEjercicio` ASC),
  INDEX `fk_Entrenamiento_has_Ejercicio_Entrenamiento1_idx` (`Entrenamiento_idEntrenamiento` ASC),
  CONSTRAINT `fk_Entrenamiento_has_Ejercicio_Entrenamiento1`
    FOREIGN KEY (`Entrenamiento_idEntrenamiento`)
    REFERENCES `Ufitness`.`Entrenamiento` (`idEntrenamiento`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Entrenamiento_has_Ejercicio_Ejercicio1`
    FOREIGN KEY (`Ejercicio_idEjercicio`)
    REFERENCES `Ufitness`.`Ejercicio` (`idEjercicio`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ufitness`.`Sesion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Ufitness`.`Sesion` (
  `Deportista_Usuario_Dni` VARCHAR(10) NOT NULL,
  `Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento` INT NOT NULL,
  `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio` INT NOT NULL,
  `anotaciones` VARCHAR(100) NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`Deportista_Usuario_Dni`, `Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento`, `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio`),
  INDEX `fk_Sesion_Entrenamiento_has_Ejercicio1_idx` (`Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento` ASC, `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio` ASC),
  INDEX `fk_Sesion_Deportista1_idx` (`Deportista_Usuario_Dni` ASC),
  CONSTRAINT `fk_Sesion_Entrenamiento_has_Ejercicio1`
    FOREIGN KEY (`Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento` , `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio`)
    REFERENCES `Ufitness`.`Entrenamiento_has_Ejercicio` (`Entrenamiento_idEntrenamiento` , `Ejercicio_idEjercicio`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Sesion_Deportista1`
    FOREIGN KEY (`Deportista_Usuario_Dni`)
    REFERENCES `Ufitness`.`Deportista` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `Ufitness`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `edad`) VALUES ('11223344F', NULL, 'administrador', 'Samuel', 'samuel@gmail.com', 'root', 21);
INSERT INTO `Ufitness`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `edad`) VALUES ('44444444B', NULL, 'entrenador', 'Emily', 'emily@gmail.com', 'root', 21);
INSERT INTO `Ufitness`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `edad`) VALUES ('66666666C', NULL, 'deportista', 'Diego', 'diego@gmail.com', 'root', 21);
INSERT INTO `Ufitness`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `edad`) VALUES ('77777777D', NULL, 'deportista', 'Ruben', 'ruben@gmail.com', 'root', 21);
INSERT INTO `Ufitness`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `edad`) VALUES ('88888888E', NULL, 'deportista', 'Ismael', 'ismale@gmail.com', 'root', 21);
INSERT INTO `Ufitness`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `edad`) VALUES ('99999999F', NULL, 'deportista', 'Ramon', 'ramon@gmail.com', 'root', 21);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Actividad`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Actividad` (`idActividad`, `Usuario_Dni`, `nombre`, `numPlazas`, `horario`, `lugar`, `tipoAct`) VALUES (1, '44444444B', 'spinning', 20, '2016-11-20 19:00:00', 'pabellon', 'individual');
INSERT INTO `Ufitness`.`Actividad` (`idActividad`, `Usuario_Dni`, `nombre`, `numPlazas`, `horario`, `lugar`, `tipoAct`) VALUES (2, '44444444B', 'bicicleta', 30, '2016-11-21 21:00:00', 'pabellon', 'grupo');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Notificacion`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Notificacion` (`idNotificacion`, `Usuario_Dni`, `Deportista_Usuario_Dni`, `titulo`, `descripcion`) VALUES (1, '11223344F', '66666666C', 'Actividad spinning', 'Nueva actividad');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Deportista`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('66666666C', '11223344F', 'ninguno', 'entrenamiento1,entrenamiento2', 'TDU');
INSERT INTO `Ufitness`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('77777777D', '11223344F', 'ninguno', 'entrenamiento1', 'PEF');
INSERT INTO `Ufitness`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('88888888E', '11223344F', 'ninguno', 'entrenamiento2', 'TDU');
INSERT INTO `Ufitness`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('99999999F', '11223344F', 'ninguno', 'entrenamiento2', 'PEF');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Entrenamiento`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Entrenamiento` (`idEntrenamiento`, `Deportista_DNI`, `duracion`, `nombre`, `nivel`) VALUES (1, '66666666C', 30, 'press banca', 'principiante');
INSERT INTO `Ufitness`.`Entrenamiento` (`idEntrenamiento`, `Deportista_DNI`, `duracion`, `nombre`, `nivel`) VALUES (2, '77777777D', 15, 'bicicleta', 'intermedio');

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Reserva`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Reserva` (`idReserva`, `Deportista_Usuario_Dni`, `Actividad_idActividad`, `fecha`, `numero_Plazas_Reservadas`) VALUES (1, '66666666C', 1, '2016-11-20', 19);
INSERT INTO `Ufitness`.`Reserva` (`idReserva`, `Deportista_Usuario_Dni`, `Actividad_idActividad`, `fecha`, `numero_Plazas_Reservadas`) VALUES (2, '77777777D', 2, '2016-11-21', 29);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Ejercicio`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Ejercicio` (`idEjercicio`, `Usuario_Dni`, `nombre`, `tipoEjer`, `maquina`, `grupoMuscular`, `descripcion`, `imagen`, `video`) VALUES (1, '44444444B', 'ejercicio press banca', 'muscular', 'press banca', 'pectorales', 'levantamiento de pesas en una determinada posicion', NULL, NULL);
INSERT INTO `Ufitness`.`Ejercicio` (`idEjercicio`, `Usuario_Dni`, `nombre`, `tipoEjer`, `maquina`, `grupoMuscular`, `descripcion`, `imagen`, `video`) VALUES (2, '44444444B', 'bicicleta', 'cardio', 'bici estatica', NULL, 'Pedaleo de forma ciclica', NULL, NULL);
INSERT INTO `Ufitness`.`Ejercicio` (`idEjercicio`, `Usuario_Dni`, `nombre`, `tipoEjer`, `maquina`, `grupoMuscular`, `descripcion`, `imagen`, `video`) VALUES (3, '44444444B', 'estiramiento', 'estiramiento', 'abdominal', NULL, 'Tumbarse boca abajo levantando el torso', NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Entrenamiento_has_Ejercicio`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Entrenamiento_has_Ejercicio` (`Entrenamiento_idEntrenamiento`, `Ejercicio_idEjercicio`, `series_repeticiones`, `carga`) VALUES (1, 1, '10', 25);

COMMIT;


-- -----------------------------------------------------
-- Data for table `Ufitness`.`Sesion`
-- -----------------------------------------------------
START TRANSACTION;
USE `Ufitness`;
INSERT INTO `Ufitness`.`Sesion` (`Deportista_Usuario_Dni`, `Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento`, `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio`, `anotaciones`, `fecha`) VALUES ('66666666C', 1, 1, NULL, '2016-10-26');
INSERT INTO `Ufitness`.`Sesion` (`Deportista_Usuario_Dni`, `Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento`, `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio`, `anotaciones`, `fecha`) VALUES ('77777777D', 1, 1, NULL, '2016-10-26');

COMMIT;


-- MySQL Script generated by MySQL Workbench
-- 01/04/17 19:01:34
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema G24
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `G24` ;

-- -----------------------------------------------------
-- Schema G24
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `G24` DEFAULT CHARACTER SET utf8 ;
USE `G24` ;

-- -----------------------------------------------------
-- Table `G24`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Usuario` (
  `Dni` VARCHAR(10) NOT NULL,
  `Usuario_Dni` VARCHAR(10) NULL,
  `rol` ENUM('administrador', 'entrenador', 'deportista') NOT NULL,
  `Nombre` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  PRIMARY KEY (`Dni`),
  INDEX `fk_Usuario_Usuario1_idx` (`Usuario_Dni` ASC),
  CONSTRAINT `fk_Usuario_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `G24`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Actividad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Actividad` (
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
    REFERENCES `G24`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Notificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Notificacion` (
  `idNotificacion` INT NOT NULL AUTO_INCREMENT,
  `Usuario_Dni` VARCHAR(10) NOT NULL,
  `Deportista_Usuario_Dni` VARCHAR(10) NOT NULL,
  `titulo` VARCHAR(45) NULL,
  `descripcion` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`idNotificacion`),
  INDEX `fk_Notificacion_Usuario1_idx` (`Usuario_Dni` ASC),
  CONSTRAINT `fk_Notificacion_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `G24`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Entrenamiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Entrenamiento` (
  `idEntrenamiento` INT NOT NULL AUTO_INCREMENT,
  `duracion` DOUBLE NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `nivel` ENUM('principiante', 'intermedio', 'avanzado') NOT NULL,
  PRIMARY KEY (`idEntrenamiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Deportista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Deportista` (
  `DNI` VARCHAR(10) NOT NULL,
  `Usuario_Dni` VARCHAR(10) NOT NULL,
  `riesgos` VARCHAR(45) NOT NULL,
  `historialEntrenamiento` VARCHAR(45) NULL,
  `tipoDep` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`DNI`),
  CONSTRAINT `fk_Deportista_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `G24`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Reserva` (
  `idReserva` INT NOT NULL AUTO_INCREMENT,
  `Deportista_Usuario_Dni` VARCHAR(10) NOT NULL,
  `Actividad_idActividad` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `plazas_ocupadas` INT(2) NOT NULL,
  PRIMARY KEY (`idReserva`),
  INDEX `fk_Reserva_Actividad1_idx` (`Actividad_idActividad` ASC),
  INDEX `fk_Reserva_Deportista1_idx` (`Deportista_Usuario_Dni` ASC),
  CONSTRAINT `fk_Reserva_Actividad1`
    FOREIGN KEY (`Actividad_idActividad`)
    REFERENCES `G24`.`Actividad` (`idActividad`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Reserva_Deportista1`
    FOREIGN KEY (`Deportista_Usuario_Dni`)
    REFERENCES `G24`.`Deportista` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Ejercicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Ejercicio` (
  `idEjercicio` INT NOT NULL AUTO_INCREMENT,
  `Usuario_Dni` VARCHAR(10) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `tipoEjer` VARCHAR(45) NOT NULL,
  `maquina` VARCHAR(45) NULL,
  `grupoMuscular` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(300) NULL,
  `imagen` VARCHAR(100) NULL,
  `video` VARCHAR(100) NULL,
  PRIMARY KEY (`idEjercicio`, `Usuario_Dni`),
  INDEX `fk_Ejercicio_Usuario1_idx` (`Usuario_Dni` ASC),
  CONSTRAINT `fk_Ejercicio_Usuario1`
    FOREIGN KEY (`Usuario_Dni`)
    REFERENCES `G24`.`Usuario` (`Dni`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Entrenamiento_has_Ejercicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Entrenamiento_has_Ejercicio` (
  `Entrenamiento_idEntrenamiento` INT NOT NULL,
  `Ejercicio_idEjercicio` INT NOT NULL,
  `series_repeticiones` VARCHAR(45) NOT NULL,
  `carga` FLOAT NULL,
  PRIMARY KEY (`Entrenamiento_idEntrenamiento`, `Ejercicio_idEjercicio`),
  INDEX `fk_Entrenamiento_has_Ejercicio_Ejercicio1_idx` (`Ejercicio_idEjercicio` ASC),
  INDEX `fk_Entrenamiento_has_Ejercicio_Entrenamiento1_idx` (`Entrenamiento_idEntrenamiento` ASC),
  CONSTRAINT `fk_Entrenamiento_has_Ejercicio_Entrenamiento1`
    FOREIGN KEY (`Entrenamiento_idEntrenamiento`)
    REFERENCES `G24`.`Entrenamiento` (`idEntrenamiento`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Entrenamiento_has_Ejercicio_Ejercicio1`
    FOREIGN KEY (`Ejercicio_idEjercicio`)
    REFERENCES `G24`.`Ejercicio` (`idEjercicio`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Sesion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Sesion` (
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
    REFERENCES `G24`.`Entrenamiento_has_Ejercicio` (`Entrenamiento_idEntrenamiento` , `Ejercicio_idEjercicio`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Sesion_Deportista1`
    FOREIGN KEY (`Deportista_Usuario_Dni`)
    REFERENCES `G24`.`Deportista` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Entrenamiento_has_Deportista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Entrenamiento_has_Deportista` (
  `Entrenamiento_idEntrenamiento` INT NOT NULL,
  `Deportista_DNI` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`Entrenamiento_idEntrenamiento`, `Deportista_DNI`),
  INDEX `fk_Entrenamiento_has_Deportista_Deportista1_idx` (`Deportista_DNI` ASC),
  INDEX `fk_Entrenamiento_has_Deportista_Entrenamiento1_idx` (`Entrenamiento_idEntrenamiento` ASC),
  CONSTRAINT `fk_Entrenamiento_has_Deportista_Entrenamiento1`
    FOREIGN KEY (`Entrenamiento_idEntrenamiento`)
    REFERENCES `G24`.`Entrenamiento` (`idEntrenamiento`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Entrenamiento_has_Deportista_Deportista1`
    FOREIGN KEY (`Deportista_DNI`)
    REFERENCES `G24`.`Deportista` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `G24`.`Notificacion_has_Deportista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `G24`.`Notificacion_has_Deportista` (
  `Notificacion_idNotificacion` INT NOT NULL,
  `Deportista_DNI` VARCHAR(10) NOT NULL,
  `Visto` INT(1) NULL DEFAULT 0,
  PRIMARY KEY (`Notificacion_idNotificacion`, `Deportista_DNI`),
  INDEX `fk_Notificacion_has_Deportista_Deportista1_idx` (`Deportista_DNI` ASC),
  INDEX `fk_Notificacion_has_Deportista_Notificacion1_idx` (`Notificacion_idNotificacion` ASC),
  CONSTRAINT `fk_Notificacion_has_Deportista_Notificacion1`
    FOREIGN KEY (`Notificacion_idNotificacion`)
    REFERENCES `G24`.`Notificacion` (`idNotificacion`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Notificacion_has_Deportista_Deportista1`
    FOREIGN KEY (`Deportista_DNI`)
    REFERENCES `G24`.`Deportista` (`DNI`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `G24`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `fecha_nacimiento`) VALUES ('11223344F', NULL, 'administrador', 'Samuel', 'samuel@gmail.com', 'root', '1994-11-2');
INSERT INTO `G24`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `fecha_nacimiento`) VALUES ('44444444B', NULL, 'entrenador', 'Emily', 'emily@gmail.com', 'root', '1993-10-1');
INSERT INTO `G24`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `fecha_nacimiento`) VALUES ('66666666C', NULL, 'deportista', 'Diego', 'diego@gmail.com', 'root', '1995-5-15');
INSERT INTO `G24`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `fecha_nacimiento`) VALUES ('77777777D', NULL, 'deportista', 'Ruben', 'ruben@gmail.com', 'root', '1994-6-22');
INSERT INTO `G24`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `fecha_nacimiento`) VALUES ('88888888E', NULL, 'deportista', 'Ismael', 'ismale@gmail.com', 'root', '1995-1-29');
INSERT INTO `G24`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `fecha_nacimiento`) VALUES ('99999999F', NULL, 'deportista', 'Ramon', 'ramon@gmail.com', 'root', '1992-2-1');

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Actividad`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Actividad` (`idActividad`, `Usuario_Dni`, `nombre`, `numPlazas`, `horario`, `lugar`, `tipoAct`) VALUES (1, '44444444B', 'Spinning', 20, '2016-11-20 19:00:00', 'Pabellon', 'Individual');
INSERT INTO `G24`.`Actividad` (`idActividad`, `Usuario_Dni`, `nombre`, `numPlazas`, `horario`, `lugar`, `tipoAct`) VALUES (2, '44444444B', 'Bicicleta', 30, '2016-11-21 21:00:00', 'Pabellon', 'Grupo');

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Notificacion`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Notificacion` (`idNotificacion`, `Usuario_Dni`, `Deportista_Usuario_Dni`, `titulo`, `descripcion`) VALUES (1, '11223344F', '66666666C', 'Actividad spinning', 'Nueva actividad');

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Entrenamiento`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Entrenamiento` (`idEntrenamiento`, `duracion`, `nombre`, `nivel`) VALUES (1, 30, 'press banca', 'principiante');
INSERT INTO `G24`.`Entrenamiento` (`idEntrenamiento`, `duracion`, `nombre`, `nivel`) VALUES (2, 15, 'bicicleta', 'intermedio');

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Deportista`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('66666666C', '11223344F', 'ninguno', 'entrenamiento1,entrenamiento2', 'TDU');
INSERT INTO `G24`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('77777777D', '11223344F', 'ninguno', 'entrenamiento1', 'PEF');
INSERT INTO `G24`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('88888888E', '11223344F', 'ninguno', 'entrenamiento2', 'TDU');
INSERT INTO `G24`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `historialEntrenamiento`, `tipoDep`) VALUES ('99999999F', '11223344F', 'ninguno', 'entrenamiento2', 'PEF');

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Reserva`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Reserva` (`idReserva`, `Deportista_Usuario_Dni`, `Actividad_idActividad`, `fecha`, `plazas_ocupadas`) VALUES (1, '66666666C', 1, '2016-11-20', 19);
INSERT INTO `G24`.`Reserva` (`idReserva`, `Deportista_Usuario_Dni`, `Actividad_idActividad`, `fecha`, `plazas_ocupadas`) VALUES (2, '77777777D', 2, '2016-11-21', 29);

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Ejercicio`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Ejercicio` (`idEjercicio`, `Usuario_Dni`, `nombre`, `tipoEjer`, `maquina`, `grupoMuscular`, `descripcion`, `imagen`, `video`) VALUES (1, '11223344F', 'Sentadillas', 'Muscular', 'Banco Smith', 'Piernas', 'Flexionar rodillas y cadera para hacer bajar el cuerpo hacia el suelo sin perder la verticalidad,volviendo luego a la posicion erguida ', 'sentadilla.jpg', 'https://www.youtube.com/embed/0rgiePufo0A');
INSERT INTO `G24`.`Ejercicio` (`idEjercicio`, `Usuario_Dni`, `nombre`, `tipoEjer`, `maquina`, `grupoMuscular`, `descripcion`, `imagen`, `video`) VALUES (2, '11223344F', 'Curl de biceps', 'Muscular', 'Banco Scott', 'Brazos', 'Tomar la barra a una separacion media entre manos, y flexionar, manteniendo en todo momento las axilas en el filo del apoyo del banco', 'curldebiceps.jpg', 'https://www.youtube.com/embed/oHO6dV7aQbE');
INSERT INTO `G24`.`Ejercicio` (`idEjercicio`, `Usuario_Dni`, `nombre`, `tipoEjer`, `maquina`, `grupoMuscular`, `descripcion`, `imagen`, `video`) VALUES (3, '11223344F', 'Dominadas', 'Muscular', 'Barra de dominadas', 'Espalda', 'Partiendo de la posicion de reposo en la que los brazos se encuentran totalmente estirados, se eleva el cuerpo mediante la flexion de los brazos, hasta que la barbilla sobrepase la barra de la cual se cuelga, sin elevar las piernas durante el proceso(dominadas estrictas)', 'dominada.jpg', 'https://www.youtube.com/embed/RjZOKbg-Viw');

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Entrenamiento_has_Ejercicio`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Entrenamiento_has_Ejercicio` (`Entrenamiento_idEntrenamiento`, `Ejercicio_idEjercicio`, `series_repeticiones`, `carga`) VALUES (1, 1, '10', 25);

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Sesion`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Sesion` (`Deportista_Usuario_Dni`, `Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento`, `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio`, `anotaciones`, `fecha`) VALUES ('66666666C', 1, 1, NULL, '2016-10-26');
INSERT INTO `G24`.`Sesion` (`Deportista_Usuario_Dni`, `Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento`, `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio`, `anotaciones`, `fecha`) VALUES ('77777777D', 1, 1, NULL, '2016-10-26');

COMMIT;


-- -----------------------------------------------------
-- Data for table `G24`.`Notificacion_has_Deportista`
-- -----------------------------------------------------
START TRANSACTION;
USE `G24`;
INSERT INTO `G24`.`Notificacion_has_Deportista` (`Notificacion_idNotificacion`, `Deportista_DNI`, `Visto`) VALUES (1, '66666666C', 0);

COMMIT;


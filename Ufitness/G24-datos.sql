
-- -----------------------------------------------------
-- Data for table `G24`.`Usuario`
-- -----------------------------------------------------
USE `G24`;

INSERT INTO `G24`.`Usuario` (`Dni`, `Usuario_Dni`, `rol`, `Nombre`, `email`, `password`, `fecha_nacimiento`) VALUES
('11223344F', NULL, 'administrador', 'Samuel', 'samuel@gmail.com', 'root', '1994-11-02'),
('12345678Y', '11223344F', 'deportista', 'Leticia López López', 'leti@gmail.com', 'root', '1983-06-16'),
('15896472T', '11223344F', 'deportista', 'Martín Gómez', 'martin@gmail.com', 'root', '1997-06-12'),
('22222222L', '11223344F', 'entrenador', 'Jose Mártinez López', 'jose@uvigo.es', 'root', '1986-07-12'),
('33333333T', '11223344F', 'entrenador', 'Pedro Álvarez Fernández', 'pedro@uvigo.es', 'root', '1990-09-01'),
('44444444B', NULL, 'entrenador', 'Emily', 'emily@gmail.com', 'root', '1993-10-01'),
('66666666C', NULL, 'deportista', 'Diego Fernández López', 'diego@gmail.com', 'root', '1995-05-15'),
('77777777D', NULL, 'deportista', 'Ruben', 'ruben@gmail.com', 'root', '1994-06-22'),
('88888888E', NULL, 'deportista', 'Ismael Durán', 'ismale@gmail.com', 'root', '1995-01-29'),
('99999999F', NULL, 'deportista', 'Ramon', 'ramon@gmail.com', 'root', '1992-02-01');


-- -----------------------------------------------------
-- Data for table `G24`.`Deportista`
-- -----------------------------------------------------

INSERT INTO `G24`.`Deportista` (`DNI`, `Usuario_Dni`, `riesgos`, `tipoDep`) VALUES
('12345678Y', '11223344F', 'Asmática', 'tdu'),
('15896472T', '11223344F', 'ninguno', 'tdu'),
('66666666C', '11223344F', 'ninguno ', 'tdu'),
('77777777D', '11223344F', 'ninguno', 'PEF'),
('88888888E', '11223344F', 'ninguno ', 'tdu'),
('99999999F', '11223344F', 'ninguno', 'PEF');


-- -----------------------------------------------------
-- Data for table `G24`.`Actividad`
-- -----------------------------------------------------

INSERT INTO `G24`.`Actividad` (`idActividad`, `Usuario_Dni`, `nombre`, `numPlazas`, `horario`, `lugar`, `tipoAct`) VALUES
(1, '44444444B', 'Spinning', 20, '2016-11-20 19:00:00', 'Pabellon', 'Individual'),
(2, '22222222L', 'GAP', 20, '2017-01-20 16:00:00', 'Aula 5', 'Fitness'),
(3, '44444444B', 'Kick Boxing', 20, '2017-01-22 20:00:00', 'Aula 1', 'Fitness'),
(4, '33333333T', 'Zumba', 20, '2017-01-17 17:00:00', 'Aula 2', 'Fitness');



-- -----------------------------------------------------
-- Data for table `G24`.`Notificacion`
-- -----------------------------------------------------

INSERT INTO `G24`.`Notificacion` (`idNotificacion`, `Usuario_Dni`, `titulo`, `descripcion`) VALUES
(12, '11223344F', 'Cambio Horario Gimnasio', 'A partir de Enero el horario del gimnasio será de 07:00H a 23:00.\r\n\r\nFeliz Año!'),
(13, '11223344F', 'Cambio de Aula Spinning', 'En enero la actividad de Spinnig se realizará en el aula 3.\r\n\r\n'),
(14, '11223344F', 'Avisos PEF', 'Recordamos que los usuarios tipo PEF tienen que pagar el suplemento adicional.'),
(15, '11223344F', 'Avisos TDU', 'Recordamos que la tarifa de los usuarios TDU se incrementa en 5€, por lo que la tarifa será de 30€/mes.');


-- -----------------------------------------------------
-- Data for table `G24`.`Notificacion_has_Deportista`
-- -----------------------------------------------------

INSERT INTO `G24`.`Notificacion_has_Deportista` (`Notificacion_idNotificacion`, `Deportista_DNI`, `Visto`) VALUES
(12, '12345678Y', 0),
(12, '15896472T', 0),
(12, '66666666C', 0),
(12, '77777777D', 0),
(12, '88888888E', 0),
(12, '99999999F', 0),
(13, '12345678Y', 0),
(13, '15896472T', 0),
(13, '66666666C', 0),
(13, '77777777D', 0),
(13, '88888888E', 0),
(13, '99999999F', 0),
(14, '77777777D', 0),
(14, '99999999F', 0),
(15, '12345678Y', 0),
(15, '15896472T', 0),
(15, '66666666C', 0),
(15, '88888888E', 0);




-- -----------------------------------------------------
-- Data for table `G24`.`Entrenamiento`
-- -----------------------------------------------------

INSERT INTO `G24`.`Entrenamiento` (`idEntrenamiento`, `duracion`, `nombre`, `nivel`) VALUES
(1, 60, 'Standar', 'principiante'),
(3, 60, 'Full-body', 'intermedio'),
(4, 45, 'Fuerza-Pierna', 'avanzado'),
(5, 60, 'Principiante', 'principiante');



-- -----------------------------------------------------
-- Data for table `G24`.`Entrenamiento_has_Deportista`
-- -----------------------------------------------------

INSERT INTO `Entrenamiento_has_Deportista` (`Entrenamiento_idEntrenamiento`, `Deportista_DNI`) VALUES
(1, '12345678Y'),
(1, '66666666C'),
(1, '88888888E'),
(3, '12345678Y'),
(3, '66666666C'),
(4, '12345678Y'),
(4, '15896472T'),
(4, '66666666C'),
(4, '88888888E'),
(5, '12345678Y'),
(5, '15896472T'),
(5, '88888888E');



-- -----------------------------------------------------
-- Data for table `G24`.`Ejercicio`
-- -----------------------------------------------------

INSERT INTO `G24`.`Ejercicio` (`idEjercicio`, `Usuario_Dni`, `nombre`, `tipoEjer`, `maquina`, `grupoMuscular`, `descripcion`, `imagen`, `video`) VALUES
(1, '11223344F', 'Sentadillas', 'Muscular', 'Banco Smith', 'Piernas', 'Flexionar rodillas y cadera para hacer bajar el cuerpo hacia el suelo sin perder la verticalidad,volviendo luego a la posicion erguida ', 'sentadilla.jpg', 'https://www.youtube.com/embed/0rgiePufo0A'),
(2, '11223344F', 'Curl de biceps', 'Muscular', 'Banco Scott', 'Brazos', 'Tomar la barra a una separacion media entre manos, y flexionar, manteniendo en todo momento las axilas en el filo del apoyo del banco', 'curldebiceps.jpg', 'https://www.youtube.com/embed/oHO6dV7aQbE'),
(3, '11223344F', 'Dominadas', 'Muscular', 'Barra de dominadas', 'Espalda', 'Partiendo de la posicion de reposo en la que los brazos se encuentran totalmente estirados, se eleva el cuerpo mediante la flexion de los brazos, hasta que la barbilla sobrepase la barra de la cual se cuelga, sin elevar las piernas durante el proceso(dominadas estrictas)', 'dominada.jpg', 'https://www.youtube.com/embed/RjZOKbg-Viw'),
(4, '11223344F', 'Peso Muerto', 'Muscular', 'Barra', 'Piernas', 'La barra se encuentra en el suelo y el atleta debe asumir una posición erecta, con las rodillas bloqueadas al principio y al final del levantamiento. Éste debe colocarse mirando la barra y, flexionando sus piernas, se agacha hasta tener la barra a una distancia de manos ligeramente mayor a la distan', '1484220294.jpg', '//www.youtube.com/embed/gB9_9ggQ5jA'),
(5, '11223344F', ' Media Sentadilla', 'Muscular', 'Barra', 'Piernas', 'De pie, sostenga una barra con pesas sobre sus hombros.\r\n\r\nDescienda el cuerpo por medio de la flexión de ambas rodillas hasta que sus glúteos toquen la superficie de una banca o silla.\r\n\r\nAscienda inmediatamente a la posición inicial. Recuerde mantener la espalda derecha durante todo el ejercicio.', '1484220780.gif', '//www.youtube.com/embed/OWAeknIweSU'),
(6, '11223344F', 'Press Pierna', 'Muscular', 'Carro Romano', 'Piernas', 'Sentado (a) en el carro romano, coloque sus pies sobre la plataforma separados a nivel de la caderas o ligeramente por afuera de las mismas.\r\nDescienda lo maximo posible por medio de la flexión de ambas piernas\r\nEmpuje el peso por medio de la extensión de ambas piernas.', '1484220893.gif', '//www.youtube.com/embed/k9EYu1ntd9I'),
(7, '11223344F', 'Polea Tras-Nuca', 'Muscular', 'Polea', 'Espalda', 'Sentado (a) en el equipo de poleas, sostenga la barra con los brazos extendidos.\r\n\r\nJale la barra hasta que la misma toque o se acerque a la parte posterior del cuello, manteniendo la espalda derecha.\r\nRegrese a la posición inicial con desplazamiento controlado, hasta la completa extensión de ambos ', '1484221044.gif', '//www.youtube.com/embed/rmsoutkl5nQ'),
(8, '11223344F', 'Curl en Banco Inclinado', 'Muscular', 'Banco Inclinado', 'Brazos', 'Acostado (a) en una banca inclinada y apoyando su pecho y abdomen sobre la superficie de la misma (como en la imagen). Sostenga una mancuerna en cada mano con las palmas de sus manos hacia adelante.\r\nFlexione ambos brazos con desplazamiento de los antebrazos, manteniendo los brazos fijos.\r\nDescienda', '1484221174.gif', '//www.youtube.com/embed/bCek9EF-lfg');


-- -----------------------------------------------------
-- Data for table `G24`.`Entrenamiento_has_Ejercicio`
-- -----------------------------------------------------

INSERT INTO `G24`.`Entrenamiento_has_Ejercicio` (`Entrenamiento_idEntrenamiento`, `Ejercicio_idEjercicio`, `series_repeticiones`, `carga`) VALUES
(1, 1, '10', 25),
(1, 4, '3x12', 20),
(1, 8, '3x12', 10),
(3, 1, '4x6', 50),
(3, 3, '3x8', 0),
(3, 4, '3x5', 70),
(3, 6, '3x10', 100),
(3, 7, '3x10', 40),
(4, 1, '5x10', 50),
(4, 5, '5x10', 50),
(4, 6, '3x15', 20),
(5, 2, '2x10', 2),
(5, 4, '2x15', 10),
(5, 7, '3x15', 30);
-- -----------------------------------------------------
-- Data for table `G24`.`Sesion`
-- -----------------------------------------------------

INSERT INTO `G24`.`Sesion` (`Deportista_Usuario_Dni`, `Entrenamiento_has_Ejercicio_Entrenamiento_idEntrenamiento`, `Entrenamiento_has_Ejercicio_Ejercicio_idEjercicio`, `anotaciones`, `fecha`) VALUES
('66666666C', 1, 1, NULL, '2016-10-26'),
('77777777D', 1, 1, NULL, '2016-10-26');

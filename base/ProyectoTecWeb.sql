SET sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY","")); -- Comando usado para poder modificar tablar
drop database if exists examenweb;				   -- Comando para borrar una base de datos en caso de exist
create database examenweb;					   -- Comando para crear una base de datos

use examenweb;

/*===============================================Tablas===========================================================================*/
CREATE TABLE Horario
(
  idHorario INT AUTO_INCREMENT,
  Hora TIME NOT NULL,
  Día DATE NOT NULL,
  Disponibilidad INT NOT NULL,
  totalLugares INT NOT NULL,
  Disponibles INT NOT NULL,
  Ocupados INT NOT NULL,
  PRIMARY KEY (idHorario)
);

CREATE TABLE Laboratorio
(
  idLab INT AUTO_INCREMENT,
  NombreLab varchar(50) NOT NULL,
  Edificio varchar(50) NOT NULL,
  Piso varchar(50) NOT NULL,
  PRIMARY KEY (idLab)
);

CREATE TABLE EntidadFederal
(
  idEntidad INT AUTO_INCREMENT,
  NombreEstado varchar(50) NOT NULL,
  PRIMARY KEY (idEntidad)
);

CREATE TABLE EscuelaIPN
(
  idEscuela INT AUTO_INCREMENT,
  NombreEscuela varchar(50) NOT NULL,
  PRIMARY KEY (idEscuela)
);

CREATE TABLE Alcaldia
(
  idAlcaldia INT AUTO_INCREMENT,
  NombreAlcaldia varchar(50) NOT NULL,
  PRIMARY KEY (idAlcaldia)
);

CREATE TABLE Cuenta
(
  idHorario INT NOT NULL,
  idLab INT NOT NULL,
  PRIMARY KEY (idHorario, idLab),
  FOREIGN KEY (idHorario) REFERENCES Horario(idHorario),
  FOREIGN KEY (idLab) REFERENCES Laboratorio(idLab)
);

CREATE TABLE Alumno
(
  idAlumno INT AUTO_INCREMENT,
  Boleta INT NOT NULL,
  NombreAlumno varchar(50) not null,
  ApellidoPaterno INT NOT NULL,
  ApellidoMaterno INT NOT NULL,
  FechaNacimiento INT NOT NULL,
  Genero INT NOT NULL,
  CURP INT NOT NULL,
  Calle INT NOT NULL,
  Colonia INT NOT NULL,
  CP INT NOT NULL,
  Telefono INT NOT NULL,
  Correo INT NOT NULL,
  Promedio INT NOT NULL,
  EscuelaProcedencia INT NOT NULL,
  Alcaldia INT NOT NULL,
  OpcionEscom INT NOT NULL,
  idHorario INT NOT NULL,
  PRIMARY KEY (idAlumno),
  FOREIGN KEY (idHorario) REFERENCES Horario(idHorario),
  UNIQUE (CURP),
  UNIQUE (Correo),
  UNIQUE (Boleta)
);

show tables;
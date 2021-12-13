SET sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY","")); -- Comando usado para poder modificar tablar
drop database if exists examenweb;				   -- Comando para borrar una base de datos en caso de exist
create database examenweb;					   -- Comando para crear una base de datos

use examenweb;

/*===============================================Tablas===========================================================================*/
CREATE TABLE Laboratorio
(
  idLab INT AUTO_INCREMENT,
  NombreLab varchar(50) NOT NULL,
  Edificio varchar(50) NOT NULL,
  Piso varchar(50) NOT NULL,
  PRIMARY KEY (idLab)
);

CREATE TABLE Horario
(
  idHorario INT AUTO_INCREMENT,
  HoraInicio TIME NOT NULL,
  HoraFin TIME NOT NULL,
  Dia DATE NOT NULL,
  totalLugares INT NOT NULL,
  Disponibles INT NOT NULL,
  Ocupados INT NOT NULL,
  idLab INT NOT NULL,
  PRIMARY KEY (idHorario),
  FOREIGN KEY (idLab) REFERENCES Laboratorio(idLab)
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

CREATE TABLE Alumno
(
  idAlumno INT AUTO_INCREMENT,
  Boleta varchar(10) NOT NULL,
  NombreAlumno varchar(50) not null,
  ApellidoPaterno varchar(50) NOT NULL,
  ApellidoMaterno varchar(50) NOT NULL,
  FechaNacimiento DATE NOT NULL,
  Genero varchar(50) NOT NULL,
  CURP varchar(100) NOT NULL,
  Calle nvarchar(500) NOT NULL,
  Colonia nvarchar(500) NOT NULL,
  CP INT NOT NULL,
  Telefono INT NOT NULL,
  Correo varchar(50) NOT NULL,
  Promedio float(10) NOT NULL,
  EscuelaProcedencia varchar(500) NOT NULL,
  Alcaldia varchar(500) NOT NULL,
  OpcionEscom INT NOT NULL,
  idHorario INT NOT NULL,
  PRIMARY KEY (idAlumno),
  FOREIGN KEY (idHorario) REFERENCES Horario(idHorario),
  UNIQUE (CURP),
  UNIQUE (Correo),
  UNIQUE (Boleta)
);

show tables;
insert into Laboratorio(NombreLab, Edificio, Piso) values("4B", "terceredi", "5to piso");
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:30", "8:45","2021-12-12", 25, 25, 0, 1);

select * from Laboratorio;
select * from Horario;
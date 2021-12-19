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

CREATE TABLE Administradores
(
  idAdmin INT AUTO_INCREMENT,
  NombreAdmin varchar(50) NOT NULL,
  CorreoAdmin varchar(50) NOT NULL,
  ContrasenaAdmin varchar(500) NOT NULL,
  PRIMARY KEY (idAdmin)
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
  Telefono varchar(10) NOT NULL,
  Correo varchar(50) NOT NULL,
  Promedio float(10) NOT NULL,
  EscuelaProcedencia varchar(500) NOT NULL,
  Alcaldia varchar(500) NOT NULL,
  Estado varchar(500) NOT NULL,
  OpcionEscom INT NOT NULL,
  idHorario INT NOT NULL,
  PRIMARY KEY (idAlumno),
  FOREIGN KEY (idHorario) REFERENCES Horario(idHorario),
  UNIQUE (CURP),
  UNIQUE (Correo),
  UNIQUE (Boleta)
);

/*===============================================Insert===========================================================================*/

insert into EntidadFederal (NombreEstado) values("Aguas calientes");
insert into EntidadFederal (NombreEstado) values("Baja California");
insert into EntidadFederal (NombreEstado) values("Baja California Sur");
insert into EntidadFederal (NombreEstado) values("Campeche");
insert into EntidadFederal (NombreEstado) values("Chiapas");
insert into EntidadFederal (NombreEstado) values("Chihuahua");
insert into EntidadFederal (NombreEstado) values("Coahuila de Zaragoza");
insert into EntidadFederal (NombreEstado) values("Colima");
insert into EntidadFederal (NombreEstado) values("Durango");
insert into EntidadFederal (NombreEstado) values("Guanajuato");
insert into EntidadFederal (NombreEstado) values("Guerrero");
insert into EntidadFederal (NombreEstado) values("Hidalgo");
insert into EntidadFederal (NombreEstado) values("Jalisco");
insert into EntidadFederal (NombreEstado) values("Estado de México");
insert into EntidadFederal (NombreEstado) values("Michoacán de Ocampo");
insert into EntidadFederal (NombreEstado) values("Morelos");
insert into EntidadFederal (NombreEstado) values("Nayarit");
insert into EntidadFederal (NombreEstado) values("Nuevo León");
insert into EntidadFederal (NombreEstado) values("Oaxaca");
insert into EntidadFederal (NombreEstado) values("Puebla");
insert into EntidadFederal (NombreEstado) values("Querétaro");
insert into EntidadFederal (NombreEstado) values("Quintana Roo");
insert into EntidadFederal (NombreEstado) values("San Luis Potosí");
insert into EntidadFederal (NombreEstado) values("Sinaloa");
insert into EntidadFederal (NombreEstado) values("Sonora");
insert into EntidadFederal (NombreEstado) values("Tabasco");
insert into EntidadFederal (NombreEstado) values("Tamaulipas");
insert into EntidadFederal (NombreEstado) values("Tlaxcala");
insert into EntidadFederal (NombreEstado) values("Veracruz");
insert into EntidadFederal (NombreEstado) values("Yucatán");
insert into EntidadFederal (NombreEstado) values("Zacatecas");
insert into EntidadFederal (NombreEstado) values("Ciudad de México");


insert into EscuelaIPN (NombreEscuela) values("CECyT 1 Gonzalo Vázquez Vela");
insert into EscuelaIPN (NombreEscuela) values("CECyT 2 Miguel Bernard Perales");
insert into EscuelaIPN (NombreEscuela) values("CECyT 3 Estanislao Ramírez Ruiz");
insert into EscuelaIPN (NombreEscuela) values("CECyT 4 Lázaro Cárdenas del Río");
insert into EscuelaIPN (NombreEscuela) values("CECyT 5 Benito Juárez");
insert into EscuelaIPN (NombreEscuela) values("CECyT 6 Miguel Othon de Mendizábal");
insert into EscuelaIPN (NombreEscuela) values("CECyT 7 Cuauhtémoc");
insert into EscuelaIPN (NombreEscuela) values("CECyT 8 Narciso Bassols");
insert into EscuelaIPN (NombreEscuela) values("CECyT 9 Juan de Dios Bátiz Paredes");
insert into EscuelaIPN (NombreEscuela) values("CECyT 10 Carlos Vallejo Márquez");
insert into EscuelaIPN (NombreEscuela) values("CECyT 11 Wilfrido Massieu");
insert into EscuelaIPN (NombreEscuela) values("CECyT 12 José María Morelos");
insert into EscuelaIPN (NombreEscuela) values("CECyT 13 Ricardo Flores Magón");
insert into EscuelaIPN (NombreEscuela) values("CECyT 14 Luis Enrique Erro Soler");
insert into EscuelaIPN (NombreEscuela) values("CECyT 15 Diódoro Antúnez Echegaray");
insert into EscuelaIPN (NombreEscuela) values("CECyT 16 Hidalgo");
insert into EscuelaIPN (NombreEscuela) values("CECyT 17 León - Guanajuato");
insert into EscuelaIPN (NombreEscuela) values("CECyT 18 - Zacatecas");
insert into EscuelaIPN (NombreEscuela) values("CECyT 19 Leona Vicario");
insert into EscuelaIPN (NombreEscuela) values("CET 1 Walter Cross Buchanan");

insert into Alcaldia (NombreAlcaldia) values("Álvaro Obregón");
insert into Alcaldia (NombreAlcaldia) values("Azcapotzalco");
insert into Alcaldia (NombreAlcaldia) values("Benito Juárez");
insert into Alcaldia (NombreAlcaldia) values("Coyoacán");
insert into Alcaldia (NombreAlcaldia) values("Cuajimalpa");
insert into Alcaldia (NombreAlcaldia) values("Cuauhtémoc");
insert into Alcaldia (NombreAlcaldia) values("Gustavo A. Madero");
insert into Alcaldia (NombreAlcaldia) values("Iztacalco");
insert into Alcaldia (NombreAlcaldia) values("Iztapalapa");
insert into Alcaldia (NombreAlcaldia) values("La Magdalena Contreras");
insert into Alcaldia (NombreAlcaldia) values("Miguel Hidalgo");
insert into Alcaldia (NombreAlcaldia) values("Milpa Alta");
insert into Alcaldia (NombreAlcaldia) values("Tláhuac");
insert into Alcaldia (NombreAlcaldia) values("Tlalpan");
insert into Alcaldia (NombreAlcaldia) values("Venustiano Carranza");
insert into Alcaldia (NombreAlcaldia) values("Xochimilco");

insert into Laboratorio(NombreLab, Edificio, Piso) values("Laboratorio de Computo 1", "Edificio 1", "Primer piso");
insert into Laboratorio(NombreLab, Edificio, Piso) values("Laboratorio de Computo 2", "Edificio 1", "Segundo piso");
insert into Laboratorio(NombreLab, Edificio, Piso) values("Laboratorio de Computo 3", "Edificio 2", "Primer piso");
insert into Laboratorio(NombreLab, Edificio, Piso) values("Laboratorio de Computo 4", "Edificio 2", "Segundo piso");
insert into Laboratorio(NombreLab, Edificio, Piso) values("Laboratorio de Computo 5", "Edificio 3", "Primer piso");
insert into Laboratorio(NombreLab, Edificio, Piso) values("Laboratorio de Computo 6", "Edificio 3", "Segundo piso");

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-21", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-21", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-21", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-21", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-21", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-21", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-21", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-21", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-21", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-21", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-21", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-21", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-21", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-21", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-21", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-21", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-21", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-21", 25, 25, 0, 6);
/*
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-21", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-21", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-21", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-21", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-21", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-21", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-21", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-21", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-21", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-21", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-21", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-21", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-21", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-21", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-21", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-21", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-21", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-21", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-21", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-21", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-21", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-21", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-21", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-21", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-22", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-22", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-22", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-22", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-22", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:30","2021-12-22", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-22", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-22", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-22", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-22", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-22", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("8:45", "10:15","2021-12-22", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-22", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-22", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-22", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-22", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-22", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("10:30", "12:00","2021-12-22", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-22", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-22", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-22", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-22", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-22", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("12:15", "13:45","2021-12-22", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-22", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-22", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-22", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-22", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-22", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("14:00", "15:30","2021-12-22", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-22", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-22", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-22", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-22", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-22", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("15:45", "17:15","2021-12-22", 25, 25, 0, 6);

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-22", 25, 25, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-22", 25, 25, 0, 2);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-22", 25, 25, 0, 3);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-22", 25, 25, 0, 4);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-22", 25, 25, 0, 5);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("17:30", "19:00","2021-12-22", 25, 25, 0, 6);
*/
select * from Laboratorio;
select * from Horario;


/*Procedimiento (Procedure) para guardar Administrador*/
drop procedure if exists spGuardarAdmin;
delimiter |
create procedure spGuardarAdmin(in nombre nvarchar(50), in correo nvarchar(50), in contrasena nvarchar(500))
begin
	declare existe int;
    declare msj nvarchar(200);
    
    set existe = (select count(*) from Administradores where correo = CorreoAdmin);
    if(existe = 1) then
        set msj = "El correo que deseas usar esta ocupado";
    else
		insert into Administradores(NombreAdmin, CorreoAdmin, ContrasenaAdmin) values(nombre, correo, md5(contrasena));
        set msj = "ok";
	end if;
    select msj;
end; |
delimiter ;

call spGuardarAdmin("Caleb Bolaños", "bolanos.c@hotmail.com", "1234");

/*Procedimiento (Procedure) para el INICIO DE SESION*/
drop procedure if exists spIniciarSesion;
delimiter |
create procedure spIniciarSesion(in usr varchar(50), contra nvarchar(500))
begin
	declare idUsr, existe int;
    declare msj nvarchar(200);
    
    set existe = (select count(*) from Administradores where CorreoAdmin = usr and ContrasenaAdmin = md5(contra));
    if(existe = 1) then
		select idAdmin into idUsr from Administradores where CorreoAdmin = usr;
        set msj = "ok";
    else
		set msj = "Usuario o contraseña incorrecta";
	end if;
    select msj, idUsr;
end; |
delimiter ;

call spIniciarSesion("bolanos.c@hotmail.com", "1234");

/*Procedimiento (Procedure) para guardar Alumnos*/
drop procedure if exists spGuardarAlumno;
delimiter |
create procedure spGuardarAlumno(in bolet varchar(10), nalumno varchar(50), 
	apate varchar(100), amate varchar(100), fech date, gen varchar(50), 
	cur varchar(100), street nvarchar(500), col nvarchar(500), codigo int, 
    tel varchar(10), mail varchar(50), prom float(10), skulproce varchar(500),
    alcal varchar(500), esta varchar(500), opescom int)
begin
	declare dispo, numhorarios, hor, ocupa, existe, idA, idH int;
    declare msj nvarchar(200);
    set hor = 1;
    set numhorarios = (select count(*) from Horario);
    set existe = (select count(*) from Alumno where Boleta = bolet or Correo = mail or CURP = cur);

    if(existe = 0) then
		my_loop: LOOP
		set dispo = (select Disponibles from Horario where idHorario = hor);
		if(dispo > 0) then
			insert into Alumno(Boleta, NombreAlumno, ApellidoPaterno, ApellidoMaterno,
			FechaNacimiento, Genero, CURP, Calle, Colonia, CP, Telefono, Correo, 
			Promedio, EscuelaProcedencia, Alcaldia, Estado, OpcionEscom, idHorario)
			values (bolet, nalumno, apate, amate, fech, gen, cur, street, col,
			codigo, tel, mail, prom, skulproce, alcal, esta, opescom, hor);
        
			set ocupa = (select Ocupados from Horario where idHorario = hor);
			set dispo = dispo - 1;
			set ocupa = ocupa + 1;
        
			update Horario set Disponibles = dispo, Ocupados = ocupa where idHorario = hor; 
			set msj = "Usuario registrado, bienvenido a ESCOM";
            set idA = (select idAlumno from Alumno where Boleta = bolet);
            set idH = hor;
            LEAVE my_loop;
		else
			if(hor < numhorarios) then
				set hor = hor +1;
			end if;
		end if;
		END LOOP my_loop;
    else
		set msj = "Boleta o correo o CURP ya registrado";
    end if;
    select msj, idA, idH;
end; |
delimiter ;

/*Procedimiento (Procedure) para el eliminar alumno*/
drop procedure if exists spEliminarAlumno;
delimiter |
create procedure spEliminarAlumno(in id varchar(50))
begin
	declare horario, dispo, ocupa, existe int;
    declare msj nvarchar(200);
    
    set existe = (select count(*) from Alumno where idAlumno = id);
    if(existe = 1) then
		set horario = (select idHorario from Alumno where idAlumno = id);
		set ocupa = (select Ocupados from Horario where idHorario = horario);
		set dispo = (select Disponibles from Horario where idHorario = horario);
    
		set dispo = dispo + 1;
		set ocupa = ocupa - 1;
    
		update Horario set Disponibles = dispo, Ocupados = ocupa where idHorario = horario;
		delete from Alumno where idAlumno = id;
		set msj = "Alumno eliminado con exito";
    else
		set msj = "Alumno no encontrado, verifique el id";
    end if;
    select msj;
    
end; |
delimiter ;



call spGuardarAlumno('2016090069', 'Edgar', 'Garcia', 'Marciano', '2001-11-18', 'Masculino', 'RAEA650720MDFMSN04', 'Calle', 'Colonia', 12345, '5526836200', 'edgar@hotmail.com', '9.5', 'CECyT 12', 'Venustiano Carranza', 'Chiapas', 1);

select * from Alumno where idAlumno = 1;

show tables;


drop view if exists viewHorario;
create view viewHorario as select h.idHorario, h.HoraInicio as "horaInicio", h.HoraFin as "horaFin", h.Dia as "dia", l.NombreLab as "laboratorio", l.Edificio as "edificio", l.Piso as "piso"  from Horario h, Laboratorio l  where h.idLab = l.idLab order by idHorario;
select * from viewHorario where idHorario = 1;



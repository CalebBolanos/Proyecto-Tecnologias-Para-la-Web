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
  ContraseñaAdmin varchar(50) NOT NULL,
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
  Telefono int NOT NULL,
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

insert into Laboratorio(NombreLab, Edificio, Piso) values("4B", "terceredi", "5to piso");
insert into Laboratorio(NombreLab, Edificio, Piso) values("5B", "2edi", "4to piso");

insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("7:00", "8:45","2021-12-12", 25, 0, 0, 1);
insert into Horario(HoraInicio, HoraFin, Dia, totalLugares, Disponibles, Ocupados, idLab) values ("9:00", "10:45","2021-12-12", 25, 25, 0, 1);

select * from Laboratorio;
select * from Horario;


/*Procedimiento (Procedure) para guardar Alumnos*/
drop procedure if exists spGuardarAlumno;
delimiter |
create procedure spGuardarAlumno(in bolet varchar(10), nalumno varchar(50), 
	apate varchar(100), amate varchar(100), fech date, gen varchar(50), 
	cur varchar(100), street nvarchar(500), col nvarchar(500), codigo int, 
    tel int, mail varchar(50), prom float(10), skulproce varchar(500),
    alcal varchar(500), opescom int)
begin
	declare dispo, numhorarios, hor, ocupa int;
    declare msj nvarchar(200);
    set hor = 1;
    set numhorarios = (select count(*) from Horario);
    
    my_loop: LOOP
    set dispo = (select Disponibles from Horario where idHorario = hor);
    if(dispo > 0) then
		insert into Alumno(Boleta, NombreAlumno, ApellidoPaterno, ApellidoMaterno,
        FechaNacimiento, Genero, CURP, Calle, Colonia, CP, Telefono, Correo, 
        Promedio, EscuelaProcedencia, Alcaldia, OpcionEscom, idHorario)
        values (bolet, nalumno, apate, amate, fech, gen, cur, street, col,
        codigo, tel, mail, prom, skulproce, alcal, opescom, hor);
        
        set ocupa = (select Ocupados from Horario where idHorario = hor);
        set dispo = dispo - 1;
        set ocupa = ocupa + 1;
        
        update Horario set Disponibles = dispo, Ocupados = ocupa where idHorario = hor; 
        LEAVE my_loop;
	else
		if(hor < numhorarios) then
			set hor = hor +1;
		end if;
	end if;
    END LOOP my_loop;
    
end; |
delimiter ;

call spGuardarAlumno("2458f", "Prueba", "p", "m", "2001-10-10", "hombre", "dajeeif2",
	"calle", "colonia", 55687, 52, "correo@correo.correo.correo", 
    "12.2", "prepa", "alcaldia", 4);
    
select * from Alumno;
select * from Horario;
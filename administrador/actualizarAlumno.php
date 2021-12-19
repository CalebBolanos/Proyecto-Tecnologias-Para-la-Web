<?php

require_once '../base/DbConexion.php';
session_start();

if (!isset($_SESSION['idAdmin']) || !isset($_SESSION['nombre']) || !isset($_SESSION['correo'])) {
    session_unset();
    session_destroy();
    header('Location: iniciarSesion.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAlumno = $_POST['idAlumno'];
    $boleta = $_POST['boleta'];
    $nombre = $_POST['nombre'];
    $apellidop = $_POST['apellidop'];
    $apellidom = $_POST['apellidom'];
    $fecha = $_POST['fecha'];
    $genero = $_POST['genero'];
    $curp = $_POST['curp'];
    $calleNumero = $_POST['calleNumero'];
    $colonia = $_POST['colonia'];
    $alcaldia = $_POST['alcaldia'];
    $cp = $_POST['cp'];
    $telefono = $_POST['telefono'];
    $mail = $_POST['mail'];
    $escuelaP = $_POST['escuelaP'];
    $escuelaProcedencia = $_POST['escuelaProcedencia'];
    $estado = $_POST['estado'];
    $promedio = $_POST['promedio'];
    $opcion = $_POST['opcion'];

    $conexionBase = new DbConexion();
    if ($resultado = mysqli_query($conexionBase->getdbconnect(), 'update Alumno set Boleta = "'.$boleta.'",  NombreAlumno="'.$nombre.'", ApellidoPaterno="'.$apellidop.'", ApellidoMaterno="'.$apellidom.'",  FechaNacimiento="'.$fecha.'", Genero="'.$genero.'", CURP="'.$curp.'", Calle="'.$calleNumero.'", Colonia="'.$colonia.'", CP = '.$cp.', Telefono = '.$telefono.', Correo = "'.$mail.'", Promedio = '.$promedio.', EscuelaProcedencia = "'.$escuelaP.'", Alcaldia = "'.$alcaldia.'", Estado = "'.$estado.'", OpcionEscom = '.$opcion.' where idAlumno = '.$idAlumno.';')) {
        header('Location: crudAlumnos.php?msj=ok');
    } else {
        header('Location: crudAlumnos.php?msj=error');
    }
} else {
    header('Location: crudAlumnos.php');
    exit();
}

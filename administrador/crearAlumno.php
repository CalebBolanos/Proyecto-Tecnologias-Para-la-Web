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

    $sql = "call spGuardarAlumno('$boleta', 
    '$nombre',
    '$apellidop',
    '$apellidom',
    '$fecha',
    '$genero',
    '$curp',
    '$calleNumero', 
    '$colonia',  
    $cp, 
    '$telefono', 
    '$mail',
    '$promedio', 
    '$escuelaP', 
    '$alcaldia', 
    '$estado', 
    $opcion)";

    $conexionBase = new DbConexion();
    $resultado = mysqli_query($conexionBase->getdbconnect(), $sql);
    $fila = $resultado->fetch_assoc();

    if ($fila['msj'] == 'Usuario registrado, bienvenido a ESCOM') {
        header('Location: crudAlumnos.php?msj=ok');
        exit();
    } else {
        header('Location: crudAlumnos.php?msj='.$fila['msj'].'');
        exit();
    }
} else {
    header('Location: crudAlumnos.php');
    exit();
}

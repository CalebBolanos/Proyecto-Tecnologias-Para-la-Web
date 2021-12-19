<?php

require_once '../base/DbConexion.php';
session_start();

if (!isset($_SESSION['idAdmin']) || !isset($_SESSION['nombre']) || !isset($_SESSION['correo'])) {
    session_unset();
    session_destroy();
    header('Location: iniciarSesion.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: crudAlumnos.php');
    exit();
}

$idAlumno = $_GET['id'];

$conexionBase = new DbConexion();
if ($resultado = mysqli_query($conexionBase->getdbconnect(), 'call spEliminarAlumno('.$idAlumno.');')) {
    header('Location: crudAlumnos.php?borrar=ok');
    exit();
} else {
    header('Location: crudAlumnos.php?borrar=error');
    exit();
}

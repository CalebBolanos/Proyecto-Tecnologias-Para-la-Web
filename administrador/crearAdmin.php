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
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $nueva = $_POST['nuevaContrasena'];
    $nueva1 = $_POST['nuevaContrasena1'];

    if ($nueva != $nueva1) {
        header('Location: configuracion.php?msj=contrasenasDistintas');
        exit();
    }

    $sql = "call spGuardarAdmin('$nombre', '$correo', '$nueva');";

    $conexionBase = new DbConexion();
    $resultado = mysqli_query($conexionBase->getdbconnect(), $sql);
    $fila = $resultado->fetch_assoc();

    if ($fila['msj'] == 'ok') {
        header('Location: configuracion.php?msj=ok');
        exit();
    } else {
        header('Location: crudAlumnos.php?msj=correoOcupado');
        exit();
    }
} else {
    header('Location: inicio.php');
    exit();
}

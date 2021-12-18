<?php

require_once '../base/DbConexion.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    if (!empty($usuario) && !empty($contrasena)) {
        $conexionBase = new DbConexion();
        if ($resultado = mysqli_query($conexionBase->getdbconnect(), "call spIniciarSesion('".$usuario."', '".$contrasena."')")) {
            $fila = $resultado->fetch_assoc(); //obtenemos la unica fila del sp
            if ($fila['msj'] == 'ok') {
                $idUsuario = $fila['idUsr'];
                if ($resultadoInfoAdmin = mysqli_query($conexionBase->getdbconnect(), 'select * from Administradores where idAdmin = '.$idUsuario.';')) {
                    $fila = $resultadoInfoAdmin->fetch_assoc();

                    $_SESSION['idAdmin'] = $fila['idAdmin'];
                    $_SESSION['nombre'] = $fila['NombreAdmin'];
                    $_SESSION['correo'] = $fila['CorreoAdmin'];

                    echo $_SESSION['idAdmin'];
                    echo $_SESSION['nombre'];
                    echo $_SESSION['correo'];
                }
            } else {
                session_unset();
                session_destroy();
                header('Location: iniciarSesion.php?msj=sinCoincidencias');
                exit();
            }
        }
    } else {
        session_unset();
        session_destroy();
        header('Location: iniciarSesion.php?msj=camposVacios');
        exit();
    }
} else {
    session_unset();
    session_destroy();
    header('Location: iniciarSesion.php');
    exit();
}

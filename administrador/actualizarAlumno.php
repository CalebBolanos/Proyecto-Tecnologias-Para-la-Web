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

    $identidad = [
        'Boleta' => $boleta,
        'Nombre' => $nombre,
        'Apellido Paterno' => $apellidop,
        'Apellido Materno' => $apellidom,
        'Fecha de Nacimineto' => $fecha,
        'Genero' => $genero,
        'CURP' => $curp,
    ];

    $contacto = [
        'Calle y numero' => $calleNumero,
        'Colonia' => $colonia,
        'Alcaldia' => $alcaldia,
        'Codigo Postal' => $cp,
        'Telefono' => $telefono,
        'Correo' => $mail,
    ];

    //a partir de aqui hacer conexion a la base de datos y actualizar datos de alumno

    if ($escuelaP == 'on') {
        $procedencia = [
            'Escuela de Procedencia' => $escuelaProcedencia,
            'Entidad Federativa' => $estado,
            'Promedio' => $promedio,
            'ESCOM fue tu opcion' => $opcion,
        ];
    } else {
        $procedencia = [
            'Escuela de Procedencia' => $escuelaP,
            'Entidad Federativa' => $estado,
            'Promedio' => $promedio,
            'ESCOM fue tu opcion' => $opcion,
        ];
    }

    foreach ($identidad as $key => $value) {
        echo "$key : $value <br>";
    }

    echo '<br>';

    foreach ($contacto as $llave => $valor) {
        echo "$llave : $valor <br>";
    }

    echo '<br>';

    foreach ($procedencia as $clave => $atributos) {
        echo "$clave : $atributos <br>";
    }
} else {
    header('Location: crudAlumnos.php');
    exit();
}

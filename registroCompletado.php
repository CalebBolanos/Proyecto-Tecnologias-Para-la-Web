<?php

require_once 'base/DbConexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boleta = $_POST['Boleta'];
    $nombre = $_POST['Nombre'];
    $apellidop = $_POST['ApellidoPaterno'];
    $apellidom = $_POST['ApellidoMaterno'];
    $fecha = $_POST['FechadeNacimineto'];
    $genero = $_POST['Genero'];
    $curp = $_POST['CURP'];
    $calleNumero = $_POST['Calleynumero'];
    $colonia = $_POST['Colonia'];
    $alcaldia = $_POST['Alcaldia'];
    $cp = $_POST['CodigoPostal'];
    $telefono = $_POST['Telefono'];
    $mail = $_POST['Correo'];
    $escuelaP = $_POST['escuelaP'];
    $escuelaProcedencia = $_POST['EscueladeProcedencia'];
    $estado = $_POST['EntidadFederativa'];
    $promedio = $_POST['Promedio'];
    $opcion = $_POST['ESCOMfuetuopcion'];

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
        $idAlumno = $fila['idA'];
        $idHorario = $fila['idH'];

        $sqlHorario = "select * from viewHorario where idHorario = $idHorario;";
        if ($resultadoInfoAdmin = mysqli_query($conexionBase->getdbconnect(), $sqlHorario)) {
            $filaHorario = $resultadoInfoAdmin->fetch_assoc();
            $infoHorario = [
                'Hora de Inicio' => $filaHorario['horaInicio'],
                'Hora de Fin' => $filaHorario['horaFin'],
                'Día de aplicación' => $filaHorario['dia'],
                'Laboratorio' => $filaHorario['laboratorio'],
                'Edificio' => $filaHorario['edificio'],
                'Piso' => $filaHorario['piso'],
            ];
        }
    } else {
        header('Location: index.php?msj='.$fila['msj'].'');
        exit();
    }
} else {
    header('Location: index.php?msj=Llena todos los datos del formulario');
    exit();
}
?>


<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Datos guardados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="css/estilos.css" rel="stylesheet">
    <!--  <script src="js/verificarDatos.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="img/ipn.png" height="40" class="lineaDerecha">
                    <img src="img/escom.png" height="40">
                    <span class="fs-5">Registro de datos generales </span>
                </a>


            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-6 fw-normal">¡Tus datos fueron guardados correctamente!</h1>
                <p class="fs-5 text-muted">El horario en el que presentarás el exámen es el siguiente:</p>
            </div>
        </header>
        <main>
            <div class="row">
                <div class="col-md-12">
                    <div class="card p-0 tarjeta">
                        <div class="card-body mt-2">
                            <ul>
                                <?php
                                            foreach ($infoHorario as $llave => $valor) {
                                                echo '<li class="color-azul"><strong class="color-azul">'.$llave.': </strong><span class="color-negro">'.$valor.'</span></li>';
                                            }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 pt-3 ">
                    <p class="text-muted">Te mandamos un PDF con tu horario a tu correo electronico, pero si lo deseas,
                        puedes visualizarlo dando clic en <strong>"Generar PDF"</strong></p>
                </div>
                <div class="col-md-12 pt-3 text-center">
                    <button type="button" class="btn btn-primary">Generar PDF</button>
                    <a class="btn btn-outline-primary" href="index.php" role="button">Regresar a la pagina principal</a>
                </div>

            </div>


        </main>

        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img src="img/ipn.png" height="64" class="lineaDerecha">
                    <img src="img/escom.png" height="64">
                    <small class="d-block pt-3 text-muted">&copy; 2021 - ESCOM IPN</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Integrantes del equipo 6</h5>
                    <ul class="list-unstyled text-small">
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Resource</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Resource name</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Another resource</a>
                        </li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Acerca de</h5>
                    <ul class="list-unstyled text-small">
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Tecnologías para la
                                web</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">2CM12</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Proyecto Final:
                                Registro de datos generales para alumnos de nuevo ingreso (enero 2021)</a></li>
                    </ul>
                </div>
            </div>
        </footer>



    </div>


</body>

</html> 

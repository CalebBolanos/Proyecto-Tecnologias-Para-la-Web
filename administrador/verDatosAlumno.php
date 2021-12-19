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
$resultado = mysqli_query($conexionBase->getdbconnect(), 'select * from Alumno where idAlumno = '.$idAlumno.';');
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    $identidad = [
        'Boleta' => $fila['Boleta'],
        'Nombre' => $fila['NombreAlumno'],
        'Apellido Paterno' => $fila['ApellidoPaterno'],
        'Apellido Materno' => $fila['ApellidoMaterno'],
        'Fecha de Nacimineto' => $fila['FechaNacimiento'],
        'Genero' => $fila['Genero'],
        'CURP' => $fila['CURP'],
    ];

    $contacto = [
        'Calle y numero' => $fila['Calle'],
        'Colonia' => $fila['Colonia'],
        'Alcaldia' => $fila['Alcaldia'],
        'Codigo Postal' => $fila['CP'],
        'Telefono' => $fila['Telefono'],
        'Correo' => $fila['Correo'],
    ];

    $procedencia = [
        'Escuela de Procedencia' => $fila['EscuelaProcedencia'],
        'Entidad Federativa' => $fila['Estado'],
        'Promedio' => $fila['Promedio'],
        'ESCOM fue tu opcion' => $fila['OpcionEscom'],
    ];
} else {
    header('Location: crudAlumnos.php');
    exit();
}

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Datos del alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="../css/estilos.css" rel="stylesheet">
    <link href="../css/administrador.css" rel="stylesheet">
    <!--  <script src="js/verificarDatos.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <div class="container py-3">
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light blur border-bottom p-3 mb-3">
            <div class="container-fluid">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="../img/ipn.png" height="40" class="lineaDerecha">
                    <img src="../img/escom.png" height="40">
                    <span class="fs-5">Administrador </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="inicio.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="crudAlumnos.php">CRUD Alumnos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Configuración</a>
                        </li>
                    </ul>
                    <div class="dropdown text-end ">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://icons.deanishe.net/static/icons/material/444444/account-circle-256.png"
                                alt="mdo" width="32" height="32" class="rounded-circle">
                        </a>

                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#"><?php echo $_SESSION['nombre']; ?></a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Configuración</a></li>
                            <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
        </nav>
        <main class="container">
            <div class="row">
                <div class="col-12 pt-3">
                    <h3 class="pb-2 border-bottom">Datos del alumno</h3>
                </div>
                <div class="col-md-12 pt-3">
                    <div class="accordion " id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne" disabled>
                                    Identidad
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                    <ul>
                                        <?php
                                            foreach ($identidad as $llave => $valor) {
                                                echo '<li class="color-azul"><strong class="color-azul">'.$llave.': </strong><span class="color-negro">'.$valor.'</span></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo" disabled>
                                    Contacto
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <ul>
                                        <?php
                                            foreach ($contacto as $llave => $valor) {
                                                echo '<li class="color-azul"><strong class="color-azul">'.$llave.': </strong><span class="color-negro">'.$valor.'</span></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree" disabled>
                                    Procedencia
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                                    <ul>
                                        <?php
                                            foreach ($procedencia as $llave => $valor) {
                                                echo '<li class="color-azul"><strong class="color-azul">'.$llave.': </strong><span class="color-negro">'.$valor.'</span></li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </main>

    </div>


</body>

</html>
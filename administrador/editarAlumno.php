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
    <title>Editar datos del alumno</title>
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
                    <h3 class="pb-2 border-bottom">Editar datos del alumno</h3>
                </div>
                <div class="col-12 bg-white tarjeta">
                    <form class="needs-validation"  method="POST" action="actualizarAlumno.php" id="formulario" novalidate>
                        <div class="row g-3 ">
                            <div class="col-md-12 ">
                                <h3>Identidad</h3>
                            </div>
                            <div class="col-md-12 ">
                                <label for="boleta" class="form-label">Boleta</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupBoleta"><i class="bi bi-123"></i></span>
                                    <input type="text" class="form-control" id="boleta" name="boleta" pattern="^\d{10}|[PP]+\d{8}|[PE]+\d{8}$" aria-describedby="inputGroupBoleta" value="<?php echo $identidad['Boleta']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa una boleta valida.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="nombre" class="form-label">Nombre(s)</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupNombre"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="nombre" name="nombre" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupNombre" value="<?php echo $identidad['Nombre']; ?>" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="apellidop" class="form-label">Apellido Paterno</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupApellidop"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="apellidop" name="apellidop" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupApellidop" value="<?php echo $identidad['Apellido Paterno']; ?>" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="apellidom" class="form-label">Apellido Materno</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupApellidom"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="apellidom" name="apellidom" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupApellidom" value="<?php echo $identidad['Apellido Materno']; ?>" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="fecha" class="form-label">Fecha de nacimiento</label>
                                <div class="input-group has-validation">

                                    <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="inputGroupFecha" value="<?php echo $identidad['Fecha de Nacimineto']; ?>" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="fecha" class="form-label">Genero: </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="inlineRadio1" value="Femenino" <?php echo ($identidad['Genero'] == 'Femenino') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="inlineRadio1">Femenino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="inlineRadio2" value="Masculino" <?php echo ($identidad['Genero'] == 'Masculino') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="curp" class="form-label">CURP</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupCurp"><i class="bi bi-123"></i></span>
                                    <input type="text" class="form-control" id="curp" name="curp" pattern="^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$" aria-describedby="inputGroupCurp" value="<?php echo $identidad['CURP']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa una CURP valida.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <hr/>
                            </div>
                        </div>

                        <div class="row g-3 ">
                            <div class="col-md-12 ">
                                <h3>Contacto</h3>
                            </div>
                            <div class="col-md-6">
                                <label for="calleNumero" class="form-label">Calle y Número</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupCalleNumero"><i class="bi bi-house"></i></span>
                                    <input type="text" class="form-control" id="calleNumero" name="calleNumero" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupCalleNumero" value="<?php echo $contacto['Calle y numero']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa una dirección valida.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="colonia" class="form-label">Colonia</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupColonia"><i class="bi bi-house"></i></span>
                                    <input type="text" class="form-control" id="colonia" name="colonia" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupColonia" value="<?php echo $contacto['Colonia']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa una dirección valida.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="colonia" class="form-label">Alcaldía</label>
                                <select class="form-select" aria-label="Default select example" name="alcaldia" id="alcaldia" required>
                                        <option value="Álvaro Obregón" <?php echo ($contacto['Alcaldia'] == 'Álvaro Obregón') ? 'selected' : ''; ?> >Álvaro Obregón</option>
                                        <option value="Azcapotzalco" <?php echo ($contacto['Alcaldia'] == 'Azcapotzalco') ? 'selected' : ''; ?> >Azcapotzalco</option>
                                        <option value="Benito Juárez" <?php echo ($contacto['Alcaldia'] == 'Benito Juárez') ? 'selected' : ''; ?> >Benito Juárez</option>
                                        <option value="Coyoacán" <?php echo ($contacto['Alcaldia'] == 'Coyoacán') ? 'selected' : ''; ?> >Coyoacán</option>
                                        <option value="Cuajimalpa de Morelos" <?php echo ($contacto['Alcaldia'] == 'Cuajimalpa de Morelos') ? 'selected' : ''; ?> >Cuajimalpa de Morelos</option>
                                        <option value="Cuauhtémoc" <?php echo ($contacto['Alcaldia'] == 'Cuauhtémoc') ? 'selected' : ''; ?> >Cuauhtémoc</option>
                                        <option value="Gustavo A. Madero" <?php echo ($contacto['Alcaldia'] == 'Gustavo A. Madero') ? 'selected' : ''; ?> >Gustavo A. Madero</option>
                                        <option value="Iztacalco" <?php echo ($contacto['Alcaldia'] == 'Iztacalco') ? 'selected' : ''; ?> >Iztacalco</option>
                                        <option value="Iztapalapa" <?php echo ($contacto['Alcaldia'] == 'Iztapalapa') ? 'selected' : ''; ?> >Iztapalapa</option>
                                        <option value="La Magdalena Contreras" <?php echo ($contacto['Alcaldia'] == 'La Magdalena Contreras') ? 'selected' : ''; ?> >La Magdalena Contreras</option>
                                        <option value="Miguel Hidalgo" <?php echo ($contacto['Alcaldia'] == 'Miguel Hidalgo') ? 'selected' : ''; ?> >Miguel Hidalgo</option>
                                        <option value="Milpa Alta" <?php echo ($contacto['Alcaldia'] == 'Milpa Alta') ? 'selected' : ''; ?> >Milpa Alta</option>
                                        <option value="Tláhuac" <?php echo ($contacto['Alcaldia'] == 'Tláhuac') ? 'selected' : ''; ?> >Tláhuac</option>
                                        <option value="Tlalpan" <?php echo ($contacto['Alcaldia'] == 'Tlalpan') ? 'selected' : ''; ?> >Tlalpan</option>
                                        <option value="Venustiano Carranza" <?php echo ($contacto['Alcaldia'] == 'Venustiano Carranza') ? 'selected' : ''; ?> >Venustiano Carranza</option>
                                        <option value="Xochimilco" <?php echo ($contacto['Alcaldia'] == 'Xochimilco') ? 'selected' : ''; ?> >Xochimilco</option>
                                    </select>
                                <div class="invalid-feedback">
                                    Selecciona una alcaldia valida.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="cp" class="form-label">Código postal</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupCp"><i class="bi bi-123"></i></span>
                                    <input type="text" class="form-control"  id="cp" name="cp" pattern="^\d{5}$" aria-describedby="inputGroupCp" value="<?php echo $contacto['Codigo Postal']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa un código postal valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="telefono" class="form-label">Teléfono o celular</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupTelefono"><i class="bi bi-telephone"></i></span>
                                    <input type="text" class="form-control" id="telefono" name="telefono" pattern="^\d{10}$" aria-describedby="inputGroupTelefono" value="<?php echo $contacto['Telefono']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa un número valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="mail" class="form-label">Correo electrónico</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupMail"><i class="bi bi-envelope"></i></i></span>
                                    <input type="email" class="form-control" id="mail" name="mail" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" aria-describedby="inputGroupMail" value="<?php echo $contacto['Correo']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa un correo electrónico valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <hr/>
                            </div>
                        </div>



                        <div class="row g-3 ">
                            <div class="col-md-12 ">
                                <h3>Procedencia</h3>
                            </div>
                            <div class="col-md-12">
                                <label for="escuelaP" class="form-label">Escuela de procedencia: </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt1" value="CECyT 1" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 1') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt1">
                                        CECyT 1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt2" value="CECyT 2" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 2') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt2">
                                        CECyT 2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt3" value="CECyT 3" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 3') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt3">
                                        CECyT 3
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt4" value="CECyT 4" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 4') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt4">
                                        CECyT 4
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt5" value="CECyT 5" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 5') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt5">
                                        CECyT 5
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt6" value="CECyT 6" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 6') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt6">
                                        CECyT 6
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt7" value="CECyT 7" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 7') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt7">
                                        CECyT 7
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt8" value="CECyT 8" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 8') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt8">
                                        CECyT 8
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt9" value="CECyT 9" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 9') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt9">
                                        CECyT 9
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt10" value="CECyT 10" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 10') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt10">
                                        CECyT 10
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt11" value="CECyT 11" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 11') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt11">
                                        CECyT 11
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt12" value="CECyT 12" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 12') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt12">
                                        CECyT 12
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt13" value="CECyT 13" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 13') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt13">
                                        CECyT 13
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt14" value="CECyT 14" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 14') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt14">
                                        CECyT 14
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt15" value="CECyT 15" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 15') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt15">
                                        CECyT 15
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt16" value="CECyT 16" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 16') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt16">
                                        CECyT 16
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt17" value="CECyT 17" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 17') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt17">
                                        CECyT 17
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt18" value="CECyT 18" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 18') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt18">
                                        CECyT 18
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt19" value="CECyT 19" <?php echo ($procedencia['Escuela de Procedencia'] == 'CECyT 19') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cecyt19">
                                        CECyT 19
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cet1" value="CET 1" <?php echo ($procedencia['Escuela de Procedencia'] == 'CET 1') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cet1">
                                        CET 1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="chkYes" <?php echo (strlen($procedencia['Escuela de Procedencia']) > 8) ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="chkYes">
                                      Otra
                                    </label>
                                    <div class="col-md-12" id="dvtext">

                                        <label for="escuelaProcedencia" class="form-label">Escribe el nombre de tu escuela</label>
                                        <div class="has-validation">
                                            <input type="text"  class="form-control" id="escuelaProcedencia" name="escuelaProcedencia"  pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" value="<?php echo $procedencia['Escuela de Procedencia']; ?>"  aria-describedby="inputGroupEscuelaProcedencia">
                                            <div class="invalid-feedback">
                                                Este campo es requerido.
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>
                            <div class="col-md-12">
                                <label for="estado" class="form-label">Entidad Federativa</label>
                                <select class="form-select" aria-label="Default select example" name="estado" id="estado" required>
                                        <option value="Aguascalientes" <?php echo ($procedencia['Entidad Federativa'] == 'Aguascalientes') ? 'selected' : ''; ?> >Aguascalientes</option>
                                        <option value="Baja California" <?php echo ($procedencia['Entidad Federativa'] == 'Baja California') ? 'selected' : ''; ?> >Baja California</option>
                                        <option value="Baja California Sur" <?php echo ($procedencia['Entidad Federativa'] == 'Baja California Sur') ? 'selected' : ''; ?> >Baja California Sur</option>
                                        <option value="Campeche" <?php echo ($procedencia['Entidad Federativa'] == 'Campeche') ? 'selected' : ''; ?> >Campeche</option>
                                        <option value="Coahuila" <?php echo ($procedencia['Entidad Federativa'] == 'Coahuila') ? 'selected' : ''; ?> >Coahuila</option>
                                        <option value="Colima" <?php echo ($procedencia['Entidad Federativa'] == 'Colima') ? 'selected' : ''; ?> >Colima</option>
                                        <option value="Chiapas" <?php echo ($procedencia['Entidad Federativa'] == 'Chiapas') ? 'selected' : ''; ?> >Chiapas</option>
                                        <option value="Chihuahua" <?php echo ($procedencia['Entidad Federativa'] == 'Chihuahua') ? 'selected' : ''; ?> >Chihuahua</option>
                                        <option value="Ciudad de Mexico" <?php echo ($procedencia['Entidad Federativa'] == 'Ciudad de Mexico') ? 'selected' : ''; ?> >Ciudad de Mexico</option>
                                        <option value="Durango" <?php echo ($procedencia['Entidad Federativa'] == 'Durango') ? 'selected' : ''; ?> >Durango</option>
                                        <option value="Guanajuato" <?php echo ($procedencia['Entidad Federativa'] == 'Guanajuato') ? 'selected' : ''; ?> >Guanajuato</option>
                                        <option value="Guerrero" <?php echo ($procedencia['Entidad Federativa'] == 'Guerrero') ? 'selected' : ''; ?> >Guerrero</option>
                                        <option value="Hidalgo" <?php echo ($procedencia['Entidad Federativa'] == 'Hidalgo') ? 'selected' : ''; ?> >Hidalgo</option>
                                        <option value="Jalisco" <?php echo ($procedencia['Entidad Federativa'] == 'Jalisco') ? 'selected' : ''; ?> >Jalisco</option>
                                        <option value="México" <?php echo ($procedencia['Entidad Federativa'] == 'México') ? 'selected' : ''; ?> >México</option>
                                        <option value="Michoacán" <?php echo ($procedencia['Entidad Federativa'] == 'Michoacán') ? 'selected' : ''; ?> >Michoacán</option>
                                        <option value="Morelos" <?php echo ($procedencia['Entidad Federativa'] == 'Morelos') ? 'selected' : ''; ?> >Morelos</option>
                                        <option value="Nayarit" <?php echo ($procedencia['Entidad Federativa'] == 'Nayarit') ? 'selected' : ''; ?> >Nayarit</option>
                                        <option value="Nuevo León" <?php echo ($procedencia['Entidad Federativa'] == 'Nuevo León') ? 'selected' : ''; ?> >Nuevo León</option>
                                        <option value="Oaxaca" <?php echo ($procedencia['Entidad Federativa'] == 'Oaxaca') ? 'selected' : ''; ?> >Oaxaca</option>
                                        <option value="Puebla" <?php echo ($procedencia['Entidad Federativa'] == 'Puebla') ? 'selected' : ''; ?> >Puebla</option>
                                        <option value="Querétaro" <?php echo ($procedencia['Entidad Federativa'] == 'Querétaro') ? 'selected' : ''; ?> >Querétaro</option>
                                        <option value="Quintana Roo" <?php echo ($procedencia['Entidad Federativa'] == 'Quintana Roo') ? 'selected' : ''; ?> >Quintana Roo</option>
                                        <option value="San Luis Potosi" <?php echo ($procedencia['Entidad Federativa'] == 'San Luis Potosi') ? 'selected' : ''; ?> >San Luis Potosi</option>
                                        <option value="Sinaloa" <?php echo ($procedencia['Entidad Federativa'] == 'Sinaloa') ? 'selected' : ''; ?> >Sinaloa</option>
                                        <option value="Sonora" <?php echo ($procedencia['Entidad Federativa'] == 'Sonora') ? 'selected' : ''; ?> >Sonora</option>
                                        <option value="Tabasco" <?php echo ($procedencia['Entidad Federativa'] == 'Tabasco') ? 'selected' : ''; ?> >Tabasco</option>
                                        <option value="Tamaulipas" <?php echo ($procedencia['Entidad Federativa'] == 'Tamaulipas') ? 'selected' : ''; ?> >Tamaulipas</option>
                                        <option value="Tlaxcala" <?php echo ($procedencia['Entidad Federativa'] == 'Tlaxcala') ? 'selected' : ''; ?> >Tlaxcala</option>
                                        <option value="Veracruz" <?php echo ($procedencia['Entidad Federativa'] == 'Veracruz') ? 'selected' : ''; ?> >Veracruz</option>
                                        <option value="Yucatán" <?php echo ($procedencia['Entidad Federativa'] == 'Yucatán') ? 'selected' : ''; ?> >Yucatán</option>
                                        <option value="Zacatecas" <?php echo ($procedencia['Entidad Federativa'] == 'Zacatecas') ? 'selected' : ''; ?> >Zacatecas</option>
                                    </select>
                                <div class="invalid-feedback">
                                    Selecciona una alcaldia valida.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="promedio" class="form-label">Promedio</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPromedio"><i class="bi bi-mortarboard"></i></span>
                                    <input type="number" step="0.01" min="0" max="10" class="form-control" id="promedio" name="promedio" pattern="^[0-9]+([.][0-9]+)?$" aria-describedby="inputGroupPromedio" value="<?php echo $procedencia['Promedio']; ?>" required>
                                    <div class="invalid-feedback">
                                        Ingresa un número valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="fecha" class="form-label">ESCOM fue tu... </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="primer" value="1" <?php echo ($procedencia['ESCOM fue tu opcion'] == '1') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="primer">Primera opción</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="segunda" value="2" <?php echo ($procedencia['ESCOM fue tu opcion'] == '2') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="segunda">Segunda opción</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="tercera" value="3" <?php echo ($procedencia['ESCOM fue tu opcion'] == '3') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="tercera">Tercera opción</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="cuarta" value="4" <?php echo ($procedencia['ESCOM fue tu opcion'] == '4') ? 'checked' : ''; ?> required>
                                    <label class="form-check-label" for="cuarta">Cuarta opción</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary" >Actualizar datos</button>
                            </div>
                            <div class="col-md-4 d-md-flex justify-content-md-end">
                                <input type="reset" class="btn btn btn-outline-secondary" value="Restablecer valores"></button>
                            </div>
                            
                        </div>

                    </form>
                    <script src="../js/index.js"></script>
                </div>

            </div>


        </main>

    </div>


</body>

</html>
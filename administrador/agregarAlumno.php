<?php
require_once '../base/DbConexion.php';
session_start();

if (!isset($_SESSION['idAdmin']) || !isset($_SESSION['nombre']) || !isset($_SESSION['correo'])) {
    session_unset();
    session_destroy();
    header('Location: iniciarSesion.php');
    exit();
}

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Agregar nuevo del alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="../css/estilos.css" rel="stylesheet">
    <link href="../css/administrador.css" rel="stylesheet">
    <script src="../js/index.js" defer></script>
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
                            <a class="nav-link" href="configuracion.php">Configuración</a>
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
                            <li><a class="dropdown-item" href="configuracion.php">Configuración</a></li>
                            <li><a class="dropdown-item" href="cerrarSesion.php">Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
        </nav>
        <main class="container">
            <div class="row">
                <div class="col-12 pt-3">
                    <h3 class="pb-2 border-bottom">Agregar nuevo alumno</h3>
                </div>
                <div class="col-12 bg-white tarjeta">
                    <form class="needs-validation" method="POST" action="crearAlumno.php" id="formulario" novalidate>
                        <div class="row g-3 ">
                            <div class="col-md-12 ">
                                <h3>Identidad</h3>
                            </div>
                            <div class="col-md-12 ">
                                <label for="boleta" class="form-label">Boleta</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupBoleta"><i class="bi bi-123"></i></span>
                                    <input type="text" class="form-control" id="boleta" name="boleta" pattern="^\d{10}|[PP]+\d{8}|[PE]+\d{8}$" aria-describedby="inputGroupBoleta" required>
                                    <div class="invalid-feedback">
                                        Ingresa una boleta valida.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="nombre" class="form-label">Nombre(s)</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupNombre"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="nombre" name="nombre" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupNombre" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="apellidop" class="form-label">Apellido Paterno</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupApellidop"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="apellidop" name="apellidop" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupApellidop" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="apellidom" class="form-label">Apellido Materno</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupApellidom"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="apellidom" name="apellidom" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupApellidom" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="fecha" class="form-label">Fecha de nacimiento</label>
                                <div class="input-group has-validation">

                                    <input type="date" class="form-control" id="fecha" name="fecha" aria-describedby="inputGroupFecha" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="fecha" class="form-label">Genero: </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="inlineRadio1" value="Femenino" required>
                                    <label class="form-check-label" for="inlineRadio1">Femenino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="genero" id="inlineRadio2" value="Masculino" required>
                                    <label class="form-check-label" for="inlineRadio2">Masculino</label>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="curp" class="form-label">CURP</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupCurp"><i class="bi bi-123"></i></span>
                                    <input type="text" class="form-control" id="curp" name="curp" pattern="^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$"
                                        aria-describedby="inputGroupCurp" required>
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
                                    <input type="text" class="form-control" id="calleNumero" name="calleNumero" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupCalleNumero" required>
                                    <div class="invalid-feedback">
                                        Ingresa una dirección valida.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="colonia" class="form-label">Colonia</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupColonia"><i class="bi bi-house"></i></span>
                                    <input type="text" class="form-control" id="colonia" name="colonia" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupColonia" required>
                                    <div class="invalid-feedback">
                                        Ingresa una dirección valida.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="colonia" class="form-label">Alcaldía</label>
                                <select class="form-select" aria-label="Default select example" name="alcaldia" id="alcaldia" required>
                                        <option value="">Selecciona una opción</option>
                                        <option value="Álvaro Obregón">Álvaro Obregón</option>
                                        <option value="Azcapotzalco">Azcapotzalco</option>
                                        <option value="Benito Juárez">Benito Juárez</option>
                                        <option value="Coyoacán">Coyoacán</option>
                                        <option value="Cuajimalpa de Morelos">Cuajimalpa de Morelos</option>
                                        <option value="Cuauhtémoc">Cuauhtémoc</option>
                                        <option value="Gustavo A. Madero">Gustavo A. Madero</option>
                                        <option value="Iztacalco">Iztacalco</option>
                                        <option value="Iztapalapa">Iztapalapa</option>
                                        <option value="La Magdalena Contreras">La Magdalena Contreras</option>
                                        <option value="Miguel Hidalgo">Miguel Hidalgo</option>
                                        <option value="Milpa Alta">Milpa Alta</option>
                                        <option value="Tláhuac">Tláhuac</option>
                                        <option value="Tlalpan">Tlalpan</option>
                                        <option value="Venustiano Carranza">Venustiano Carranza</option>
                                        <option value="Xochimilco">Xochimilco</option>
                                    </select>
                                <div class="invalid-feedback">
                                    Selecciona una alcaldia valida.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="cp" class="form-label">Código postal</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupCp"><i class="bi bi-123"></i></span>
                                    <input type="text" class="form-control" id="cp" name="cp" pattern="^\d{5}$" aria-describedby="inputGroupCp" required>
                                    <div class="invalid-feedback">
                                        Ingresa un código postal valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="telefono" class="form-label">Teléfono o celular</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupTelefono"><i class="bi bi-telephone"></i></span>
                                    <input type="text" class="form-control" id="telefono" name="telefono" pattern="^\d{10}$" aria-describedby="inputGroupTelefono" required>
                                    <div class="invalid-feedback">
                                        Ingresa un número valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="mail" class="form-label">Correo electrónico</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupMail"><i class="bi bi-envelope"></i></i></span>
                                    <input type="email" class="form-control" id="mail" name="mail" pattern="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$" aria-describedby="inputGroupMail" required>
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
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt1" value="CECyT 1" required>
                                    <label class="form-check-label" for="cecyt1">
                                        CECyT 1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt2" value="CECyT 2" required>
                                    <label class="form-check-label" for="cecyt2">
                                        CECyT 2
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt3" value="CECyT 3" required>
                                    <label class="form-check-label" for="cecyt3">
                                        CECyT 3
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt4" value="CECyT 4" required>
                                    <label class="form-check-label" for="cecyt4">
                                        CECyT 4
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt5" value="CECyT 5" required>
                                    <label class="form-check-label" for="cecyt5">
                                        CECyT 5
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt6" value="CECyT 6" required>
                                    <label class="form-check-label" for="cecyt6">
                                        CECyT 6
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt7" value="CECyT 7" required>
                                    <label class="form-check-label" for="cecyt7">
                                        CECyT 7
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt8" value="CECyT 8" required>
                                    <label class="form-check-label" for="cecyt8">
                                        CECyT 8
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt9" value="CECyT 9" required>
                                    <label class="form-check-label" for="cecyt9">
                                        CECyT 9
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt10" value="CECyT 10" required>
                                    <label class="form-check-label" for="cecyt10">
                                        CECyT 10
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt11" value="CECyT 11" required>
                                    <label class="form-check-label" for="cecyt11">
                                        CECyT 11
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt12" value="CECyT 12" required>
                                    <label class="form-check-label" for="cecyt12">
                                        CECyT 12
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt13" value="CECyT 13" required>
                                    <label class="form-check-label" for="cecyt13">
                                        CECyT 13
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt14" value="CECyT 14" required>
                                    <label class="form-check-label" for="cecyt14">
                                        CECyT 14
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt15" value="CECyT 15" required>
                                    <label class="form-check-label" for="cecyt15">
                                        CECyT 15
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt16" value="CECyT 16" required>
                                    <label class="form-check-label" for="cecyt16">
                                        CECyT 16
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt17" value="CECyT 17" required>
                                    <label class="form-check-label" for="cecyt17">
                                        CECyT 17
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt18" value="CECyT 18" required>
                                    <label class="form-check-label" for="cecyt18">
                                        CECyT 18
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cecyt19" value="CECyT 19" required>
                                    <label class="form-check-label" for="cecyt19">
                                        CECyT 19
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="cet1" value="CET 1" required>
                                    <label class="form-check-label" for="cet1">
                                        CET 1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="escuelaP" id="chkYes" required>
                                    <label class="form-check-label" for="chkYes">
                                      Otra
                                    </label>
                                    <div class="col-md-12" id="dvtext">

                                        <label for="escuelaProcedencia" class="form-label">Escribe el nombre de tu escuela</label>
                                        <div class="has-validation">
                                            <input type="text" class="form-control" id="escuelaProcedencia" name="escuelaProcedencia" pattern="^[a-zA-ZÀ-ÿ\s]{1,40}$" aria-describedby="inputGroupEscuelaProcedencia">
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
                                        <option value="">Selecciona una opción</option>
                                        <option value="Aguascalientes">Aguascalientes</option>
                                        <option value="Baja California">Baja California</option>
                                        <option value="Baja California Sur">Baja California Sur</option>
                                        <option value="Campeche">Campeche</option>
                                        <option value="Coahuila">Coahuila</option>
                                        <option value="Colima">Colima</option>
                                        <option value="Chiapas">Chiapas</option>
                                        <option value="Chihuahua">Chihuahua</option>
                                        <option value="Ciudad de Mexico">Ciudad de Mexico</option>
                                        <option value="Durango">Durango</option>
                                        <option value="Guanajuato">Guanajuato</option>
                                        <option value="Guerrero">Guerrero</option>
                                        <option value="Hidalgo">Hidalgo</option>
                                        <option value="Jalisco">Jalisco</option>
                                        <option value="México">México</option>
                                        <option value="Michoacán">Michoacán</option>
                                        <option value="Morelos">Morelos</option>
                                        <option value="Nayarit">Nayarit</option>
                                        <option value="Nuevo León">Nuevo León</option>
                                        <option value="Oaxaca">Oaxaca</option>
                                        <option value="Puebla">Puebla</option>
                                        <option value="Querétaro">Querétaro</option>
                                        <option value="Quintana Roo">Quintana Roo</option>
                                        <option value="San Luis Potosi">San Luis Potosi</option>
                                        <option value="Sinaloa">Sinaloa</option>
                                        <option value="Sonora">Sonora</option>
                                        <option value="Tabasco">Tabasco</option>
                                        <option value="Tamaulipas">Tamaulipas</option>
                                        <option value="Tlaxcala">Tlaxcala</option>
                                        <option value="Veracruz">Veracruz</option>
                                        <option value="Yucatán">Yucatán</option>
                                        <option value="Zacatecas">Zacatecas</option>
                                    </select>
                                <div class="invalid-feedback">
                                    Selecciona una alcaldia valida.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="promedio" class="form-label">Promedio</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPromedio"><i class="bi bi-mortarboard"></i></span>
                                    <input type="number" step="0.01" min="0" max="10" class="form-control" id="promedio" name="promedio" pattern="^[0-9]+([.][0-9]+)?$" aria-describedby="inputGroupPromedio" required>
                                    <div class="invalid-feedback">
                                        Ingresa un número valido.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="fecha" class="form-label">ESCOM fue tu... </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="primer" value="1" required>
                                    <label class="form-check-label" for="primer">Primera opción</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="segunda" value="2" required>
                                    <label class="form-check-label" for="segunda">Segunda opción</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="tercera" value="3" required>
                                    <label class="form-check-label" for="tercera">Tercera opción</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="opcion" id="cuarta" value="4" required>
                                    <label class="form-check-label" for="cuarta">Cuarta opción</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Enviar datos</button>
                            </div>
                            <div class="col-md-4 d-md-flex justify-content-md-end">
                                <input type="reset" class="btn btn btn-outline-secondary" value="Limpiar"></button>
                            </div>

                        </div>

                    </form>
                </div>

            </div>


        </main>

    </div>


</body>

</html>
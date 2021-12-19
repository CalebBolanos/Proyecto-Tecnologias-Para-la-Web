<?php
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
    <title>Configuracion de la cuenta</title>
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
                            <a class="nav-link" href="crudAlumnos.php">CRUD Alumnos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Configuración</a>
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
                    <h2 class="pb-2 border-bottom">Información de la cuenta</h2>
                </div>
                <div class="col-12 bg-white tarjeta">
                    <?php
                        echo '<li class="color-azul"><strong class="color-azul">Nombre de administrador: </strong><span class="color-negro">'.$_SESSION['nombre'].'</span></li>';
                        echo '<li class="color-azul"><strong class="color-azul">Correo: </strong><span class="color-negro">'.$_SESSION['correo'].'</span></li>';
                    ?>
                </div>

                <div class="col-12 pt-3">
                    <h2 class="pb-2 border-bottom">Cambiar contraseña</h2>
                </div>
                <div class="col-12 bg-white tarjeta">
                    <form class="needs-validation" method="POST" action="cambiarContrasena.php" id="formulario">
                        <div class="row g-3 ">
                            <div class="col-md-12 ">
                                <label for="contraAntigua" class="form-label">Ingresa tu contraseña actual</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputContraAntigua"><i
                                            class="bi bi-key"></i></span>
                                    <input type="password" class="form-control" id="contraAntigua" name="contraAntigua"
                                        aria-describedby="inputContraAntigua" required>
                                    <div class="invalid-feedback">
                                        Ingresa una contraseña.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="nuevaContrasena" class="form-label">Ingresa tu nueva contraseña</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputNuevaContrasena"><i
                                            class="bi bi-key"></i></span>
                                    <input type="password" class="form-control" id="nuevaContrasena"
                                        name="nuevaContrasena" aria-describedby="inputNuevaContrasena" required>
                                    <div class="invalid-feedback">
                                        Ingresa una contraseña.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="nuevaContrasena1" class="form-label">Vuelve a ingresar tu nueva
                                    contraseña</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputNuevaContrasena1"><i
                                            class="bi bi-key"></i></span>
                                    <input type="password" class="form-control" id="nuevaContrasena1"
                                        name="nuevaContrasena1" aria-describedby="inputNuevaContrasena1" required>
                                    <div class="invalid-feedback">
                                        Ingresa una contraseña.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="hidden" name="idAdmin" value="<?php echo $_SESSION['idAdmin']; ?>">
                                <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="col-12 pt-3" id="agregarAdmin">
                    <h2 class="pb-2 border-bottom">Agregar administrador</h2>
                </div>
                <div class="col-12 bg-white tarjeta">
                    <form class="needs-validation" method="POST" action="crearAdmin.php" id="formulario2">
                        <div class="row g-3 ">
                            <div class="col-md-12 ">
                                <label for="nombre" class="form-label">Nombre de administrador</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputNombre"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        aria-describedby="inputNombre" required>
                                    <div class="invalid-feedback">
                                        Ingresa un nombre.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="correo" class="form-label">Correo</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputCorreo"><i
                                            class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="correo" name="correo"
                                        aria-describedby="inputCorreo" required>
                                    <div class="invalid-feedback">
                                        Ingresa un correo.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="nuevaContrasena" class="form-label">Contraseña</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputNuevaContrasena"><i
                                            class="bi bi-key"></i></span>
                                    <input type="password" class="form-control" id="nuevaContrasena"
                                        name="nuevaContrasena" aria-describedby="inputNuevaContrasena" required>
                                    <div class="invalid-feedback">
                                        Ingresa una contraseña.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <label for="nuevaContrasena1" class="form-label">Vuelve a ingresar tu contraseña</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputNuevaContrasena1"><i
                                            class="bi bi-key"></i></span>
                                    <input type="password" class="form-control" id="nuevaContrasena1"
                                        name="nuevaContrasena1" aria-describedby="inputNuevaContrasena1" required>
                                    <div class="invalid-feedback">
                                        Ingresa una contraseña.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                            </div>

                        </div>

                    </form>
                </div>





            </div>


        </main>

    </div>


</body>

</html>
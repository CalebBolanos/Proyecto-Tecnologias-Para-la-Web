<?php
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
} else {
    header('Location: index.php.?msj=Llena todos los datos del formulario');
    exit();
}
?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Verifica tus datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="css/estilos.css" rel="stylesheet">
    <script src="js/verificarDatos.js?new" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body>
    <div class="container py-3">
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="#" class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="img/ipn.png" height="40" class="lineaDerecha">
                    <img src="img/escom.png" height="40">
                    <span class="fs-5">Verifica tus datos</span>
                </a>


            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto ">
                <h1 class="display-6 fw-normal">Verifica tus datos</h1>
                <p class="fs-5 text-muted">Hola <strong><?php echo $nombre; ?></strong>, verifica que los datos que
                    ingresaste sean correctos:</p>
            </div>
        </header>
        <main>
            <div class="row">
                <div class="col-md-12">
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
                <div class="col-md-12 pt-3 text-center">
                    <form method="POST" id="datos">
                        <?php
                            foreach ($identidad as $llave => $valor) {
                                echo '<input type="hidden" name="'.str_replace(' ', '', $llave).'" value="'.$valor.'">';
                            }
                            foreach ($contacto as $llave => $valor) {
                                echo '<input type="hidden" name="'.str_replace(' ', '', $llave).'" value="'.$valor.'">';
                            }
                            foreach ($procedencia as $llave => $valor) {
                                echo '<input type="hidden" name="'.str_replace(' ', '', $llave).'" value="'.$valor.'">';
                            }
                            echo '<input type="hidden" name="escuelaP" value="'.$escuelaP.'">';

                        ?>
                        <button type="button" class="btn btn-primary" onclick="redirigirDatos('registroCompletado.php')">Aceptar</button>
                        <button type="button" class="btn btn-outline-primary" onclick="redirigirDatos('index.php')" >Modificar</button>
                    </form>
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
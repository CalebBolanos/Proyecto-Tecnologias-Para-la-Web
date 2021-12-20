<?php

require_once 'base/DbConexion.php';
include("./fpdf182/fpdf.php");
include("./phpMailer/class.phpmailer.php");
include("./phpMailer/class.smtp.php");
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
        'Fecha de Nacimiento' => $fecha,
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
        class PDF extends FPDF
        {
        // Cabecera de página
            function Header()
            {
            // Logo
                $this->Image('./img/escom.png',170,8,30);
                $this->Image('./img/ipn.png',10,8,30);
                $this->SetFont('Arial','B',24);
                $this->Cell(190,25,'Examen diagnostico',0,0,'C');
                $this->Ln(20);
            }

            // Pie de página
            function Footer()
            {       
            // Posición: a 1,5 cm del final
                $this->SetY(-15);
            // Arial italic 8
                $this->SetFont('Arial','I',8);
            // Número de página
                $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'I');
            }
        }

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','',12);

        $pdf->Cell(190,10,"",0,2,'C');
        $pdf->Cell(190,5,"Datos del alumno",0,2,'L');
        $pdf->Cell(190,10,"",0,2,'C');
        $pdf->Cell(190,5,"Boleta:$boleta",0,2,'L');
        $pdf->Cell(190,5,"Nombre:".$identidad["Nombre"],0,2,'L');
        $pdf->Cell(190,5,"Apellido Paterno:".$identidad["Apellido Paterno"],0,2,'L');
        $pdf->Cell(190,5,"Apellido Materno:".$identidad["Apellido Materno"],0,2,'L');
        $pdf->Cell(190,5,"Fecha de nacimiento:".$identidad["Fecha de Nacimiento"],0,2,'L');
        $pdf->Cell(190,5,"Genero:".$identidad["Genero"],0,2,'L');
        $pdf->Cell(190,5,"CURP:".$identidad["CURP"],0,2,'L');
        $pdf->Cell(190,5,"Calle:".$contacto["Calle y numero"],0,2,'L');
        $pdf->Cell(190,5,"Colonia:".$contacto["Colonia"],0,2,'L');
        $pdf->Cell(190,5,"CP:".$contacto["Codigo Postal"],0,2,'L');
        $pdf->Cell(190,5,"Telefono:".$contacto["Telefono"],0,2,'L');
        $pdf->Cell(190,5,"Correo:".$contacto["Correo"],0,2,'L');
        $pdf->Cell(190,5,"Promedio:".$procedencia["Promedio"],0,2,'L');
        $pdf->Cell(190,5,"Escuela de procedencia:".$procedencia["Escuela de Procedencia"],0,2,'L');
        $pdf->Cell(190,5,"Alcaldía:".$contacto["Alcaldia"],0,2,'L');
        $pdf->Cell(190,5,"Estado de procedencia:".$procedencia["Entidad Federativa"],0,2,'L');
        $pdf->Cell(190,5,"ESCOM fue tu opción:".$procedencia["ESCOM fue tu opcion"],0,2,'L');

        $pdf->Cell(190,10,"",0,2,'C');
        $pdf->Cell(190,5,"Horario",0,2,'L');
        $pdf->Cell(190,10,"",0,2,'C');
        $pdf->Cell(190,5,"Hora de inicio:".$infoHorario["Hora de Inicio"],0,2,'L');
        $pdf->Cell(190,5,"Hora de termino:".$infoHorario["Hora de Fin"],0,2,'L');
        $pdf->Cell(190,5,"Día de la aplicación:".$infoHorario["Día de aplicación"],0,2,'L');
        $pdf->Cell(190,5,"Laboratorio:".$infoHorario["Laboratorio"],0,2,'L');
        $pdf->Cell(190,5,"Edificio:".$infoHorario["Edificio"],0,2,'L');
        $pdf->Cell(190,5,"Piso:".$infoHorario["Piso"],0,2,'L');

        //Envio del mail
        $email_user = "pruebatecweb@gmail.com"; //OJO. Debes actualizar esta línea con tu información
        $email_password = "PruebaTecWeb1"; //OJO. Debes actualizar esta línea con tu información
        $the_subject = "Registro Nuevo Alumno ESCOM";
        $address_to = $contacto['Correo']; //OJO. Debes actualizar esta línea con tu información
        $from_name = "Equipo 6";
        $phpmailer = new PHPMailer();
        // ---------- datos de la cuenta de Gmail -------------------------------
        $phpmailer->Username = $email_user;
        $phpmailer->Password = $email_password; 
        //-----------------------------------------------------------------------
        // $phpmailer->SMTPDebug = 1;
        $phpmailer->SMTPSecure = 'ssl';
        $phpmailer->Host = "smtp.gmail.com"; // GMail
        $phpmailer->Port = 465;
        $phpmailer->IsSMTP(); // use SMTP
        $phpmailer->SMTPAuth = true;

        $phpmailer->setFrom($phpmailer->Username,$from_name);
        $phpmailer->AddAddress($address_to); // recipients email

        $phpmailer->Subject = $the_subject; 
        $phpmailer->Body .="<h2 style='color:#3498db;'>Registro completado</h2><h1 style='color:#3498db;'>Bienvenido a ESCOM!!</h1>";
        $phpmailer->Body .= "<p>Anexamos tus datos datos personales y el horario para presentar tu examen dentro del PDF</p>";
        $phpmailer->Body .= "<p>En caso de perder el archivo, puedes obtenerlo en la plataforma, en el apartado de RecuperarPDF</p>";
        $phpmailer->Body .= "<p>Fecha y Hora: ".date("d-m-Y h:i:s")."</p>";
        $pdfdoc = $pdf->Output('', 'S');
        $phpmailer->addStringAttachment($pdfdoc, 'RegistroESCOM.pdf');
        $phpmailer->IsHTML(true);

        $phpmailer->Send(); //Envio del mail

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
                    <form action="generarPDF.php" method="POST">
                    <input Type="hidden" name="idAlumno" value="<?php echo $idAlumno;?>">
                    <input Type="submit" class="btn btn-primary" value="Generar PDF"/>
                    </form>
                    
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
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Bolaños Ramos Caleb Salomón</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">García Marciano Edgar</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Hernádez Oble Axel</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Garduño Salazar Josué Judá*</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Acerca de</h5>
                    <ul class="list-unstyled text-small">
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Tecnologías para la web</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">2CM12</a></li>
                        <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Proyecto Final: Registro de datos generales para alumnos de nuevo ingreso (enero 2021)</a></li>
                    </ul>
                </div>
            </div>
        </footer>



    </div>


</body>

</html> 

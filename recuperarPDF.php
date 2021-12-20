<?php 

include("./fpdf182/fpdf.php");

require_once 'base/DbConexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $boleta = $_POST['boleta'];
    $curp = $_POST['curp'];
    $mail = $_POST['mail'];

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

$sql = "SELECT idAlumno FROM Alumno WHERE Boleta = '$boleta' AND CURP='$curp' AND Correo='$mail'";

$conexionBase = new DbConexion();
$resultado = mysqli_query($conexionBase->getdbconnect(), $sql);

$IdAlumno1 = mysqli_fetch_row($resultado);
$contenidoId = "$IdAlumno1[0]";
   
$sql = "SELECT * FROM Alumno WHERE idAlumno = $contenidoId";

$conexionBase = new DbConexion();
$resultado = mysqli_query($conexionBase->getdbconnect(), $sql);

$Alumno = mysqli_fetch_row($resultado);

//$contenidoPDF1 = "$Alumno[0]";id
$contenidoPDF2 = "$Alumno[1]";
$contenidoPDF3 = "$Alumno[2]";
$contenidoPDF4 = "$Alumno[3]";
$contenidoPDF5 = "$Alumno[4]";
$contenidoPDF6 = "$Alumno[5]";
$contenidoPDF7 = "$Alumno[6]";
$contenidoPDF8 = "$Alumno[7]";
$contenidoPDF9 = "$Alumno[8]";
$contenidoPDF10 = "$Alumno[9]";
$contenidoPDF11 = "$Alumno[10]";
$contenidoPDF12 = "$Alumno[11]";
$contenidoPDF13 = "$Alumno[12]";
$contenidoPDF14 = "$Alumno[13]";
$contenidoPDF15 = "$Alumno[14]";
$contenidoPDF16 = "$Alumno[15]";
$contenidoPDF17 = "$Alumno[16]";
$contenidoPDF18 = "$Alumno[17]";
$idHorario = "$Alumno[18]";

$sql2 ="SELECT * FROM viewHorario WHERE idHorario = $idHorario";
$conexionBase2 = new DbConexion();
$resultado2 = mysqli_query($conexionBase2->getdbconnect(), $sql2);

$Horario = mysqli_fetch_row($resultado2);
$contenidoHorario1 = "$Horario[1]";
$contenidoHorario2 = "$Horario[2]";
$contenidoHorario3 = "$Horario[3]";
$contenidoHorario4 = "$Horario[4]";
$contenidoHorario5 = "$Horario[5]";
$contenidoHorario6 = "$Horario[6]";
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica','',12);

$pdf->Cell(190,10,"",0,2,'C');
$pdf->Cell(190,5,"Datos del alumno",0,2,'L');
$pdf->Cell(190,10,"",0,2,'C');
$pdf->Cell(190,5,"Boleta:$contenidoPDF2",0,2,'L');
$pdf->Cell(190,5,"Nombre:$contenidoPDF3",0,2,'L');
$pdf->Cell(190,5,"Apellido Paterno:$contenidoPDF4",0,2,'L');
$pdf->Cell(190,5,"Apellido Materno:$contenidoPDF5",0,2,'L');
$pdf->Cell(190,5,"Fecha de nacimiento:$contenidoPDF6",0,2,'L');
$pdf->Cell(190,5,"Sexo:$contenidoPDF7",0,2,'L');
$pdf->Cell(190,5,"CURP:$contenidoPDF8",0,2,'L');
$pdf->Cell(190,5,"Calle:$contenidoPDF9",0,2,'L');
$pdf->Cell(190,5,"Colonia:$contenidoPDF10",0,2,'L');
$pdf->Cell(190,5,"CP:$contenidoPDF11",0,2,'L');
$pdf->Cell(190,5,"Telefono:$contenidoPDF12",0,2,'L');
$pdf->Cell(190,5,"Correo:$contenidoPDF13",0,2,'L');
$pdf->Cell(190,5,"Promedio:$contenidoPDF14",0,2,'L');
$pdf->Cell(190,5,"Escuela de procedencia:$contenidoPDF15",0,2,'L');
$pdf->Cell(190,5,"Delegación:$contenidoPDF16",0,2,'L');
$pdf->Cell(190,5,"Estado de procedencia:$contenidoPDF17",0,2,'L');
$pdf->Cell(190,5,"ESCOM fue tu opción:$contenidoPDF18",0,2,'L');

$pdf->Cell(190,10,"",0,2,'C');
$pdf->Cell(190,5,"Horario",0,2,'L');
$pdf->Cell(190,10,"",0,2,'C');
$pdf->Cell(190,5,"Hora de inicio:$contenidoHorario1",0,2,'L');
$pdf->Cell(190,5,"Hora de termino:$contenidoHorario2",0,2,'L');
$pdf->Cell(190,5,"Día de la aplicación:$contenidoHorario3",0,2,'L');
$pdf->Cell(190,5,"Laboratorio:$contenidoHorario4",0,2,'L');
$pdf->Cell(190,5,"Edificio:$contenidoHorario5",0,2,'L');
$pdf->Cell(190,5,"Piso:$contenidoHorario6",0,2,'L');
$pdf->Output();
}
else{
    header('Location: index.php?msj=Alumno no encontrado');
}
?>
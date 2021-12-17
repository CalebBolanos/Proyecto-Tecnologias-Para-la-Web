<?php
    $boleta = $_GET["boleta"];
    $nombre = $_GET["nombre"];
    $apellidop = $_GET["apellidop"];
    $apellidom = $_GET["apellidom"];
    $fecha = $_GET["fecha"];
    $genero = $_GET["genero"];
    $curp = $_GET["curp"];
    $calleNumero = $_GET["calleNumero"];
    $colonia = $_GET["colonia"];
    $alcaldia = $_GET["alcaldia"];
    $cp = $_GET["cp"];
    $telefono = $_GET["telefono"];
    $mail = $_GET["mail"];
    $escuelaP = $_GET["escuelaP"];
    $escuelaProcedencia = $_GET["escuelaProcedencia"];
    $estado = $_GET["estado"];
    $promedio = $_GET["promedio"];
    $opcion = $_GET["opcion"];


    $identidad=array(
        "Boleta"=>$boleta,
        "Nombre"=>$nombre,
        "Apellido Paterno"=>$apellidop,
        "Apellido Materno"=>$apellidom,
        "Fecha de Nacimineto"=>$fecha,
        "Genero"=>$genero,
        "CURP"=>$curp
    );

    $contacto=array(
        "Calle y numero"=>$calleNumero,
        "Colonia"=>$colonia,
        "Alcaldia"=>$alcaldia,
        "Codigo Postal"=>$cp,
        "Telefono"=>$telefono,
        "Correo"=>$mail
    );

    if($escuelaP=="on"){
        $procedencia=array(
            "Escuela de Procedencia"=>$escuelaProcedencia,
            "Entidad Federativa"=>$estado,
            "Promedio"=>$promedio,
            "ESCOM fue tu opcion"=>$opcion
        );
    }else{
        $procedencia=array(
            "Escuela de Procedencia"=>$escuelaP,
            "Entidad Federativa"=>$estado,
            "Promedio"=>$promedio,
            "ESCOM fue tu opcion"=>$opcion
        );
    }

    foreach($identidad as $key => $value){
        echo "$key : $value <br>";
    }
  
    echo "<br>";

    foreach($contacto as $llave => $valor){
        echo "$llave : $valor <br>";
    }

    echo "<br>";

    foreach($procedencia as $clave => $atributos){
        echo "$clave : $atributos <br>";
    }

    echo "<br>";
    
    $conexion = mysqli_connect("localhost","root","","examenweb");

    
    $sql = "call spGuardarAlumno('PE2', 'caleb', 'ca', 'leb', '15/12/21', 'masculino', '5454de', 'calle', 'colonia', 56130, '594526', 'correo@correo', '12.2', 'escuela', 'alcaldia', 'estado1', 5)";
    $resultado = mysqli_query($conexion,$sql);

    $numFilasResultado = mysqli_num_rows($resultado);

    echo "Tienes $numFilasResultado registros en la tabla alumno";
    

    /*
    $sentencia = $conexion->prepare("CALL spGuardarAlumno(?, ?, ?, ?,
    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $sentencia->brind_Param('sssssssssisssssi',
    $identidad["Boleta"],
    $identidad["Nombre"],
    $identidad["Apellido Paterno"],
    $identidad["Apellido Materno"],
    $identidad["Fecha de Nacimiento"],
    $identidad["Genero"],
    $identidad["CURP"],
    $contacto["Calle y numero"],
    $contacto["Colonia"],
    $contacto["CP"],
    $contacto["Telefono"],
    $contacto["Correo"],
    $procedencia["Promedio"],
    $procedencia["Escuela de Procedencia"],
    $contacto["Alcaldia"],
    $procedencia["ESCOM fue tu opcion"]
    );
    $sentencia->execute();

    $sentencia->close();*/
?>
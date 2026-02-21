<?php
    session_start();
    $estudiante = null;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $edad = $_POST["edad"];
        $carrera = $_POST["carrera"];
        $curso = $_POST["curso"];
        $semana = $_POST["semana"];
        $fecha = $_POST["fecha"];

        $nombre_completo = $nombre . " " . $apellido;
        
        //estructura de control
        if($edad >= 18){
            $mayorEdad = "Es mayor de edad";
        }else {
            $mayorEdad = "Es menor de edad";
        }

        //Arreglos asociativos
        $estudiante = [
            "nombre_completo" => $nombre_completo,
            "edad" => $edad,
            "carrera" => $carrera,
            "curso" => $curso,
            "fecha" => $fecha,
            "mayorEdad" => $mayorEdad,
            "semana" => $semana
        ];

        $_SESSION['Estudiante'] = $estudiante;

        //Redireccion
        header("Location: example.php");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "GET"){
       $_SESSION['Mensaje'] = "Bienvenido al primer formulario con PHP"; 
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Example PHP</title>
</head>
<body>
    <main>
        <?php if(isset($_SESSION['Mensaje'])):?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><?= $_SESSION['Mensaje'] ?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Formulario -->
        <div class="container mt-4">
            <h2>Registro Estudiante</h2>
            <form method="POST" class="mb-4">
                <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" required>
                <input type="text" name="apellido" placeholder="Apellido" class="form-control mb-2" required>
                <input type="number" name="edad" placeholder="Edad" class="form-control mb-2" required>
                <input type="text" name="carrera" placeholder="Carrera" class="form-control mb-2" required>
                <input type="text" name="curso" placeholder="Curso" class="form-control mb-2" required>
                <input type="number" name="semana" placeholder="Semana" class="form-control mb-2" required>
                <input type="date" name="fecha" placeholder="Fecha" class="form-control mb-2" required>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
        </div>
        <!-- Resultado -->
         <?php if(isset($_SESSION['Estudiante'])): ?>
            <?php $estudiante = $_SESSION['Estudiante']?>
            <div class="container mt=3">
                <h2>Bienvenido <?=  $estudiante['nombre_completo']?></h2>
                <p>Es un estudiante de <?= $estudiante['edad'] ?> años de edad, <?= $estudiante['mayorEdad'] ?> y actualmente cursa la carrera: <?= $estudiante['carrera'] ?>, esta cursando la materia de <?= $estudiante['curso'] ?>, el cual va por su semana #: <?= $estudiante['semana'] ?>,
                    su clase se programo para la fecha: <?= $estudiante['fecha'] ?>.
                </p>
            </div>
            <?php unset($_SESSION['Estudiante']); ?>
        <?php endif; ?>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</html>
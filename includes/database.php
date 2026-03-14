<?php
//Control de conexion a la base de datos

//Activar el control de errores 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//Informacion de conexion 
$host = 'localhost';
$user= 'root';
$pass= 'Jdcc7206.';
$database = 'tienda_app';

//conexion a la base de datos
$mysqli = new mysqli($host, $user,$pass,$database);

//Verificamos la conexion
if($mysqli->connect_error){
    echo "<div class='alert alert-danger>Error al conectar con la base de datos</div>'";
}else {
    $mysqli->set_charset('utf8mb4');
}
?>
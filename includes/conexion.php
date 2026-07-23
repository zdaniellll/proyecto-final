<?php
$host = "localhost";
$user = "root";
$password = ""; // En XAMPP va vacío por defecto
$database = "bd_incb";

$conexion = mysqli_connect($host, $user, $password, $database);

if (!$conexion) {
    die("Error crítico de conexión a la base de datos: " . mysqli_connect_error());
}

// Forzamos UTF-8 para que las tildes y las 'ñ' se guarden correctamente
mysqli_set_charset($conexion, "utf8mb4");
?>
<?php
// --- Conexión a la base de datos --------------------------------------------
// XAMPP usa 'root' sin contraseña por defecto (''). Si el servidor tiene contraseña, se prueba también.
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "bd_incb";

$conexion = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conexion) {
    // Si falla sin contraseña, intenta con la contraseña alternativa (por si se cambió en MySQL)
    $conexion = @mysqli_connect($db_host, $db_user, "200905", $db_name);
}

// Si falla, detiene la ejecución y muestra el error del driver
if (!$conexion) {
    die("Error crítico de conexión a la base de datos: " . mysqli_connect_error());
}

// UTF-8 extendido: permite tildes, 'ñ' y emojis en la BD
mysqli_set_charset($conexion, "utf8mb4");
?>

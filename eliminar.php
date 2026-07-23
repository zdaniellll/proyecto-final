<?php
// Seguridad: sesión activa + método POST + token CSRF antes de borrar nada
require_once 'includes/auth.php';   // ya incluye config.php (sesión + $base_url)
require_once 'includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_validar($_POST['csrf_token'] ?? null)) {
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        $stmt = mysqli_prepare($conexion, "DELETE FROM mensajes_contacto WHERE id = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($conexion);
header("Location: admin.php");
exit();

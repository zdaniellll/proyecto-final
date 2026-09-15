<?php
// --- Eliminar mensaje de contacto -------------------------------------------
// Solo acepta POST con CSRF válido y sesión admin activa (auth.php)
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_validar($_POST['csrf_token'] ?? null)) {
    // Convierte el ID a entero para evitar inyección SQL
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        // Consulta preparada: borra el mensaje con el ID indicado
        $stmt = mysqli_prepare($conexion, "DELETE FROM mensajes_contacto WHERE id = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

mysqli_close($conexion);

// Vuelve al dashboard tras la eliminación
header('Location: ' . $base_url . 'admin.php');
exit();

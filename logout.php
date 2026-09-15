<?php
// --- Cierre de sesión -------------------------------------------------------
// Carga config para tener acceso a app_url() y la sesión ya iniciada
require_once __DIR__ . '/includes/config.php';

// Elimina todas las variables de sesión y destruye la sesión del servidor
session_unset();
session_destroy();

// Redirige al login tras cerrar sesión
header('Location: ' . app_url('login.php'));
exit();
?>
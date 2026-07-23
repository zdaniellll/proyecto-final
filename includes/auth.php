<?php
// Protege cualquier página que lo incluya: si no hay sesión de admin, expulsa al login.
require_once __DIR__ . '/config.php'; // ya arranca la sesión

if (!isset($_SESSION['usuario_admin']) || empty($_SESSION['usuario_admin'])) {
    header("Location: " . $base_url . "login.php");
    exit();
}

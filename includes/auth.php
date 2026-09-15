<?php
// --- Guardia de sesión admin ------------------------------------------------
// Incluir al inicio de cualquier página del panel protegido.
// Si no hay sesión activa, redirige al login y corta la ejecución.
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['usuario_admin']) || empty($_SESSION['usuario_admin'])) {
    header("Location: " . app_url('login.php'));
    exit();
}

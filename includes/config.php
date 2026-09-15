<?php
// ============================================================
// config.php — Configuración central del portal INCB
// Para cambiar de entorno (XAMPP ↔ hosting) solo edita este archivo.
// ============================================================

// --- Sesión -----------------------------------------------------------------
// Inicia sesión solo si no hay una activa (evita el error "headers already sent")
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- Ruta base del proyecto -------------------------------------------------
// APP_ROOT = ruta absoluta del sistema de archivos hasta la carpeta Portal/
define('APP_ROOT', dirname(__DIR__));

// Detecta automáticamente el subfolder según SCRIPT_NAME
// Ej: /proyecto_final/Portal/index.php → base_url = '/proyecto_final/Portal/'
$script_name = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
$script_dir  = rtrim(dirname($script_name), '/');

// Si el script está dentro de subcarpetas conocidas (/pages, /admin, /actions, /components), sube un nivel para obtener la raíz real
$script_dir = preg_replace('#/(pages|admin|actions|components)$#', '', $script_dir);

$auto_base_url = ($script_dir !== '' && $script_dir !== '.') ? $script_dir . '/' : '/';

// Solo se asigna si no fue definida antes (útil para admin/)
if (!isset($base_url)) {
    $base_url = $auto_base_url;
}

define('APP_URL', $base_url);

// app_path('img/logo.png') → ruta absoluta del sistema de archivos
function app_path(string $path = ''): string {
    return rtrim(APP_ROOT, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . ltrim($path, '/\\');
}

// app_url('login.php') → URL web completa usando $base_url
function app_url(string $path = ''): string {
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/\\');
}

// --- Credenciales del panel de administración -------------------------------
// Contraseña almacenada como hash bcrypt (NO en texto plano)
// Para generar nuevo hash: php -r "echo password_hash('nueva_clave', PASSWORD_DEFAULT);"
define('ADMIN_USUARIO',    'admin');
define('ADMIN_CLAVE_HASH', '$2b$10$Blwjh5seUfLJuZ6JfxC4P.WWbTEsCPkyiUjKk0/hIIpwcs8E/IgD2'); // = "incb2026"

// --- Tokens CSRF ------------------------------------------------------------
// Generan y validan el token anti-falsificación en formularios sensibles

// Genera (o recupera) el token de la sesión actual
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Valida que el token enviado coincida con el de la sesión (comparación segura)
function csrf_validar(?string $token): bool {
    return !empty($token)
        && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

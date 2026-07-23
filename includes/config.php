<?php
/**
 * config.php
 * Configuración central del sitio: rutas, credenciales admin y CSRF.
 * Al mover el proyecto de carpeta (XAMPP <-> InfinityFree) SOLO hay
 * que tocar $base_url aquí; el resto del portal ya no usa rutas fijas.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- Ruta base del proyecto -------------------------------------------------
// En local (XAMPP):  '/proyecto_final/Portal/'
// En InfinityFree:    '/'   (la carpeta pública ES la raíz del dominio)
if (!isset($base_url)) {
    $base_url = '/proyecto_final/Portal/';
}

// --- Credenciales del panel de administración -------------------------------
// La contraseña NUNCA se guarda en texto plano: se compara contra un hash.
// Para generar un hash nuevo (ej. si cambian la contraseña):
//   php -r "echo password_hash('nueva_clave', PASSWORD_DEFAULT);"
define('ADMIN_USUARIO', 'admin');
define('ADMIN_CLAVE_HASH', '$2b$10$Blwjh5seUfLJuZ6JfxC4P.WWbTEsCPkyiUjKk0/hIIpwcs8E/IgD2'); // hash de "incb2026"

// --- Ayudante CSRF (protege formularios que cambian datos) -----------------
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_validar(?string $token): bool {
    return !empty($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

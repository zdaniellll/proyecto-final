<?php
// 1. Reanudamos la sesión actual que está activa en el navegador
session_start();

// 2. Vaciamos todas las variables de sesión (como 'usuario_admin')
session_unset();

// 3. Destruimos la sesión por completo de la memoria del servidor
session_destroy();

// 4. Redirigimos al administrador de vuelta a la puerta de entrada
// [!] IMPORTANTE: Si tu pantalla para iniciar sesión se llama "index.php", 
// cambia la palabra "login.php" por "index.php" aquí abajo.
header("Location: index.php");
exit();
?>
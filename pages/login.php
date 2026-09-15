<?php
// --- Login del panel de administración -------------------------------------
// Autentica contra la tabla `usuarios` de bd_incb.
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/conexion.php';

// Crea la tabla `usuarios` si no existe (primera vez que se ejecuta el portal)
$tabla_check = mysqli_query($conexion, "SHOW TABLES LIKE 'usuarios'");
if ($tabla_check && mysqli_num_rows($tabla_check) == 0) {
    $sql_crear_tabla = "CREATE TABLE `usuarios` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `usuario` VARCHAR(50) NOT NULL UNIQUE,
      `password` VARCHAR(255) NOT NULL,
      `nombre` VARCHAR(100) NOT NULL,
      `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    mysqli_query($conexion, $sql_crear_tabla);

    // Inserción del usuario inicial de administración por defecto (admin / incb2026)
    $hash_defecto = password_hash('incb2026', PASSWORD_DEFAULT);
    $stmt_init = mysqli_prepare($conexion, "INSERT INTO usuarios (usuario, password, nombre) VALUES ('admin', ?, 'Administrador INCB')");
    if ($stmt_init) {
        mysqli_stmt_bind_param($stmt_init, "s", $hash_defecto);
        mysqli_stmt_execute($stmt_init);
        mysqli_stmt_close($stmt_init);
    }
}

// Si ya hay sesión activa, redirige directo al panel
if (isset($_SESSION['usuario_admin'])) {
    header("Location: " . app_url('admin.php'));
    exit();
}

$error = "";

// --- Protección anti-fuerza bruta -----------------------------------------
// Bloquea el formulario 60 segundos después de 5 intentos fallidos consecutivos
if (!isset($_SESSION['login_intentos']))  $_SESSION['login_intentos'] = 0;
if (!isset($_SESSION['login_bloqueo']))   $_SESSION['login_bloqueo'] = 0;

$bloqueado = $_SESSION['login_bloqueo'] > time();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$bloqueado) {

    if (!csrf_validar($_POST['csrf_token'] ?? null)) {
        $error = "Sesión expirada, por favor intenta de nuevo.";
    } else {
        $usuario_input = trim($_POST['usuario'] ?? '');
        $clave_input   = trim($_POST['clave']   ?? '');

        // Busca el usuario en la BD con consulta preparada (previene inyección SQL)
        $sql_login = "SELECT id, usuario, password, nombre FROM usuarios WHERE usuario = ?";
        $stmt_login = mysqli_prepare($conexion, $sql_login);
        
        if ($stmt_login) {
            mysqli_stmt_bind_param($stmt_login, "s", $usuario_input);
            mysqli_stmt_execute($stmt_login);
            $res = mysqli_stmt_get_result($stmt_login);
            $user_row = mysqli_fetch_assoc($res);
            mysqli_stmt_close($stmt_login);

            // Verifica contraseña con bcrypt (password_verify es resistente a timing attacks)
            if ($user_row && password_verify($clave_input, $user_row['password'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_admin'] = $user_row['usuario'];
                $_SESSION['nombre_admin']  = $user_row['nombre'];
                $_SESSION['login_intentos'] = 0;
                header("Location: " . app_url('admin.php'));
                exit();
            } else {
                $_SESSION['login_intentos']++;
                if ($_SESSION['login_intentos'] >= 5) {
                    $_SESSION['login_bloqueo']  = time() + 60;
                    $_SESSION['login_intentos'] = 0;
                    $error = "Demasiados intentos fallidos. Espera 1 minuto antes de volver a intentar.";
                } else {
                    $error = "Usuario o contraseña incorrectos. Intenta de nuevo.";
                }
            }
        } else {
            $error = "Error al consultar la base de datos.";
        }
    }
} elseif ($bloqueado) {
    $error = "Demasiados intentos fallidos. Espera un momento antes de volver a intentar.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión · Panel de Administración INCB</title>
    <link rel="icon" type="image/png" href="<?= $base_url; ?>img/logo_incb_formatoMejorado.png">
    
    <!-- Archivos CSS de Bootstrap locales -->
    <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/bootstrap-icons.min.css">
    
    <!-- Google Fonts con carga asíncrona -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    
    <style>
      :root {
        --incb-azul-oscuro: #0b2447;
        --incb-azul: #14487a;
        --incb-dorado: #c99a3c;
      }
      body { font-family: 'Inter', system-ui, sans-serif; background: #f4f6f9; }
      h1, h3, .fw-brand { font-family: 'Poppins', sans-serif; }
      .btn-primary {
        background: var(--incb-azul); border-color: var(--incb-azul);
      }
      .btn-primary:hover { background: var(--incb-azul-oscuro); border-color: var(--incb-azul-oscuro); }
      .accent-line { width: 48px; height: 4px; background: var(--incb-dorado); border-radius: 2px; margin: 0 auto 1.5rem; }
      .toggle-password { cursor: pointer; }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">

        <!-- Panel izquierdo con imagen del INCB -->
        <div class="col-lg-7 d-none d-lg-flex position-relative overflow-hidden">
            <img src="<?= $base_url; ?>img/logo_incb_formatoMejorado.png"
                 alt="Instituto Nacional de Ciudad Barrios"
                 class="position-absolute top-0 start-0 w-100 h-100"
                 style="object-fit: cover; object-position: center;">
            <div class="position-absolute top-0 start-0 w-100 h-100"
                 style="background: linear-gradient(135deg, rgba(11,36,71,0.90) 0%, rgba(20,72,122,0.82) 100%);"></div>
            <div class="position-relative w-100 h-100 d-flex flex-column justify-content-center align-items-center text-center text-white p-5" style="z-index:2;">
                <i class="bi bi-mortarboard text-warning opacity-75 mb-4" style="font-size: 5rem;"></i>
                <h1 class="display-4 fw-brand fw-bold">Instituto Nacional de Ciudad Barrios</h1>
                <p class="lead opacity-75 mt-2" style="max-width: 500px;">Panel de Administración y Gestión Institucional</p>
            </div>
        </div>

        <!-- Panel derecho: formulario -->
        <div class="col-lg-5 d-flex align-items-center justify-content-center bg-white shadow-lg p-4 p-sm-5" style="z-index:1;">
            <div class="w-100" style="max-width: 400px;">

                <div class="text-center mb-4">
                    <div class="d-inline-block bg-light rounded-circle p-3 mb-3 shadow-sm border">
                        <i class="bi bi-shield-lock-fill fs-2" style="color: var(--incb-azul);"></i>
                    </div>
                    <h3 class="fw-brand fw-bold text-dark">Acceso Restringido</h3>
                    <div class="accent-line"></div>
                    <p class="text-muted small">Ingresa tus credenciales para administrar el portal</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger d-flex align-items-center rounded-3 shadow-sm p-3 small mb-4" role="alert">
                        <i class="bi bi-exclamation-octagon-fill me-2 fs-5 flex-shrink-0"></i>
                        <div><?= htmlspecialchars($error); ?></div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" autocomplete="off">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">

                    <div class="mb-3">
                        <label for="usuario" class="form-label fw-bold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Usuario</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 py-2" id="usuario" name="usuario"
                                   placeholder="Ej. admin" required autofocus <?= $bloqueado ? 'disabled' : ''; ?>>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="clave" class="form-label fw-bold text-secondary small text-uppercase" style="letter-spacing: 0.5px;">Contraseña de Seguridad</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0 text-muted">
                                <i class="bi bi-key"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 border-end-0 py-2" id="clave" name="clave"
                                   placeholder="••••••••" required <?= $bloqueado ? 'disabled' : ''; ?>>
                            <span class="input-group-text bg-white border-start-0 text-muted toggle-password" id="btnTogglePassword" title="Mostrar/ocultar contraseña">
                                <i class="bi bi-eye-slash" id="iconEye"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fs-6 fw-semibold shadow-sm py-2 mt-2" <?= $bloqueado ? 'disabled' : ''; ?>>
                        Entrar al Sistema <i class="bi bi-arrow-right-short ms-1"></i>
                    </button>
                </form>

                <div class="text-center mt-5">
                    <a href="<?= app_url('index.php'); ?>" class="text-decoration-none text-secondary small">
                        <i class="bi bi-arrow-left-circle me-1"></i> Volver a la página principal
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- JS local de Bootstrap -->
<script src="<?= $base_url; ?>assets/js/bootstrap.bundle.min.js"></script>

<script>
  // Toggle interactivo para mostrar/ocultar contraseña
  document.getElementById('btnTogglePassword')?.addEventListener('click', function () {
    const inputClave = document.getElementById('clave');
    const iconEye = document.getElementById('iconEye');
    if (inputClave.type === 'password') {
      inputClave.type = 'text';
      iconEye.classList.replace('bi-eye-slash', 'bi-eye');
    } else {
      inputClave.type = 'password';
      iconEye.classList.replace('bi-eye', 'bi-eye-slash');
    }
  });
</script>
</body>
</html>

<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/conexion.php';

$mensaje = '';
$exito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $contenido = trim($_POST['contenido'] ?? '');
    $autor = trim($_POST['autor'] ?? '');

    if ($titulo === '' || $contenido === '' || $autor === '') {
        $mensaje = '<div class="alert alert-warning">Completa todos los campos antes de publicar.</div>';
    } elseif (!csrf_validar($_POST['csrf_token'] ?? null)) {
        $mensaje = '<div class="alert alert-danger">La sesión ha expirado. Inténtalo de nuevo.</div>';
    } else {
        $sql = 'CREATE TABLE IF NOT EXISTS noticias_institucionales (
            id INT AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(255) NOT NULL,
            contenido TEXT NOT NULL,
            autor VARCHAR(100) NOT NULL,
            fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;';

        if (mysqli_query($conexion, $sql)) {
            $stmt = mysqli_prepare($conexion, 'INSERT INTO noticias_institucionales (titulo, contenido, autor) VALUES (?, ?, ?)');
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'sss', $titulo, $contenido, $autor);
                if (mysqli_stmt_execute($stmt)) {
                    $exito = true;
                    $mensaje = '<div class="alert alert-success">¡Noticia publicada correctamente!</div>';
                    $titulo = $contenido = $autor = '';
                } else {
                    $mensaje = '<div class="alert alert-danger">Error al guardar la noticia: ' . htmlspecialchars(mysqli_error($conexion)) . '</div>';
                }
                mysqli_stmt_close($stmt);
            } else {
                $mensaje = '<div class="alert alert-danger">No se pudo preparar la consulta: ' . htmlspecialchars(mysqli_error($conexion)) . '</div>';
            }
        } else {
            $mensaje = '<div class="alert alert-danger">No se pudo crear la tabla de noticias: ' . htmlspecialchars(mysqli_error($conexion)) . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar noticia | INCB</title>
    <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/bootstrap-icons.min.css">
    <style>
        body { background: #f4f6f9; font-family: Arial, sans-serif; }
        .panel { max-width: 760px; margin: 40px auto; background: #fff; border-radius: 18px; padding: 30px; box-shadow: 0 10px 28px rgba(0,0,0,.08) }
        textarea { min-height: 180px; }
    </style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar_admin.php'; ?>
<div class="container py-4">
    <div class="panel">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <div class="text-uppercase small text-secondary fw-bold">Panel de administración</div>
                <h1 class="h3 mb-0">Publicar noticia</h1>
            </div>
            <a href="<?= $base_url; ?>admin.php" class="btn btn-outline-secondary">Volver al dashboard</a>
        </div>

        <?= $mensaje; ?>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
            <div class="mb-3">
                <label class="form-label fw-bold">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($titulo ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Autor</label>
                <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($autor ?? ($_SESSION['nombre_admin'] ?? 'Administrador')); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Contenido</label>
                <textarea name="contenido" class="form-control" required><?= htmlspecialchars($contenido ?? ''); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar noticia</button>
        </form>
    </div>
</div>
<?php mysqli_close($conexion); ?>
</body>
</html>
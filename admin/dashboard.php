<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/conexion.php';

$sql = "SELECT * FROM mensajes_contacto ORDER BY id DESC";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$totalMensajes = mysqli_num_rows($resultado);
$mensajes = [];
while ($fila = mysqli_fetch_assoc($resultado)) {
    $mensajes[] = $fila;
}
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel de Administración — INCB</title>
  <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $base_url; ?>assets/css/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    :root {
      --incb-azul-oscuro: #0b2447;
      --incb-azul: #14487a;
      --incb-dorado: #c99a3c;
    }
    body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
    h1, h5, .fw-brand { font-family: 'Poppins', sans-serif; }
    .stat-card { border: none; border-radius: 16px; padding: 1.5rem; color: #fff; position: relative; overflow: hidden; }
    .stat-card .stat-icon { font-size: 3.5rem; opacity: 0.15; position: absolute; right: 1rem; bottom: 0.5rem; }
    .stat-card .stat-number { font-size: 2.2rem; font-weight: 700; line-height: 1; }
    .stat-card .stat-label { font-size: 0.85rem; opacity: 0.85; margin-top: 4px; }
    .msg-card { border: none; border-radius: 14px; box-shadow: 0 2px 12px rgba(0,0,0,0.07); transition: transform .18s, box-shadow .18s; background: #fff; }
    .msg-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
    .msg-card .card-header { background: #fff; border-bottom: 1px solid #f0f2f5; border-radius: 14px 14px 0 0 !important; padding: 0.9rem 1.2rem; }
    .avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--incb-azul), var(--incb-azul-oscuro)); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 1rem; flex-shrink: 0; }
    .msg-text { background: #f8f9fb; border-radius: 10px; padding: 0.75rem 1rem; font-size: 0.9rem; color: #444; line-height: 1.55; }
    .badge-id { background: #e9ecef; color: #6c757d; font-size: 0.75rem; font-weight: 600; border-radius: 20px; padding: 3px 10px; }
    .section-title { font-size: 0.7rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #6c757d; }
    .empty-state { background: #fff; border-radius: 16px; padding: 4rem 2rem; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .page-header { background: linear-gradient(135deg, var(--incb-azul-oscuro) 0%, var(--incb-azul) 100%); border-radius: 16px; padding: 2rem 2rem; color: #fff; margin-bottom: 1.5rem; }
    .btn-images { background: #fff; color: var(--incb-azul); border: none; font-weight: 600; border-radius: 10px; padding: 0.5rem 1.2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.12); transition: background 0.25s, color 0.25s; }
    .btn-images:hover { background: #eaf1f8; color: var(--incb-azul-oscuro); }
    .btn-export { background: #fff; color: #198754; border: none; font-weight: 600; border-radius: 10px; padding: 0.5rem 1.2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.12); }
    .btn-export:hover { background: #f0fff4; color: #157347; }
    .btn-logout { background: rgba(255,255,255,0.15); color: #fff; border: 1px solid rgba(255,255,255,0.35); border-radius: 10px; padding: 0.5rem 1.2rem; font-weight: 500; }
    .btn-logout:hover { background: rgba(255,255,255,0.25); color: #fff; }
  </style>
</head>
<body>
<?php include __DIR__ . '/../includes/navbar_admin.php'; ?>
<div class="container py-4">
  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <div class="section-title text-white-50 mb-1">Panel de Administración</div>
      <h1 class="h3 fw-bold mb-1 text-white"><i class="bi bi-envelope-paper-fill me-2"></i>Mensajes de Contacto</h1>
      <p class="mb-0 text-white-50 small">Gestiona los mensajes recibidos desde el formulario del portal.</p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <a href="<?= $base_url; ?>admin/imagenes.php" class="btn btn-images">
        <i class="bi bi-images me-1"></i>Cambiar Imágenes
      </a>
      <a href="<?= $base_url; ?>admin/exportar_excel.php" class="btn btn-export">
        <i class="bi bi-file-earmark-excel-fill me-1 text-success"></i>Exportar Excel
      </a>
      <a href="<?= $base_url; ?>logout.php" class="btn btn-logout">
        <i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión
      </a>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
      <div class="stat-card" style="background: linear-gradient(135deg,var(--incb-azul),var(--incb-azul-oscuro));">
        <div class="stat-number"><?= $totalMensajes ?></div>
        <div class="stat-label">Total de mensajes</div>
        <i class="bi bi-envelope-fill stat-icon"></i>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <div class="stat-card" style="background: linear-gradient(135deg,#198754,#20c997);">
        <?php $conCorreo = array_filter($mensajes, fn($m) => !empty($m['correo_remitente'])); ?>
        <div class="stat-number"><?= count($conCorreo) ?></div>
        <div class="stat-label">Con correo</div>
        <i class="bi bi-at stat-icon"></i>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <?php $hoy = date('Y-m-d'); $hoy_count = count(array_filter($mensajes, fn($m) => str_starts_with($m['fecha_envio'], $hoy))); ?>
      <div class="stat-card" style="background: linear-gradient(135deg,#fd7e14,#ffc107);">
        <div class="stat-number"><?= $hoy_count ?></div>
        <div class="stat-label">Hoy</div>
        <i class="bi bi-calendar-check stat-icon"></i>
      </div>
    </div>
    <div class="col-6 col-md-3">
      <?php $este_mes = date('Y-m'); $mes_count = count(array_filter($mensajes, fn($m) => str_starts_with($m['fecha_envio'], $este_mes))); ?>
      <div class="stat-card" style="background: linear-gradient(135deg,#dc3545,#e85d75);">
        <div class="stat-number"><?= $mes_count ?></div>
        <div class="stat-label">Este mes</div>
        <i class="bi bi-graph-up stat-icon"></i>
      </div>
    </div>
  </div>

  <?php if ($totalMensajes > 0): ?>
    <div class="section-title mb-3"><i class="bi bi-inbox me-1"></i>Bandeja de entrada</div>
    <div class="row g-3">
      <?php foreach ($mensajes as $fila): ?>
        <?php $inicial = strtoupper(mb_substr($fila['nombre_remitente'], 0, 1)); ?>
        <div class="col-md-6 col-xl-4">
          <div class="msg-card h-100 d-flex flex-column">
            <div class="card-header d-flex align-items-center gap-3">
              <div class="avatar"><?= htmlspecialchars($inicial) ?></div>
              <div class="flex-grow-1 overflow-hidden">
                <div class="fw-semibold text-truncate"><?= htmlspecialchars($fila['nombre_remitente']) ?></div>
                <?php if (!empty($fila['correo_remitente'])): ?>
                  <div class="small text-muted text-truncate"><i class="bi bi-envelope me-1"></i><?= htmlspecialchars($fila['correo_remitente']) ?></div>
                <?php endif; ?>
              </div>
              <span class="badge-id">#<?= (int)$fila['id'] ?></span>
            </div>
            <div class="card-body d-flex flex-column flex-grow-1 p-3">
              <div class="msg-text flex-grow-1"><?= nl2br(htmlspecialchars($fila['mensaje_texto'])) ?></div>
              <div class="small text-muted mt-3"><?= htmlspecialchars($fila['fecha_envio']) ?></div>
              <form method="POST" action="<?= $base_url; ?>admin/eliminar.php" onsubmit="return confirm('¿Eliminar este mensaje?');" class="mt-3">
                <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
                <input type="hidden" name="id" value="<?= (int)$fila['id']; ?>">
                <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                  <i class="bi bi-trash3 me-1"></i>Eliminar
                </button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="empty-state text-center">
      <i class="bi bi-inbox fs-1 text-muted mb-3 d-block"></i>
      <h2 class="h5 fw-bold mb-2 text-dark">No hay mensajes aún</h2>
      <p class="text-muted mb-0">Cuando llegue el primer contacto, aparecerá aquí.</p>
    </div>
  <?php endif; ?>
</div>
<footer class="py-4 text-white mt-5" style="background: var(--incb-azul-oscuro);">
  <div class="container small">
    <div class="row">
      <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-2">
          <img src="<?= $base_url; ?>img/logo_incb_formatoMejorado.png" alt="Logotipo INCB" height="35">
          <strong>Instituto Nacional de Ciudad Barrios (INCB)</strong>
        </div>
        <div class="text-white-50">&copy; <?= date('Y') ?> INCB. Todos los derechos reservados.</div>
      </div>
      <div class="col-md-5 text-md-end mt-3 mt-md-0">
        <a href="<?= $base_url; ?>index.php" class="me-3 text-white text-decoration-none">Inicio</a>
        <a href="<?= $base_url; ?>index.php#contacto" class="text-white text-decoration-none">Contacto</a>
      </div>
    </div>
  </div>
</footer>
<script src="<?= $base_url; ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

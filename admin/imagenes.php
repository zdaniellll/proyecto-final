<?php
require_once __DIR__ . '/../includes/auth.php';

// ─── Imágenes gestionables ────────────────────────────────────────────────────
$imagenes_gestionables = [
    'fachada.jpg'                   => 'Fachada del Instituto (Carrusel 1)',
    'banda.jpg'                     => 'Banda Musical (Carrusel 2)',
    'danza.jpg'                     => 'Danza Folclórica (Carrusel 3)',
    'anuncio.jpg'                   => 'Imagen de Anuncio Emergente',
    'profesores.jpg'                => 'Foto de Profesores / Nosotros',
    'logo_incb.png'                 => 'Logo INCB (formato PNG)',
    'logo_incb_formatoMejorado.png' => 'Logo INCB Mejorado (PNG)'
];

// ─── Configuración de validación ──────────────────────────────────────────────
const MAX_BYTES  = 2 * 1024 * 1024;          // 2 MB
const TIPOS_VALIDOS  = ['image/jpeg', 'image/png', 'image/webp'];
const EXT_VALIDAS    = ['jpg', 'jpeg', 'png', 'webp'];

$img_dir  = dirname(__DIR__) . '/img/';
$mensajes = [];

// ─── Procesamiento POST ───────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validación CSRF nativa (Compara el token enviado por POST con el de la sesión)
    $token_post = $_POST['csrf_token'] ?? '';
    $token_session = $_SESSION['csrf_token'] ?? '';

    if (empty($token_post) || $token_post !== $token_session) {
        $mensajes[] = ['tipo' => 'danger', 'texto' => 'Token de seguridad inválido. Recarga la página e intenta de nuevo.'];
    } else {
        $objetivo = $_POST['imagen_objetivo'] ?? '';

        if (!array_key_exists($objetivo, $imagenes_gestionables)) {
            $mensajes[] = ['tipo' => 'danger', 'texto' => 'Imagen de destino no permitida.'];
        } elseif (!isset($_FILES['nueva_imagen']) || $_FILES['nueva_imagen']['error'] !== UPLOAD_ERR_OK) {
            $mensajes[] = ['tipo' => 'danger', 'texto' => 'No se recibió ningún archivo o hubo un error en la subida.'];
        } else {
            $archivo    = $_FILES['nueva_imagen'];
            $tmp        = $archivo['tmp_name'];
            $tamanio    = $archivo['size'];
            $nombre_sub = $archivo['name'];
            $ext_sub    = strtolower(pathinfo($nombre_sub, PATHINFO_EXTENSION));

            if (!in_array($ext_sub, EXT_VALIDAS, true)) {
                $mensajes[] = ['tipo' => 'danger', 'texto' => "Formato no permitido (<strong>{$ext_sub}</strong>). Solo JPG, PNG o WEBP."];
            } elseif ($tamanio > MAX_BYTES) {
                $mb = number_format($tamanio / 1024 / 1024, 2);
                $mensajes[] = ['tipo' => 'danger', 'texto' => "El archivo pesa <strong>{$mb} MB</strong>. El límite máximo es 2 MB."];
            } else {
                $finfo     = new finfo(FILEINFO_MIME_TYPE);
                $mime_real = $finfo->file($tmp);

                if (!in_array($mime_real, TIPOS_VALIDOS, true)) {
                    $mensajes[] = ['tipo' => 'danger', 'texto' => "El contenido del archivo no es una imagen válida (MIME: {$mime_real})."];
                } else {
                    $destino = $img_dir . $objetivo;
                    if (move_uploaded_file($tmp, $destino)) {
                        $desc = htmlspecialchars($imagenes_gestionables[$objetivo]);
                        $mensajes[] = ['tipo' => 'success', 'texto' => "<i class='bi bi-check-circle-fill me-1'></i> <strong>{$desc}</strong> actualizada correctamente."];
                    } else {
                        $mensajes[] = ['tipo' => 'danger', 'texto' => 'No se pudo mover el archivo. Verifica los permisos de la carpeta <code>img/</code>.'];
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestionar Imágenes — Panel INCB</title>
  <!-- Bootstrap 5.3.3 CSS – local -->
  <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons 1.11.3 – local -->
  <link href="<?= $base_url; ?>assets/css/bootstrap-icons.min.css" rel="stylesheet">
  <!-- Fuentes de Google -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --incb-azul-oscuro: #0b2447;
      --incb-azul:        #14487a;
      --incb-dorado:      #c99a3c;
      --incb-gris:        #5b6b7d;
    }
    body { background-color: #f0f2f5; font-family: 'Inter', sans-serif; }
    h1, h5, .fw-brand { font-family: 'Poppins', sans-serif; }

    .page-header {
      background: linear-gradient(135deg, var(--incb-azul-oscuro) 0%, var(--incb-azul) 100%);
      border-radius: 16px;
      padding: 2rem 2rem;
      color: #fff;
      margin-bottom: 1.5rem;
    }
    .section-title {
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.7);
    }
    .img-card {
      border: none;
      border-radius: 14px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.07);
      background: #fff;
      transition: transform .18s, box-shadow .18s;
    }
    .img-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.12); }
    .img-preview-wrap {
      position: relative;
      background: #e8edf4;
      height: 180px;
      display: flex; align-items: center; justify-content: center;
      border-radius: 14px 14px 0 0;
      overflow: hidden;
    }
    .img-preview-wrap img {
      width: 100%; height: 100%; object-fit: contain; transition: transform 0.4s ease; padding: 5px;
    }
    .img-card:hover .img-preview-wrap img { transform: scale(1.04); }
    
    .file-badge {
      position: absolute; top: 0.5rem; right: 0.5rem;
      background: rgba(11,36,71,0.85); color: #fff; font-size: 0.65rem; font-weight: 600;
      padding: 0.2rem 0.6rem; border-radius: 20px;
    }
    .img-filename { font-size: 0.85rem; font-weight: 600; color: var(--incb-azul-oscuro); margin-bottom: 0.2rem; }
    .img-desc { font-size: 0.75rem; color: var(--incb-gris); margin-bottom: 0.8rem; }
    
    .custom-file-label {
      display: flex; align-items: center; gap: 0.5rem;
      border: 1.5px dashed #b8c8d9; border-radius: 0.6rem;
      padding: 0.4rem 0.6rem; font-size: 0.8rem; color: var(--incb-gris);
      cursor: pointer; background: #f8f9fb; margin-bottom: 0.5rem;
    }
    .custom-file-label:hover { border-color: var(--incb-dorado); background: #fffbf2; }
    .custom-file-label input[type="file"] { display: none; }
    
    .btn-subir {
      background: var(--incb-azul-oscuro); color: #fff; border: none;
      border-radius: 0.6rem; font-size: 0.8rem; font-weight: 600; padding: 0.4rem; width: 100%;
    }
    .btn-subir:hover { background: var(--incb-azul); color: #fff; }
  </style>
</head>
<body>

<?php include __DIR__ . '/../includes/navbar_admin.php'; ?>

<div class="container py-4">

  <!-- Header -->
  <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
      <div class="section-title mb-1">Panel de Administración</div>
      <h1 class="h3 fw-bold mb-1 text-white">
        <i class="bi bi-images me-2"></i>Gestor de Imágenes
      </h1>
      <p class="mb-0 text-white-50 small">Reemplaza las imágenes estáticas. Máximo 2MB (JPG, PNG, WEBP).</p>
    </div>
    <div>
      <a href="<?= $base_url; ?>admin.php" class="btn btn-outline-light rounded-3">
        <i class="bi bi-arrow-left me-1"></i>Volver a Mensajes
      </a>
    </div>
  </div>

  <!-- Mensajes de alerta -->
  <?php if (!empty($mensajes)): ?>
    <div class="mb-4">
      <?php foreach ($mensajes as $msg): ?>
        <div class="alert alert-<?= $msg['tipo']; ?> alert-dismissible fade show shadow-sm" role="alert">
          <?= $msg['texto']; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <!-- Cuadrícula de imágenes -->
  <div class="row g-3">
    <?php foreach ($imagenes_gestionables as $archivo => $descripcion): 
      $ruta_web   = $base_url . 'img/' . $archivo;
      $ruta_disco = $img_dir . $archivo;
      $existe      = file_exists($ruta_disco);
      $ext         = strtoupper(pathinfo($archivo, PATHINFO_EXTENSION));
      $id_input    = 'file_' . preg_replace('/[^a-z0-9]/i', '_', $archivo);
    ?>
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
      <div class="img-card h-100 d-flex flex-column">
        
        <div class="img-preview-wrap">
          <?php if ($existe): ?>
            <img src="<?= htmlspecialchars($ruta_web); ?>?v=<?php echo time(); ?>" alt="<?= htmlspecialchars($descripcion); ?>">
          <?php else: ?>
            <div class="text-secondary text-center"><i class="bi bi-image-slash fs-1"></i><br>Sin imagen</div>
          <?php endif; ?>
          <span class="file-badge"><?= $ext; ?></span>
        </div>

        <div class="card-body d-flex flex-column p-3 flex-grow-1">
          <p class="img-filename"><i class="bi bi-file-earmark-image text-primary me-1"></i><?= htmlspecialchars($archivo); ?></p>
          <p class="img-desc"><?= htmlspecialchars($descripcion); ?></p>

          <form method="POST" enctype="multipart/form-data" class="mt-auto">
            <input type="hidden" name="csrf_token" value="<?= function_exists('csrf_token') ? csrf_token() : ($_SESSION['csrf_token'] ?? ''); ?>">
            <input type="hidden" name="imagen_objetivo" value="<?= htmlspecialchars($archivo); ?>">
            
            <label class="custom-file-label w-100" for="<?= $id_input; ?>">
              <i class="bi bi-upload"></i> <span id="label_<?= $id_input; ?>" class="text-truncate">Elegir archivo...</span>
              <input type="file" id="<?= $id_input; ?>" name="nueva_imagen" accept=".jpg,.jpeg,.png,.webp" data-label="label_<?= $id_input; ?>" onchange="mostrarNombre(this)">
            </label>
            <button type="submit" class="btn-subir"><i class="bi bi-arrow-repeat me-1"></i> Reemplazar</button>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<!-- Footer (Idéntico al de admin.php) -->
<footer class="py-4 text-white mt-5" style="background: var(--incb-azul-oscuro);">
  <div class="container small">
    <div class="row">
      <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-2">
          <img src="<?= $base_url ?>img/logo_incb_formatoMejorado.png" alt="Logotipo INCB" height="35">
          <strong>Instituto Nacional de Ciudad Barrios (INCB)</strong>
        </div>
        <div class="text-white-50">
          &copy; <?= date('Y') ?> INCB. Todos los derechos reservados.<br>
          Creado por Daniel Sorto &nbsp;|&nbsp; Docente: Allan Romero
        </div>
      </div>
      <div class="col-md-5 text-md-end mt-3 mt-md-0">
        <a href="<?= $base_url; ?>index.php" class="me-3 text-white text-decoration-none">Inicio</a>
        <a href="<?= $base_url; ?>index.php#contacto" class="text-white text-decoration-none">Contacto</a>
      </div>
    </div>
  </div>
</footer>

<!-- JS local de Bootstrap -->
<script src="<?= $base_url; ?>assets/js/bootstrap.bundle.min.js"></script>
<script>
  function mostrarNombre(input) {
    const label = document.getElementById(input.dataset.label);
    if (label && input.files.length > 0) {
      label.textContent = input.files[0].name;
    }
  }
</script>
</body>
</html>
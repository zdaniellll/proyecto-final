<?php
/**
 * navbar_admin.php — Barra de navegación exclusiva del panel de administración.
 * Muestra el nombre del usuario con sesión activa y el botón de cerrar sesión.
 * Solo se incluye desde admin.php (zona protegida por auth.php).
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark border-bottom sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= app_url('index.php'); ?>" aria-label="Inicio INCB">
      <img src="<?= app_url('img/logo_incb_formatoMejorado.png'); ?>"
           alt="Logo INCB"
           height="42" width="42"
           style="object-fit: contain; display: block; border-radius: 10px; background: rgba(255,255,255,0.06);">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navAdmin"
            aria-controls="navAdmin" aria-expanded="false" aria-label="Abrir menú">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navAdmin" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <li class="nav-item"><a class="nav-link" href="<?= app_url('index.php'); ?>">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= app_url('index.php#nosotros'); ?>">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= app_url('index.php#oferta-academica'); ?>">Carreras</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= app_url('index.php#noticias'); ?>">Noticias</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= app_url('index.php#contacto'); ?>">Contacto</a></li>
        <!-- Enlace al módulo de gestión de imágenes -->
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1" href="<?= app_url('admin/imagenes.php'); ?>">
            <i class="bi bi-images"></i> Imágenes
          </a>
        </li>
        <li class="nav-item ms-lg-3 d-flex align-items-center gap-2">
        <!-- $_SESSION['usuario_admin'] se establece al iniciar sesión en login.php -->
          <span class="text-white-50 small">
            <i class="bi bi-person-circle me-1"></i>
            <?= htmlspecialchars($_SESSION['usuario_admin'] ?? 'Admin'); ?>
          </span>
          <a href="<?= app_url('logout.php'); ?>" class="btn btn-outline-light btn-sm">
            <i class="bi bi-box-arrow-right me-1"></i>Salir
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

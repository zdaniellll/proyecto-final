<?php
/**
 * navbar.php — Barra de navegación pública del portal INCB.
 * Se incluye desde header.php en todas las páginas del área pública.
 * Es "sticky-top": se queda fija en la parte superior al hacer scroll.
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark border-bottom sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $base_url; ?>index.php">
      <img src="<?= $base_url; ?>img/logo_incb.png" alt="Logo INCB" height="40">
    </a>
    <!-- Botón hamburguesa: solo visible en pantallas pequeñas (Bootstrap lo muestra/oculta) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"
            aria-controls="navMain" aria-expanded="false" aria-label="Abrir menú">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Contenedor colapsable del menú; en móvil se expande con el botón hamburguesa -->
    <div id="navMain" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <!-- Links con anclas (#id) para navegar directamente a cada sección de index.php -->
        <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>index.php">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>index.php#nosotros">Nosotros</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>index.php#oferta-academica">Oferta Académica</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>index.php#noticias">Noticias</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base_url; ?>index.php#contacto">Contacto</a></li>
        <!-- Botón de llamada a la acción (CTA) en color dorado institucional -->
        <li class="nav-item ms-lg-2">
          <a class="btn btn-sm rounded-pill px-3 fw-semibold" style="background: var(--incb-dorado); color: #1a1a1a;"
             href="<?= $base_url; ?>inscripcion.php">
            <i class="bi bi-ui-checks me-1"></i>Inscripción
          </a>
        </li>
        <!-- Ícono de engranaje: enlace discreto al panel de administración -->
        <li class="nav-item ms-lg-2">
          <a class="nav-link" href="<?= $base_url; ?>login.php" title="Panel de Administración">
            <i class="bi bi-gear-fill"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

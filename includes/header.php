<?php
// Config centraliza $base_url, sesión y credenciales; si algo ya la incluyó, no se repite.
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= htmlspecialchars($page_desc ?? 'Portal Institucional INCB'); ?>">
  <title><?= htmlspecialchars($page_title ?? 'INCB'); ?></title>

  <!-- Bootstrap 5.3.3 CSS – local (sin internet) -->
  <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons 1.11.3 – local (sin internet) -->
  <link rel="stylesheet" href="<?= $base_url; ?>assets/css/bootstrap-icons.min.css">

  <!-- Google Fonts – carga asíncrona (funciona offline con fallback del sistema) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
  <link rel="icon" type="image/png" href="<?= $base_url; ?>img/logo_incb_formatoMejorado.png">

  <style>
    /* ============================================================
       IDENTIDAD VISUAL INCB — paleta, tipografía y utilidades base
       ============================================================ */
    :root {
      --incb-azul-oscuro: #0b2447;   /* navbar / footer / textos fuertes */
      --incb-azul:        #14487a;   /* color primario institucional   */
      --incb-azul-claro:  #eaf1f8;   /* fondos suaves de sección       */
      --incb-dorado:      #c99a3c;   /* acento / detalles / hover      */
      --incb-gris:        #5b6b7d;   /* texto secundario                */
    }

    html { scroll-behavior: smooth; }
    body { font-family: 'Inter', system-ui, sans-serif; color: #2c3440; }
    h1, h2, h3, h4, h5, h6, .fw-brand { font-family: 'Poppins', 'Inter', sans-serif; }

    .incb-titulo { color: var(--incb-azul-oscuro) !important; font-weight: 700; }
    .incb-titulo::after {
      content: ""; display: block; width: 52px; height: 4px;
      background: var(--incb-dorado); border-radius: 2px; margin-top: 10px;
    }
    .text-center .incb-titulo::after { margin-left: auto; margin-right: auto; }

    .navbar { background: var(--incb-azul-oscuro) !important; }
    .navbar .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; }
    .navbar .nav-link:hover, .navbar .nav-link:focus { color: var(--incb-dorado) !important; }

    .btn-primary {
      background: var(--incb-azul); border-color: var(--incb-azul);
    }
    .btn-primary:hover, .btn-primary:focus {
      background: var(--incb-azul-oscuro); border-color: var(--incb-azul-oscuro);
    }
    .btn-outline-primary {
      color: var(--incb-azul); border-color: var(--incb-azul);
    }
    .btn-outline-primary:hover {
      background: var(--incb-azul); border-color: var(--incb-azul);
    }

    .bg-light { background-color: var(--incb-azul-claro) !important; }

    /* Evita que el navbar sticky tape el título al saltar a un ancla (#nosotros, #contacto, etc.) */
    section[id] { scroll-margin-top: 70px; }

    .hero-carousel .carousel-item { height: 70vh; min-height: 450px; background: #111; }
    .hero-carousel .carousel-item img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
    .hero-carousel .carousel-caption { left: 5%; right: 5%; }

    @media (max-width: 768px) {
      .hero-carousel .carousel-item { height: 60vh; min-height: 320px; }
      .hero-carousel .carousel-caption {
        display: block !important;   /* en escritorio se oculta con d-none d-md-block; en móvil sí se ve */
        bottom: 0.75rem;
        padding: 0.75rem 1rem !important;
      }
      .hero-carousel .carousel-caption h5 { font-size: 1rem; }
      .hero-carousel .carousel-caption p  { font-size: 0.8rem; margin-bottom: 0; }
      section[id] { scroll-margin-top: 58px; }
    }

    @media (max-width: 400px) {
      .hero-carousel .carousel-item { min-height: 260px; }
    }
  </style>
</head>
<body>

<?php require 'navbar.php'; ?>


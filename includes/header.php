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

    html {
      max-width: 100%;
      overflow-x: clip;
      scroll-behavior: smooth;
    }
    body {
      max-width: 100%;
      overflow-x: clip;
      font-family: 'Inter', system-ui, sans-serif;
      color: #2c3440;
    }
    img { max-width: 100%; }
    html.incb-font-large,
    body.incb-font-large {
      font-size: 1.20rem;
    }
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

    /* ============================================================
       HERO CAROUSEL — Full-screen, Premium, Responsive
       ============================================================ */

    /* Asegura que el carrusel ocupe toda la ventana */
    #inicio { margin: 0; padding: 0; overflow: hidden; position: relative; }

    .hero-carousel { width: 100%; overflow: hidden; position: relative; }

    .hero-carousel .carousel-inner,
    .hero-carousel .carousel-item {
      height: 100dvh;          /* usa dvh para móviles con barra dinámica */
      min-height: 500px;
      background: #0b2447;
    }

    /* Imagen de fondo */
    .hero-carousel .carousel-item img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center 30%;
      filter: brightness(0.55) saturate(1.1);
      transition: transform 8s ease;
    }
    .hero-carousel .carousel-item.active img {
      transform: scale(1.06);
    }

    /* Overlay degradado oscuro elegante */
    .hero-carousel .carousel-item::after {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(
        160deg,
        rgba(11,36,71,0.75) 0%,
        rgba(11,36,71,0.30) 55%,
        rgba(0,0,0,0.55) 100%
      );
      pointer-events: none;
    }

    /* Caption — centrada y elegante */
    .hero-carousel .carousel-caption {
      position: absolute;
      inset: 0;
      display: flex !important;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: clamp(1.5rem, 5vw, 5rem) clamp(1.5rem, 8vw, 9rem);
      text-align: left;
      z-index: 10;
      background: none !important;
    }

    /* Badge institucional */
    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      background: rgba(201,154,60,0.18);
      border: 1.5px solid var(--incb-dorado);
      color: var(--incb-dorado);
      font-size: 0.78rem;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      padding: 0.35rem 0.9rem;
      border-radius: 100px;
      margin-bottom: 1.2rem;
    }
    .hero-badge i { font-size: 0.9rem; }

    /* Título principal */
    .hero-carousel .carousel-caption .hero-title {
      font-family: 'Poppins', sans-serif;
      font-size: clamp(2rem, 5vw, 4rem);
      font-weight: 800;
      line-height: 1.12;
      color: #ffffff;
      text-shadow: 0 4px 24px rgba(0,0,0,0.45);
      margin-bottom: 1rem;
      max-width: min(750px, 100%);
    }

    /* Subtítulo */
    .hero-carousel .carousel-caption .hero-subtitle {
      font-family: 'Inter', sans-serif;
      font-size: clamp(0.95rem, 2vw, 1.25rem);
      font-weight: 400;
      color: rgba(255,255,255,0.85);
      line-height: 1.6;
      max-width: min(560px, 100%);
      margin-bottom: 2rem;
    }

    /* Botón CTA */
    .hero-cta {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--incb-dorado);
      color: #0b2447;
      font-family: 'Poppins', sans-serif;
      font-size: 0.9rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      padding: 0.75rem 1.75rem;
      border-radius: 100px;
      text-decoration: none;
      border: none;
      box-shadow: 0 8px 28px rgba(201,154,60,0.35);
      transition: background 0.25s, transform 0.2s, box-shadow 0.25s;
    }
    .hero-cta:hover {
      background: #e0b04a;
      color: #0b2447;
      transform: translateY(-2px);
      box-shadow: 0 12px 36px rgba(201,154,60,0.50);
    }
    .hero-cta i { font-size: 1rem; }

    /* Línea decorativa lateral */
    .hero-carousel .carousel-caption::before {
      content: '';
      position: absolute;
      left: clamp(1rem, 5vw, 5.5rem);
      top: 50%;
      transform: translateY(-50%);
      width: 4px;
      height: 120px;
      background: linear-gradient(to bottom, var(--incb-dorado), transparent);
      border-radius: 2px;
      opacity: 0.6;
    }

    /* Indicadores personalizados */
    .hero-carousel .carousel-indicators {
      bottom: 2rem;
      gap: 0.5rem;
      margin-bottom: 0;
    }
    .hero-carousel .carousel-indicators [data-bs-target] {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: rgba(255,255,255,0.45);
      border: 2px solid rgba(255,255,255,0.6);
      transition: background 0.3s, transform 0.3s;
      opacity: 1;
    }
    .hero-carousel .carousel-indicators [data-bs-target].active {
      background: var(--incb-dorado);
      border-color: var(--incb-dorado);
      transform: scale(1.3);
    }

    /* Botones prev/next elegantes */
    .hero-carousel .carousel-control-prev,
    .hero-carousel .carousel-control-next {
      width: 56px;
      height: 56px;
      top: 50%;
      transform: translateY(-50%);
      bottom: unset;
      background: rgba(255,255,255,0.12);
      border: 1.5px solid rgba(255,255,255,0.25);
      border-radius: 50%;
      backdrop-filter: blur(6px);
      margin: 0 1rem;
      opacity: 0;
      transition: opacity 0.3s, background 0.25s;
    }
    .hero-carousel:hover .carousel-control-prev,
    .hero-carousel:hover .carousel-control-next {
      opacity: 1;
    }
    .hero-carousel .carousel-control-prev:hover,
    .hero-carousel .carousel-control-next:hover {
      background: rgba(201,154,60,0.5);
      border-color: var(--incb-dorado);
    }
    .hero-carousel .carousel-control-prev-icon,
    .hero-carousel .carousel-control-next-icon {
      width: 20px;
      height: 20px;
    }

    /* Animación de entrada del caption */
    @keyframes heroSlideUp {
      from { opacity: 0; transform: translateY(32px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .hero-carousel .carousel-item.active .hero-badge,
    .hero-carousel .carousel-item.active .hero-title,
    .hero-carousel .carousel-item.active .hero-subtitle,
    .hero-carousel .carousel-item.active .hero-cta {
      animation: heroSlideUp 0.8s cubic-bezier(.22,.68,0,1.2) both;
    }
    .hero-carousel .carousel-item.active .hero-badge    { animation-delay: 0.15s; }
    .hero-carousel .carousel-item.active .hero-title    { animation-delay: 0.30s; }
    .hero-carousel .carousel-item.active .hero-subtitle { animation-delay: 0.45s; }
    .hero-carousel .carousel-item.active .hero-cta      { animation-delay: 0.60s; }

    /* RESPONSIVE — Tablet */
    @media (max-width: 991px) {
      .hero-carousel .carousel-caption::before { display: none; }
      .hero-carousel .carousel-caption {
        padding: clamp(1.2rem, 5vw, 3rem);
        align-items: flex-start;
      }
    }

    /* RESPONSIVE — Móvil */
    @media (max-width: 767.98px) {
      .hero-carousel .carousel-inner,
      .hero-carousel .carousel-item { min-height: max(450px, 70vh); }
      .hero-carousel .carousel-caption {
        padding: 1.5rem;
        justify-content: center;
        padding-top: 5rem;
        padding-bottom: 7rem;
        text-align: left;
      }
      .hero-carousel .carousel-caption .hero-title {
        font-size: clamp(1.5rem, 7vw, 1.9rem);
        margin-top: .5rem;
        margin-bottom: .5rem;
        max-width: 100%;
      }
      .hero-carousel .carousel-caption .hero-subtitle {
        font-size: clamp(0.88rem, 3.5vw, 1rem);
        max-width: 100%;
        margin-bottom: 1.25rem;
      }
      .hero-cta {
        font-size: 0.82rem;
        padding: 0.6rem 1.25rem;
        max-width: 100%;
        white-space: normal;
        word-break: break-word;
      }
      .hero-carousel .carousel-indicators { bottom: 1rem; }
      section[id] { scroll-margin-top: 58px; }
    }
  </style>
</head>
<body>

<?php require __DIR__ . '/navbar_offcanvas.php'; ?>


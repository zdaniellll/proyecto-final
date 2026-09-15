<?php
$current_page = basename($_SERVER['PHP_SELF']);

function navIsActive(string $page, string $current): string {
    return $page === $current ? 'active' : '';
}

function navAriaCurrent(string $page, string $current): string {
    return $page === $current ? ' aria-current="page"' : '';
}

$nav_links = [
    [$base_url . 'index.php', 'bi-house-door-fill', 'Inicio', 'index.php'],
    [$base_url . 'index.php#nosotros', 'bi-info-circle-fill', 'Nosotros', ''],
    [$base_url . 'index.php#noticias', 'bi-newspaper', 'Noticias', ''],
    [$base_url . 'index.php#contacto', 'bi-envelope-fill', 'Contacto', ''],
];
  $oferta_opciones = [
    ['tab-general', 'Bachillerato General', 'bi-mortarboard-fill'],
    ['tab-software', 'Desarrollo de Software', 'bi-code-slash'],
    ['tab-contable', 'Administrativo Contable', 'bi-calculator-fill'],
    ['tab-distancia', 'Bachillerato a Distancia', 'bi-laptop'],
  ];
?>

<div id="aviso-top" class="incb-aviso-bar w-100 text-center py-2 px-3">
  <span>
    <i class="bi bi-megaphone-fill me-1"></i>
    <strong>Aviso:</strong>
    Se informa a la comunidad educativa que la Rendición de Cuentas anual se realizará el próximo 20 de noviembre.
  </span>
</div>

<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark incb-navbar sticky-top shadow-sm" aria-label="Navegación principal">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $base_url; ?>index.php" aria-label="Ir al inicio — INCB">
      <img class="incb-brand-logo" src="<?= $base_url; ?>img/logo_incb.png" alt="Logo INCB" loading="eager">
    </a>

    <button class="navbar-toggler incb-toggler border-0"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#navOffcanvas"
            aria-controls="navOffcanvas"
            aria-expanded="false"
            aria-label="Abrir menú de navegación"
            id="navOffcanvasToggler">
      <span class="incb-toggler-bar"></span>
      <span class="incb-toggler-bar"></span>
      <span class="incb-toggler-bar"></span>
    </button>

    <div class="collapse navbar-collapse" id="navDesktopLinks">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-1">
        <?php foreach ($nav_links as [$href, $icon, $label, $page]): ?>
          <li class="nav-item">
            <a class="nav-link incb-nav-link <?= navIsActive($page, $current_page) ?>" href="<?= $href ?>"<?= navAriaCurrent($page, $current_page) ?>>
              <?= $label ?>
            </a>
          </li>
        <?php endforeach; ?>

        <li class="nav-item dropdown">
          <a class="nav-link incb-nav-link dropdown-toggle <?= navIsActive('oferta_academica.php', $current_page) ?>"
             href="<?= app_url('oferta_academica.php'); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Oferta Académica
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <?php foreach ($oferta_opciones as [$anchor, $label, $icon]): ?>
              <li>
                <a class="dropdown-item js-especialidad-link" href="<?= app_url('oferta_academica.php#' . $anchor); ?>">
                  <i class="bi <?= $icon ?> me-2"></i><?= htmlspecialchars($label) ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>

        <li class="nav-item ms-lg-2">
          <a class="btn btn-sm incb-btn-cta rounded-pill px-3 fw-semibold" href="<?= app_url('inscripcion.php'); ?>">
            <i class="bi bi-ui-checks me-1"></i>Inscripción
          </a>
        </li>

        <li class="nav-item ms-lg-1">
          <a class="nav-link incb-icon-link" href="<?= app_url('login.php'); ?>" title="Panel de Administración" aria-label="Acceder al panel de administración">
            <i class="bi bi-gear-fill"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="offcanvas offcanvas-start incb-offcanvas" tabindex="-1" id="navOffcanvas" aria-labelledby="navOffcanvasLabel">
  <div class="offcanvas-header incb-offcanvas-header">
    <div class="d-flex align-items-center gap-2">
      <img class="incb-offcanvas-logo" src="<?= $base_url; ?>img/logo_incb.png" alt="Logo INCB">
      <div>
        <h5 id="navOffcanvasLabel" class="offcanvas-title text-white mb-0">Menú</h5>
        <small class="text-white-50">INCB</small>
      </div>
    </div>
    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Cerrar menú"></button>
  </div>

  <div class="offcanvas-body incb-offcanvas-body d-flex flex-column p-0">
    <div class="incb-offcanvas-divider"></div>

    <nav aria-label="Menú móvil">
      <ul class="list-unstyled mb-0 incb-offcanvas-nav">
        <?php foreach ($nav_links as [$href, $icon, $label, $page]): ?>
          <li>
            <a class="incb-offcanvas-link d-flex align-items-center gap-3 <?= navIsActive($page, $current_page) ?>"
               href="<?= $href ?>"
               <?= navAriaCurrent($page, $current_page) ?>
               aria-label="Ir a <?= htmlspecialchars($label) ?>">
              <span class="incb-offcanvas-icon"><i class="bi <?= $icon ?>"></i></span>
              <span><?= htmlspecialchars($label) ?></span>
              <i class="bi bi-chevron-right ms-auto incb-offcanvas-arrow"></i>
            </a>
          </li>
        <?php endforeach; ?>
        <li>
          <div class="incb-offcanvas-section-label px-4 pt-3">Oferta Académica</div>
          <?php foreach ($oferta_opciones as [$anchor, $label, $icon]): ?>
            <a class="incb-offcanvas-link d-flex align-items-center gap-3 js-especialidad-link"
               href="<?= app_url('oferta_academica.php#' . $anchor); ?>">
              <span class="incb-offcanvas-icon"><i class="bi <?= $icon ?>"></i></span>
              <span><?= htmlspecialchars($label) ?></span>
              <i class="bi bi-chevron-right ms-auto incb-offcanvas-arrow"></i>
            </a>
          <?php endforeach; ?>
        </li>
      </ul>
    </nav>

    <div class="incb-offcanvas-divider mt-2"></div>

    <div class="px-4 py-3">
      <p class="incb-offcanvas-section-label">Acciones rápidas</p>
      <div class="d-grid gap-2">
        <a class="btn incb-btn-cta fw-semibold" href="<?= app_url('inscripcion.php'); ?>">
          <i class="bi bi-ui-checks me-2"></i>Inscríbete ahora
        </a>

        <a class="btn incb-btn-admin fw-semibold" href="<?= app_url('login.php'); ?>">
          <i class="bi bi-gear-fill me-2"></i>Panel Administrativo
        </a>
      </div>
    </div>

    <div class="mt-auto px-4 py-3 incb-offcanvas-footer">
      <p class="mb-1 small"><i class="bi bi-geo-alt-fill me-1"></i>Ciudad Barrios, San Miguel, El Salvador</p>
      <p class="mb-0 small"><i class="bi bi-telephone-fill me-1"></i>(503) 2664-0000</p>
    </div>
  </div>
</div>

<style>
  :root {
    --incb-azul-oscuro: #0b2447;
    --incb-azul: #14487a;
    --incb-dorado: #c99a3c;
    --incb-dorado-hover: #e0b04a;
    --incb-gris-suave: rgba(255,255,255,.08);
  }

  .incb-aviso-bar {
    background: #d6ecf3;
    color: #1a1a1a;
    font-size: .9rem;
    line-height: 1.4;
    border-bottom: 1px solid #b0d5e8;
  }

  .incb-navbar {
    background: var(--incb-azul-oscuro) !important;
    min-height: 56px;
    transition: box-shadow .3s ease;
  }

  .incb-brand-logo {
    display: block;
    width: auto;
    height: 38px;
    object-fit: contain;
  }

  .incb-offcanvas-logo {
    display: block;
    width: auto;
    height: 46px;
    object-fit: contain;
  }

  .incb-navbar.scrolled {
    box-shadow: 0 4px 24px rgba(0,0,0,.35) !important;
  }

  .incb-nav-link {
    color: rgba(255,255,255,.82) !important;
    font-weight: 500;
    font-size: .93rem;
    padding: .45rem .7rem !important;
    border-radius: .4rem;
    position: relative;
  }

  .incb-nav-link::after {
    content: '';
    position: absolute;
    bottom: 2px;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 70%;
    height: 2px;
    background: var(--incb-dorado);
    border-radius: 2px;
    transition: transform .25s ease;
  }

  .incb-nav-link:hover,
  .incb-nav-link.active {
    color: #fff !important;
    background: var(--incb-gris-suave);
  }

  .incb-nav-link:hover::after,
  .incb-nav-link.active::after {
    transform: translateX(-50%) scaleX(1);
  }

  .incb-icon-link {
    color: rgba(255,255,255,.6) !important;
    transition: color .2s ease, transform .2s ease;
    font-size: 1.1rem;
  }

  .incb-icon-link:hover {
    color: var(--incb-dorado) !important;
    transform: rotate(30deg);
  }

  .incb-btn-cta {
    background: var(--incb-dorado);
    color: #0b2447 !important;
    border: none;
    transition: background .22s ease, transform .18s ease, box-shadow .22s ease;
    box-shadow: 0 4px 14px rgba(201,154,60,.3);
  }

  .incb-btn-cta:hover {
    background: var(--incb-dorado-hover);
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(201,154,60,.45);
  }

  .incb-toggler {
    padding: .4rem .5rem;
    display: flex;
    flex-direction: column;
    gap: 5px;
    cursor: pointer;
    background: transparent;
  }

  .incb-toggler-bar {
    display: block;
    width: 24px;
    height: 2px;
    background: #fff;
    border-radius: 2px;
    transition: transform .3s ease, opacity .3s ease;
    transform-origin: center;
  }

  .incb-toggler[aria-expanded="true"] .incb-toggler-bar:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
  }

  .incb-toggler[aria-expanded="true"] .incb-toggler-bar:nth-child(2) {
    opacity: 0;
    transform: scaleX(0);
  }

  .incb-toggler[aria-expanded="true"] .incb-toggler-bar:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
  }

  .incb-offcanvas {
    width: min(320px, 85vw) !important;
    max-width: 100%;
    background: var(--incb-azul-oscuro) !important;
    border-right: 1px solid rgba(255,255,255,.08) !important;
  }

  .incb-offcanvas-header {
    background: linear-gradient(135deg, #0b2447, #14487a);
    padding: 1.1rem 1.25rem;
    border-bottom: 2px solid var(--incb-dorado);
  }

  .incb-offcanvas-divider {
    height: 1px;
    background: linear-gradient(90deg, var(--incb-dorado), transparent);
    opacity: .35;
    margin: .25rem 1rem;
  }

  .incb-offcanvas-nav {
    padding: .5rem 0;
  }

  .incb-offcanvas-link {
    color: rgba(255,255,255,.82);
    text-decoration: none;
    padding: .85rem 1.25rem;
    font-size: .95rem;
    font-weight: 500;
    transition: background .2s ease, color .2s ease, padding-left .2s ease;
    border-left: 3px solid transparent;
  }

  .incb-offcanvas-link:hover,
  .incb-offcanvas-link.active {
    background: rgba(255,255,255,.07);
    color: #fff;
    padding-left: 1.6rem;
    border-left-color: var(--incb-dorado);
  }

  .incb-offcanvas-link.active {
    color: var(--incb-dorado);
  }

  .incb-offcanvas-icon {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(201,154,60,.12);
    border-radius: .4rem;
    color: var(--incb-dorado);
    font-size: 1rem;
    flex-shrink: 0;
  }

  .incb-offcanvas-link:hover .incb-offcanvas-icon,
  .incb-offcanvas-link.active .incb-offcanvas-icon {
    background: rgba(201,154,60,.25);
  }

  .incb-offcanvas-arrow {
    color: rgba(255,255,255,.25);
    font-size: .78rem;
    transition: transform .2s ease, color .2s ease;
  }

  .incb-offcanvas-link:hover .incb-offcanvas-arrow {
    transform: translateX(4px);
    color: rgba(255,255,255,.5);
  }

  .incb-offcanvas-section-label {
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    color: rgba(255,255,255,.35);
    margin-bottom: .6rem;
  }

  .incb-btn-admin {
    background: rgba(255,255,255,.08);
    color: rgba(255,255,255,.75) !important;
    border: 1px solid rgba(255,255,255,.15);
    transition: background .2s ease, color .2s ease;
  }

  .incb-btn-admin:hover {
    background: rgba(255,255,255,.14);
    color: #fff !important;
  }

  .incb-offcanvas-footer {
    border-top: 1px solid rgba(255,255,255,.08);
    color: rgba(255,255,255,.45);
    font-size: .8rem;
  }

  body.offcanvas-backdrop-visible {
    overflow: hidden;
  }

  .offcanvas-backdrop {
    background: rgba(0,0,0,.6) !important;
    backdrop-filter: blur(3px);
  }

  section[id] {
    scroll-margin-top: 72px;
  }

  @media (max-width: 576px) {
    .incb-aviso-bar {
      font-size: .78rem;
    }

    section[id] {
      scroll-margin-top: 60px;
    }
  }
</style>

<script>
(function () {
  'use strict';

  function initNavbarOffcanvas() {
    var navbar = document.getElementById('mainNavbar');
    if (navbar) {
      var onScroll = function () {
        navbar.classList.toggle('scrolled', window.scrollY > 10);
      };
      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();
    }

    var offcanvasEl = document.getElementById('navOffcanvas');
    var toggler = document.getElementById('navOffcanvasToggler');

    if (offcanvasEl && toggler) {
      offcanvasEl.addEventListener('show.bs.offcanvas', function () {
        toggler.setAttribute('aria-expanded', 'true');
      });

      offcanvasEl.addEventListener('hide.bs.offcanvas', function () {
        toggler.setAttribute('aria-expanded', 'false');
      });
    }

    document.querySelectorAll('#navOffcanvas a[href]').forEach(function (link) {
      link.addEventListener('click', function () {
        var offcanvasInstance = bootstrap.Offcanvas.getInstance(offcanvasEl);
        if (offcanvasInstance) {
          offcanvasInstance.hide();
        }
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNavbarOffcanvas);
  } else {
    initNavbarOffcanvas();
  }
})();
</script>

<?php
// --- Datos de cada slide del carrusel ---------------------------------------
// Cada elemento define imágenes por dispositivo, texto del caption y enlace CTA.
// Agrega o quita elementos del array para cambiar los slides.

$slides = [
  [
    'img_mobile'  => $base_url . 'img/fachada_mobile.jpg',   // ≤ 767 px
    'img_tablet'  => $base_url . 'img/fachada_tablet.jpg',   // 768–991 px
    'img_desktop' => $base_url . 'img/fachada.jpg',          // ≥ 992 px
    'alt'         => 'Fachada del INCB',
    'badge_icon'  => 'bi-award-fill',
    'badge_text'  => 'Excelencia Académica',
    'titulo'      => 'Instituto Nacional<br>de Ciudad Barrios',
    'subtitulo'   => 'Formando líderes del futuro con valores, ciencia y tradición desde 1978.',
    'cta_href'    => '#nosotros',
    'cta_icon'    => 'bi-arrow-down-circle',
    'cta_texto'   => 'Conoce más',
    'interval'    => 6000,
  ],
  [
    'img_mobile'  => $base_url . 'img/banda_mobile.jpg',
    'img_tablet'  => $base_url . 'img/banda_tablet.jpg',
    'img_desktop' => $base_url . 'img/banda.jpg',
    'alt'         => 'Banda musical INCB',
    'badge_icon'  => 'bi-music-note-beamed',
    'badge_text'  => 'Cultura &amp; Arte',
    'titulo'      => 'Inscribe tu pasión,<br>forja tu futuro',
    'subtitulo'   => 'Únete a nuestra destacada banda musical y descubre el poder de la expresión artística.',
    'cta_href'    => '#oferta-academica',
    'cta_icon'    => 'bi-mortarboard',
    'cta_texto'   => 'Ver oferta académica',
    'interval'    => 6000,
  ],
  [
    'img_mobile'  => $base_url . 'img/danza_mobile.jpg',
    'img_tablet'  => $base_url . 'img/danza_tablet.jpg',
    'img_desktop' => $base_url . 'img/danza.jpg',
    'alt'         => 'Danza folclórica INCB',
    'badge_icon'  => 'bi-globe-americas',
    'badge_text'  => 'Identidad &amp; Tradición',
    'titulo'      => 'Danza y tradición<br>que nos une',
    'subtitulo'   => 'Rescatamos y celebramos nuestra identidad cultural a través de la danza folclórica salvadoreña.',
    'cta_href'    => '#inscripcion',
    'cta_icon'    => 'bi-pencil-square',
    'cta_texto'   => 'Inscríbete ahora',
    'interval'    => 6000,
  ],
];
?>

<style>
  /* ── Variables de marca ── */
  :root {
    --incb-azul-oscuro : #0b2447;
    --incb-azul        : #14487a;
    --incb-dorado      : #c99a3c;
  }

  html { scroll-behavior: smooth; }
  body { margin: 0; font-family: 'Inter', system-ui, sans-serif; }

  /* ── Contenedor del hero: evita desbordamiento lateral ── */
  #carrusel-responsivo-wrapper {
    overflow: hidden;
    position: relative;
  }

  /* ── Altura del carrusel: ocupa toda la ventana ── */
  .rc-carousel .carousel-inner,
  .rc-carousel .carousel-item {
    height: 100dvh;    /* dvh = viewport dinámico (barra del móvil incluida) */
    min-height: 500px;
    background: var(--incb-azul-oscuro);
  }

  /* ── Imagen: ocupa el slide como fondo, recortada proporcionalmente ── */
  .rc-carousel .carousel-item picture,
  .rc-carousel .carousel-item picture img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
  }
  .rc-carousel .carousel-item picture img {
    object-fit: cover;
    object-position: center 30%;
    filter: brightness(0.52) saturate(1.1);
    transition: transform 8s ease;
  }
  /* Zoom-in suave en el slide activo (se resetea al cambiar) */
  .rc-carousel .carousel-item.active picture img {
    transform: scale(1.05);
  }

  /* ── Overlay degradado oscuro sobre la imagen ── */
  .rc-carousel .carousel-item::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
      155deg,
      rgba(11,36,71,.78) 0%,
      rgba(11,36,71,.28) 55%,
      rgba(0,0,0,.55)   100%
    );
    pointer-events: none;
    z-index: 1;
  }

  /* ── Caption: texto centrado verticalmente, alineado a la izquierda ── */
  .rc-carousel .carousel-caption {
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

  /* Línea decorativa lateral (solo en desktop) */
  .rc-carousel .carousel-caption::before {
    content: '';
    position: absolute;
    left: clamp(1rem, 5vw, 5.5rem);
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 110px;
    background: linear-gradient(to bottom, var(--incb-dorado), transparent);
    border-radius: 2px;
    opacity: .6;
  }

  /* ── Badge ── */
  .rc-badge {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    background: rgba(201,154,60,.18);
    border: 1.5px solid var(--incb-dorado);
    color: var(--incb-dorado);
    font-size: .78rem;
    font-weight: 600;
    letter-spacing: .12em;
    text-transform: uppercase;
    padding: .35rem .9rem;
    border-radius: 100px;
    margin-bottom: 1.1rem;
  }

  /* ── Título principal ── */
  .rc-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 5vw, 4rem);
    font-weight: 800;
    line-height: 1.12;
    color: #fff;
    text-shadow: 0 4px 24px rgba(0,0,0,.45);
    margin-bottom: 1rem;
    max-width: min(750px, 100%);
  }

  /* ── Subtítulo ── */
  .rc-subtitle {
    font-size: clamp(.95rem, 2vw, 1.2rem);
    color: rgba(255,255,255,.85);
    line-height: 1.6;
    max-width: min(540px, 100%);
    margin-bottom: 2rem;
  }

  /* ── Botón CTA ── */
  .rc-cta {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    background: var(--incb-dorado);
    color: var(--incb-azul-oscuro);
    font-family: 'Poppins', sans-serif;
    font-size: .9rem;
    font-weight: 700;
    padding: .72rem 1.7rem;
    border-radius: 100px;
    text-decoration: none;
    box-shadow: 0 8px 28px rgba(201,154,60,.35);
    transition: background .25s, transform .2s, box-shadow .25s;
    white-space: normal;
    word-break: break-word;
  }
  .rc-cta:hover {
    background: #e0b04a;
    color: var(--incb-azul-oscuro);
    transform: translateY(-2px);
    box-shadow: 0 12px 36px rgba(201,154,60,.5);
  }

  /* ── Indicadores de posición (puntos abajo) ── */
  .rc-carousel .carousel-indicators { bottom: 1.5rem; gap: .5rem; margin-bottom: 0; }
  .rc-carousel .carousel-indicators [data-bs-target] {
    width: 10px; height: 10px;
    border-radius: 50%;
    background: rgba(255,255,255,.45);
    border: 2px solid rgba(255,255,255,.6);
    transition: background .3s, transform .3s;
    opacity: 1;
  }
  .rc-carousel .carousel-indicators [data-bs-target].active {
    background: var(--incb-dorado);
    border-color: var(--incb-dorado);
    transform: scale(1.3);
  }

  /* ── Botones prev/next (aparecen al pasar el mouse) ── */
  .rc-carousel .carousel-control-prev,
  .rc-carousel .carousel-control-next {
    width: 52px; height: 52px;
    top: 50%; transform: translateY(-50%);
    bottom: unset;
    background: rgba(255,255,255,.12);
    border: 1.5px solid rgba(255,255,255,.25);
    border-radius: 50%;
    backdrop-filter: blur(6px);
    margin: 0 1rem;
    opacity: 0;
    transition: opacity .3s, background .25s;
  }
  .rc-carousel:hover .carousel-control-prev,
  .rc-carousel:hover .carousel-control-next { opacity: 1; }
  .rc-carousel .carousel-control-prev:hover,
  .rc-carousel .carousel-control-next:hover {
    background: rgba(201,154,60,.5);
    border-color: var(--incb-dorado);
  }

  /* ── Animación de entrada del caption al cambiar slide ── */
  @keyframes rcSlideUp {
    from { opacity: 0; transform: translateY(28px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .rc-carousel .carousel-item.active .rc-badge,
  .rc-carousel .carousel-item.active .rc-title,
  .rc-carousel .carousel-item.active .rc-subtitle,
  .rc-carousel .carousel-item.active .rc-cta {
    animation: rcSlideUp .8s cubic-bezier(.22,.68,0,1.2) both;
  }
  /* Retrasos escalonados para que cada elemento entre uno tras otro */
  .rc-carousel .carousel-item.active .rc-badge    { animation-delay: .15s; }
  .rc-carousel .carousel-item.active .rc-title    { animation-delay: .30s; }
  .rc-carousel .carousel-item.active .rc-subtitle { animation-delay: .45s; }
  .rc-carousel .carousel-item.active .rc-cta      { animation-delay: .60s; }

  /* ── Responsive: Tablet ── */
  @media (max-width: 991px) {
    .rc-carousel .carousel-caption::before { display: none; }
    .rc-carousel .carousel-caption { padding: clamp(1.2rem, 5vw, 3rem); }
  }

  /* ── Responsive: Móvil ── */
  @media (max-width: 576px) {
    .rc-carousel .carousel-inner,
    .rc-carousel .carousel-item { min-height: 480px; }
    .rc-carousel .carousel-caption {
      padding: 1.5rem;
      padding-top: 5rem;
      padding-bottom: 5rem;
      justify-content: center;
      text-align: left;
    }
    .rc-title    { font-size: clamp(1.6rem, 7vw, 2.4rem); max-width: 100%; }
    .rc-subtitle { font-size: clamp(.88rem, 3.5vw, 1rem); max-width: 100%; margin-bottom: 1.25rem; }
    .rc-cta      { font-size: .82rem; padding: .6rem 1.25rem; }
    .rc-carousel .carousel-indicators { bottom: 1rem; }
    .rc-carousel .carousel-control-prev,
    .rc-carousel .carousel-control-next { opacity: .8; width: 40px; height: 40px; margin: 0 .4rem; }
  }
</style>

<!-- ── Carrusel ────────────────────────────────────────────────────────────
     Usa <picture> + <source media="..."> para servir imágenes distintas
     según el ancho de pantalla (móvil / tablet / desktop) sin JavaScript.
     El navegador elige la primera <source> cuya media query coincida. -->
<section id="inicio" style="margin:0;padding:0;overflow:hidden;position:relative;">
  <div id="rcCarousel"
       class="carousel slide carousel-fade rc-carousel"
       data-bs-ride="carousel"
       data-bs-pause="false">

    <!-- ── Indicadores (puntos de navegación) ── -->
    <div class="carousel-indicators">
      <?php foreach ($slides as $i => $slide): ?>
        <button type="button"
                data-bs-target="#rcCarousel"
                data-bs-slide-to="<?= $i ?>"
                <?= $i === 0 ? 'class="active" aria-current="true"' : '' ?>
                aria-label="Diapositiva <?= $i + 1 ?>"></button>
      <?php endforeach; ?>
    </div>

    <!-- ── Slides ── -->
    <div class="carousel-inner">
      <?php foreach ($slides as $i => $slide): ?>
        <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>"
             data-bs-interval="<?= (int) $slide['interval'] ?>">

          <!-- <picture>: el navegador selecciona automáticamente la imagen correcta.
               Orden: móvil primero (más restrictivo), luego tablet, luego desktop (fallback). -->
          <picture>
            <source media="(max-width: 767px)"  srcset="<?= htmlspecialchars($slide['img_mobile']) ?>">
            <source media="(max-width: 991px)"  srcset="<?= htmlspecialchars($slide['img_tablet']) ?>">
            <img    src="<?= htmlspecialchars($slide['img_desktop']) ?>"
                    alt="<?= htmlspecialchars($slide['alt']) ?>">
          </picture>

          <!-- Texto del slide -->
          <div class="carousel-caption">
            <span class="rc-badge">
              <i class="bi <?= $slide['badge_icon'] ?>"></i>
              <?= $slide['badge_text'] ?>
            </span>
            <h2 class="rc-title"><?= $slide['titulo'] ?></h2>
            <p class="rc-subtitle"><?= $slide['subtitulo'] ?></p>
            <a href="<?= htmlspecialchars($slide['cta_href']) ?>" class="rc-cta">
              <i class="bi <?= $slide['cta_icon'] ?>"></i>
              <?= htmlspecialchars($slide['cta_texto']) ?>
            </a>
          </div>

        </div>
      <?php endforeach; ?>
    </div>

    <!-- ── Controles prev / next ── -->
    <button class="carousel-control-prev" type="button"
            data-bs-target="#rcCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button"
            data-bs-target="#rcCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>

  </div>
</section>

<script>
  // ── Re-dispara animaciones del caption al cambiar de slide ──
  (function () {
    var carousel = document.getElementById('rcCarousel');
    if (!carousel) return;

    // Al iniciar la transición, espera a que termine para re-animar
    carousel.addEventListener('slide.bs.carousel', function () {
      carousel.addEventListener('slid.bs.carousel', function handler() {
        var active = carousel.querySelector('.carousel-item.active');
        if (active) {
          // Fuerza reflow para que los keyframes vuelvan a ejecutarse
          ['.rc-badge', '.rc-title', '.rc-subtitle', '.rc-cta'].forEach(function (sel) {
            var el = active.querySelector(sel);
            if (!el) return;
            el.style.animation = 'none';
            el.offsetHeight; // reflow
            el.style.animation = '';
          });
        }
        carousel.removeEventListener('slid.bs.carousel', handler);
      });
    });

    // Aplica zoom-in a la imagen del slide activo; resetea las demás
    carousel.addEventListener('slid.bs.carousel', function () {
      carousel.querySelectorAll('.carousel-item picture img').forEach(function (img) {
        img.style.transform = '';
      });
      var activeImg = carousel.querySelector('.carousel-item.active picture img');
      if (activeImg) activeImg.style.transform = 'scale(1.05)';
    });
  })();
</script>

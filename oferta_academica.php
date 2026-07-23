<?php
$page_title = 'Oferta Académica | INCB';
$page_desc  = 'Conoce en detalle los bachilleratos que ofrece el Instituto Nacional de Ciudad Barrios (INCB): duración, plan de estudios, perfil de egreso y requisitos.';
require 'includes/header.php';
?>

<style>
  .oa-eyebrow {
    color: var(--incb-dorado, #b3922a); font-size: .78rem; font-weight: 600;
    letter-spacing: 2px; text-transform: uppercase;
  }
  .oa-hero-rule { width: 64px; height: 3px; background: var(--incb-dorado, #b3922a); margin: 1rem auto 0; }

  .programa-icon {
    width: 52px; height: 52px;
    display: flex; align-items: center; justify-content: center;
    border-radius: .35rem;
    background: #fff;
    border: 1px solid var(--incb-azul);
    color: var(--incb-azul);
    font-size: 1.4rem;
    flex-shrink: 0;
  }
  .toc-link {
    display: flex; align-items: center; gap: .5rem;
    padding: 0.55rem 0.85rem;
    border-left: 3px solid transparent;
    color: #495057;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: border-color .15s, color .15s, background .15s;
  }
  .toc-link:hover, .toc-link.active {
    background: #f7f8fa;
    border-left-color: var(--incb-azul);
    color: var(--incb-azul-oscuro);
  }
  .programa-detalle { scroll-margin-top: 90px; border-radius: .375rem !important; }
  .programa-detalle .badge { font-weight: 500; }
  .lista-check li {
    display: flex; align-items: flex-start; gap: 0.6rem;
    margin-bottom: 0.55rem; color: #444;
  }
  .lista-check i { color: var(--incb-azul); margin-top: 3px; flex-shrink: 0; }
  .oa-panel-header {
    border-bottom: 1px solid #eef0f3; padding-bottom: 1rem; margin-bottom: 1.25rem;
  }
</style>

<!-- Encabezado de la página -->
<section class="py-5" style="background: var(--incb-azul-oscuro); color: #fff;">
  <div class="container text-center">
    <div class="oa-eyebrow">Instituto Nacional de Ciudad Barrios</div>
    <h1 class="fw-brand fw-bold display-6 mt-1">Oferta Académica</h1>
    <p class="mb-0" style="color: rgba(255,255,255,.8);">Todo lo que necesitas saber antes de inscribirte para el ciclo 2026</p>
    <div class="oa-hero-rule"></div>
  </div>
</section>

<div class="container py-5">
  <div class="row g-4 g-lg-5">

    <!-- Índice / navegación lateral -->
    <div class="col-lg-3">
      <div class="sticky-top" style="top: 90px;">
        <div class="border rounded-3 bg-white" style="border-radius: .375rem !important;">
          <div class="text-uppercase small fw-bold text-secondary px-3 py-3 border-bottom" style="letter-spacing: 1px;">Bachilleratos</div>
          <nav id="toc-programas" class="py-2">
            <a class="toc-link" href="#general"><i class="bi bi-mortarboard-fill"></i>Bachillerato General</a>
            <a class="toc-link" href="#software"><i class="bi bi-code-slash"></i>Desarrollo de Software</a>
            <a class="toc-link" href="#contable"><i class="bi bi-calculator-fill"></i>Administrativo Contable</a>
            <a class="toc-link" href="#distancia"><i class="bi bi-laptop"></i>Bachillerato a Distancia</a>
          </nav>
        </div>
        <a href="<?= $base_url; ?>inscripcion.php" class="btn w-100 mt-3" style="background: var(--incb-azul-oscuro); border-color: var(--incb-azul-oscuro); color:#fff; border-radius:.3rem; font-weight:600;">
          <i class="bi bi-send-fill me-2"></i>Inscripción
        </a>
      </div>
    </div>

    <!-- Detalle de programas -->
    <div class="col-lg-9">

      <!-- Bachillerato General -->
      <div id="general" class="programa-detalle p-4 p-md-5 border rounded-3 mb-4 bg-white">
        <div class="d-flex align-items-center gap-3 oa-panel-header">
          <div class="programa-icon"><i class="bi bi-mortarboard-fill"></i></div>
          <div>
            <h2 class="h4 fw-bold mb-1">Bachillerato General</h2>
            <span class="badge text-bg-light border" style="border-radius:.25rem; font-weight:500;">Duración: 2 años</span>
          </div>
        </div>
        <p class="text-muted">
          Formación integral con énfasis humanístico y científico, pensada para quienes buscan una base
          académica sólida antes de continuar estudios universitarios en cualquier área.
        </p>
        <div class="row g-4 mt-2">
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Plan de estudios incluye</h3>
            <ul class="list-unstyled lista-check">
              <li><i class="bi bi-check-circle-fill"></i>Matemática, Física y Ciencias Naturales</li>
              <li><i class="bi bi-check-circle-fill"></i>Lenguaje y Literatura</li>
              <li><i class="bi bi-check-circle-fill"></i>Ciencias Sociales y Cívica</li>
              <li><i class="bi bi-check-circle-fill"></i>Inglés técnico</li>
              <li><i class="bi bi-check-circle-fill"></i>Orientación para la Vida</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Perfil de egreso</h3>
            <p class="text-muted small mb-0">
              Egresas con las bases necesarias para continuar cualquier carrera universitaria,
              con pensamiento crítico, hábitos de estudio y valores ciudadanos consolidados.
            </p>
          </div>
        </div>
      </div>

      <!-- Desarrollo de Software -->
      <div id="software" class="programa-detalle p-4 p-md-5 border rounded-3 mb-4 bg-white">
        <div class="d-flex align-items-center gap-3 oa-panel-header">
          <div class="programa-icon"><i class="bi bi-code-slash"></i></div>
          <div>
            <h2 class="h4 fw-bold mb-1">Bachillerato en Desarrollo de Software</h2>
            <span class="badge text-bg-light border" style="border-radius:.25rem; font-weight:500;">Duración: 3 años</span>
            <span class="badge ms-1" style="border-radius:.25rem; font-weight:500; background: var(--incb-dorado, #b3922a); color:#fff;">Alta demanda</span>
          </div>
        </div>
        <p class="text-muted">
          Formación técnica en lógica de programación, bases de datos y desarrollo de sistemas,
          orientada a que el estudiante egrese con habilidades reales para trabajar o emprender en tecnología.
        </p>
        <div class="row g-4 mt-2">
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Plan de estudios incluye</h3>
            <ul class="list-unstyled lista-check">
              <li><i class="bi bi-check-circle-fill"></i>Lógica de programación y algoritmos</li>
              <li><i class="bi bi-check-circle-fill"></i>Programación web (HTML, CSS, PHP, JS)</li>
              <li><i class="bi bi-check-circle-fill"></i>Bases de datos (MySQL)</li>
              <li><i class="bi bi-check-circle-fill"></i>Redes y mantenimiento de equipo</li>
              <li><i class="bi bi-check-circle-fill"></i>Proyecto final / pasantía técnica</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Perfil de egreso</h3>
            <p class="text-muted small mb-0">
              Egresas con la capacidad de diseñar, programar y dar mantenimiento a sistemas
              y páginas web básicas, con bases sólidas para continuar estudios en Ingeniería o
              Licenciatura en Computación.
            </p>
          </div>
        </div>
      </div>

      <!-- Administrativo Contable -->
      <div id="contable" class="programa-detalle p-4 p-md-5 border rounded-3 mb-4 bg-white">
        <div class="d-flex align-items-center gap-3 oa-panel-header">
          <div class="programa-icon"><i class="bi bi-calculator-fill"></i></div>
          <div>
            <h2 class="h4 fw-bold mb-1">Bachillerato Administrativo Contable</h2>
            <span class="badge text-bg-light border" style="border-radius:.25rem; font-weight:500;">Duración: 3 años</span>
          </div>
        </div>
        <p class="text-muted">
          Prepara al estudiante en gestión financiera, contabilidad y administración de empresas,
          con una fuerte orientación práctica hacia el mundo laboral y el emprendimiento.
        </p>
        <div class="row g-4 mt-2">
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Plan de estudios incluye</h3>
            <ul class="list-unstyled lista-check">
              <li><i class="bi bi-check-circle-fill"></i>Contabilidad general y de costos</li>
              <li><i class="bi bi-check-circle-fill"></i>Legislación tributaria y mercantil</li>
              <li><i class="bi bi-check-circle-fill"></i>Administración de empresas</li>
              <li><i class="bi bi-check-circle-fill"></i>Ofimática (Excel, Word aplicado a negocios)</li>
              <li><i class="bi bi-check-circle-fill"></i>Prácticas administrativas</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Perfil de egreso</h3>
            <p class="text-muted small mb-0">
              Egresas con capacidad para llevar la contabilidad de una pequeña empresa,
              apoyar áreas administrativas y financieras, o continuar estudios en Contaduría,
              Administración de Empresas o carreras afines.
            </p>
          </div>
        </div>
      </div>

      <!-- Bachillerato a Distancia -->
      <div id="distancia" class="programa-detalle p-4 p-md-5 border rounded-3 mb-2 bg-white">
        <div class="d-flex align-items-center gap-3 oa-panel-header">
          <div class="programa-icon"><i class="bi bi-laptop"></i></div>
          <div>
            <h2 class="h4 fw-bold mb-1">Bachillerato a Distancia</h2>
            <span class="badge text-bg-light border" style="border-radius:.25rem; font-weight:500;">Modalidad flexible</span>
          </div>
        </div>
        <p class="text-muted">
          Pensado para estudiantes que trabajan, viven lejos o necesitan compatibilizar sus estudios
          con otras responsabilidades. Combina sesiones virtuales con encuentros presenciales periódicos.
        </p>
        <div class="row g-4 mt-2">
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Cómo funciona</h3>
            <ul class="list-unstyled lista-check">
              <li><i class="bi bi-check-circle-fill"></i>Clases y materiales a través del aula virtual</li>
              <li><i class="bi bi-check-circle-fill"></i>Encuentros presenciales de tutoría y evaluación</li>
              <li><i class="bi bi-check-circle-fill"></i>Acompañamiento docente durante todo el proceso</li>
              <li><i class="bi bi-check-circle-fill"></i>Mismo plan de estudios que la modalidad presencial</li>
            </ul>
          </div>
          <div class="col-md-6">
            <h3 class="h6 fw-bold text-uppercase" style="color: var(--incb-azul);">Ideal para</h3>
            <p class="text-muted small mb-0">
              Jóvenes y adultos que necesitan retomar o continuar su bachillerato con horarios flexibles,
              sin sacrificar la calidad ni el acompañamiento académico.
            </p>
          </div>
        </div>
      </div>

      <!-- Requisitos generales -->
      <div id="requisitos" class="programa-detalle p-4 p-md-5 mt-4 border" style="background: var(--incb-azul-claro); border-color: rgba(0,0,0,.05) !important;">
        <h3 class="h5 fw-bold mb-3"><i class="bi bi-clipboard-check me-2" style="color: var(--incb-azul);"></i>Requisitos de ingreso (todos los bachilleratos)</h3>
        <ul class="list-unstyled lista-check mb-4">
          <li><i class="bi bi-check-circle-fill"></i>Partida de nacimiento original y copia</li>
          <li><i class="bi bi-check-circle-fill"></i>Constancia de notas o título de noveno grado</li>
          <li><i class="bi bi-check-circle-fill"></i>NIE (Número de Identificación Estudiantil) válido</li>
          <li><i class="bi bi-check-circle-fill"></i>2 fotografías tamaño carnet</li>
        </ul>
        <a href="<?= $base_url; ?>index.php#contacto" class="btn px-4" style="background: var(--incb-azul-oscuro); border-color: var(--incb-azul-oscuro); color:#fff; border-radius:.3rem; font-weight:600;">
          <i class="bi bi-envelope-fill me-2"></i>Escríbenos para más información
        </a>
      </div>

    </div>
  </div>
</div>

<script>
  // Resalta en el índice lateral la sección que se está viendo
  document.addEventListener('DOMContentLoaded', function () {
    const enlaces  = document.querySelectorAll('#toc-programas .toc-link');
    const secciones = Array.from(enlaces).map(a => document.querySelector(a.getAttribute('href')));

    const observador = new IntersectionObserver((entradas) => {
      entradas.forEach(entrada => {
        if (entrada.isIntersecting) {
          const id = '#' + entrada.target.id;
          enlaces.forEach(a => a.classList.toggle('active', a.getAttribute('href') === id));
        }
      });
    }, { rootMargin: '-40% 0px -50% 0px' });

    secciones.forEach(sec => sec && observador.observe(sec));
  });
</script>

<?php require 'includes/footer.php'; ?>

<
      <!-- Slide 1 -->
      <div class="carousel-item active" data-bs-interval="6000">
        <img src="<?= $base_url; ?>img/fachada.jpg" alt="Fachada INCB">
        <div class="carousel-caption">
          <span class="hero-badge"><i class="bi bi-award-fill"></i> Excelencia Académica</span>
          <h1 class="hero-title fs-3 my-2">Instituto Nacional<br>de Ciudad Barrios</h1>
          <p class="hero-subtitle">Formando líderes del futuro con valores, ciencia y tradición desde 1978.</p>
          <a href="#nosotros" class="hero-cta"><i class="bi bi-arrow-down-circle"></i> Conoce más</a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" data-bs-interval="6000">
        <img src="<?= $base_url; ?>img/banda.jpg" alt="Banda musical INCB">
        <div class="carousel-caption">
          <span class="hero-badge"><i class="bi bi-music-note-beamed"></i> Cultura &amp; Arte</span>
          <h1 class="hero-title fs-3 my-2">Inscribe tu pasión,<br>forja tu futuro</h1>
          <p class="hero-subtitle">Únete a nuestra destacada banda musical y descubre el poder de la expresión artística.</p>
          <a href="#oferta-academica" class="hero-cta"><i class="bi bi-mortarboard"></i> Ver oferta académica</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" data-bs-interval="6000">
        <img src="<?= $base_url; ?>img/danza.jpg" alt="Danza folclórica INCB">
        <div class="carousel-caption">
          <span class="hero-badge"><i class="bi bi-globe-americas"></i> Identidad &amp; Tradición</span>
          <h1 class="hero-title fs-3 my-2">Danza y tradición<br>que nos une</h1>
          <p class="hero-subtitle">Rescatamos y celebramos nuestra identidad cultural a través de la danza folclórica salvadoreña.</p>
          <a href="#inscripcion" class="hero-cta"><i class="bi bi-pencil-square"></i> Inscríbete ahora</a>
        </div>
      </div>

    </div>

    <button class="carousel-control-prev d-none d-md-flex" type="button" data-bs-target="#carruselInstitucional" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next d-none d-md-flex" type="button" data-bs-target="#carruselInstitucional" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>
</section>



<section id="nosotros" class="py-5 bg-light">
  <div class="container">
    <div class="row g-5 align-items-start">

      <div class="col-lg-7">
        <h2 class="h3 fw-bold mb-4 incb-titulo">Nosotros</h2>
        <p class="text-muted mb-4">
          El Instituto Nacional de Ciudad Barrios (INCB) impulsa la formación
          integral de los estudiantes con énfasis en competencias técnicas,
          ciudadanía y valores.
        </p>

        <button type="button" class="btn btn-primary btn-sm mb-4"
                data-bs-toggle="modal" data-bs-target="#historiaModal">
          Leer más sobre nuestra historia
        </button>

        <div class="accordion" id="accordionNosotros">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapseMision" aria-expanded="true">
                <strong>Misión</strong>
              </button>
            </h2>
            <div id="collapseMision" class="accordion-collapse collapse show" data-bs-parent="#accordionNosotros">
              <div class="accordion-body">
                Contribuir al desarrollo integral de jóvenes a través de la formación moral, espiritual,
                cultural, técnica y científica, para adquirir capacidades que les permitan incorporarse
                en niveles educativos superiores y laborales.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapseVision" aria-expanded="false">
                <strong>Visión</strong>
              </button>
            </h2>
            <div id="collapseVision" class="accordion-collapse collapse" data-bs-parent="#accordionNosotros">
              <div class="accordion-body">
                Ser una institución de educación media con integración de conocimientos técnico-científico
                para el desarrollo de habilidades y destrezas, utilizando metodologías participativas y
                proyectando una imagen de prestigio, excelencia y calidad académica.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button"
                      data-bs-toggle="collapse" data-bs-target="#collapseValores" aria-expanded="false">
                <strong>Valores</strong>
              </button>
            </h2>
            <div id="collapseValores" class="accordion-collapse collapse" data-bs-parent="#accordionNosotros">
              <div class="accordion-body">
                Respeto, Confianza, Solidaridad y Responsabilidad como pilares de nuestra comunidad educativa.
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="p-4 border rounded-3 bg-white shadow-sm">
          <h3 class="h5 mb-3"><i class="bi bi-folder2-open text-primary me-2"></i>Enlaces rápidos</h3>
          <div class="d-flex gap-2 flex-wrap">
            <a class="btn btn-primary" href="#noticias">Ver noticias</a>
            <a class="btn btn-outline-dark" href="https://docentes.incb.edu.sv/" title="Portal Docente" target="_blank" rel="noopener">Portal Docente</a>
            <a class="btn btn-outline-dark" href="https://alumnos.incb.edu.sv/" title="Portal Estudiante" target="_blank" rel="noopener">Portal Estudiante</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SECCIÓN DE OFERTA ACADÉMICA LLAMADA DE FORMA MODULAR -->
<?php require __DIR__ . '/../components/oferta_seccion.php'; ?>

<?php require __DIR__ . '/../components/pasos_inscripcion.php'; ?>

<?php require __DIR__ . '/../components/beneficios_seccion.php'; ?>

<?php require __DIR__ . '/../components/noticias.php'; ?>

<?php require __DIR__ . '/../components/contacto_seccion.php'; ?>

<div class="modal fade" id="historiaModal" tabindex="-1" aria-labelledby="historiaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg overflow-hidden" style="border-radius:1.25rem;">

      <!-- Header -->
      <div class="modal-header border-0 position-relative pb-4 pt-4 px-4"
           style="background: linear-gradient(135deg, #0b2447 0%, #14487a 60%, #1a5fa0 100%);">
        <div class="d-flex align-items-center gap-3">
          <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 overflow-hidden"
               style="width:72px;height:72px;background:rgba(255,255,255,0.12);border:2px solid var(--incb-dorado);padding:4px;">
            <img src="<?= $base_url; ?>img/logo_incb_formatoMejorado.jfif" alt="Logo INCB" style="width:100%;height:100%;object-fit:contain;">
          </div>
          <div>
            <h5 class="modal-title mb-0 fw-bold text-white" id="historiaModalLabel" style="font-family:'Poppins',sans-serif;font-size:1.3rem;">
              Nuestra Historia
            </h5>
            <p class="mb-0 small" style="color:rgba(255,255,255,0.65);">Instituto Nacional de Ciudad Barrios · Desde 1978</p>
          </div>
        </div>
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                data-bs-dismiss="modal" aria-label="Cerrar"></button>
        <!-- Línea decorativa inferior -->
        <div class="position-absolute bottom-0 start-0 end-0" style="height:3px;
             background:linear-gradient(90deg,var(--incb-dorado),transparent);"></div>
      </div>

      <!-- Body con línea de tiempo -->
      <div class="modal-body px-4 py-4" style="background:#f8fafd;">
        <style>
          .historia-timeline { position: relative; padding-left: 2rem; }
          .historia-timeline::before {
            content: '';
            position: absolute;
            left: 0.55rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--incb-dorado), #c5d9ef, var(--incb-azul));
            border-radius: 2px;
          }
          .historia-hito {
            position: relative;
            margin-bottom: 1.6rem;
          }
          .historia-hito::before {
            content: '';
            position: absolute;
            left: -1.63rem;
            top: 0.45rem;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: var(--incb-dorado);
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px var(--incb-dorado);
          }
          .historia-year-badge {
            display: inline-block;
            background: var(--incb-azul-oscuro);
            color: var(--incb-dorado);
            font-family: 'Poppins', sans-serif;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            padding: 0.18rem 0.65rem;
            border-radius: 100px;
            margin-bottom: 0.4rem;
          }
          .historia-card {
            background: #fff;
            border-radius: 0.85rem;
            padding: 1rem 1.1rem;
            box-shadow: 0 2px 10px rgba(11,36,71,0.07);
            border-left: 3px solid var(--incb-dorado);
          }
          .historia-card p { margin-bottom: 0.4rem; color: #3a4558; font-size: 0.92rem; line-height: 1.6; }
          .historia-card ul { padding-left: 1.2rem; margin-bottom: 0; }
          .historia-card ul li { color: #3a4558; font-size: 0.9rem; margin-bottom: 0.25rem; }
          .historia-card strong { color: var(--incb-azul-oscuro); }
        </style>

        <div class="historia-timeline">

          <!-- 1978 Fundación -->
          <div class="historia-hito">
            <span class="historia-year-badge"><i class="bi bi-flag-fill me-1"></i>1978 — Fundación</span>
            <div class="historia-card">
              <p>El Instituto Nacional de Ciudad Barrios fue fundado en <strong>enero de 1978</strong>. La primera Directiva estuvo conformada por:</p>
              <ul>
                <li>Sr. Geofredo Amaya</li>
                <li>Sr. Salvador Márquez (QDDG)</li>
                <li>Sra. Thelma Díaz (QDDG)</li>
              </ul>
              <p class="mt-2"><strong>Primera Planta Docente:</strong></p>
              <ul>
                <li>Director Sr. Rosendo Fuentes</li>
                <li>Secretaria Sra. Rosibel Jurado</li>
                <li>Prof. José Gaspar Trejo — Ciencias Naturales</li>
                <li>Juana Mineros — Humanidades e Inglés</li>
                <li>Thelma Díaz (QDDG) — Corte y Confección (Señoritas)</li>
                <li>Sr. Santos Bonilla (QDDG) — Instalación Eléctrica (Caballeros)</li>
              </ul>
              <p class="mt-2">Primera matrícula: <strong>32 alumnos</strong>.</p>
              <p>Oferta académica inicial: Humanidades, Físico Matemático, Salud, Comercial (Contador y Secretariado).</p>
            </div>
          </div>

          <!-- 1978–1982 Instalaciones -->
          <div class="historia-hito">
            <span class="historia-year-badge"><i class="bi bi-building me-1"></i>1978–1982 — Primeras Instalaciones</span>
            <div class="historia-card">
              <ul>
                <li>Casa alquilada a Sra. Etelvina Galdámez, Barrio Concepción (actual Iglesia Elim).</li>
                <li><strong>1979:</strong> Traslado a casa alquilada del Sr. Juan Ayala.</li>
                <li><strong>1980:</strong> Casa del Sr. Márquez, Barrio El Calvario. Aquí egresó la <strong>primera promoción</strong> (20 alumnos, Bachillerato Académico).</li>
                <li><strong>1981:</strong> Local de la Clínica del Ministerio de Salud — prestada para evitar alquileres.</li>
                <li><strong>1982:</strong> El Director Rosendo gestiona el actual espacio físico, pasando al MINED. Se realizaron remodelaciones con apoyo de patronatos.</li>
              </ul>
            </div>
          </div>

          <!-- 1988 -->
          <div class="historia-hito">
            <span class="historia-year-badge"><i class="bi bi-person-badge me-1"></i>1988 — Nueva Dirección</span>
            <div class="historia-card">
              <p>El Sr. Rosendo se retira. La institución ya contaba con <strong>tres salones</strong> y matrícula de ¢10 colones mensuales.</p>
              <p>Ingresa como Directora la <strong>Licda. Lidia Jeannette Hernández de Medina</strong>, impulsando mejoras en infraestructura, redistribución horaria por especialidad y proyectos estudiantiles.</p>
              <ul>
                <li><strong>1988–2000:</strong> Subdirector Prof. Oswaldo Andrade Solórzano — remodelación de secciones vía Servicio Social Estudiantil.</li>
                <li><strong>Desde 1990:</strong> Carga horaria distribuida por especialidad; CDE asume salarios de Secretaria y vigilante.</li>
              </ul>
            </div>
          </div>

          <!-- 1994–1997 -->
          <div class="historia-hito">
            <span class="historia-year-badge"><i class="bi bi-hammer me-1"></i>1994–1997 — Infraestructura</span>
            <div class="historia-card">
              <ul>
                <li><strong>1994:</strong> Remodelación gestionada a través del Fondo de Inversión Social (FIS).</li>
                <li><strong>1995:</strong> Construcción de muro de protección con apoyo de la Cooperativa de Cafetaleros.</li>
                <li><strong>1996:</strong> Se consolida el <strong>primer CDE</strong>. Se recibe primer bono del MINED por <strong>¢100,000</strong> invertido en: material bibliográfico, equipo de laboratorio, reparación de muro, construcción de portones y mobiliario.</li>
                <li><strong>1997:</strong> Construcción del chalet N.° 1 con fondos propios.</li>
              </ul>
            </div>
          </div>

          <!-- 1998–2002 -->
          <div class="historia-hito">
            <span class="historia-year-badge"><i class="bi bi-pc-display me-1"></i>1998–2002 — Tecnología y CRA</span>
            <div class="historia-card">
              <ul>
                <li><strong>1998:</strong> Adquisición de 5 computadoras (200 MHz, 2 GB) para Informática; arrendamiento de 12 equipos adicionales.</li>
                <li><strong>2002:</strong> Participación en el Proyecto <strong>CRA</strong> (Centro de Recursos para el Aprendizaje). Bono de <strong>¢437,000</strong> para equipamiento: 19 PC + servidor, cañón, cámaras, impresoras y más. Reconocidos por mejor PEI y candidatos a <em>Escuela 10</em>; bono adicional de <strong>¢370,000</strong> para mobiliario, materiales y reparaciones.</li>
              </ul>
            </div>
          </div>

        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer border-0 px-4 py-3" style="background:#f0f5fb;">
        <button type="button" class="btn btn-sm px-4 fw-semibold rounded-pill"
                style="background:var(--incb-azul-oscuro);color:#fff;"
                data-bs-dismiss="modal">
          <i class="bi bi-x-circle me-1"></i>Cerrar
        </button>
      </div>

    </div>
  </div>
</div>



<div class="modal fade" id="modalAnuncioEmergente" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 position-relative text-center">
        <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white shadow-sm rounded-circle"
                style="z-index:1060;" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        <img src="<?= $base_url; ?>img/anuncio.jpg" class="img-fluid rounded shadow-lg" alt="Anuncio institucional">
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {

    // ── Modal de anuncio emergente ──────────────────────────────────
    if (!sessionStorage.getItem('anuncioVisto')) {
      var el = document.getElementById('modalAnuncioEmergente');
      if (el) {
        new bootstrap.Modal(el).show();
        sessionStorage.setItem('anuncioVisto', 'true');
      }
    }

    // ── Re-disparar animaciones del carrusel en cada slide ──────────
    var carousel = document.getElementById('carruselInstitucional');
    if (carousel) {
      carousel.addEventListener('slide.bs.carousel', function (e) {
        // Al terminar la transición, re-clona los elementos animados
        // para forzar el replay de los @keyframes
        carousel.addEventListener('slid.bs.carousel', function handler() {
          var activeItem = carousel.querySelector('.carousel-item.active');
          if (activeItem) {
            ['.hero-badge', '.hero-title', '.hero-subtitle', '.hero-cta'].forEach(function(sel) {
              var el = activeItem.querySelector(sel);
              if (el) {
                el.style.animation = 'none';
                el.offsetHeight; // reflow
                el.style.animation = '';
              }
            });
          }
          carousel.removeEventListener('slid.bs.carousel', handler);
        });
      });

      // Efecto zoom en imagen del slide activo
      carousel.addEventListener('slid.bs.carousel', function () {
        carousel.querySelectorAll('.carousel-item img').forEach(function(img) {
          img.style.transform = '';
        });
        var activeImg = carousel.querySelector('.carousel-item.active img');
        if (activeImg) activeImg.style.transform = 'scale(1.06)';
      });
    }

  });
</script>
</body>
</html>
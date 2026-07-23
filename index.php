<?php
$base_url   = '/proyecto_final/Portal/';
$page_title = 'INCB | Instituto Nacional de Ciudad Barrios';
$page_desc  = 'Sitio Web Institucional del Instituto Nacional de Ciudad Barrios (INCB).';
require 'includes/header.php';
?>

<section id="inicio" class="p-0">
  <div id="carruselInstitucional"
       class="carousel slide carousel-fade hero-carousel"
       data-bs-ride="carousel"
       data-bs-pause="false">

    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carruselInstitucional" data-bs-slide-to="0"
              class="active" aria-current="true" aria-label="Diapositiva 1"></button>
      <button type="button" data-bs-target="#carruselInstitucional" data-bs-slide-to="1"
              aria-label="Diapositiva 2"></button>
      <button type="button" data-bs-target="#carruselInstitucional" data-bs-slide-to="2"
              aria-label="Diapositiva 3"></button>
    </div>

    <div class="carousel-inner shadow-sm">
      <div class="carousel-item active" data-bs-interval="5000">
        <img src="<?= $base_url; ?>img/fachada.jpg" class="d-block w-100" alt="Fachada INCB">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
          <h5 class="fw-bold">Instituto Nacional de Ciudad Barrios</h5>
          <p>Formando líderes del futuro con excelencia académica</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <img src="<?= $base_url; ?>img/banda.jpg" class="d-block w-100" alt="Banda musical INCB">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
          <h5 class="fw-bold">Inscribe tu pasión, forja tu futuro</h5>
          <p>Únete a la excelencia musical</p>
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="5000">
        <img src="<?= $base_url; ?>img/danza.jpg" class="d-block w-100" alt="Danza folclórica INCB">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
          <h5 class="fw-bold">Danza y tradición INCB</h5>
          <p>Rescatando nuestra identidad y cultura</p>
        </div>
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carruselInstitucional" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carruselInstitucional" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>
</section>


<?php require 'includes/aviso_banner.php'; ?>

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
          <div class="list-group">
            <a href="<?= $base_url; ?>document/Organigrama_.pdf"
               class="list-group-item list-group-item-action">
              <i class="bi bi-diagram-3 me-2 text-primary"></i>Organigrama
            </a>
            <a href="<?= $base_url; ?>document/Normativa_del_Aula_Virtual.pdf"
               class="list-group-item list-group-item-action">
              <i class="bi bi-book me-2 text-primary"></i>Uso del aula virtual
            </a>
            <a href="<?= $base_url; ?>document/Compromisos_Estudiantes.pdf"
               class="list-group-item list-group-item-action">
              <i class="bi bi-person-check me-2 text-primary"></i>Compromisos del estudiante
            </a>
            <a href="<?= $base_url; ?>document/Compromisos_Padres.pdf"
               class="list-group-item list-group-item-action">
              <i class="bi bi-people me-2 text-primary"></i>Compromisos padres de familia
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- SECCIÓN DE OFERTA ACADÉMICA LLAMADA DE FORMA MODULAR -->
<?php require 'oferta_seccion.php'; ?>

<?php require 'pasos_inscripcion.php'; ?>

<?php require 'beneficios_seccion.php'; ?>

<?php require 'noticias.php'; ?>

<?php require 'contacto_seccion.php'; ?>

<div class="modal fade" id="historiaModal" tabindex="-1" aria-labelledby="historiaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="historiaModalLabel">Nuestra Historia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p>El Instituto Nacional de Ciudad Barrios fue fundado con el propósito de brindar educación media
           de calidad a los jóvenes de la región oriental de El Salvador, formando ciudadanos íntegros y competentes.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

<?php require 'includes/footer.php'; ?>

<script>
  // Control del modal de anuncio emergente (Código que ya tenías)
  document.addEventListener('DOMContentLoaded', function () {
    if (!sessionStorage.getItem('anuncioVisto')) {
      var el = document.getElementById('modalAnuncioEmergente');
      if (el) { 
        new bootstrap.Modal(el).show(); 
        sessionStorage.setItem('anuncioVisto', 'true');
      }
    }
  });
</script>
</body>
</html>
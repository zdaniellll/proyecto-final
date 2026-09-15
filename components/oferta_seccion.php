<style>
  /* Pequeño efecto CSS para que las tarjetas se eleven al pasar el mouse */
  .hover-card-incb {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .hover-card-incb:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.15) !important;
  }
  /* Estilo para los círculos de los íconos */
  .icon-circle {
    width: 80px; 
    height: 80px;
  }
</style>

<section id="oferta-academica" class="py-5 bg-white">
  <div class="container">

    <h2 class="text-center fw-bold mb-2 display-6 incb-titulo">Oferta Académica</h2>
    <p class="text-center text-muted mb-5">Descubre nuestras especialidades para el ciclo 2026</p>

    <div class="row g-4 mb-5 text-center">

      <!-- Bachillerato General -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm hover-card-incb bg-light rounded-4">
          <div class="card-body p-4 d-flex flex-column align-items-center">
            <div class="rounded-circle bg-white shadow-sm p-3 mb-4 d-inline-flex justify-content-center align-items-center icon-circle">
              <i class="bi bi-mortarboard-fill text-primary display-5"></i>
            </div>
            <h3 class="h5 fw-bold mb-3">Bachillerato General</h3>
            <p class="text-muted small mb-4">Formación integral en áreas humanísticas y científicas con duración de 2 años.</p>
            <a href="<?= app_url('oferta_academica.php#tab-general'); ?>" class="btn btn-outline-primary btn-sm mt-auto stretched-link">Ver detalles</a>
          </div>
        </div>
      </div>

      <!-- Bachillerato en Desarrollo de Software -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm hover-card-incb bg-light rounded-4 position-relative">
          <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger shadow-sm">
            Alta Demanda
          </span>
          <div class="card-body p-4 d-flex flex-column align-items-center">
            <div class="rounded-circle bg-white shadow-sm p-3 mb-4 d-inline-flex justify-content-center align-items-center icon-circle">
              <i class="bi bi-code-slash text-primary display-5"></i>
            </div>
            <h3 class="h5 fw-bold mb-3">Desarrollo de Software</h3>
            <p class="text-muted small mb-4">Aprende lógica, bases de datos y creación de sistemas informáticos en 3 años.</p>
            <a href="<?= app_url('oferta_academica.php#tab-software'); ?>" class="btn btn-outline-primary btn-sm mt-auto stretched-link">Ver detalles</a>
          </div>
        </div>
      </div>

      <!-- Bachillerato Administrativo Contable -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm hover-card-incb bg-light rounded-4">
          <div class="card-body p-4 d-flex flex-column align-items-center">
            <div class="rounded-circle bg-white shadow-sm p-3 mb-4 d-inline-flex justify-content-center align-items-center icon-circle">
              <i class="bi bi-calculator-fill text-primary display-5"></i>
            </div>
            <h3 class="h5 fw-bold mb-3">Administrativo Contable</h3>
            <p class="text-muted small mb-4">Gestión financiera, leyes tributarias y administración de empresas en 3 años.</p>
            <a href="<?= app_url('oferta_academica.php#tab-contable'); ?>" class="btn btn-outline-primary btn-sm mt-auto stretched-link">Ver detalles</a>
          </div>
        </div>
      </div>

      <!-- Bachillerato a Distancia -->
      <div class="col-12 col-sm-6 col-lg-3">
        <div class="card h-100 border-0 shadow-sm hover-card-incb bg-light rounded-4">
          <div class="card-body p-4 d-flex flex-column align-items-center">
            <div class="rounded-circle bg-white shadow-sm p-3 mb-4 d-inline-flex justify-content-center align-items-center icon-circle">
              <i class="bi bi-laptop text-primary display-5"></i>
            </div>
            <h3 class="h5 fw-bold mb-3">Bachillerato a Distancia</h3>
            <p class="text-muted small mb-4">Flexibilidad total para culminar tus estudios combinando modalidades virtual y presencial.</p>
            <a href="<?= app_url('oferta_academica.php#tab-distancia'); ?>" class="btn btn-outline-primary btn-sm mt-auto stretched-link">Ver detalles</a>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
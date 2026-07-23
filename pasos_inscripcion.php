<?php
/**
 * pasos_inscripcion.php — Sección visual con los 4 pasos del proceso de inscripción.
 * Se incluye desde index.php como sección modular. No tiene lógica PHP propia.
 */
?>
<!-- Sección proceso: tarjetas numeradas con los pasos para inscribirse -->
<section id="proceso" class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="h3 fw-bold incb-titulo d-inline-block">¿Cómo inscribirte?</h2>
      <p class="text-muted mt-3 mx-auto" style="max-width: 640px;">
        El proceso de inscripción para nuevo ingreso es sencillo. Sigue estos 4 pasos:
      </p>
    </div>

    <div class="row g-4">

      <div class="col-md-6 col-lg-3">
        <div class="text-center h-100 p-4 border rounded-4 shadow-sm position-relative">
          <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
               style="width:64px; height:64px; background: var(--incb-azul-claro); color: var(--incb-azul); font-size:1.6rem; font-weight:700;">1</div>
          <h3 class="h6 fw-bold">Consulta la oferta</h3>
          <p class="text-muted small mb-0">Revisa los bachilleratos disponibles y elige la especialidad que más te interesa.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="text-center h-100 p-4 border rounded-4 shadow-sm">
          <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
               style="width:64px; height:64px; background: var(--incb-azul-claro); color: var(--incb-azul); font-size:1.6rem; font-weight:700;">2</div>
          <h3 class="h6 fw-bold">Reúne tus documentos</h3>
          <p class="text-muted small mb-0">Ten a mano tu NIE, partida de nacimiento y constancia de notas de 9° grado.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="text-center h-100 p-4 border rounded-4 shadow-sm">
          <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
               style="width:64px; height:64px; background: var(--incb-azul-claro); color: var(--incb-azul); font-size:1.6rem; font-weight:700;">3</div>
          <h3 class="h6 fw-bold">Llena la ficha en línea</h3>
          <p class="text-muted small mb-0">Completa el formulario de inscripción con los datos del estudiante y su representante.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="text-center h-100 p-4 border rounded-4 shadow-sm">
          <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle"
               style="width:64px; height:64px; background: var(--incb-azul-claro); color: var(--incb-azul); font-size:1.6rem; font-weight:700;">4</div>
          <h3 class="h6 fw-bold">Entrega documentos</h3>
          <p class="text-muted small mb-0">Presenta tu documentación física en el instituto para confirmar tu cupo.</p>
        </div>
      </div>

    </div>

    <div class="text-center mt-5">
      <a href="<?= $base_url; ?>inscripcion.php" class="btn btn-primary btn-lg rounded-pill shadow-sm px-4">
        <i class="bi bi-ui-checks me-2"></i>Iniciar mi inscripción
      </a>
    </div>
  </div>
</section>

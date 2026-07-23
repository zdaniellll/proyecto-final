<?php
/**
 * Franja de aviso institucional — para anuncios puntuales (convocatorias,
 * fechas límite, avisos). Editar el texto de abajo cuando cambie el aviso.
 * Se puede cerrar y no vuelve a aparecer en esa sesión del navegador.
 */
$aviso_texto = 'Convocatoria de inscripciones abiertas para el ciclo escolar 2027 — cupos limitados por especialidad.';
$aviso_link  = $base_url . 'inscripcion.php';
?>
<div id="avisoInstitucional" class="text-white py-2" style="background: var(--incb-dorado); display: none;">
  <div class="container d-flex align-items-center justify-content-between gap-3 flex-wrap">
    <div class="d-flex align-items-center gap-2 small fw-semibold">
      <i class="bi bi-megaphone-fill"></i>
      <span><?= htmlspecialchars($aviso_texto); ?></span>
      <a href="<?= htmlspecialchars($aviso_link); ?>" class="text-white text-decoration-underline ms-1">Ver más</a>
    </div>
    <button type="button" class="btn-close btn-close-white btn-sm" aria-label="Cerrar aviso" onclick="cerrarAvisoInstitucional()"></button>
  </div>
</div>
<script>
  (function () {
    var el = document.getElementById('avisoInstitucional');
    if (el && !sessionStorage.getItem('avisoInstitucionalCerrado')) {
      el.style.display = 'block';
    }
  })();
  function cerrarAvisoInstitucional() {
    var el = document.getElementById('avisoInstitucional');
    if (el) el.style.display = 'none';
    sessionStorage.setItem('avisoInstitucionalCerrado', 'true');
  }
</script>

<!-- Botón flotante de accesibilidad -->
<div id="floatingA11y" class="floating-a11y" aria-label="Control de accesibilidad">
  <button id="btn-font" class="btn btn-secondary btn-sm" type="button" title="Aumentar o reducir tamaño de fuente" aria-label="Aumentar o reducir tamaño de fuente">
    <i class="bi bi-fonts"></i><span class="d-none d-sm-inline ms-1">A+</span>
  </button>
</div>

<!-- Botón WhatsApp flotante -->
<a href="https://wa.me/50366926477"
   title="Contactar al INCB por WhatsApp"
   class="btn btn-success rounded-circle d-flex align-items-center justify-content-center floating-whatsapp"
   aria-label="Contactar por WhatsApp"
   style="position: fixed; right: 14px; bottom: 14px; z-index: 1000; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
  <i class="bi bi-whatsapp"></i>
</a>

<style>
  .floating-whatsapp {
    width: 60px; height: 60px; font-size: 2rem;
    max-width: 100%;
    right: 14px; bottom: 14px;
  }

  .floating-a11y {
    position: fixed;
    max-width: 100%;
    left: 16px;
    bottom: 16px;
    z-index: 1001;
    user-select: none;
  }

  .floating-a11y .btn {
    font-size: 0.8rem;
    padding: 0.45rem 0.8rem;
    border-radius: 999px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.18);
    border: 1px solid rgba(255,255,255,0.2);
    background: rgba(11, 36, 71, 0.92);
    color: #fff;
  }

  .floating-a11y .btn:hover {
    background: rgba(20,72,122,1);
  }

  @media (max-width: 480px) {
    .floating-whatsapp { width: 48px; height: 48px; font-size: 1.5rem; right: 10px; bottom: 10px; }
    .floating-a11y { left: 10px; bottom: 10px; }
    .floating-a11y .btn { padding: 0.35rem 0.6rem; font-size: 0.75rem; }
  }
</style>

<footer class="py-4 text-white" style="background: var(--incb-azul-oscuro, #0b2447);">
  <div class="container small">
    <div class="row">
      <div class="col-md-7">
        <div class="d-flex align-items-center gap-2 mb-2">
          <img src="<?= $base_url; ?>img/logo_incb_formatoMejorado.png" alt="Logotipo INCB" height="35">
          <strong>Instituto Nacional de Ciudad Barrios (INCB)</strong>
        </div>
        <div class="text-white-50">
          &copy; <?= date('Y'); ?> INCB. Todos los derechos reservados.<br>
          Creado por <a href="<?= app_url('perfil_desarrollador.php'); ?>" class="text-white text-decoration-underline">Daniel Sorto</a> &nbsp;|&nbsp; Coordinación: Allan Romero
        </div>
      </div>
      <div class="col-md-5 text-md-end mt-3 mt-md-0">
        <div>
          <a href="<?= app_url('index.php#nosotros'); ?>" class="me-3 text-white text-decoration-none">Nosotros</a>
          <a href="<?= app_url('index.php#oferta-academica'); ?>" class="me-3 text-white text-decoration-none">Oferta</a>
          <a href="<?= app_url('index.php#contacto'); ?>" class="text-white text-decoration-none">Contacto</a>
        </div>
        <div class="mt-3">
          <h5 class="fw-bold mb-2">Síguenos en Facebook</h5>
          <a href="https://www.facebook.com/InstitutoNacionaldeciudadbarrios" class="text-white">
            <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap 5.3.3 JS Bundle local: dropdown, collapse y offcanvas -->
<script src="<?= $base_url; ?>assets/js/bootstrap.bundle.min.js"></script>

<script>
  (function () {
    const STORAGE_KEY = 'incbFontScale';
    const btn = document.getElementById('btn-font');

    function updateButtonLabel(isLarge) {
      if (!btn) return;
      btn.innerHTML = isLarge
        ? '<i class="bi bi-fonts"></i><span class="d-none d-sm-inline ms-1">A-</span>'
        : '<i class="bi bi-fonts"></i><span class="d-none d-sm-inline ms-1">A+</span>';
    }

    function applyScale(forceLarge) {
      const enabled = forceLarge === undefined ? !document.body.classList.contains('incb-font-large') : !!forceLarge;
      document.documentElement.classList.toggle('incb-font-large', enabled);
      document.body.classList.toggle('incb-font-large', enabled);
      localStorage.setItem(STORAGE_KEY, enabled ? '1' : '0');
      updateButtonLabel(enabled);
    }

    function restoreScale() {
      const saved = localStorage.getItem(STORAGE_KEY);
      // Si está guardado como '1', aplicar escala, sino mantener normal
      applyScale(saved === '1');
    }

    if (btn) {
      btn.addEventListener('click', function () {
        const isLarge = document.body.classList.contains('incb-font-large');
        applyScale(!isLarge);
      });

      // Prevenir que la tecla espacio o Enter active el botón
      btn.addEventListener('keydown', function (event) {
        if (event.code === 'Space' || event.code === 'Enter') {
          event.preventDefault();
        }
      });
    }

    restoreScale();
    localStorage.removeItem('incbA11yPos');
  })();
</script>
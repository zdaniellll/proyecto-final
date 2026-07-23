<?php
/**
 * contacto_seccion.php
 * Sección de Contacto del INCB – diseñada para ser incluida desde index.php
 * Usa la misma conexión (includes/conexion.php) que noticias.php
 */

$cs_nombre  = '';
$cs_correo  = '';
$cs_mensaje = '';
$cs_alerta  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contacto_submit'])) {

    // Guardamos el texto tal cual (sin escapar) — el escape se hace solo al
    // momento de imprimir en HTML (más abajo), para no guardar "&amp;" en la BD
    // ni terminar mostrando "&amp;amp;" si el mensaje se re-muestra dos veces.
    $cs_nombre  = trim($_POST['nombre']  ?? '');
    $cs_correo  = trim($_POST['correo']  ?? '');
    $cs_mensaje = trim($_POST['mensaje'] ?? '');

    if (empty($cs_nombre)) {
        $cs_alerta = "
          <div class='alert alert-danger mt-4' role='alert'>
            <i class='bi bi-exclamation-triangle-fill me-2'></i>
            <strong>¡Campo requerido!</strong> Por favor ingresa tu nombre.
          </div>";
    } elseif (!csrf_validar($_POST['csrf_token'] ?? null)) {
        $cs_alerta = "
          <div class='alert alert-danger mt-4' role='alert'>
            <i class='bi bi-exclamation-triangle-fill me-2'></i>
            <strong>Formulario expirado.</strong> Por favor intenta enviarlo de nuevo.
          </div>";
    } else {
        require_once __DIR__ . '/includes/conexion.php';
        $guardado_en_bd = false;
        $correo_enviado = false;
        $error_detalle  = '';

        $sql = "INSERT INTO mensajes_contacto (nombre_remitente, correo_remitente, mensaje_texto) VALUES (?, ?, ?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $cs_nombre, $cs_correo, $cs_mensaje);
            if (mysqli_stmt_execute($stmt)) {
                $guardado_en_bd = true;

                // Envío por FormSubmit (igual que contacto.php)
                $correo_destino = "d4886160@gmail.com";
                $datos_post = [
                    'Remitente'      => $cs_nombre,
                    'Email_Contacto' => !empty($cs_correo) ? $cs_correo : 'No proporcionado',
                    'Mensaje'        => $cs_mensaje,
                    '_subject'       => "Nuevo mensaje de contacto: " . $cs_nombre,
                    '_captcha'       => 'false',
                ];
                $ch = curl_init("https://formsubmit.co/ajax/" . $correo_destino);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => http_build_query($datos_post),
                    CURLOPT_HTTPHEADER     => ['Accept: application/json', 'Content-Type: application/x-www-form-urlencoded'],
                    CURLOPT_REFERER        => "http://localhost",
                    CURLOPT_SSL_VERIFYPEER => true,
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_TIMEOUT        => 10,
                ]);
                $respuesta = curl_exec($ch);
                if ($respuesta !== false) {
                    $json = json_decode($respuesta, true);
                    if (!empty($json['success']) && ($json['success'] === 'true' || $json['success'] === true)) {
                        $correo_enviado = true;
                    } else {
                        $error_detalle = htmlspecialchars($respuesta);
                    }
                } else {
                    $error_detalle = curl_error($ch);
                }
                curl_close($ch);
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($conexion);

        if ($guardado_en_bd && $correo_enviado) {
            $cs_alerta = "
              <div class='alert alert-success mt-4' role='alert'>
                <i class='bi bi-check-circle-fill me-2'></i>
                <strong>¡Mensaje enviado!</strong> Gracias <strong>" . htmlspecialchars($cs_nombre) . "</strong>, tu mensaje fue guardado y enviado correctamente.
              </div>";
            $cs_nombre = $cs_correo = $cs_mensaje = '';
        } elseif ($guardado_en_bd) {
            $cs_alerta = "
              <div class='alert alert-warning mt-4' role='alert'>
                <i class='bi bi-exclamation-circle-fill me-2'></i>
                <strong>Guardado en base de datos, pero falló el correo.</strong>
                <small class='d-block text-danger mt-1'>{$error_detalle}</small>
              </div>";
        } else {
            $cs_alerta = "
              <div class='alert alert-danger mt-4' role='alert'>
                <i class='bi bi-exclamation-triangle-fill me-2'></i>
                <strong>Error de conexión</strong> a la base de datos <code>bd_incb</code>.
              </div>";
        }
    }
}
?>

<style>
  #contacto { --cs-navy: var(--incb-azul-oscuro, #0b2447); --cs-blue: var(--incb-azul, #1a5fb4); --cs-gold: var(--incb-dorado, #b3922a); }

  #contacto .cs-eyebrow {
    color: var(--cs-gold); font-size: .78rem; font-weight: 600;
    letter-spacing: 2px; text-transform: uppercase;
  }
  #contacto .cs-titulo { color: var(--cs-navy); }
  #contacto .cs-hero-rule {
    width: 64px; height: 3px; background: var(--cs-gold); margin: .9rem auto 0;
  }

  #contacto .cs-panel {
    border: 1px solid #dfe3e8;
    border-radius: .375rem;
    background: #fff;
  }
  #contacto .cs-panel-header {
    background: #f7f8fa;
    border-bottom: 1px solid #dfe3e8;
    padding: .9rem 1.25rem;
    font-weight: 600;
    color: var(--cs-navy);
    font-size: .95rem;
  }
  #contacto .cs-panel-body { padding: 1.25rem; }

  #contacto .cs-info-row {
    display: flex; align-items: flex-start; gap: .85rem;
    padding: .65rem 0; border-bottom: 1px solid #eef0f3;
  }
  #contacto .cs-info-row:last-of-type { border-bottom: none; }
  #contacto .cs-info-row i { color: var(--cs-blue); font-size: 1.05rem; margin-top: .15rem; width: 18px; text-align: center; }
  #contacto .cs-info-label { font-size: .72rem; text-transform: uppercase; letter-spacing: .5px; color: #6c757d; margin-bottom: .1rem; }

  #contacto .cs-copy-btn { border: none; background: transparent; color: #8a919b; padding: 0 .25rem; }
  #contacto .cs-copy-btn:hover { color: var(--cs-blue); }

  #contacto .cs-status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 6px; }
  #contacto .cs-status-dot.abierto { background: #2e7d32; }
  #contacto .cs-status-dot.cerrado { background: #b3261e; }

  #contacto .cs-social a {
    color: var(--cs-navy); border: 1px solid #dfe3e8; border-radius: .3rem;
    width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center;
    text-decoration: none; font-size: 1rem;
  }
  #contacto .cs-social a:hover { border-color: var(--cs-blue); color: var(--cs-blue); }

  #contacto .form-label { font-size: .85rem; color: var(--cs-navy); }
  #contacto .cs-char-counter { font-size: .78rem; }
  #contacto .cs-char-counter.text-danger { font-weight: 600; }
  #contacto .btn-cs-primary {
    background: var(--cs-navy); border-color: var(--cs-navy); color: #fff;
    border-radius: .3rem; font-weight: 600; letter-spacing: .3px;
  }
  #contacto .btn-cs-primary:hover { background: var(--cs-blue); border-color: var(--cs-blue); color: #fff; }

  #contacto .cs-dir-table { border: 1px solid #dfe3e8; border-radius: .375rem; overflow: hidden; }
  #contacto .cs-dir-item {
    display: flex; align-items: center; gap: 1rem;
    padding: .9rem 1.25rem; border-bottom: 1px solid #eef0f3;
  }
  #contacto .cs-dir-item:last-child { border-bottom: none; }
  #contacto .cs-dir-item i { color: var(--cs-blue); font-size: 1.15rem; width: 22px; text-align: center; }
  #contacto .cs-dir-nombre { font-weight: 600; color: var(--cs-navy); font-size: .92rem; }
  #contacto .cs-dir-desc { color: #6c757d; font-size: .82rem; }
  #contacto .cs-dir-item .btn { border-radius: .3rem; font-size: .82rem; }

  #contacto .accordion-button { color: var(--cs-navy); font-weight: 600; font-size: .92rem; border-radius: 0 !important; }
  #contacto .accordion-button:not(.collapsed) { background: #f7f8fa; color: var(--cs-navy); box-shadow: none; }
  #contacto .accordion-button:focus { box-shadow: none; }
  #contacto .accordion-item { border-color: #dfe3e8; }

  #contacto .cs-dir-btn { border-color: var(--cs-blue); color: var(--cs-blue); }
  #contacto .cs-dir-btn:hover { background: var(--cs-blue); border-color: var(--cs-blue); color: #fff; }

  #contacto .cs-alerta-wrapper .alert { border-radius: .3rem; border-width: 1px 1px 1px 4px; }
  #contacto #cs-btn-enviar:disabled { opacity: .75; cursor: progress; }
  #contacto #cs-btn-enviar .spinner-border { width: .9rem; height: .9rem; border-width: .15em; }
</style>

<section id="contacto" class="py-5 bg-white">
  <div class="container">

    <div class="text-center mb-5">
      <div class="cs-eyebrow">Instituto Nacional de Ciudad Barrios</div>
      <h2 class="fw-bold fs-3 cs-titulo mt-1">Contacto</h2>
      <p class="text-muted mb-0">¿Tienes alguna consulta? Escríbenos y te responderemos a la brevedad.</p>
      <div class="cs-hero-rule"></div>
    </div>

    <div class="row g-4">

      <!-- Información y mapa -->
      <div class="col-lg-6">
        <div class="cs-panel h-100 d-flex flex-column">
          <div class="cs-panel-header">Información de contacto</div>
          <div class="cs-panel-body flex-grow-1 d-flex flex-column">

            <div class="cs-info-row">
              <i class="bi bi-geo-alt-fill"></i>
              <div class="flex-grow-1">
                <div class="cs-info-label">Dirección</div>
                <span id="cs-direccion-texto">4ta. Av. Sur #7, Barrio Concepción, Ciudad Barrios, San Miguel Norte, El Salvador</span>
                <a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d968.8135726854701!2d-88.27051766111268!3d13.763532816254862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f64da4bfeecc3f1%3A0x4ab43da4795d990a!2sInstituto%20Nacional%20de%20Ciudad%20Barrios!5e0!3m2!1ses!2ssv!4v1763186476060!5m2!1ses!2ssv" class="d-block small mt-1" style="color: var(--cs-blue);">Cómo llegar <i class="bi bi-arrow-up-right small"></i></a>
              </div>
              <button type="button" class="cs-copy-btn" title="Copiar dirección" data-copy="4ta. Av. Sur #7, Barrio Concepción, Ciudad Barrios, San Miguel Norte, El Salvador">
                <i class="bi bi-clipboard"></i>
              </button>
            </div>

            <div class="cs-info-row align-items-center">
              <i class="bi bi-telephone-fill"></i>
              <div class="flex-grow-1">
                <div class="cs-info-label">Teléfono</div>
                <span id="cs-telefono-texto">(+503) 6692-6477</span>
              </div>
              <button type="button" class="cs-copy-btn" title="Copiar teléfono" data-copy="(+503) 6692-6477">
                <i class="bi bi-clipboard"></i>
              </button>
            </div>

            <div class="cs-info-row align-items-center">
              <i class="bi bi-envelope-fill"></i>
              <div class="flex-grow-1">
                <div class="cs-info-label">Correo electrónico</div>
                <a href="mailto:19977355@incb.edu.sv" class="text-decoration-none" id="cs-correo-texto">19977355@incb.edu.sv</a>
              </div>
              <button type="button" class="cs-copy-btn" title="Copiar correo" data-copy="19977355@incb.edu.sv">
                <i class="bi bi-clipboard"></i>
              </button>
            </div>

            <div class="cs-info-row align-items-center">
              <i class="bi bi-clock-fill"></i>
              <div>
                <div class="cs-info-label">Horario de atención</div>
                <span id="cs-horario-estado" aria-live="polite"><span class="cs-status-dot"></span>Verificando horario...</span>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
              <span class="cs-info-label mb-0">Canales digitales</span>
              <div class="cs-social d-flex gap-2">
                <a href="https://wa.me/50366926477" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                <a href="https://www.facebook.com" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com" title="Instagram"><i class="bi bi-instagram"></i></a>
              </div>
            </div>

            <iframe title="Mapa de ubicación del INCB"
                    class="w-100 border mt-3" style="border-radius:.3rem;" height="200" loading="lazy" allowfullscreen
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d968.8135726854701!2d-88.27051766111268!3d13.763532816254862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f64da4bfeecc3f1%3A0x4ab43da4795d990a!2sInstituto%20Nacional%20de%20Ciudad%20Barrios!5e0!3m2!1ses!2ssv!4v1763186476060!5m2!1ses!2ssv">
            </iframe>
          </div>
        </div>
      </div>

      <!-- Formulario -->
      <div class="col-lg-6">
        <div class="cs-panel h-100 d-flex flex-column">
          <div class="cs-panel-header">Enviar un mensaje</div>
          <div class="cs-panel-body flex-grow-1">
            <form action="#contacto" method="POST" class="needs-validation" id="cs-form" novalidate>
              <input type="hidden" name="contacto_submit" value="1">
              <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">

              <div class="mb-3">
                <label for="cs_nombre" class="form-label fw-semibold">Nombre <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="cs_nombre" name="nombre"
                       placeholder="Tu nombre completo" value="<?= htmlspecialchars($cs_nombre); ?>" required>
                <div class="invalid-feedback">Por favor ingresa tu nombre.</div>
              </div>

              <div class="mb-3">
                <label for="cs_correo" class="form-label fw-semibold">Correo electrónico</label>
                <input class="form-control" type="email" id="cs_correo" name="correo"
                       placeholder="ejemplo@correo.com" value="<?= htmlspecialchars($cs_correo); ?>">
                <div class="invalid-feedback">Ingresa un correo válido.</div>
              </div>

              <div class="mb-1">
                <label for="cs_mensaje" class="form-label fw-semibold">Mensaje</label>
                <textarea class="form-control" id="cs_mensaje" name="mensaje" rows="4" maxlength="500"
                          placeholder="Escribe tu mensaje aquí..."><?= htmlspecialchars($cs_mensaje); ?></textarea>
              </div>
              <div class="text-end cs-char-counter text-muted mb-3" id="cs-contador">0 / 500</div>

              <button class="btn btn-cs-primary w-100 py-2" type="submit" id="cs-btn-enviar">
                <span id="cs-btn-texto">Enviar mensaje</span>
              </button>

              <div class="d-flex justify-content-between align-items-center mt-2">
                <span class="text-muted" style="font-size: .78rem;"><span class="text-danger">*</span> Campo obligatorio</span>
                <span class="text-muted" style="font-size: .78rem;"><i class="bi bi-clock-history me-1"></i>Respuesta en 24–48h</span>
              </div>
            </form>
            <div id="cs-alerta-wrapper" class="cs-alerta-wrapper" aria-live="polite"><?= $cs_alerta; ?></div>
          </div>
        </div>
      </div>

    </div>

    <!-- Directorio institucional por área -->
    <div class="mt-5 pt-4 border-top">
      <h3 class="h5 fw-bold cs-titulo text-center mb-1">Directorio institucional</h3>
      <p class="text-muted text-center small mb-4">Todas las áreas atienden por el mismo número institucional; se muestran separadas para facilitar tu consulta.</p>

      <div class="cs-dir-table">

        <div class="cs-dir-item">
          <i class="bi bi-person-badge"></i>
          <div class="flex-grow-1">
            <div class="cs-dir-nombre">Dirección</div>
            <div class="cs-dir-desc">Asuntos generales</div>
          </div>
          <a href="https://wa.me/50366926477" class="btn btn-sm btn-outline-primary cs-dir-btn">
            <i class="bi bi-whatsapp me-1"></i>Contactar
          </a>
        </div>

        <div class="cs-dir-item">
          <i class="bi bi-journal-bookmark"></i>
          <div class="flex-grow-1">
            <div class="cs-dir-nombre">Registro Académico</div>
            <div class="cs-dir-desc">Inscripciones y constancias</div>
          </div>
          <a href="https://wa.me/50366926477" class="btn btn-sm btn-outline-primary cs-dir-btn">
            <i class="bi bi-whatsapp me-1"></i>Contactar
          </a>
        </div>

        <div class="cs-dir-item">
          <i class="bi bi-code-slash"></i>
          <div class="flex-grow-1">
            <div class="cs-dir-nombre">Coord. Desarrollo de Software</div>
            <div class="cs-dir-desc">Consultas de la especialidad</div>
          </div>
          <a href="https://wa.me/50366926477" class="btn btn-sm btn-outline-primary cs-dir-btn">
            <i class="bi bi-whatsapp me-1"></i>Contactar
          </a>
        </div>

        <div class="cs-dir-item">
          <i class="bi bi-mortarboard"></i>
          <div class="flex-grow-1">
            <div class="cs-dir-nombre">Orientación Estudiantil</div>
            <div class="cs-dir-desc">Apoyo y bienestar del alumnado</div>
          </div>
          <a href="https://wa.me/50366926477" class="btn btn-sm btn-outline-primary cs-dir-btn">
            <i class="bi bi-whatsapp me-1"></i>Contactar
          </a>
        </div>

      </div>
    </div>

    <!-- Preguntas frecuentes -->
    <div class="mt-5 pt-4 border-top">
      <h3 class="h5 fw-bold cs-titulo text-center mb-4">Preguntas frecuentes</h3>
      <div class="accordion" id="cs-accordion">

        <div class="accordion-item">
          <h4 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cs-faq-1">
              ¿En cuánto tiempo responden los mensajes?
            </button>
          </h4>
          <div id="cs-faq-1" class="accordion-collapse collapse" data-bs-parent="#cs-accordion">
            <div class="accordion-body">Normalmente respondemos en un plazo de 24 a 48 horas hábiles.</div>
          </div>
        </div>

        <div class="accordion-item">
          <h4 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cs-faq-2">
              ¿Puedo hacer mi consulta por WhatsApp?
            </button>
          </h4>
          <div id="cs-faq-2" class="accordion-collapse collapse" data-bs-parent="#cs-accordion">
            <div class="accordion-body">Sí, puedes escribirnos directamente al número institucional desde el directorio de esta sección.</div>
          </div>
        </div>

        <div class="accordion-item">
          <h4 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cs-faq-3">
              ¿Es obligatorio dejar mi correo electrónico?
            </button>
          </h4>
          <div id="cs-faq-3" class="accordion-collapse collapse" data-bs-parent="#cs-accordion">
            <div class="accordion-body">No, el correo es opcional. Solo el nombre es obligatorio, pero si deseas una respuesta por ese medio te recomendamos incluirlo.</div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

  // Validación visual del formulario (no reemplaza la validación PHP)
  var form = document.getElementById('cs-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        form.classList.add('was-validated');
        return;
      }
      form.classList.add('was-validated');

      // Estado de carga del botón mientras se procesa el envío en el servidor
      var btn = document.getElementById('cs-btn-enviar');
      var btnTexto = document.getElementById('cs-btn-texto');
      if (btn && btnTexto) {
        btn.disabled = true;
        btnTexto.innerHTML = '<span class="spinner-border me-2" role="status" aria-hidden="true"></span>Enviando...';
      }
    }, false);
  }

  // Contador de caracteres del mensaje
  var mensaje = document.getElementById('cs_mensaje');
  var contador = document.getElementById('cs-contador');
  if (mensaje && contador) {
    var actualizarContador = function () {
      var max = mensaje.getAttribute('maxlength');
      var actual = mensaje.value.length;
      contador.textContent = actual + ' / ' + max;
      contador.classList.toggle('text-danger', actual >= max - 20);
    };
    mensaje.addEventListener('input', actualizarContador);
    actualizarContador();
  }

  // Copiar teléfono / correo al portapapeles
  document.querySelectorAll('.cs-copy-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var texto = btn.getAttribute('data-copy');
      navigator.clipboard.writeText(texto).then(function () {
        var icono = btn.querySelector('i');
        icono.classList.remove('bi-clipboard');
        icono.classList.add('bi-clipboard-check-fill');
        setTimeout(function () {
          icono.classList.remove('bi-clipboard-check-fill');
          icono.classList.add('bi-clipboard');
        }, 1500);
      });
    });
  });

  // Indicador de horario de atención (Lunes a Viernes, 7:30am - 4:00pm)
  var estado = document.getElementById('cs-horario-estado');
  if (estado) {
    var ahora = new Date();
    var dia = ahora.getDay(); // 0 = domingo, 6 = sábado
    var minutosAhora = ahora.getHours() * 60 + ahora.getMinutes();
    var abre = 7 * 60 + 30;
    var cierra = 16 * 60;
    var abierto = dia >= 1 && dia <= 5 && minutosAhora >= abre && minutosAhora <= cierra;

    estado.innerHTML = '<span class="cs-status-dot ' + (abierto ? 'abierto' : 'cerrado') + '"></span>' +
      (abierto ? 'Abierto ahora · L-V 7:30am a 4:00pm' : 'Cerrado ahora · L-V 7:30am a 4:00pm');
  }

  // Si el servidor devolvió una alerta (envío ya procesado), desplazarse hacia ella
  var alerta = document.querySelector('#cs-alerta-wrapper .alert');
  if (alerta) {
    alerta.scrollIntoView({ behavior: 'smooth', block: 'center' });
  }
});
</script>

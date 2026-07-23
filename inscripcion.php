<?php
$page_title = 'Inscripción Nuevo Ingreso | INCB';
$page_desc  = 'Ficha de inscripción para aspirantes a nuevo ingreso del Instituto Nacional de Ciudad Barrios (INCB).';
require 'includes/header.php';
?>

<style>
  .req::after { content: " *"; color: #dc2626; }
  .form-section {
    border-top: 3px solid var(--incb-azul);
    border-radius: .5rem;
    padding: 1.5rem;
    margin-top: 2rem;
    background-color: #fff;
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
  }
  .form-section-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--incb-azul-oscuro);
  }
</style>

<main class="py-5" style="background-color: var(--incb-azul-claro);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="p-4 p-md-5 bg-white border rounded-4 shadow-sm">

          <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h1 class="h4 fw-bold m-0">Ficha de inscripción para aspirantes a nuevo ingreso 2027</h1>
            <span class="badge rounded-pill" style="background: var(--incb-azul);">2027</span>
          </div>
          <p class="text-muted">
            Completa cuidadosamente la información solicitada. Los campos con <span class="req"></span> son obligatorios.
          </p>

          <!-- Campos ocultos: acción SQL, año y ID del centro — el usuario no los ve ni los modifica -->
          <form id="ficha" method="post" action="guardar.php" onsubmit="return validarFicha();">
            <input type="hidden" name="action" value="insert">
            <input type="hidden" name="ano_ingreso" value="2027">
            <input type="hidden" name="centro_educativo_id" value="1">

            <div class="alert mb-4 p-3 border-0 mt-3 rounded-3" style="background-color: var(--incb-azul-claro);">
              <div class="d-flex align-items-center">
                <div class="me-3 display-6" style="color: var(--incb-azul); opacity: .85;">
                  <i class="bi bi-bank"></i>
                </div>
                <div>
                  <h5 class="mb-1 fw-bold" style="color: var(--incb-azul-oscuro);">Centro Educativo de Registro</h5>
                  <p class="mb-0 fs-5">Instituto Nacional de Ciudad Barrios</p>
                </div>
              </div>
            </div>

            <!-- 1. Identificación del estudiante -->
            <div class="form-section">
              <h2 class="form-section-title">1. Datos del estudiante</h2>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label req">Nombres del estudiante (Según partida o DUI)</label>
                  <input name="nombres" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label req">Apellidos del estudiante (Según partida o DUI)</label>
                  <input name="apellidos" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label req">Fecha de nacimiento</label>
                  <input type="date" name="fecha_nac" class="form-control" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label req">Género</label>
                  <select name="genero" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <option>Masculino</option>
                    <option>Femenino</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Nº de DUI del estudiante</label>
                  <input name="dui_estudiante" class="form-control" placeholder="00000000-0" oninput="formatDUI(this)" maxlength="10">
                </div>
                <div class="col-md-4">
                  <label class="form-label req">NIE del estudiante</label>
                  <input id="nie" name="nie" class="form-control" required pattern="\d{6,12}" minlength="6" maxlength="12" placeholder="Ej. 19942410">
                </div>
                <div class="col-md-4">
                  <label class="form-label req">Número de teléfono del estudiante</label>
                  <input name="tel_estudiante" class="form-control" required oninput="formatPhoneNumber(this)" maxlength="9" placeholder="0000-0000">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Correo electrónico personal del estudiante</label>
                  <input type="email" name="email_estudiante" class="form-control" placeholder="nombre@correo.com">
                </div>
                <div class="col-md-6">
                  <label class="form-label req">Centro educativo de procedencia</label>
                  <select id="centro_proc" name="centro_procedencia" class="form-select" required>
                    <option value="">Seleccione…</option>
                    <option>Complejo Educativo General Francisco Morazán</option>
                    <option>Centro Escolar Capitán General Gerardo Barrios</option>
                    <option>Centro Escolar Las Palmeras</option>
                    <option>Centro Escolar Cantón Belén</option>
                    <option>Centro Escolar San Matías</option>
                    <option>Centro Escolar Llano El Ángel</option>
                    <option>Centro Escolar La Torrecilla</option>
                    <option>Centro Escolar La Arenera</option>
                    <option>Centro Escolar Las Marías</option>
                    <option>Centro Escolar Guanaste</option>
                    <option>Centro Escolar Teponahuaste</option>
                    <option>Centro Escolar Cantón San Juan</option>
                    <option>Centro Escolar El Picacho</option>
                    <option>Otro</option>
                  </select>
                  <input id="centro_otro" name="centro_procedencia_otro" class="form-control mt-2 d-none" placeholder="Especifique otro centro">
                </div>
                <div class="col-md-12">
                  <label class="form-label req">Dirección donde vive el estudiante</label>
                  <input name="direccion" class="form-control" required>
                </div>
              </div>
            </div>

            <!-- 2. Oferta a la que aplicas -->
            <div class="form-section">
              <h2 class="form-section-title">2. Oferta a la que aplicas</h2>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label req">Especialidad de bachillerato</label>
                  <select id="especialidad" name="especialidad" class="form-select" required>
                    <option value="">Seleccione…</option>
                    <option>Desarrollo de Software</option>
                    <option>Administrativo contable</option>
                    <option>General</option>
                    <option>General a Distancia</option>
                    <option>No aplica</option>
                    <option>Otro</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-label req">Tercer ciclo de Educación a Distancia</label>
                  <select id="tercer_ciclo" name="tercer_ciclo" class="form-select" required>
                    <option value="">Seleccione…</option>
                    <option>Séptimo</option>
                    <option>Octavo</option>
                    <option>Noveno</option>
                    <option>No aplica</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- 3. Información del representante legal -->
            <div class="form-section">
              <h2 class="form-section-title">3. Información del representante legal</h2>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label req">Nombre del representante legal</label>
                  <input name="representante_nombre" class="form-control" required>
                </div>
                <div class="col-md-3">
                  <label class="form-label req">Parentesco con el estudiante</label>
                  <select id="parentesco" name="representante_parentesco" class="form-select" required>
                    <option value="">Seleccione…</option>
                    <option>Madre</option>
                    <option>Padre</option>
                    <option>Otro</option>
                  </select>
                  <input id="parentesco_otro" name="representante_parentesco_otro" class="form-control mt-2 d-none" placeholder="Especifique el parentesco">
                </div>
                <div class="col-md-3">
                  <label class="form-label req">Nº de DUI del representante</label>
                  <input name="representante_dui" class="form-control" required oninput="formatDUI(this)" maxlength="10" placeholder="00000000-0">
                </div>
                <div class="col-md-4">
                  <label class="form-label req">Nº de celular del representante</label>
                  <input name="representante_cel" class="form-control" required oninput="formatPhoneNumber(this)" maxlength="9" placeholder="0000-0000">
                </div>
                <div class="col-md-8">
                  <label class="form-label">Correo del representante</label>
                  <input type="email" name="representante_email" class="form-control" placeholder="responsable@correo.com">
                </div>
              </div>
            </div>

            <!-- 4. Recursos que posee el estudiante -->
            <div class="form-section">
              <h2 class="form-section-title">4. Recursos que posee el estudiante</h2>
              <div class="row g-2">
                <div class="col-12 small text-muted">Puede elegir más de una opción.</div>
                <div class="col-md-12">
                  <div class="d-flex flex-wrap gap-3">
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="recursos[]" value="Teléfono Inteligente"> Teléfono Inteligente</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="recursos[]" value="Tablet"> Tablet</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="recursos[]" value="Computadora de Escritorio"> Computadora de Escritorio</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="recursos[]" value="Laptop"> Laptop</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="recursos[]" value="Internet Residencial"> Internet Residencial</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="recursos[]" value="Paquetes de Datos Móviles"> Paquetes de Datos Móviles</label>
                  </div>
                </div>
              </div>
            </div>

            <!-- 5. Habilidades que posee el estudiante -->
            <div class="form-section">
              <h2 class="form-section-title">5. Habilidades que posee el estudiante</h2>
              <div class="row g-2">
                <div class="col-12 small text-muted">Puede elegir más de una opción.</div>
                <div class="col-md-12">
                  <div class="d-flex flex-wrap gap-3">
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Música"> Música</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Futbol Femenino"> Futbol Femenino</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Futbol Masculino"> Futbol Masculino</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Ping pong"> Ping pong</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Softball"> Softball</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Danza"> Danza</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Oratoria"> Oratoria</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Poesía"> Poesía</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Teatro"> Teatro</label>
                    <label class="form-check"><input class="form-check-input" type="checkbox" name="habilidades[]" value="Ajedrez"> Ajedrez</label>
                  </div>
                  <div class="mt-2">
                    <label class="form-label">Otro (especifique)</label>
                    <input name="habilidad_otro" class="form-control" placeholder="Otra habilidad">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-check mt-4">
              <input class="form-check-input" type="checkbox" id="acepto" required>
              <label class="form-check-label" for="acepto">
                Declaro que la información proporcionada es verídica y autorizo su tratamiento para fines de admisión.
              </label>
            </div>

            <div class="d-flex gap-2 mt-4">
              <a href="<?= $base_url; ?>oferta_academica.php" class="btn btn-outline-secondary">Regresar</a>
              <button class="btn btn-primary" type="submit">Enviar inscripción</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</main>

<script>
  /**
   * formatPhoneNumber — Formatea automáticamente el teléfono mientras el usuario escribe.
   * Elimina caracteres no numéricos y agrega el guión en la posición correcta.
   * Resultado esperado: "7777-8888"
   */
  function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, ''); // elimina todo lo que no sea dígito
    if (value.length > 8) value = value.substring(0, 8); // máximo 8 dígitos
    input.value = value.length > 4 ? value.substring(0, 4) + '-' + value.substring(4) : value;
  }

  /**
   * formatDUI — Formatea el DUI salvadoreño en tiempo real.
   * Resultado esperado: "12345678-9"
   */
  function formatDUI(input) {
    let value = input.value.replace(/\D/g, ''); // elimina caracteres no numéricos
    if (value.length > 9) value = value.substring(0, 9); // máximo 9 dígitos
    input.value = value.length > 8 ? value.substring(0, 8) + '-' + value.substring(8) : value;
  }

  // Prefill del campo NIE desde la URL: ej. inscripcion.php?nie=19942410
  // Permite llegar al formulario con el NIE ya completado desde un link externo
  (function () {
    const params = new URLSearchParams(window.location.search);
    const nie = params.get('nie'); // lee el parámetro ?nie= de la URL
    const input = document.getElementById('nie');
    if (nie && input && !input.value) { input.value = nie; } // solo si el campo está vacío
  })();

  // Muestra/oculta el campo de texto libre cuando el usuario elige "Otro" en centro de procedencia
  const centro = document.getElementById('centro_proc');
  const centroOtro = document.getElementById('centro_otro');
  centro.addEventListener('change', () => {
    const show = centro.value === 'Otro';
    centroOtro.classList.toggle('d-none', !show); // d-none = oculto con Bootstrap
    centroOtro.required = show; // lo hace obligatorio solo si está visible
    if (!show) centroOtro.value = ''; // limpia el campo si se oculta
  });

  // Misma lógica para "Otro" en parentesco del representante legal
  const parentesco = document.getElementById('parentesco');
  const parentescoOtro = document.getElementById('parentesco_otro');
  parentesco.addEventListener('change', () => {
    const show = parentesco.value === 'Otro';
    parentescoOtro.classList.toggle('d-none', !show);
    parentescoOtro.required = show;
    if (!show) parentescoOtro.value = '';
  });

  // Sincronización especialidad ↔ tercer_ciclo:
  // Si el alumno va a bachillerato normal, "Tercer ciclo" debe ser "No aplica" y viceversa
  const especialidad = document.getElementById('especialidad');
  const tercer = document.getElementById('tercer_ciclo');
  function syncTercerCiclo() {
    if (especialidad.value === 'No aplica') {
      if (tercer.value === 'No aplica') tercer.value = '';
    } else {
      tercer.value = 'No aplica'; // fuerza "No aplica" en tercer ciclo si hay especialidad
    }
  }
  especialidad.addEventListener('change', syncTercerCiclo);
  tercer.addEventListener('change', () => {
    if (especialidad.value !== 'No aplica' && tercer.value !== 'No aplica') {
      alert('Si seleccionas una especialidad de bachillerato, "Tercer ciclo" debe ser "No aplica".');
      tercer.value = 'No aplica';
    }
  });

  /**
   * validarFicha — Validación del lado del cliente antes de enviar el formulario.
   * Complementa la validación HTML5 (required, pattern) con reglas de negocio adicionales.
   * Retorna false para detener el envío si hay errores.
   */
  function validarFicha() {
    // Verifica que el NIE tenga entre 6 y 12 dígitos (solo números)
    const nie = document.getElementById('nie').value.trim();
    if (!/^\d{6,12}$/.test(nie)) { alert('NIE inválido.'); return false; }

    // Verifica que el teléfono del estudiante tenga el formato 0000-0000
    const telEstudiante = document.querySelector('input[name="tel_estudiante"]');
    if (telEstudiante && !/^\d{4}-\d{4}$/.test(telEstudiante.value)) {
      alert('El número de teléfono del estudiante debe tener el formato 0000-0000.');
      telEstudiante.focus();
      return false;
    }
    // Verifica el teléfono del representante con el mismo formato
    const telRepresentante = document.querySelector('input[name="representante_cel"]');
    if (telRepresentante && !/^\d{4}-\d{4}$/.test(telRepresentante.value)) {
      alert('El número de celular del representante debe tener el formato 0000-0000.');
      telRepresentante.focus();
      return false;
    }

    // El DUI del estudiante es opcional, pero si se ingresa debe ser válido (00000000-0)
    const duiEstudiante = document.querySelector('input[name="dui_estudiante"]');
    if (duiEstudiante && duiEstudiante.value !== '' && !/^\d{8}-\d$/.test(duiEstudiante.value)) {
      alert('El número de DUI del estudiante debe tener el formato 00000000-0.');
      duiEstudiante.focus();
      return false;
    }
    // El DUI del representante siempre es obligatorio
    const duiRepresentante = document.querySelector('input[name="representante_dui"]');
    if (duiRepresentante && !/^\d{8}-\d$/.test(duiRepresentante.value)) {
      alert('El número de DUI del representante debe tener el formato 00000000-0.');
      duiRepresentante.focus();
      return false;
    }

    // Regla de negocio: especialidad y tercer ciclo son mutuamente excluyentes
    if (especialidad.value === '') { alert('Selecciona una especialidad.'); return false; }
    if (especialidad.value === 'No aplica' && (tercer.value === '' || tercer.value === 'No aplica')) {
      alert('Si seleccionas "No aplica" en especialidad, debes elegir Séptimo/Octavo/Noveno en "Tercer ciclo".');
      return false;
    }
    return true; // todo válido: el formulario se envía
  }
</script>

<?php require 'includes/footer.php'; ?>

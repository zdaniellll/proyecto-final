<?php
// --- Noticias institucionales (Base de datos con fallback predeterminado) ----
require_once __DIR__ . '/../includes/config.php';
$noticias = [];

// Intenta obtener las noticias recientes publicadas desde el panel de administración
if (file_exists(__DIR__ . '/../includes/conexion.php')) {
    require_once __DIR__ . '/../includes/conexion.php';
    $tabla_n_check = mysqli_query($conexion, "SHOW TABLES LIKE 'noticias_institucionales'");
    if ($tabla_n_check && mysqli_num_rows($tabla_n_check) > 0) {
        $res_noticias = mysqli_query($conexion, "SELECT titulo, fecha_publicacion FROM noticias_institucionales ORDER BY id DESC LIMIT 6");
        if ($res_noticias && mysqli_num_rows($res_noticias) > 0) {
            $meses = ['01'=>'Ene','02'=>'Feb','03'=>'Mar','04'=>'Abr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Ago','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dic'];
            $img_pool = [
                $base_url . 'img/imagen_noticias1.jfif',
                $base_url . 'img/imagen_noticias2.jfif',
                $base_url . 'img/imagen_noticias3.jfif',
                $base_url . 'img/imagen_noticias4.jfif',
                $base_url . 'img/imagen_noticias5.jfif',
                $base_url . 'img/danza.jpg',
            ];
            $idx = 0;
            while ($row = mysqli_fetch_assoc($res_noticias)) {
                $time = strtotime($row['fecha_publicacion'] ?? 'now');
                $m_num = date('m', $time);
                $noticias[] = [
                    'titulo' => $row['titulo'],
                    'dia'    => date('d', $time),
                    'mes'    => $meses[$m_num] ?? date('M', $time),
                    'anio'   => date('Y', $time),
                    'img'    => $img_pool[$idx % count($img_pool)],
                ];
                $idx++;
            }
        }
    }
}

// Si la base de datos no tiene noticias aún, muestra las noticias institucionales predeterminadas
if (empty($noticias)) {
    $noticias = [
      [
        'titulo' => 'Inauguración del Año Escolar y Bienvenida Estudiantil',
        'dia'    => '20', 'mes' => 'Feb', 'anio' => '2026',
        'img'    => $base_url . 'img/imagen_noticias1.jfif',
      ],
      [
        'titulo' => 'Feria de Ciencia, Robótica y Tecnología INCB',
        'dia'    => '28', 'mes' => 'May', 'anio' => '2026',
        'img'    => $base_url . 'img/imagen_noticias2.jfif',
      ],
      [
        'titulo' => 'Convocatoria Abierta de Admisión y Matrícula',
        'dia'    => '15', 'mes' => 'Ene', 'anio' => '2026',
        'img'    => $base_url . 'img/imagen_noticias3.jfif',
      ],
      [
        'titulo' => 'Actividades Culturales y Expresión Artística',
        'dia'    => '10', 'mes' => 'Abr', 'anio' => '2026',
        'img'    => $base_url . 'img/imagen_noticias4.jfif',
      ],
      [
        'titulo' => 'Reconocimientos Académicos a Estudiantes Destacados',
        'dia'    => '28', 'mes' => 'May', 'anio' => '2026',
        'img'    => $base_url . 'img/imagen_noticias5.jfif',
      ],
      [
        'titulo' => 'Jornada de Orientación Vocacional y Profesional',
        'dia'    => '03', 'mes' => 'Jun', 'anio' => '2026',
        'img'    => $base_url . 'img/danza.jpg',
      ],
    ];
}
?>

<!-- ── Sección Noticias ── -->
<section id="noticias" class="py-5" style="background-color: #f0f4f8; overflow-x: hidden;">
  <div class="container-fluid px-0">

    <div class="text-center mb-4">
      <h2 class="fw-bold fs-3 incb-titulo" style="letter-spacing: 2px;">
        <i class="bi bi-newspaper me-2"></i>NOTICIAS Y EVENTOS
      </h2>
    </div>

    <!-- Cuadrícula de tarjetas: recorre el array $noticias -->
    <div class="row g-0">
      <?php foreach ($noticias as $n): ?>
      <div class="col-12 col-md-6 col-lg-4 noticia-card position-relative overflow-hidden">

        <!-- Imagen de fondo de la tarjeta -->
        <img src="<?= $n['img']; ?>" alt="<?= htmlspecialchars($n['titulo']); ?>"
             class="w-100 h-100 object-fit-cover noticia-img">

        <!-- Degradado oscuro en la parte inferior para mejorar legibilidad del texto -->
        <div class="position-absolute bottom-0 start-0 w-100"
             style="height: 60%; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.85) 100%);"></div>

        <!-- Fecha en esquina superior derecha -->
        <div class="position-absolute top-0 end-0 text-center text-white py-2 px-3 m-3"
             style="background-color: rgba(30, 30, 30, 0.7); min-width: 60px;">
          <div style="font-size: 0.8rem; font-weight: normal;"><?= $n['mes']; ?></div>
          <div style="font-size: 1.8rem; font-weight: bold; line-height: 1; margin: 3px 0;"><?= $n['dia']; ?></div>
          <div style="font-size: 0.8rem; font-weight: normal; border-top: 1px solid rgba(255,255,255,0.4); padding-top: 2px;"><?= $n['anio']; ?></div>
        </div>

        <!-- Título de la noticia superpuesto sobre la imagen -->
        <div class="position-absolute bottom-0 start-0 w-100 text-white text-center px-4 pb-4">
          <h5 class="fw-normal m-0" style="font-size: 1.1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.8);">
            <?= htmlspecialchars($n['titulo']); ?>
          </h5>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<style>
  /* ── Tarjetas de noticias ── */
  .noticia-card {
    height: 400px;
    cursor: pointer;
    box-shadow: inset 0 0 0 1px #1a252f;
    /* Estado inicial: oculta y desplazada hacia la derecha (animación de entrada) */
    opacity: 0;
    transform: translateX(100px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
  }

  /* El script agrega .visible cuando la tarjeta entra al viewport */
  .noticia-card.visible {
    opacity: 1;
    transform: translateX(0);
  }

  /* Zoom-in suave en la imagen al pasar el mouse */
  .noticia-img { transition: transform 0.4s ease; }
  .noticia-card:hover .noticia-img { transform: scale(1.05); }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // IntersectionObserver: activa la animación cuando la tarjeta es visible en pantalla
    const opciones = {
      root: null,        // referencia al viewport
      rootMargin: '0px',
      threshold: 0.15    // se activa cuando el 15% de la tarjeta es visible
    };

    const observador = new IntersectionObserver((entradas, observador) => {
      entradas.forEach((entrada) => {
        if (entrada.isIntersecting) {
          entrada.target.classList.add('visible');
          observador.unobserve(entrada.target); // deja de observar para no repetir la animación
        }
      });
    }, opciones);

    // Asigna retraso escalonado (0s, 0.15s, 0.3s) para tarjetas de la misma fila
    document.querySelectorAll('.noticia-card').forEach((tarjeta, index) => {
      tarjeta.style.transitionDelay = `${(index % 3) * 0.15}s`;
      observador.observe(tarjeta);
    });
  });
</script>
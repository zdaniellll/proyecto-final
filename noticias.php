<?php
/**
 * noticias.php
 * Sección de Noticias del INCB
 */

// Tu array $noticias queda exactamente igual
$noticias = [
  [
    'titulo' => 'agregar algo',
    'dia'    => '20', 'mes' => 'Feb', 'anio' => '2026',
    'img'    => $base_url . 'img/imagen_noticias1.jfif',
  ],
  [
    'titulo' => 'agregar algo',
    'dia'    => '28', 'mes' => 'May', 'anio' => '2025',
    'img'    => $base_url . 'img/imagen_noticias2.jfif',
  ],
  [
    'titulo' => 'agregar algo',
    'dia'    => '06', 'mes' => 'Ene', 'anio' => '2025',
    'img'    => $base_url . 'img/imagen_noticias3.jfif',
  ],
  [
    'titulo' => 'Actividades culturales del INCB',
    'dia'    => '10', 'mes' => 'Abr', 'anio' => '2026',
    'img'    => $base_url . 'img/imagen_noticias4.jfif',
  ],
  [
    'titulo' => 'Reconocimientos académicos a estudiantes destacados',
    'dia'    => '28', 'mes' => 'May', 'anio' => '2026',
    'img'    => $base_url . 'img/imagen_noticias5.jfif',
  ],
  [
    'titulo' => 'Jornada de orientación vocacional 2026',
    'dia'    => '03', 'mes' => 'Jun', 'anio' => '2026',
    'img'    => $base_url . 'img/danza.jpg', // nota: imagen_noticias6.jfif no existía en /img, se usó una imagen disponible como reemplazo temporal
  ],
];
?>

<section id="noticias" class="py-5" style="background-color: #f0f4f8; overflow-x: hidden;">
  <div class="container-fluid px-0">

    <div class="text-center mb-4">
      <h2 class="fw-bold fs-3 incb-titulo" style="letter-spacing: 2px;">
        <i class="bi bi-newspaper me-2"></i>NOTICIAS Y EVENTOS
      </h2>
    </div>

    <div class="row g-0">
      <?php foreach ($noticias as $n): ?>
      <div class="col-12 col-md-6 col-lg-4 noticia-card position-relative overflow-hidden">
        
        <img src="<?= $n['img']; ?>" alt="<?= htmlspecialchars($n['titulo']); ?>"
             class="w-100 h-100 object-fit-cover noticia-img">

        <div class="position-absolute bottom-0 start-0 w-100"
             style="height: 60%; background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.85) 100%);"></div>

        <div class="position-absolute top-0 end-0 text-center text-white py-2 px-3 m-3"
             style="background-color: rgba(30, 30, 30, 0.7); min-width: 60px;">
          <div style="font-size: 0.8rem; font-weight: normal;"><?= $n['mes']; ?></div>
          <div style="font-size: 1.8rem; font-weight: bold; line-height: 1; margin: 3px 0;"><?= $n['dia']; ?></div>
          <div style="font-size: 0.8rem; font-weight: normal; border-top: 1px solid rgba(255,255,255,0.4); padding-top: 2px;"><?= $n['anio']; ?></div>
        </div>

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
  /* ── Sección Noticias (Modo Cuadrícula) ── */
  .noticia-card {
    height: 400px;
    cursor: pointer;
    box-shadow: inset 0 0 0 1px #1a252f;
    
    /* Configuración inicial para la animación: oculto y desplazado a la derecha */
    opacity: 0;
    transform: translateX(100px); 
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
  }
  
  /* Clase que el script agregará cuando la tarjeta sea visible */
  .noticia-card.visible {
    opacity: 1;
    transform: translateX(0);
  }

  .noticia-img {
    transition: transform 0.4s ease;
  }
  .noticia-card:hover .noticia-img {
    transform: scale(1.05);
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Configuramos el observador
    const opciones = {
      root: null, // Usa el viewport del navegador
      rootMargin: '0px',
      threshold: 0.15 // Se activa cuando el 15% de la tarjeta es visible en pantalla
    };

    const observador = new IntersectionObserver((entradas, observador) => {
      entradas.forEach((entrada) => {
        // Si el usuario scrolleó hasta esta tarjeta
        if (entrada.isIntersecting) {
          entrada.target.classList.add('visible');
          
          // Dejamos de observar la tarjeta para que se quede ahí permanentemente
          observador.unobserve(entrada.target);
        }
      });
    }, opciones);

    // Seleccionamos todas las tarjetas de noticias
    const tarjetas = document.querySelectorAll('.noticia-card');
    
    tarjetas.forEach((tarjeta, index) => {
      // Opcional: Agregamos un ligero retraso en cascada para que no aparezcan de golpe 
      // las que están en la misma fila (0s, 0.15s, 0.3s)
      tarjeta.style.transitionDelay = `${(index % 3) * 0.15}s`;
      
      // Le decimos al observador que vigile esta tarjeta
      observador.observe(tarjeta);
    });
  });
</script>
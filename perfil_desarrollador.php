<?php require_once __DIR__ . '/includes/config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Desarrollador | Oscar Daniel Sorto Martinez</title>
    <!-- CSS de Bootstrap 5 local -->
    <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Bootstrap local -->
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f6f9; /* Un tono gris muy claro y profesional */
        }
        .profile-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .bg-header {
            background: linear-gradient(135deg, #2b2d42 0%, #8d99ae 100%);
            height: 120px;
        }
        .foto-perfil {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #ffffff;
            margin-top: -75px;
            background-color: #fff;
        }
        .badge-skill {
            font-weight: 500;
            padding: 0.5em 0.8em;
            background-color: #e9ecef;
            color: #495057;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>

    <div class="container min-vh-100 d-flex justify-content-center align-items-center py-5">
        
        <div class="card profile-card w-100" style="max-width: 850px;">
            <!-- Encabezado con color degradado -->
            <div class="bg-header w-100"></div>
            
            <div class="row g-0">
                <!-- Columna Izquierda: Foto y Contacto -->
                <div class="col-md-4 text-center p-4 border-end">
                    <img src="ruta_a_tu_foto.jpg" class="rounded-circle shadow-sm foto-perfil mb-3" alt="Oscar Daniel Sorto Martinez">
                    <h4 class="fw-bold mb-1">Oscar Daniel</h4>
                    <h4 class="fw-bold mb-3">Sorto Martinez</h4>
                    <p class="text-muted mb-4">Desarrollador Full-Stack</p>
                    
                    <div class="d-flex flex-column gap-2 text-start px-3">
                        <a href="https://github.com/tu-usuario" class="text-decoration-none text-secondary">
                            <i class="bi bi-github me-2 text-dark"></i> GitHub
                        </a>
                        <a href="mailto:tu-correo@ejemplo.com" class="text-decoration-none text-secondary">
                            <i class="bi bi-envelope me-2 text-primary"></i> Contacto
                        </a>
                    </div>
                </div>

                <!-- Columna Derecha: Biografía y Habilidades -->
                <div class="col-md-8 p-5">
                    <h5 class="text-uppercase text-muted fw-bold mb-3" style="letter-spacing: 1px; font-size: 0.85rem;">Sobre el Desarrollador</h5>
                    <p class="text-secondary mb-4" style="line-height: 1.7;">
                        Encargado del diseño, estructuración y desarrollo del <strong>Portal Institucional</strong>. 
                        Especializado en la creación de soluciones web responsivas, seguras y escalables, gestionando 
                        tanto el lado del servidor como la interfaz de usuario para garantizar una experiencia óptima.
                    </p>

                    <h5 class="text-uppercase text-muted fw-bold mb-3 mt-4" style="letter-spacing: 1px; font-size: 0.85rem;">Stack Tecnológico</h5>
                    <div class="d-flex flex-wrap gap-2 mb-5">
                        <span class="badge badge-skill">PHP</span>
                        <span class="badge badge-skill">Laravel</span>
                        <span class="badge badge-skill">MySQL</span>
                        <span class="badge badge-skill">Bootstrap 5</span>
                        <span class="badge badge-skill">HTML & CSS Grid</span>
                        <span class="badge badge-skill">Flexbox</span>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-flex gap-3 mt-auto">
                        <a href="index.php" class="btn btn-dark px-4 py-2 shadow-sm">
                            <i class="bi bi-arrow-left me-2"></i> Volver al Portal
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?= $base_url; ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
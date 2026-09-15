<?php require_once __DIR__ . '/../includes/config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Desarrollador | Oscar Daniel Sorto Martinez - INCB</title>
    <!-- CSS de Bootstrap 5 local -->
    <link href="<?= $base_url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Bootstrap local -->
    <link rel="stylesheet" href="<?= $base_url; ?>assets/css/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .profile-card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        .bg-header {
            background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%);
            height: 140px;
        }
        .foto-perfil {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #ffffff;
            margin-top: -75px;
            background-color: #f8f9fa;
        }
        .badge-skill {
            font-weight: 500;
            padding: 0.6em 1em;
            background-color: #e9ecef;
            color: #495057;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }
        .badge-hardware {
            background-color: #e3f2fd;
            color: #0d47a1;
            border-color: #bbdefb;
        }

        /* Escritorio/tablet: columna de foto y contacto separada con línea vertical */
        @media (min-width: 768px) {
            .col-foto {
                border-right: 1px solid #dee2e6;
            }
        }

        /* Responsivo: pantallas pequeñas */
        @media (max-width: 767.98px) {
            .bg-header {
                height: 100px;
            }
            .foto-perfil {
                width: 110px;
                height: 110px;
                margin-top: -55px;
                border-width: 4px;
            }
            .col-foto {
                border-bottom: 1px solid #dee2e6;
            }
            .p-5 {
                padding: 1.75rem !important;
            }
        }
    </style>
</head>
<body>

    <div class="container min-vh-100 d-flex justify-content-center align-items-center py-4 py-md-5 px-3">

        <div class="card profile-card w-100" style="max-width: 900px;">
            <!-- Encabezado con color degradado -->
            <div class="bg-header w-100"></div>

            <div class="row g-0">
                <!-- Columna Izquierda: Foto y Contacto -->
                <div class="col-12 col-md-4 col-foto text-center p-4 bg-white">
                    <img src="<?= app_url('img/daniel.jpeg'); ?>" class="rounded-circle shadow-sm foto-perfil mb-3" alt="Oscar Daniel Sorto Martinez">
                    <h4 class="fw-bold mb-1">Oscar Daniel</h4>
                    <h4 class="fw-bold mb-3">Sorto Martinez</h4>

                    <span class="badge bg-primary mb-2">Desarrollador Web &amp; Soporte Técnico</span>
                    <p class="text-muted small mb-4">Segundo Año - Bachillerato Técnico en Desarrollo de Software</p>

                    <div class="d-flex flex-column gap-3 text-start px-3 mt-4">
                        <a href="https://github.com/zdaniellll" target="_blank" class="text-decoration-none text-secondary custom-link">
                            <i class="bi bi-github me-2 text-dark fs-5 align-middle"></i> Github
                        </a>
                        <a href="mailto:d4886160@gmail.com" class="text-decoration-none text-secondary custom-link">
                            <i class="bi bi-envelope-fill me-2 text-primary fs-5 align-middle"></i> Contacto
                        </a>
                    </div>
                </div>

                <!-- Columna Derecha: Biografía y Habilidades -->
                <div class="col-12 col-md-8 p-5 bg-white">
                    <h5 class="text-uppercase text-muted fw-bold mb-3" style="letter-spacing: 1px; font-size: 0.85rem;">
                        <i class="bi bi-person-lines-fill me-2"></i> Sobre el Desarrollador
                    </h5>
                    <p class="text-secondary mb-4" style="line-height: 1.7; text-align: justify;">
                        Soy estudiante de segundo año del Bachillerato Técnico en Desarrollo de Software en el Instituto Nacional de Ciudad Barrios (INCB). Mi perfil combina la pasión por la programación con la experiencia práctica en el mantenimiento y soporte técnico de computadoras. Para fortalecer mis competencias, completé formación especializada en desarrollo de aplicaciones web. Actualmente, estoy a cargo del desarrollo integral del <strong>Portal Web Institucional</strong>, desde el diseño visual y la experiencia de usuario hasta la programación del frontend y backend, asegurando una plataforma moderna, dinámica y accesible para toda la comunidad educativa.
                    </p>

                    <h5 class="text-uppercase text-muted fw-bold mb-3 mt-5" style="letter-spacing: 1px; font-size: 0.85rem;">
                        <i class="bi bi-code-slash me-2"></i> Stack Tecnológico y Conocimientos
                    </h5>

                    <!-- Desarrollo Web -->
                    <p class="text-muted small fw-bold mb-2">Desarrollo Web</p>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <span class="badge badge-skill">PHP</span>
                        <span class="badge badge-skill">MySQL</span>
                        <span class="badge badge-skill">HTML5</span>
                        <span class="badge badge-skill">Bootstrap 5</span>
                    </div>

                    <!-- Soporte y Hardware -->
                    <p class="text-muted small fw-bold mb-2">Soporte Técnico de Laboratorio</p>
                    <div class="d-flex flex-wrap gap-2 mb-5">
                        <span class="badge badge-skill badge-hardware">Ensamblaje de PC</span>
                        <span class="badge badge-skill badge-hardware">Mantenimiento Preventivo</span>
                        <span class="badge badge-skill badge-hardware">Diagnóstico de Hardware</span>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-flex flex-wrap gap-3 mt-auto pt-3 border-top">
                        <a href="<?= app_url('index.php'); ?>" class="btn btn-outline-secondary px-4 py-2 shadow-sm">
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
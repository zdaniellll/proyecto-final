-- phpMyAdmin SQL Dump
-- Base de datos: `bd_incb`
-- Proyecto: Portal Web Institucional (INCB)
-- Servidor: 127.0.0.1
-- Versión del servidor: MariaDB / MySQL 8.0+

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_incb`
--
CREATE DATABASE IF NOT EXISTS `bd_incb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_incb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
-- Clave por defecto: incb2026
--
INSERT INTO `usuarios` (`id`, `usuario`, `password`, `nombre`, `fecha_creacion`) VALUES
(1, 'admin', '$2b$10$Blwjh5seUfLJuZ6JfxC4P.WWbTEsCPkyiUjKk0/hIIpwcs8E/IgD2', 'Administrador INCB', '2026-06-25 12:00:00')
ON DUPLICATE KEY UPDATE `id` = `id`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_contacto`
--
CREATE TABLE IF NOT EXISTS `mensajes_contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_remitente` varchar(100) NOT NULL,
  `correo_remitente` varchar(100) DEFAULT NULL,
  `mensaje_texto` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes_contacto`
--
INSERT INTO `mensajes_contacto` (`id`, `nombre_remitente`, `correo_remitente`, `mensaje_texto`, `fecha_envio`) VALUES
(26, 'Daniel Sorto', 'd4886160@gmail.com', 'Consulta sobre el proceso de matrícula para nuevo ingreso 2027.', '2026-06-25 13:25:45'),
(28, 'Oscar Martínez', 'contacto@ejemplo.com', 'Solicito información sobre los horarios y cupos del Bachillerato en Desarrollo de Software.', '2026-06-25 15:18:58'),
(30, 'Daniel', 'd4886160@gmail.com', 'Buenas tardes, quisiera saber los requisitos para el Bachillerato General.', '2026-06-26 20:38:09')
ON DUPLICATE KEY UPDATE `id` = `id`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias_institucionales`
--
CREATE TABLE IF NOT EXISTS `noticias_institucionales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `autor` varchar(100) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias_institucionales`
--
INSERT INTO `noticias_institucionales` (`id`, `titulo`, `contenido`, `autor`, `fecha_publicacion`) VALUES
(1, 'Inauguración del Año Escolar y Bienvenida Estudiantil', 'Damos inicio a un nuevo año lectivo lleno de entusiasmo, metas académicas y nuevos desafíos para toda nuestra comunidad educativa.', 'Dirección INCB', '2026-02-20 08:00:00'),
(2, 'Feria de Ciencia, Robótica y Tecnología INCB', 'Nuestros estudiantes de bachillerato técnico demostraron proyectos innovadores, desarrollo de software y prototipos tecnológicos de alto impacto.', 'Coordinación Técnica', '2026-05-28 09:30:00'),
(3, 'Convocatoria Abierta de Admisión y Matrícula', 'Se encuentra abierto el proceso de pre-inscripción y registro para aspirantes de nuevo ingreso en todas las especialidades.', 'Administración', '2026-01-15 10:00:00'),
(4, 'Actividades Culturales y Expresión Artística', 'Presentación destacada de nuestra banda musical y grupo de danza folclórica en las celebraciones cívicas institucionales.', 'Comité Cívico', '2026-04-10 11:00:00'),
(5, 'Reconocimientos Académicos a Estudiantes Destacados', 'Felicitamos a los estudiantes con mejores promedios y rendimiento sobresaliente en cada especialidad durante el periodo evaluativo.', 'Dirección Académica', '2026-05-28 14:00:00'),
(6, 'Jornada de Orientación Vocacional y Profesional', 'Charlas y talleres prácticos orientados a guiar a los futuros bachilleres en la elección de su carrera universitaria y campo laboral.', 'Allan Romero', '2026-06-03 15:30:00')
ON DUPLICATE KEY UPDATE `id` = `id`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--
CREATE TABLE IF NOT EXISTS `inscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` varchar(20) NOT NULL,
  `dui_estudiante` varchar(20) DEFAULT NULL,
  `nie` varchar(20) NOT NULL,
  `tel_estudiante` varchar(20) NOT NULL,
  `email_estudiante` varchar(150) DEFAULT NULL,
  `centro_procedencia` varchar(200) NOT NULL,
  `centro_procedencia_otro` varchar(200) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `especialidad` varchar(120) NOT NULL,
  `tercer_ciclo` varchar(80) NOT NULL,
  `representante_nombre` varchar(150) NOT NULL,
  `representante_parentesco` varchar(80) NOT NULL,
  `representante_parentesco_otro` varchar(120) DEFAULT NULL,
  `representante_dui` varchar(20) NOT NULL,
  `representante_cel` varchar(20) NOT NULL,
  `representante_email` varchar(150) DEFAULT NULL,
  `recursos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `habilidades` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `habilidad_otro` varchar(150) DEFAULT NULL,
  `ano_ingreso` int(11) NOT NULL DEFAULT 2027,
  `centro_educativo_id` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--
CREATE TABLE IF NOT EXISTS `docentes` (
  `id_docente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_docente` varchar(100) DEFAULT NULL,
  `especialidad_tecnica` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--
INSERT INTO `docentes` (`id_docente`, `nombre_docente`, `especialidad_tecnica`) VALUES
(1, 'Allan Romero', 'Desarrollo de Software'),
(2, 'Roberto Hernandez', 'Redes Informaticas')
ON DUPLICATE KEY UPDATE `id_docente` = `id_docente`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id_estudiante` int(11) NOT NULL AUTO_INCREMENT,
  `nombres_estudiante` varchar(100) DEFAULT NULL,
  `apellidos_estudiante` varchar(100) DEFAULT NULL,
  `anio_bachillerato` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_estudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--
INSERT INTO `estudiantes` (`id_estudiante`, `nombres_estudiante`, `apellidos_estudiante`, `anio_bachillerato`) VALUES
(1, 'Juan Carlos', 'Perez', 1),
(2, 'Maria Teresa', 'Gomez', 2)
ON DUPLICATE KEY UPDATE `id_estudiante` = `id_estudiante`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorios`
--
CREATE TABLE IF NOT EXISTS `laboratorios` (
  `id_laboratorio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_laboratorio` varchar(50) DEFAULT NULL,
  `cantidad_equipos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_laboratorio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `laboratorios`
--
INSERT INTO `laboratorios` (`id_laboratorio`, `nombre_laboratorio`, `cantidad_equipos`) VALUES
(1, 'Laboratorio de Computación 1', 30),
(2, 'Laboratorio de Redes y Hardware', 25)
ON DUPLICATE KEY UPDATE `id_laboratorio` = `id_laboratorio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(100) DEFAULT NULL,
  `horas_semanales` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulos`
--
INSERT INTO `modulos` (`id_modulo`, `nombre_modulo`, `horas_semanales`) VALUES
(1, 'Desarrollo de Aplicaciones Web', 8),
(2, 'Mantenimiento de Redes Informáticas', 6),
(3, 'Gestión Contable y Administrativa', 6)
ON DUPLICATE KEY UPDATE `id_modulo` = `id_modulo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_asistencia`
--
CREATE TABLE IF NOT EXISTS `registro_asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(11) DEFAULT NULL,
  `fecha_clase` varchar(20) DEFAULT NULL,
  `estado_asistencia` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_asistencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_asistencia`
--
INSERT INTO `registro_asistencia` (`id_asistencia`, `id_estudiante`, `fecha_clase`, `estado_asistencia`) VALUES
(1, 1, '2026-06-25', 'Presente'),
(2, 2, '2026-06-25', 'Presente')
ON DUPLICATE KEY UPDATE `id_asistencia` = `id_asistencia`;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

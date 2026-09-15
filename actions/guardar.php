<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $base_url . 'inscripcion.php');
    exit();
}

$token = $_POST['csrf_token'] ?? null;
if (!csrf_validar($token)) {
    header('Location: ' . $base_url . 'inscripcion.php?status=error');
    exit();
}

$campos = [
    'nombres', 'apellidos', 'fecha_nac', 'genero', 'dui_estudiante', 'nie', 'tel_estudiante',
    'email_estudiante', 'centro_procedencia', 'centro_procedencia_otro', 'direccion',
    'especialidad', 'tercer_ciclo', 'representante_nombre', 'representante_parentesco',
    'representante_parentesco_otro', 'representante_dui', 'representante_cel',
    'representante_email', 'habilidad_otro', 'ano_ingreso', 'centro_educativo_id'
];

$datos = [];
foreach ($campos as $campo) {
    $datos[$campo] = trim($_POST[$campo] ?? '');
}

$datos['recursos'] = isset($_POST['recursos']) ? json_encode(array_map('strval', $_POST['recursos'])) : json_encode([]);
$datos['habilidades'] = isset($_POST['habilidades']) ? json_encode(array_map('strval', $_POST['habilidades'])) : json_encode([]);

$tabla = 'inscripciones';
$check = mysqli_query($conexion, "SHOW TABLES LIKE '{$tabla}'");
if ($check !== false && mysqli_num_rows($check) === 0) {
    $sqlCrear = "CREATE TABLE `{$tabla}` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `nombres` VARCHAR(100) NOT NULL,
        `apellidos` VARCHAR(100) NOT NULL,
        `fecha_nac` DATE NOT NULL,
        `genero` VARCHAR(20) NOT NULL,
        `dui_estudiante` VARCHAR(20) DEFAULT NULL,
        `nie` VARCHAR(20) NOT NULL,
        `tel_estudiante` VARCHAR(20) NOT NULL,
        `email_estudiante` VARCHAR(150) DEFAULT NULL,
        `centro_procedencia` VARCHAR(200) NOT NULL,
        `centro_procedencia_otro` VARCHAR(200) DEFAULT NULL,
        `direccion` VARCHAR(255) NOT NULL,
        `especialidad` VARCHAR(120) NOT NULL,
        `tercer_ciclo` VARCHAR(80) NOT NULL,
        `representante_nombre` VARCHAR(150) NOT NULL,
        `representante_parentesco` VARCHAR(80) NOT NULL,
        `representante_parentesco_otro` VARCHAR(120) DEFAULT NULL,
        `representante_dui` VARCHAR(20) NOT NULL,
        `representante_cel` VARCHAR(20) NOT NULL,
        `representante_email` VARCHAR(150) DEFAULT NULL,
        `recursos` JSON DEFAULT NULL,
        `habilidades` JSON DEFAULT NULL,
        `habilidad_otro` VARCHAR(150) DEFAULT NULL,
        `ano_ingreso` INT NOT NULL,
        `centro_educativo_id` INT NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if (!mysqli_query($conexion, $sqlCrear)) {
        mysqli_close($conexion);
        header('Location: ' . $base_url . 'inscripcion.php?status=error');
        exit();
    }
}

$stmt = mysqli_prepare($conexion, "INSERT INTO `{$tabla}` (
    nombres, apellidos, fecha_nac, genero, dui_estudiante, nie, tel_estudiante, email_estudiante,
    centro_procedencia, centro_procedencia_otro, direccion, especialidad, tercer_ciclo,
    representante_nombre, representante_parentesco, representante_parentesco_otro, representante_dui,
    representante_cel, representante_email, recursos, habilidades, habilidad_otro, ano_ingreso, centro_educativo_id
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    mysqli_close($conexion);
    header('Location: ' . $base_url . 'inscripcion.php?status=error');
    exit();
}

mysqli_stmt_bind_param(
    $stmt,
    'ssssssssssssssssssssssss',
    $datos['nombres'],
    $datos['apellidos'],
    $datos['fecha_nac'],
    $datos['genero'],
    $datos['dui_estudiante'],
    $datos['nie'],
    $datos['tel_estudiante'],
    $datos['email_estudiante'],
    $datos['centro_procedencia'],
    $datos['centro_procedencia_otro'],
    $datos['direccion'],
    $datos['especialidad'],
    $datos['tercer_ciclo'],
    $datos['representante_nombre'],
    $datos['representante_parentesco'],
    $datos['representante_parentesco_otro'],
    $datos['representante_dui'],
    $datos['representante_cel'],
    $datos['representante_email'],
    $datos['recursos'],
    $datos['habilidades'],
    $datos['habilidad_otro'],
    $datos['ano_ingreso'],
    $datos['centro_educativo_id']
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
    header('Location: ' . $base_url . 'inscripcion.php?status=success');
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conexion);
header('Location: ' . $base_url . 'inscripcion.php?status=error');
exit();

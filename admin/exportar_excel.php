<?php
// --- Exportar mensajes a Excel ----------------------------------------------
// Solo accesible con sesión admin activa (auth.php lo verifica)
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/conexion.php';

// Trae todos los mensajes ordenados del más reciente al más antiguo
$resultado = mysqli_query(
    $conexion,
    "SELECT id, nombre_remitente, correo_remitente, mensaje_texto, fecha_envio
     FROM mensajes_contacto
     ORDER BY id DESC"
);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// --- Cabeceras HTTP ----------------------------------------------------------
// Fuerzan al navegador a descargar el archivo como Excel (.xls)
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Mensajes_INCB_" . date('d-m-Y') . ".xls");
header("Pragma: no-cache"); // sin caché: cada descarga genera el archivo fresco
header("Expires: 0");
?>
<meta charset="utf-8">
<table border="1" cellpadding="6" cellspacing="0">
  <thead>
    <tr>
      <th style="background-color:#0d6efd;color:white;font-weight:bold;">ID</th>
      <th style="background-color:#0d6efd;color:white;font-weight:bold;">Nombre</th>
      <th style="background-color:#0d6efd;color:white;font-weight:bold;">Correo Electrónico</th>
      <th style="background-color:#0d6efd;color:white;font-weight:bold;">Mensaje</th>
      <th style="background-color:#0d6efd;color:white;font-weight:bold;">Fecha de Envío</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
      <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
        <tr>
          <td><?= (int)$fila['id'] ?></td>
          <td><?= htmlspecialchars($fila['nombre_remitente']) ?></td>
          <td><?= htmlspecialchars($fila['correo_remitente'] ?? '') ?></td>
          <td><?= htmlspecialchars($fila['mensaje_texto']) ?></td>
          <td><?= htmlspecialchars($fila['fecha_envio']) ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="5">No hay mensajes para exportar.</td></tr>
    <?php endif; ?>
  </tbody>
</table>
<?php mysqli_close($conexion); ?>

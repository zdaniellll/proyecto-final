<?php
/**
 * exportar_excel.php — Genera y descarga un archivo Excel con todos los mensajes de contacto.
 * REQUIERE sesión activa (auth.php). Solo accesible desde el panel de administración.
 *
 * Técnica: envía cabeceras HTTP que le indican al navegador que la respuesta es un
 * archivo Excel descargable. El contenido real es una tabla HTML que Excel puede abrir.
 * Nota: se usa extensión .xls (formato antiguo) para máxima compatibilidad con Excel.
 */
require_once 'includes/auth.php';
require_once 'includes/conexion.php';

// Consulta todos los campos relevantes para el reporte
$resultado = mysqli_query($conexion, "SELECT id, nombre_remitente, correo_remitente, mensaje_texto, fecha_envio FROM mensajes_contacto ORDER BY id DESC");

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

// Cabeceras HTTP que fuerzan la descarga del archivo como Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Mensajes_INCB_" . date('d-m-Y') . ".xls");
header("Pragma: no-cache");   // evita que el navegador cachee el archivo
header("Expires: 0");          // el archivo expira inmediatamente (siempre se regenera)
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

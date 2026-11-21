<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nuevo_nombre'])) {
    $nombre = $conn->real_escape_string($_POST['nuevo_nombre']);
    $area = $conn->real_escape_string($_POST['area']);
    if (!empty($nombre)) {
        $conn->query("INSERT INTO trabajadores (nombre, area, pago_diario) VALUES ('$nombre', '$area', 250.00)");
    }
}

$patio = $conn->query("SELECT * FROM trabajadores WHERE area = 'Patio y Selección' AND activo = 1");
$transporte = $conn->query("SELECT * FROM trabajadores WHERE area = 'Transporte' AND activo = 1");

$num_patio = $patio->num_rows;
$num_transporte = $transporte->num_rows;
$costo_patio = $num_patio * 250;
$costo_transporte = $num_transporte * 250;
$costo_total = $costo_patio + $costo_transporte;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuadrilla y Nómina | Centro de Acopio Citrícola</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header class="encabezado">
        <div class="contenedor">
            <h1>Cuadrilla y Nómina Diaria</h1>
            <p>Control de personal activo en base de datos ($250 MXN / día)</p>
        </div>
    </header>

    <nav class="navegacion">
        <div class="contenedor">
            <a href="index.php">1. Inicio y Precios</a>
            <a href="recepcion.php">2. Recepción y Bitácora</a>
            <a href="personal.php" class="activo">3. Cuadrilla y Nómina</a>
            <a href="salida.php">4. Carga y Exportadora</a>
        </div>
    </nav>

    <main class="contenedor">
        <section class="seccion">
            <h2>Resumen de Nómina Calculada</h2>
            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>Área Operativa</th>
                        <th>Personal Activo</th>
                        <th>Actividades Asignadas</th>
                        <th>Pago por Día</th>
                        <th>Subtotal Nómina</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Patio y Selección</strong></td>
                        <td><?php echo $num_patio; ?> trabajadores</td>
                        <td>Descargar rejas, clasificar (1ª, 2ª y 3ª), cantar conteo y subir carga a camiones.</td>
                        <td>$250.00 MXN</td>
                        <td>$<?php echo number_format($costo_patio, 2); ?> MXN</td>
                    </tr>
                    <tr>
                        <td><strong>Transporte</strong></td>
                        <td><?php echo $num_transporte; ?> trabajadores</td>
                        <td>Llegar al cierre del día con unidades y trasladar el limón a las exportadoras.</td>
                        <td>$250.00 MXN</td>
                        <td>$<?php echo number_format($costo_transporte, 2); ?> MXN</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Total Nómina Diaria (<?php echo ($num_patio + $num_transporte); ?> trabajadores):</strong></td>
                        <td><strong>$<?php echo number_format($costo_total, 2); ?> MXN</strong></td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="seccion">
            <h2>Lista de Personal Activo</h2>
            <div class="grid-tarjetas">
                <div class="tarjeta calidad-primera">
                    <span class="etiqueta">Turno Completo</span>
                    <h3>Cuadrilla de Patio (<?php echo $num_patio; ?>)</h3>
                    <ul class="lista-personal">
                        <?php while($t = $patio->fetch_assoc()): ?>
                            <li><?php echo htmlspecialchars($t['nombre']); ?> — $<?php echo $t['pago_diario']; ?></li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="tarjeta calidad-segunda">
                    <span class="etiqueta">Cierre de Jornada</span>
                    <h3>Equipo de Transporte (<?php echo $num_transporte; ?>)</h3>
                    <ul class="lista-personal">
                        <?php while($t = $transporte->fetch_assoc()): ?>
                            <li><?php echo htmlspecialchars($t['nombre']); ?> — $<?php echo $t['pago_diario']; ?></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </section>

        <section class="seccion">
            <h2>Registrar Nuevo Trabajador</h2>
            <form method="POST" action="personal.php" class="formulario-registro">
                <div class="campo-grupo">
                    <div class="campo">
                        <label for="nuevo_nombre">Nombre Completo:</label>
                        <input type="text" id="nuevo_nombre" name="nuevo_nombre" placeholder="Ej. Carlos Gómez" required>
                    </div>
                    <div class="campo">
                        <label for="area">Área Asignada:</label>
                        <select id="area" name="area" style="padding: 10px; border: 1px solid #dce1de; border-radius: 6px; font-size: 1rem;">
                            <option value="Patio y Selección">Patio y Selección ($250/día)</option>
                            <option value="Transporte">Transporte ($250/día)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="boton-registrar">Agregar Trabajador</button>
            </form>
        </section>
    </main>

    <footer class="pie-pagina">
        <div class="contenedor">
            <p>Centro de Acopio y Comercialización de Limón &copy; 2026</p>
        </div>
    </footer>

</body>
</html>
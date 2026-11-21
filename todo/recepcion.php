<?php
include 'conexion.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cosechador = $conn->real_escape_string($_POST['cosechador']);
    $hora = $_POST['hora'];
    $rejas1 = (int)$_POST['rejas1'];
    $rejas2 = (int)$_POST['rejas2'];
    $rejas3 = (int)$_POST['rejas3'];

    if (!empty($cosechador)) {
        $sql_insert = "INSERT INTO recepciones (cosechador, hora_llegada, rejas_primera, rejas_segunda, rejas_tercera) 
                       VALUES ('$cosechador', '$hora', $rejas1, $rejas2, $rejas3)";
        if ($conn->query($sql_insert) === TRUE) {
            $mensaje = "Entrega registrada correctamente en la base de datos.";
        } else {
            $mensaje = "Error al guardar: " . $conn->error;
        }
    }
}

$sql_select = "SELECT * FROM recepciones WHERE fecha = CURDATE() ORDER BY id DESC";
$resultado = $conn->query($sql_select);

$total1 = 0;
$total2 = 0;
$total3 = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepción | Centro de Acopio Citrícola</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header class="encabezado">
        <div class="contenedor">
            <h1>Recepción de Cosechadores</h1>
            <p>Registro en base de datos de rejas descargadas y clasificadas</p>
        </div>
    </header>

    <nav class="navegacion">
        <div class="contenedor">
            <a href="index.php">1. Inicio y Precios</a>
            <a href="recepcion.php" class="activo">2. Recepción y Bitácora</a>
            <a href="personal.php">3. Cuadrilla y Nómina</a>
            <a href="salida.php">4. Carga y Exportadora</a>
        </div>
    </nav>

    <main class="contenedor">
        <section class="seccion">
            <h2>Anotar Entrega de Cosechador Independiente</h2>
            <p class="subtitulo">Registra las rejas conforme la cuadrilla termina de seleccionar cada lote:</p>
            
            <?php if ($mensaje != ""): ?>
                <p style="background: #d8f3dc; color: #1b4332; padding: 12px; border-radius: 6px; margin-bottom: 15px; font-weight: bold;">
                    <?php echo $mensaje; ?>
                </p>
            <?php endif; ?>

            <form method="POST" action="recepcion.php" class="formulario-registro">
                <div class="campo-grupo">
                    <div class="campo">
                        <label for="cosechador">Nombre del Cosechador:</label>
                        <input type="text" id="cosechador" name="cosechador" placeholder="Ej. Roberto Hernández" required>
                    </div>
                    <div class="campo">
                        <label for="hora">Hora de Llegada:</label>
                        <input type="time" id="hora" name="hora" value="<?php echo date('H:i'); ?>" required>
                    </div>
                </div>

                <div class="campo-grupo">
                    <div class="campo">
                        <label for="rejas1">Rejas de 1ª ($300-$350):</label>
                        <input type="number" id="rejas1" name="rejas1" min="0" value="0" required>
                    </div>
                    <div class="campo">
                        <label for="rejas2">Rejas de 2ª ($200):</label>
                        <input type="number" id="rejas2" name="rejas2" min="0" value="0" required>
                    </div>
                    <div class="campo">
                        <label for="rejas3">Rejas de 3ª ($50):</label>
                        <input type="number" id="rejas3" name="rejas3" min="0" value="0" required>
                    </div>
                </div>
                <button type="submit" class="boton-registrar">Guardar Registro en Bitácora</button>
            </form>
        </section>

        <section class="seccion">
            <h2>Bitácora del Día (Datos desde MySQL)</h2>
            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Cosechador</th>
                        <th>Rejas 1ª</th>
                        <th>Rejas 2ª</th>
                        <th>Rejas 3ª</th>
                        <th>Total Rejas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultado->num_rows > 0): ?>
                        <?php while($fila = $resultado->fetch_assoc()): 
                            $suma_fila = $fila['rejas_primera'] + $fila['rejas_segunda'] + $fila['rejas_tercera'];
                            $total1 += $fila['rejas_primera'];
                            $total2 += $fila['rejas_segunda'];
                            $total3 += $fila['rejas_tercera'];
                        ?>
                        <tr>
                            <td><?php echo substr($fila['hora_llegada'], 0, 5); ?></td>
                            <td><?php echo htmlspecialchars($fila['cosechador']); ?></td>
                            <td><?php echo $fila['rejas_primera']; ?></td>
                            <td><?php echo $fila['rejas_segunda']; ?></td>
                            <td><?php echo $fila['rejas_tercera']; ?></td>
                            <td><strong><?php echo $suma_fila; ?> rejas</strong></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Aún no hay entregas registradas hoy.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><strong>Acumulado en Patio:</strong></td>
                        <td><strong><?php echo $total1; ?></strong></td>
                        <td><strong><?php echo $total2; ?></strong></td>
                        <td><strong><?php echo $total3; ?></strong></td>
                        <td><strong><?php echo ($total1 + $total2 + $total3); ?> rejas</strong></td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </main>

    <footer class="pie-pagina">
        <div class="contenedor">
            <p>Centro de Acopio y Comercialización de Limón &copy; 2026</p>
        </div>
    </footer>

</body>
</html>
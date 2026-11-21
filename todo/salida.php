<?php
include 'conexion.php';

$sql_totales = "SELECT 
    COALESCE(SUM(rejas_primera), 0) AS t1,
    COALESCE(SUM(rejas_segunda), 0) AS t2,
    COALESCE(SUM(rejas_tercera), 0) AS t3
    FROM recepciones WHERE fecha = CURDATE()";
$res = $conn->query($sql_totales)->fetch_assoc();

$r1 = (int)$res['t1'];
$r2 = (int)$res['t2'];
$r3 = (int)$res['t3'];
$total_rejas = $r1 + $r2 + $r3;

$precio1 = 325;
$precio2 = 200;
$precio3 = 50;

$venta1 = $r1 * $precio1;
$venta2 = $r2 * $precio2;
$venta3 = $r3 * $precio3;
$venta_bruta = $venta1 + $venta2 + $venta3;

$res_nomina = $conn->query("SELECT COALESCE(SUM(pago_diario), 0) AS total_nomina FROM trabajadores WHERE activo = 1")->fetch_assoc();
$nomina_dia = (float)$res_nomina['total_nomina'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga y Exportadora | Centro de Acopio Citrícola</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header class="encabezado">
        <div class="contenedor">
            <h1>Carga y Entrega a Exportadora</h1>
            <p>Cierre automático del día conectado a la bitácora de recepción</p>
        </div>
    </header>

    <nav class="navegacion">
        <div class="contenedor">
            <a href="index.php">1. Inicio y Precios</a>
            <a href="recepcion.php">2. Recepción y Bitácora</a>
            <a href="personal.php">3. Cuadrilla y Nómina</a>
            <a href="salida.php" class="activo">4. Carga y Exportadora</a>
        </div>
    </nav>

    <main class="contenedor">
        <section class="seccion">
            <h2>Manifiesto de Carga (Acumulado de Hoy)</h2>
            <p class="subtitulo">Estas cantidades se actualizan automáticamente conforme anotas entregas en la pantalla de Recepción:</p>

            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>Clasificación</th>
                        <th>Rejas Listas en Patio</th>
                        <th>Precio Exportadora (Ref.)</th>
                        <th>Valor Estimado de Venta</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Limón de Primera</strong></td>
                        <td><?php echo $r1; ?> rejas</td>
                        <td>$325.00 MXN (promedio $300-$350)</td>
                        <td>$<?php echo number_format($venta1, 2); ?> MXN</td>
                    </tr>
                    <tr>
                        <td><strong>Limón de Segunda</strong></td>
                        <td><?php echo $r2; ?> rejas</td>
                        <td>$200.00 MXN</td>
                        <td>$<?php echo number_format($venta2, 2); ?> MXN</td>
                    </tr>
                    <tr>
                        <td><strong>Limón de Tercera</strong></td>
                        <td><?php echo $r3; ?> rejas</td>
                        <td>$50.00 MXN</td>
                        <td>$<?php echo number_format($venta3, 2); ?> MXN</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total a Embarcar:</strong></td>
                        <td><strong><?php echo $total_rejas; ?> rejas</strong></td>
                        <td>—</td>
                        <td><strong>$<?php echo number_format($venta_bruta, 2); ?> MXN</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Menos Nómina Diaria (Patio + Transporte):</strong></td>
                        <td><strong>- $<?php echo number_format($nomina_dia, 2); ?> MXN</strong></td>
                    </tr>
                </tfoot>
            </table>
        </section>

        <section class="seccion">
            <h2>Operación de Cierre y Transporte</h2>
            <div class="pasos-grid">
                <div class="paso">
                    <div class="numero">1</div>
                    <h4>Carga en Centro de Compra</h4>
                    <p>Los trabajadores de patio suben las <strong><?php echo $total_rejas; ?> rejas</strong> acumuladas a los camiones.</p>
                </div>
                <div class="paso">
                    <div class="numero">2</div>
                    <h4>Traslado a Venta</h4>
                    <p>El equipo de transporte lleva el cargamento completo a las empacadoras/exportadoras.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="pie-pagina">
        <div class="contenedor">
            <p>Centro de Acopio y Comercialización de Limón &copy; 2026</p>
        </div>
    </footer>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Centro de Acopio Citrícola</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header class="encabezado">
        <div class="contenedor">
            <h1>Centro de Acopio Citrícola</h1>
            <p>Compra directa a cosechadores, selección en patio y distribución a exportadoras</p>
        </div>
    </header>

    <nav class="navegacion">
        <div class="contenedor">
            <a href="index.php" class="activo">1. Inicio y Precios</a>
            <a href="recepcion.php">2. Recepción y Bitácora</a>
            <a href="personal.php">3. Cuadrilla y Nómina</a>
            <a href="salida.php">4. Carga y Exportadora</a>
        </div>
    </nav>

    <main class="contenedor">
        <section class="seccion">
            <h2>Cotización Actual (Referencia Exportadora)</h2>
            <p class="subtitulo">Precios base por reja según el estado y calidad del limón seleccionado:</p>
            
            <div class="grid-tarjetas">
                <div class="tarjeta calidad-primera">
                    <span class="etiqueta">Calidad Premium</span>
                    <h3>Limón de Primera</h3>
                    <p class="precio">$300 - $350 <span>MXN / reja</span></p>
                    <p class="descripcion">Fruto de exportación, tamaño uniforme, color verde intenso y sin daños físicos.</p>
                </div>

                <div class="tarjeta calidad-segunda">
                    <span class="etiqueta">Calidad Estándar</span>
                    <h3>Limón de Segunda</h3>
                    <p class="precio">$200 <span>MXN / reja</span></p>
                    <p class="descripcion">Buen calibre y jugo, con ligeros detalles estéticos en cáscara para mercado nacional.</p>
                </div>

                <div class="tarjeta calidad-tercera">
                    <span class="etiqueta">Industria / Local</span>
                    <h3>Limón de Tercera</h3>
                    <p class="precio">$50 <span>MXN / reja</span></p>
                    <p class="descripcion">Fruto pequeño, maduro o con mancha, destinado a jugo o comercio local.</p>
                </div>
            </div>
        </section>

        <section class="seccion">
            <h2>Resumen del Flujo Operativo</h2>
            <div class="pasos-grid">
                <div class="paso">
                    <div class="numero">1</div>
                    <h4>Compra en Patio</h4>
                    <p>Cosechadores independientes entregan sus rejas en el centro de compra.</p>
                    <a href="recepcion.php" class="enlace-tarjeta">Ir a Recepción &rarr;</a>
                </div>
                <div class="paso">
                    <div class="numero">2</div>
                    <h4>Selección (8-10 Trabajadores)</h4>
                    <p>Descargan, escogen 1ª, 2ª y 3ª calidad y cantan las cantidades para anotar.</p>
                    <a href="personal.php" class="enlace-tarjeta">Ver Personal &rarr;</a>
                </div>
                <div class="paso">
                    <div class="numero">3</div>
                    <h4>Transporte (2-3 Choferes)</h4>
                    <p>Al cierre del día, se cargan los camiones y se lleva el producto a venta.</p>
                    <a href="salida.php" class="enlace-tarjeta">Ver Salida &rarr;</a>
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Productos Disponibles</h1>
        
        <!-- Iteración de productos -->
        <div class="row">
            <?php foreach ($productos as $producto): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <!-- Encabezado del producto -->
                        <div class="card-header text-center">
                            <h5 class="card-title"><?= htmlspecialchars($producto->nombre); ?></h5>
                        </div>

                        <!-- Cuerpo del producto -->
                        <div class="card-body">
                            <p class="card-text"><strong>Precio:</strong> $<?= htmlspecialchars($producto->precio); ?></p>
                            <p class="card-text"><strong>Peso Neto:</strong> <?= htmlspecialchars($producto->peso_neto); ?> kg</p>
                            <p class="card-text">
                                <strong>Descripción:</strong> <?= nl2br(htmlspecialchars($producto->descripcion)); ?>
                            </p>
                        </div>

                        <!-- Pie de la tarjeta con enlace al detalle -->
                        <div class="card-footer text-center">
                            <a href="/productos/<?= $producto->id_producto; ?>" class="btn btn-primary">
                                Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Incluir Bootstrap JS (opcional si necesitas funcionalidad interactiva) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

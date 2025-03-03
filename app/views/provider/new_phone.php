<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nuevo Teléfono</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (opcional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <h1 class="navbar-brand">Nuevo Teléfono</h1>
        </div>
    </nav>

    <!-- Contenedor del formulario -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Puedes mostrar el nombre del proveedor -->
                        <h5 class="card-title">Agregar teléfono para: <?= htmlspecialchars($provider->name) ?></h5>
                        <form action="<?= base_url() ?>provider/storePhone" method="post">
                            <!-- Campo oculto para el ID del proveedor -->
                            <input type="hidden" name="provider_id" value="<?= htmlspecialchars($provider->provider_id) ?>">

                            <div class="mb-3">
                                <label for="number" class="form-label">Teléfono</label>
                                <input type="text" name="number" id="number" class="form-control" placeholder="Número de teléfono" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Guardar Teléfono</button>
                            </div>
                        </form>
                        <!-- Botón para volver al detalle del proveedor -->
                        <div class="mt-3">
                            <a href="<?= base_url() ?>provider/show/<?= htmlspecialchars($provider->provider_id) ?>" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva Dirección</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <h1 class="navbar-brand">Nueva Dirección</h1>
        </div>
    </nav>

    <!-- Contenedor del formulario -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Puedes incluir un mensaje o el nombre del cliente -->
                        <h5 class="card-title">Agregar dirección para: <?= htmlspecialchars($customer->name) ?></h5>
                        <form action="<?= base_url() ?>customer/storeAddress" method="post">
                            <!-- Campo oculto para el ID del cliente -->
                            <input type="hidden" name="customer_id" value="<?= htmlspecialchars($customer->customer_id) ?>">

                            <div class="mb-3">
                                <label for="street" class="form-label">Calle</label>
                                <input type="text" name="street" id="street" class="form-control" placeholder="Calle" required>
                            </div>
                            <div class="mb-3">
                                <label for="zip_code" class="form-label">Código Postal</label>
                                <input type="text" name="zip_code" id="zip_code" class="form-control" placeholder="Código Postal" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Ciudad</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="Ciudad" required>
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">País</label>
                                <input type="text" name="country" id="country" class="form-control" placeholder="País" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Guardar Dirección</button>
                            </div>
                        </form>
                        <!-- Botón para volver al detalle del cliente -->
                        <div class="mt-3">
                            <a href="<?= base_url() ?>customer/show/<?= htmlspecialchars($customer->customer_id) ?>" class="btn btn-secondary">
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
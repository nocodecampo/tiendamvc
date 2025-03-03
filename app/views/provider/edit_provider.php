<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <div class="d-flex flex-row align-items-center gap-2">
                <a href="javascript:window.history.back();" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="navbar-brand mb-0">Editar Proveedor</h1>
            </div>
            <a href="<?= base_url() ?>admin" class="btn btn-secondary m-2">
                <i class="fa-solid fa-arrow-left"></i> Volver a Admin
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <!-- Sección para editar datos generales del proveedor -->
        <div class="row mb-4">
            <div class="col">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Datos del Proveedor</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() ?>provider/updateCustomer" method="post">
                            <!-- Campo oculto para el ID del proveedor -->
                            <input type="hidden" name="provider_id" value="<?= htmlspecialchars($provider->provider_id) ?>">
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Nombre</label>
                                <input name="name" type="text" class="form-control" id="inputName" value="<?= htmlspecialchars($provider->name) ?>" placeholder="Nombre proveedor" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección para editar direcciones -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4>Direcciones</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($provider->addresses as $address): ?>
                            <form action="<?= base_url() ?>provider/updateAddress" method="post" class="mb-3">
                                <input type="hidden" name="address_id" value="<?= htmlspecialchars($address->address_id) ?>">
                                <input type="hidden" name="provider_id" value="<?= htmlspecialchars($provider->provider_id) ?>">
                                <div class="mb-2">
                                    <label class="form-label">Calle</label>
                                    <input type="text" name="street" class="form-control" value="<?= htmlspecialchars($address->street) ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Código Postal</label>
                                    <input type="text" name="zip_code" class="form-control" value="<?= htmlspecialchars($address->zip_code) ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Ciudad</label>
                                    <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($address->city) ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">País</label>
                                    <input type="text" name="country" class="form-control" value="<?= htmlspecialchars($address->country) ?>" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-secondary">Actualizar Dirección</button>
                                </div>
                            </form>
                            <hr>
                        <?php endforeach; ?>
                        <!-- Botón para agregar nueva dirección -->
                        <div class="text-end">
                            <a href="<?= base_url() ?>provider/addAddress/<?= htmlspecialchars($provider->provider_id) ?>" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Nueva Dirección
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sección para editar teléfonos -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h4>Teléfonos</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($provider->phones as $phone): ?>
                            <form action="<?= base_url() ?>provider/updatePhone" method="post" class="mb-3">
                                <input type="hidden" name="phone_id" value="<?= htmlspecialchars($phone->phone_id) ?>">
                                <input type="hidden" name="provider_id" value="<?= htmlspecialchars($provider->provider_id) ?>">
                                <div class="mb-2">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" name="number" class="form-control" value="<?= htmlspecialchars($phone->number) ?>" required>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-secondary">Actualizar Teléfono</button>
                                </div>
                            </form>
                            <hr>
                        <?php endforeach; ?>
                        <!-- Botón para agregar nuevo teléfono -->
                        <div class="text-end">
                            <a href="<?= base_url() ?>provider/addPhone/<?= htmlspecialchars($provider->provider_id) ?>" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Nuevo Teléfono
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
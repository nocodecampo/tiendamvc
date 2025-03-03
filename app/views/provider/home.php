<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Proveedores</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <div style="display: flex; flex-direction:row; gap:8px; align-items:center;">
                <a href="javascript:window.history.back();" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i></a>
                <h1 class="navbar-brand mb-0">Listado de Proveedores</h1>
            </div>
            <a href="<?= base_url() ?>admin" class="btn btn-secondary m-2">
                <i class="fa-solid fa-arrow-left"></i> Volver a Admin
            </a>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Enlace para añadir cliente -->
        <div class="mb-3">
            <a href="<?= base_url() ?>provider/addProvider" class="btn btn-success">
                <i class="fa-solid fa-plus"></i> Añadir Proveedor
            </a>
        </div>

        <!-- Mostrar mensaje de error si existe -->
        <?php
        $error = isset($_GET['error']) ? $_GET['error'] : '';
        if ($error):
        ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Card que contiene la tabla -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Web</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $provider): ?>
                                <tr>
                                    <th scope="row"><?= htmlspecialchars($provider->provider_id) ?></th>
                                    <td><?= htmlspecialchars($provider->name) ?></td>
                                    <td><?= htmlspecialchars($provider->web) ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>provider/edit/<?= $provider->provider_id ?>" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="<?= base_url() ?>provider/delete/<?= $provider->provider_id ?>" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        <a href="<?= base_url() ?>provider/show/<?= $provider->provider_id ?>" class="btn btn-sm btn-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div> <!-- table-responsive -->
            </div> <!-- card-body -->
        </div> <!-- card -->
    </div> <!-- container -->
</body>

</html>
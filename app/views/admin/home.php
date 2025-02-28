<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Cabecera -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="navbar-brand mb-0"><?php echo $data['mensaje'] ?></h1>
            <a class="btn btn-outline-light" href="<?= base_url() ?>login">Login</a>
        </div>
    </nav>

    <!-- Contenedor principal para los enlaces -->
    <div class="container my-5">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Bloque para Clientes -->
            <div class="col">
                <div class="card text-center h-100 bg-primary text-white">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-user fa-3x mb-2"></i>
                        <a href="<?= base_url() ?>customer" class="stretched-link h3 text-decoration-none text-white">
                            Clientes
                        </a>
                    </div>
                </div>
            </div>
            <!-- Bloque para Productos -->
            <div class="col">
                <div class="card text-center h-100 bg-success text-white">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-box-open fa-3x mb-2"></i>
                        <a href="<?= base_url() ?>product" class="stretched-link h3 text-decoration-none text-white">
                            Productos
                        </a>
                    </div>
                </div>
            </div>
            <!-- Bloque para Proveedores -->
            <div class="col">
                <div class="card text-center h-100 bg-warning text-dark">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-truck fa-3x mb-2"></i>
                        <a href="<?= base_url() ?>provider" class="stretched-link h3 text-decoration-none text-dark">
                            Proveedores
                        </a>
                    </div>
                </div>
            </div>
            <!-- Bloque para Ventas -->
            <div class="col">
                <div class="card text-center h-100 bg-danger text-white">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-chart-line fa-3x mb-2"></i>
                        <a href="<?= base_url() ?>order" class="stretched-link h3 text-decoration-none text-white">
                            Ventas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
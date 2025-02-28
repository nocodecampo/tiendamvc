<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir nuevo - Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <!-- Cabecera -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <h1 class="navbar-brand mb-0">Añadir nuevo cliente</h1>
            <a href="<?= base_url() ?>admin" class="btn btn-secondary m-2">
                <i class="fa-solid fa-arrow-left"></i> Volver a Admin
            </a>
        </div>
    </nav>

    <!-- Contenedor del formulario -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Card para el formulario -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="store" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input name="name" type="text" class="form-control" id="name" placeholder="Nombre cliente">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Calle</label>
                                <input name="street" type="text" class="form-control" id="street" placeholder="Calle cliente">
                            </div>
                            <div class="mb-3">
                                <label for="zip_code" class="form-label">Código Postal</label>
                                <input name="zip_code" type="text" class="form-control" id="zip_code" placeholder="Código postal cliente">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Ciudad</label>
                                <input name="city" type="text" class="form-control" id="city" placeholder="Ciudad cliente">
                            </div>
                            <div class="mb-3">
                                <label for="country" class="form-label">País</label>
                                <input name="country" type="text" class="form-control" id="country" placeholder="País cliente">
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Teléfono</label>
                                <input name="number" type="text" class="form-control" id="number" placeholder="Teléfono cliente">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Crear cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
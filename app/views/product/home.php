<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="<?= base_url() ?>assets/js/product.js" defer></script>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-text">
                <h1>Productos</h1>
            </span>
        </div>
    </nav>
    <div class="container col-md-4">
        <form id="form" action="" method="post" style="padding:40px 0;">

            <div class="col-12">
                <label for="name" class="form-label">Nombre producto</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nombre producto" required>
            </div>
            <hr>
            <div class="col-12">
                <label for="description" class="form-label">Descripción</label>
                <input name="description" type="text" class="form-control" id="description" placeholder="Descripción" required>
            </div>
            <hr>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="category">Categoría</label>
                    <select name="category" id="category">
                        <option selected>Elige...</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="provider">Proveedor</label>
                    <select name="provider" id="provider">
                        <option selected>Elige...</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input name="stock" type="number" min="0" class="form-control" id="stock" placeholder="0" required>
                </div>
                <div class="col-md-6">
                    <label for="price" class="form-label">Precio</label>
                    <input name="price" type="number" min="0" step="0.01" class="form-control" id="price" placeholder="0" required>
                </div>
            </div>

            <hr>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Crear producto</button>
            </div>

        </form>
    </div>

</body>

</html>
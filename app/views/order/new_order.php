<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Pedido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <div style="display: flex; flex-direction:row; gap:8px; align-items:center;">
                <a href="javascript:window.history.back();" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i></a>
                <h1 class="navbar-brand mb-0">Nuevo Pedido</h1>
            </div>
            <a href="<?= base_url() ?>admin" class="btn btn-secondary m-2">
                <i class="fa-solid fa-arrow-left"></i> Volver a Admin
            </a>
        </div>
    </nav>

    <!-- Contenedor del formulario -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- Formulario tradicional, sin AJAX -->
                        <form action="<?= base_url() ?>order/store" method="post">
                            <!-- Selección de cliente -->
                            <h3 class="mb-3"><i class="fa-solid fa-user"></i> Cliente</h3>
                            <div class="mb-3">
                                <label for="customer" class="form-label">Cliente</label>
                                <select name="customer_id" id="customer" class="form-select" required>
                                    <option value="">Seleccione un cliente...</option>
                                    <?php foreach ($customers as $customer): ?>
                                        <option value="<?= $customer->customer_id ?>"><?= htmlspecialchars($customer->name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Descuento (opcional) -->
                            <div class="mb-3">
                                <label for="discount" class="form-label">Descuento %</label>
                                <input name="discount" type="number" class="form-control" id="discount" placeholder="0" step="0.01">
                            </div>

                            <hr>
                            <!-- Sección para agregar productos -->
                            <h3 class="mb-3"><i class="fa-solid fa-box-open"></i> Productos</h3>
                            <div id="productsContainer">
                                <!-- Primera fila de producto -->
                                <div class="row g-3 productRow mb-3">
                                    <div class="col-md-5">
                                        <label class="form-label">Producto</label>
                                        <select name="products[0][product_id]" class="form-select product-select" required>
                                            <option value="">Seleccione un producto...</option>
                                            <?php foreach ($products as $prod): ?>
                                                <option value="<?= $prod->product_id ?>" data-price="<?= $prod->price ?>">
                                                    <?= htmlspecialchars($prod->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Cantidad</label>
                                        <input name="products[0][quantity]" type="number" min="1" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Precio</label>
                                        <input name="products[0][price]" type="number" min="0" step="0.01" class="form-control product-price" readonly required>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger removeProductBtn"> 
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Botón para agregar más productos -->
                            <div class="mb-3">
                                <button type="button" id="addProductBtn" class="btn btn-secondary">
                                    <i class="fa-solid fa-plus"></i> Agregar Producto
                                </button>
                            </div>
                            <!-- Botón de envío -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Crear Pedido</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para agregar filas dinámicamente -->
     <script src="<?= base_url()?>assets/js/order.js"></script>

    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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
  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
      <h1 class="navbar-brand mb-0">Productos</h1>
    </div>
  </nav>

  <!-- Formulario para añadir producto -->
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <form id="form" action="<?= base_url() ?>product/store" method="post">
              <div class="mb-3">
                <label for="name" class="form-label">Nombre producto</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Nombre producto" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <input name="description" type="text" class="form-control" id="description" placeholder="Descripción" required>
              </div>
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label for="category" class="form-label">Categoría</label>
                  <select name="category" id="category" class="form-select" required>
                    <option value="">Elige...</option>
                    <!-- Opciones dinámicas -->
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="provider" class="form-label">Proveedor</label>
                  <select name="provider" id="provider" class="form-select" required>
                    <option value="">Elige...</option>
                    <!-- Opciones dinámicas -->
                  </select>
                </div>
              </div>
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label for="stock" class="form-label">Stock</label>
                  <input name="stock" type="number" min="0" class="form-control" id="stock" placeholder="0" required>
                </div>
                <div class="col-md-6">
                  <label for="price" class="form-label">Precio</label>
                  <input name="price" type="number" min="0" step="0.01" class="form-control" id="price" placeholder="0" required>
                </div>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Crear producto</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Listado de Productos -->
  <div class="container my-5">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Categoría</th>
                <th scope="col">Proveedor</th>
                <th scope="col">Stock</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody id="products">
              <?php foreach ($products as $product): ?>
                <tr>
                  <td><?= htmlspecialchars($product->name) ?></td>
                  <td><?= htmlspecialchars($product->description) ?></td>
                  <td><?= htmlspecialchars($product->category ? $product->category->name : '') ?></td>
                  <td><?= htmlspecialchars($product->provider ? $product->provider->name : '') ?></td>
                  <td><?= htmlspecialchars($product->stock) ?></td>
                  <td><?= htmlspecialchars($product->price) ?></td>
                  <td>
                    <a href="<?= base_url() ?>product/delete/<?= $product->product_id ?>" class="btn btn-sm btn-danger">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div> <!-- table-responsive -->
      </div> <!-- card-body -->
    </div> <!-- card -->
  </div>

  <!-- Bootstrap JS Bundle (incluye Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
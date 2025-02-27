<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
      <h1 class="navbar-brand mb-0">Listado de Clientes</h1>
    </div>
  </nav>

  <!-- Contenedor principal -->
  <div class="container">
    <!-- Enlace para añadir cliente -->
    <div class="mb-3">
      <a href="<?= base_url() ?>customer/addCustomer" class="btn btn-success">
        <i class="fa-solid fa-plus"></i> Añadir Cliente
      </a>
    </div>

    <!-- Card que contiene la tabla -->
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead class="table-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Fecha creación</th>
                <th scope="col">Última actualización</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $customer): ?>
                <tr>
                  <th scope="row"><?= htmlspecialchars($customer->customer_id) ?></th>
                  <td><?= htmlspecialchars($customer->name) ?></td>
                  <td><?= htmlspecialchars($customer->created_at) ?></td>
                  <td><?= htmlspecialchars($customer->updated_at) ?></td>
                  <td>
                    <a href="<?= base_url() ?>customer/edit/<?= $customer->customer_id ?>" class="btn btn-sm btn-warning">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="<?= base_url() ?>customer/delete/<?= $customer->customer_id ?>" class="btn btn-sm btn-danger">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                    <a href="<?= base_url() ?>customer/show/<?= $customer->customer_id ?>" class="btn btn-sm btn-info">
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
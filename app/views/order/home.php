<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
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
                <h1 class="navbar-brand mb-0">Ventas</h1>
            </div>
            <a href="<?= base_url() ?>admin" class="btn btn-secondary m-2">
                <i class="fa-solid fa-arrow-left"></i> Volver a Admin
            </a>
        </div>
    </nav>

    <div class="container">
    <div class="mb-3">
      <a href="<?= base_url() ?>order/create" class="btn btn-success">
        <i class="fa-solid fa-plus"></i> Nueva Orden
      </a>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead class="table-dark">
              <tr>
                <th>Order ID</th>
                <th>Cliente</th>
                <th>Descuento %</th>
                <th>Fecha Creación</th>
                <th>Última Actualización</th>
                <th>Productos</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $order): ?>
                <tr>
                  <td><?= htmlspecialchars($order->order_id) ?></td>
                  <td><?= $order->customer ? htmlspecialchars($order->customer->name) : 'N/A' ?></td>
                  <td><?= htmlspecialchars($order->discount) ?></td>
                  <td><?= htmlspecialchars($order->created_at) ?></td>
                  <td><?= htmlspecialchars($order->updated_at) ?></td>
                  <td>
                    <?php 
                      echo isset($order->products) && count($order->products) > 0 
                          ? count($order->products) . " producto" . (count($order->products) > 1 ? "s" : "") 
                          : "Sin productos"; 
                    ?>
                  </td>
                  <td>
                    <a href="<?= base_url() ?>order/show/<?= $order->order_id ?>" class="btn btn-sm btn-info">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="<?= base_url() ?>order/delete/<?= $order->order_id ?>" class="btn btn-sm btn-danger">
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
  </div> <!-- container -->

    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
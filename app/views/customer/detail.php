<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle - Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <h1 class="navbar-brand mb-0">Detalle de Cliente</h1>
      <a href="<?= base_url() ?>admin" class="btn btn-secondary m-2">
        <i class="fa-solid fa-arrow-left"></i> Volver a Admin
      </a>
    </div>
  </nav>

  <!-- Contenedor principal -->
  <div class="container my-5">
    <div class="accordion" id="clienteAccordion">
      
      <!-- Acordeón: Datos del Cliente -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingCliente">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCliente" aria-expanded="true" aria-controls="collapseCliente">
            Cliente: <?= htmlspecialchars($data->name) ?>
          </button>
        </h2>
        <div id="collapseCliente" class="accordion-collapse collapse show" aria-labelledby="headingCliente" data-bs-parent="#clienteAccordion">
          <div class="accordion-body">
            <!-- Aquí puedes agregar más información del cliente si lo deseas -->
            <p><strong>Nombre:</strong> <?= htmlspecialchars($data->name) ?></p>
          </div>
        </div>
      </div>

      <!-- Acordeón: Direcciones -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingDirecciones">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDirecciones" aria-expanded="false" aria-controls="collapseDirecciones">
            Direcciones
          </button>
        </h2>
        <div id="collapseDirecciones" class="accordion-collapse collapse" aria-labelledby="headingDirecciones" data-bs-parent="#clienteAccordion">
          <div class="accordion-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Calle</th>
                  <th>Código Postal</th>
                  <th>Ciudad</th>
                  <th>País</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data->addresses as $address): ?>
                  <tr>
                    <td><?= htmlspecialchars($address->address_id) ?></td>
                    <td><?= htmlspecialchars($address->street) ?></td>
                    <td><?= htmlspecialchars($address->zip_code) ?></td>
                    <td><?= htmlspecialchars($address->city) ?></td>
                    <td><?= htmlspecialchars($address->country) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Acordeón: Teléfonos -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTelefonos">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTelefonos" aria-expanded="false" aria-controls="collapseTelefonos">
            Teléfonos
          </button>
        </h2>
        <div id="collapseTelefonos" class="accordion-collapse collapse" aria-labelledby="headingTelefonos" data-bs-parent="#clienteAccordion">
          <div class="accordion-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Número</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data->phones as $phone): ?>
                  <tr>
                    <td><?= htmlspecialchars($phone->phone_id) ?></td>
                    <td><?= htmlspecialchars($phone->number) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Bootstrap JS Bundle (incluye Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
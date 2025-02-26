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
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-text">
                <h1>Editar cliente</h1>
            </span>
        </div>
    </nav>
    <!-- FORM -->
    <div class="container col-md-4">
        <form action="<?=base_url()?>customer/updateCustomer" method="post" style="padding:40px 0;">
            <!-- Campo oculto para el ID del cliente -->
            <input type="hidden" name="customer_id" value="<?php echo $customer->customer_id; ?>">
            <!-- Campo oculto para el ID de la dirección -->
            <input type="hidden" name="address_id" value="<?php echo $address->address_id; ?>">
            <!-- Campo oculto para el ID del teléfono -->
            <input type="hidden" name="phone_id" value="<?php echo $phone->phone_id; ?>">

            <div class="col-12">
                <label for="inputName" class="form-label">Nombre</label>
                <input name="name" type="text" class="form-control" id="inputName" value="<?php echo htmlspecialchars($customer->name); ?>" placeholder="Nombre cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputStreet" class="form-label">Calle</label>
                <input name="street" type="text" class="form-control" id="inputStreet" value="<?php echo htmlspecialchars($address->street); ?>" placeholder="Calle cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputZip" class="form-label">Código Postal</label>
                <input name="zip_code" type="text" class="form-control" id="inputZip" value="<?php echo htmlspecialchars($address->zip_code); ?>" placeholder="Código postal cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputCity" class="form-label">Ciudad</label>
                <input name="city" type="text" class="form-control" id="inputCity" value="<?php echo htmlspecialchars($address->city); ?>" placeholder="Ciudad cliente">
            </div>
            <hr>
            <div class="col-md-6">
                <label for="inputCountry" class="form-label">País</label>
                <input name="country" type="text" class="form-control" id="inputCountry" value="<?php echo htmlspecialchars($address->country); ?>" placeholder="País cliente">
            </div>
            <hr>
            <div class="col-md-6">
                <label for="inputPhone" class="form-label">Teléfono</label>
                <input name="number" type="text" class="form-control" id="inputPhone" value="<?php echo htmlspecialchars($phone->number); ?>" placeholder="Teléfono cliente">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Actualizar cliente</button>
            </div>
        </form>
    </div>
</body>

</html>
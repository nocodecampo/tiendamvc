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
                <h1>Añadir nuevo cliente</h1>
            </span>
        </div>
    </nav>
    <!-- FORM -->
    <div class="container col-md-4">
        <form action="store" method="post" style="padding:40px 0;">

            <div class="col-12">
                <label for="inputEmail4" class="form-label">Nombre</label>
                <input name="name" type="text" class="form-control" id="inputEmail4" placeholder="Nombre cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputPassword4" class="form-label">Calle</label>
                <input name="street" type="text" class="form-control" id="inputPassword4" placeholder="Calle cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Código Postal</label>
                <input name="zip_code" type="text" class="form-control" id="inputAddress" placeholder="Código postal cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputAddress2" class="form-label">Ciudad</label>
                <input name="city" type="text" class="form-control" id="inputAddress2" placeholder="Ciudad cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputCity" class="form-label">País</label>
                <input name="country" type="text" class="form-control" id="inputCity" placeholder="País cliente">
            </div>
            <hr>
            <div class="col-12">
                <label for="inputCity" class="form-label">Teléfono</label>
                <input name="number" type="text" class="form-control" id="inputCity" placeholder="Teléfono cliente">
            </div>
            <hr>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Crear cliente</button>
            </div>

        </form>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-text">
                Navbar text with an inline element
            </span>
        </div>
    </nav>
    <div class="container">
        <table class="table table-dark table-striped">
            <thead>
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
                        <th scope="row"><?php echo $customer->customer_id; ?></th>
                        <td><?php echo $customer->name; ?></td>
                        <td><?php echo $customer->created_at; ?></td>
                        <td><?php echo $customer->updated_at; ?></td>
                        <td>
                            <a href="/" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Editar</a>
                            <span> | </span>
                            <a href="/" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"> Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
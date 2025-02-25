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
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <span class="navbar-text">
                <h1>Listado de clientes</h1>
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
                            <a href="/" class="link-warning link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><i class="fa-solid fa-pen-to-square"></i></a>
                            <span> | </span>
                            <a href="/" class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><i class="fa-solid fa-trash"></i></a>
                            <span> | </span>
                            <a href="<?=base_url()?>customer/show/<?=$customer->customer_id?>" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
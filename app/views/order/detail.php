<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de orden</title>
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
                <h1 class="navbar-brand mb-0">Detalle de orden</h1>
            </div>
            <a href="<?= base_url() ?>admin" class="btn btn-secondary m-2">
                <i class="fa-solid fa-arrow-left"></i> Volver a Admin
            </a>
        </div>
    </nav>

    <div class="container">
        <!-- Card con datos generales de la orden -->
        <div class="card mb-4">
            <div class="card-header">
                Información de la Orden
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> <?= htmlspecialchars($order->order_id) ?></p>
                <p><strong>Cliente:</strong> <?= $order->customer ? htmlspecialchars($order->customer->name) : 'N/A' ?></p>
                <p><strong>Descuento (%):</strong> <?= htmlspecialchars($order->discount) ?></p>
                <p><strong>Fecha Creación:</strong> <?= htmlspecialchars($order->created_at) ?></p>
                <p><strong>Última Actualización:</strong> <?= htmlspecialchars($order->updated_at) ?></p>
            </div>
        </div>

        <!-- Card con listado de productos -->
        <div class="card">
            <div class="card-header">
                Productos de la Orden
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            foreach ($order->products as $product):
                                $quantity = $product->pivot->quantity;
                                $price    = $product->pivot->price;
                                $subtotal = $quantity * $price;
                                $total   += $subtotal;
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($product->name) ?></td>
                                    <td><?= htmlspecialchars($quantity) ?></td>
                                    <td><?= htmlspecialchars($price) ?></td>
                                    <td><?= htmlspecialchars($subtotal) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php
                // Calcula el monto del descuento (porcentaje)
                $discountPercentage = $order->discount;
                $discountAmount = $total * ($discountPercentage / 100);
                $totalFinal = $total - $discountAmount;
                ?>
                <div class="text-end">
                    <h4>Total: <?= htmlspecialchars($total) ?></h4>
                    <?php if ($discountPercentage > 0): ?>
                        <h4>Descuento (<?= htmlspecialchars($discountPercentage) ?>%): -<?= htmlspecialchars(number_format($discountAmount, 2)) ?></h4>
                        <h4>Total Final: <?= htmlspecialchars(number_format($totalFinal, 2)) ?></h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
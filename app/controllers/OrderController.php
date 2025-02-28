<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Order;
use Formacom\Models\Customer;
use Formacom\Models\Product;

class OrderController extends Controller
{
    public function index(...$params)
    {
        // Carga las órdenes con las relaciones 'products' y 'customer'
        $orders = Order::with(['products', 'customer'])->orderBy('created_at', 'desc')->get();
        $this->view('home', $orders);
    }

    // >>> Redirige a la vista new_order
    public function create()
    {
        $customers = Customer::all();  // O la consulta que corresponda
        $products  = Product::all();     // O la consulta que corresponda
        $this->view('new_order', ['customers' => $customers, 'products' => $products]);
    }

    // >>> Método para Crear una nueva Orden
    public function store()
    {
        // Recoger datos del formulario
        $customer_id = $_POST['customer_id'] ?? null;
        $discount    = $_POST['discount'] ?? 0;
        $products    = $_POST['products'] ?? [];

        // Crear una nueva orden
        $order = new Order();
        $order->customer_id = $customer_id;
        $order->discount    = $discount;

        if (!$order->save()) {
            // Manejo de error (puedes redirigir o mostrar un mensaje)
            header('Location: ' . base_url() . 'order/create?error=Error al crear la orden');
            exit();
        }

        // Asociar los productos enviados
        if (is_array($products)) {
            foreach ($products as $p) {
                // Se espera que cada elemento tenga product_id, quantity y price
                $order->products()->attach($p['product_id'], [
                    'quantity' => $p['quantity'] ?? 1,
                    'price'    => $p['price'] ?? 0
                ]);
            }
        }

        // Redirigir o mostrar un mensaje de éxito
        header('Location: ' . base_url() . 'order?message=Orden creada correctamente');
        exit();
    }

    // >>>Muestra el detalle de una orden
    public function show($id)
    {
        // Cargar la orden junto con las relaciones de productos y customer
        $order = Order::with(['products', 'customer'])->find($id);

        if (!$order) {
            header("Location: " . base_url() . "order?error=Orden no encontrada");
            exit();
        }

        // Pasamos la orden a la vista 'order/detail'
        $this->view('detail', ['order' => $order]);
    }


    // >>>Método para eliminar
    public function delete($id)
    {
        // Buscar la orden por su ID
        $order = Order::find($id);
        if (!$order) {
            header("Location: " . base_url() . "order?error=Orden no encontrada");
            exit();
        }

        // Utilizamos una transacción para asegurar la operación de manera atómica
        \Illuminate\Database\Capsule\Manager::connection()->transaction(function () use ($order) {
            // Desvincular todos los productos asociados (elimina los registros en la tabla pivote)
            $order->products()->detach();
            // Eliminar la orden
            $order->delete();
        });

        header("Location: " . base_url() . "order?message=Orden eliminada correctamente");
        exit();
    }
}

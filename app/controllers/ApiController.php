<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Category;
use Formacom\Models\Provider;
use Formacom\Models\Product;

class ApiController extends Controller
{
    public function index(...$params) {}

    public function categories()
    {
        $categories = Category::all();
        $json = json_encode($categories);
        header('Content-Type: application/json');
        echo $json;
    }

    public function providers()
    {
        $providers = Provider::all();
        $json = json_encode($providers);
        header('Content-Type: application/json');
        echo $json;
    }

    public function new_product()
    {
        // Leer el contenido de la petición (JSON)
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        error_log($input);

        // Verificar que se hayan recibido datos válidos
        if (!$data) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No se recibieron datos válidos']);
            return;
        }

        // Crear una nueva instancia del modelo Product y asignar los valores
        $product = new Product();
        $product->name = $data['name'] ?? '';
        $product->description = $data['description'] ?? '';
        $product->category_id = $data['category'] ?? '';
        $product->provider_id = $data['provider'] ?? '';
        $product->stock = $data['stock'] ?? 0;
        $product->price = $data['price'] ?? 0;

        // Intentar guardar el producto en la base de datos
        if ($product->save()) {
            // Recuperar el listado actualizado de productos incluyendo las relaciones
            $allProducts = Product::with(['category', 'provider'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            header('Content-Type: application/json');
            echo json_encode([
                'success'  => true,
                'products' => $allProducts
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Error al guardar el producto']);
        }
    }
}

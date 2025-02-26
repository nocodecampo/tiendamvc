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

    public function product() {
        // Leer el contenido de la petición (JSON)
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
    
        // Verificar que se hayan recibido datos válidos
        if (!$data) {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'No se recibieron datos válidos']);
            return;
        }
    
        // Crear una nueva instancia del modelo Product y asignar los valores
        $product = new Product();
        $product->name        = $data['name'] ?? '';
        $product->description = $data['description'] ?? '';
        $product->category    = $data['category'] ?? '';
        $product->provider    = $data['provider'] ?? '';
        $product->stock       = $data['stock'] ?? 0;
        $product->price       = $data['price'] ?? 0;
    
        // Intentar guardar el producto en la base de datos
        if ($product->save()) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'product' => $product
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Error al guardar el producto']);
        }
    }
}

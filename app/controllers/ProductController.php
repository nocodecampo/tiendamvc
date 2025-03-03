<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Product;

class ProductController extends Controller
{

    public function index(...$params)
    {
        // Determina la página actual a partir del parámetro GET (por defecto 1)
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $offset = ($page - 1) * $perPage;

        // Recupera los productos con relaciones, ordenados por fecha de creación
        $products = Product::with(['category', 'provider'])
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($perPage)
            ->get();

        // Calcula el total de páginas
        $totalProducts = Product::count();
        $totalPages = ceil($totalProducts / $perPage);

        // Pasa a la vista: productos, página actual y total de páginas
        $this->view('home', [
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }


    // Método para ELIMINAR productos
    public function delete($id)
    {
        // Busca el producto por su ID
        $product = Product::find($id);

        if (!$product) {
            // Si no se encuentra el producto, obtenemos el listado actualizado y mostramos un mensaje de error
            $products = Product::with(['category', 'provider'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            $this->view('home', [
                'products' => $products,
                'error'    => 'Producto no encontrado'
            ]);
            return;
        }

        // Intenta eliminar el producto
        if ($product->delete()) {
            $products = Product::with(['category', 'provider'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            $this->view('home', [
                'products' => $products,
                'message'  => 'Producto eliminado correctamente'
            ]);
        } else {
            $products = Product::with(['category', 'provider'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            $this->view('home', [
                'products' => $products,
                'error'    => 'Error al eliminar el producto'
            ]);
        }
    }
}

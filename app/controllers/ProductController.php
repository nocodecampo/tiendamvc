<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Product;

class ProductController extends Controller
{

    public function index(...$params)
    {
        // Recupera todos los productos junto con sus relaciones 'category' y 'provider'
        $products = Product::with(['category', 'provider'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Llama a la vista "home" (o la que definas) y le pasa los productos en un array asociativo
        $this->view('home', ['products' => $products]);
    }


    // Método para borrar productos
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

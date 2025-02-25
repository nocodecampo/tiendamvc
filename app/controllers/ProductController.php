<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Product;

class ProductController extends Controller{
    public function index(...$params){
        $product = new Product();
        $product->name = "Producto1";
        $product->description = "Esto es un producto";
        $product->img = "https://picsum.photos/seed/picsum/200/300";
        $product->stock = 33;
        $product->price = 18.99;
        $product->save();
    }
}

?>
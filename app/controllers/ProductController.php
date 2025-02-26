<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Product;

class ProductController extends Controller{
    public function index(...$params){
        $this->view('home');
    }
}

?>
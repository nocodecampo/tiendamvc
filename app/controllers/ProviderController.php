<?php
namespace Formacom\controllers;
use Formacom\Core\Controller;
use Formacom\Models\Provider;

class ProviderController extends Controller{
    public function index(...$params){
       // Recupera todos los clientes
       $providers = Provider::all();
        $this->view('home', $providers);
    }
}

?>
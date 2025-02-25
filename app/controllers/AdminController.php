<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Provider;

class AdminController extends Controller
{
    public function index(...$params)
    {
        $provider = new Provider();
        $provider->name = "Soluciones de gestión";
        $provider->web = "solutions.com";
        $provider->save();


        $data = ['mensaje' => '¡Bienvenido a la página de inicio!'];
        $this->view('home', $data);
    }
}

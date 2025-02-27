<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;

class AdminController extends Controller
{
    public function index(...$params)
    {

        $data = ['mensaje' => '¡Bienvenido a la página de administración!'];
        $this->view('home', $data);
    }
}

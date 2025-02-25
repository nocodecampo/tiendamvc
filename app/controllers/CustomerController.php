<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Customer;

class CustomerController extends Controller
{
    public function index(...$params)
    {
       // Recupera todos los clientes
       $customers = Customer::all();
        $this->view('home', $customers);
    }
}

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

    public function show(...$params)
    {
        // Recupera el cliente utilizando
        $customer = Customer::find($params[0]);

        // Verifica si se encontró el cliente
        if ($customer) {
            // Llama a la vista 'detail' pasando el objeto encontrado
            $this->view('detail', $customer);
        } else {
            // Opcional: Manejar el caso en que no se encuentre el cliente
            header ("Location: ".base_url()."customer");
        }
    }

}

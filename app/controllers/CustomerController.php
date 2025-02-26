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

    // Método para mostrar los datos de un cliente
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
            header("Location: " . base_url() . "customer");
        }
    }

    // Método para añadir un nuevo cliente
    public function addCustomer(...$params)
    {
        $this->view('new_customer');
    }

    public function store(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtiene y sanitiza los datos del formulario
            $name     = trim($_POST['name']);
            $street   = trim($_POST['street']);
            $zip_code = trim($_POST['zip_code']);
            $city     = trim($_POST['city']);
            $country  = trim($_POST['country']);
            $number   = trim($_POST['number']);

            // Opcional: agregar validación de datos (campos vacíos, formato, etc.)

            // Uso de transacción para garantizar la integridad de los datos
            \Illuminate\Database\Capsule\Manager::connection()->transaction(function () use ($name, $street, $zip_code, $city, $country, $number) {
                // Crea el nuevo cliente
                $customer = new Customer();
                $customer->name = $name;
                $customer->save();

                // Crea la dirección asociada al cliente
                $customer->addresses()->create([
                    'street'   => $street,
                    'zip_code' => $zip_code,
                    'city'     => $city,
                    'country'  => $country,
                ]);

                // Crea el teléfono asociado al cliente
                $customer->phones()->create([
                    'number' => $number,
                ]);
            });

            // Redirige a la lista de clientes o a la vista que prefieras
            header("Location: " . base_url() . "customer");
            exit();
        } else {
            // Si la petición no es POST, muestra el formulario de creación
            $this->view('new_customer');
        }
    }
}

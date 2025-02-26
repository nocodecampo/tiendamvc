<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Customer;
use Formacom\Models\Address;
use Formacom\Models\Phone;


class CustomerController extends Controller
{
    public function index(...$params)
    {
        // Recupera todos los clientes
        $customers = Customer::all();
        $this->view('home', $customers);
    }

    // ---------------- Método para mostrar los datos de un cliente ----------------
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

    // ---------------- Método para añadir un nuevo cliente ----------------
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

    // ---------------- Método para eliminar clientes ----------------
    public function delete(...$params)
    {
        // Se asume que el primer parámetro es el ID del cliente
        $id = $params[0];

        // Recupera el cliente por su ID
        $customer = Customer::find($id);

        if (!$customer) {
            // Si no se encuentra el cliente, redirige o muestra un mensaje de error
            header("Location: " . base_url() . "customer");
            exit();
        }

        // Usamos una transacción para eliminar de forma atómica
        \Illuminate\Database\Capsule\Manager::connection()->transaction(function () use ($customer) {
            // Elimina las direcciones asociadas
            $customer->addresses()->delete();
            // Elimina los teléfonos asociados
            $customer->phones()->delete();
            // Finalmente, elimina el cliente
            $customer->delete();
        });

        // Redirige a la lista de clientes después de la eliminación
        header("Location: " . base_url() . "customer");
        exit();
    }

    // ---------------- Método para cargar los datos en el formulario ----------------
    public function edit(...$params)
    {
        // Recupera el cliente con sus relaciones
        $customer = Customer::with(['addresses', 'phones'])->find($params[0]);

        if (!$customer) {
            // Si no se encuentra el cliente, redirige a la lista o muestra un error
            header("Location: " . base_url() . "customer");
            exit();
        }

        // Suponemos que se usa la primera dirección y el primer teléfono asociados
        $address = $customer->addresses->first();
        $phone   = $customer->phones->first();

        // Preparamos los datos a enviar a la vista
        $data = [
            'customer' => $customer,
            'address'  => $address,
            'phone'    => $phone
        ];
        // Muestra la vista edit_customer pasándole los datos
        $this->view('edit_customer', $data);
    }

    // ---------------- Método para editar un cliente ----------------
    public function updateCustomer(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger y sanitizar los datos del formulario
            $customer_id = trim($_POST['customer_id']);
            $address_id  = trim($_POST['address_id']);
            $phone_id    = trim($_POST['phone_id']);
            $name       = trim($_POST['name']);
            $street     = trim($_POST['street']);
            $zip_code   = trim($_POST['zip_code']);
            $city       = trim($_POST['city']);
            $country    = trim($_POST['country']);
            $number     = trim($_POST['number']);

            // Uso de transacción para asegurar la integridad
            \Illuminate\Database\Capsule\Manager::connection()->transaction(function () use ($customer_id, $address_id, $phone_id, $name, $street, $zip_code, $city, $country, $number) {
                // Actualiza el cliente

                $customer = Customer::find($customer_id);
                if ($customer) {
                    $customer->name = $name;
                    $customer->save();
                }

                // Actualiza la dirección
                $address = Address::find($address_id);
                if ($address) {
                    $address->street   = $street;
                    $address->zip_code = $zip_code;
                    $address->city     = $city;
                    $address->country  = $country;
                    $address->save();
                }

                // Actualiza el teléfono
                $phone = Phone::find($phone_id);
                if ($phone) {
                    $phone->number = $number;
                    $phone->save();
                }
            });

            // Redirige a la lista de clientes o a la vista deseada
            header("Location: " . base_url() . "customer");
            exit();
        } else {
            // Si la petición no es POST, redirige a la lista de clientes
            header("Location: " . base_url() . "customer");
            exit();
        }
    }
}

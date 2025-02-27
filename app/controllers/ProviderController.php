<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Provider;

class ProviderController extends Controller
{
    public function index(...$params)
    {

        // Recupera todos los proveedores
        $providers = Provider::all();
        $this->view('home', $providers);
    }

    // ---------------- Método para mostrar los datos de un proveedor ----------------
    public function show(...$params)
    {
        // Recupera el proveedor utilizando
        $provider = Provider::find($params[0]);

        // Verifica si se encontró el proveedor
        if ($provider) {
            // Llama a la vista 'detail' pasando el objeto encontrado
            $this->view('detail', $provider);
        } else {
            // Opcional: Manejar el caso en que no se encuentre el proveedor
            header("Location: " . base_url() . "provider");
        }
    }

    // ---------------- Método para añadir un nuevo proveedor ----------------
    public function addProvider(...$params)
    {
        $this->view('new_provider');
    }

    public function store(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtiene y sanitiza los datos del formulario
            $name     = trim($_POST['name']);
            $web     = trim($_POST['web']);
            $street   = trim($_POST['street']);
            $zip_code = trim($_POST['zip_code']);
            $city     = trim($_POST['city']);
            $country  = trim($_POST['country']);
            $number   = trim($_POST['number']);


            // Uso de transacción para garantizar la integridad de los datos
            \Illuminate\Database\Capsule\Manager::connection()->transaction(function () use ($name, $web, $street, $zip_code, $city, $country, $number) {
                // Crea el nuevo cliente
                $provider = new Provider();
                $provider->name = $name;
                $provider->web = $web;
                $provider->save();

                // Crea la dirección asociada al proveedor
                $provider->addresses()->create([
                    'street'   => $street,
                    'zip_code' => $zip_code,
                    'city'     => $city,
                    'country'  => $country,
                ]);

                // Crea el teléfono asociado al proveedor
                $provider->phones()->create([
                    'number' => $number,
                ]);
            });

            // Redirige a la lista de proveedores o a la vista que prefieras
            header("Location: " . base_url() . "provider");
            exit();
        } else {
            // Si la petición no es POST, muestra el formulario de creación
            $this->view('new_provider');
        }
    }

    // ---------------- Método para eliminar PROVEEDORES ----------------
    public function delete(...$params)
    {
        // Se asume que el primer parámetro es el ID del proveedor
        $id = $params[0];

        // Recupera el proveedor por su ID
        $provider = Provider::find($id);

        if (!$provider) {
            // Si no se encuentra el proveedor, redirige o muestra un mensaje de error
            header("Location: " . base_url() . "provider");
            exit();
        }

        // Usamos una transacción para eliminar de forma atómica
        \Illuminate\Database\Capsule\Manager::connection()->transaction(function () use ($provider) {
            // Elimina las direcciones asociadas
            $provider->addresses()->delete();
            // Elimina los teléfonos asociados
            $provider->phones()->delete();
            // Finalmente, elimina el proveedor
            $provider->delete();
        });

        // Redirige a la lista de proveedores después de la eliminación
        header("Location: " . base_url() . "provider");
        exit();
    }
}

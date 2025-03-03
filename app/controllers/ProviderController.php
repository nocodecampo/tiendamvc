<?php

namespace Formacom\controllers;

use Formacom\Core\Controller;
use Formacom\Models\Provider;
use Formacom\Models\Product;

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
                // Crea el nuevo proveedor
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
            header("Location: " . base_url() . "provider?error=Proveedor no encontrado");
            exit();
        }

        // Comprobación: Verifica si existen productos asociados al proveedor
        $productCount = Product::where('provider_id', $id)->count();
        if ($productCount > 0) {
            // Redirige con un mensaje de error si hay productos asociados
            header("Location: " . base_url() . "provider?error=No se puede eliminar el proveedor porque tiene productos asociados");
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

        // Redirige a la lista de proveedores tras la eliminación con un mensaje de éxito
        header("Location: " . base_url() . "provider?message=Proveedor eliminado correctamente");
        exit();
    }

    // ---------------- Método para cargar los datos en el formulario (EDITAR) ----------------
    public function edit(...$params)
    {
        // Recupera el proveedor con sus relaciones
        $provider = Provider::with(['addresses', 'phones'])->find($params[0]);

        if (!$provider) {
            // Si no se encuentra el proveedor, redirige a la lista o muestra un error
            header("Location: " . base_url() . "provider");
            exit();
        }

        // Suponemos que se usa la primera dirección y el primer teléfono asociados
        $address = $provider->addresses->first();
        $phone   = $provider->phones->first();

        // Preparamos los datos a enviar a la vista
        $data = [
            'provider' => $provider,
            'address'  => $address,
            'phone'    => $phone
        ];
        // Muestra la vista edit_provider pasándole los datos
        $this->view('edit_provider', $data);
    }

    /**
     * Muestra el formulario para agregar una nueva dirección para un proveedor.
     * Se espera recibir el provider_id como parámetro.
     */
    public function addAddress(...$params)
    {
        $providerId = $params[0] ?? null;
        if (!$providerId) {
            header("Location: " . base_url() . "provider?error=Proveedor no especificado");
            exit();
        }

        $provider = Provider::find($providerId);
        if (!$provider) {
            header("Location: " . base_url() . "provider?error=Proveedor no encontrado");
            exit();
        }

        // Se muestra la vista new_address y se pasa el objeto provider
        $this->view('new_address', ['provider' => $provider]);
    }

    /**
     * Procesa el formulario para almacenar una nueva dirección para un proveedor.
     * Se espera que el formulario envíe: provider_id, street, zip_code, city, country.
     */
    public function storeAddress(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $providerId = trim($_POST['provider_id']);
            $street     = trim($_POST['street']);
            $zip_code   = trim($_POST['zip_code']);
            $city       = trim($_POST['city']);
            $country    = trim($_POST['country']);

            $provider = Provider::find($providerId);
            if (!$provider) {
                header("Location: " . base_url() . "provider?error=Proveedor no encontrado");
                exit();
            }

            // Se crea la dirección asociada al proveedor
            $provider->addresses()->create([
                'street'   => $street,
                'zip_code' => $zip_code,
                'city'     => $city,
                'country'  => $country,
            ]);

            // Redirige al detalle del proveedor
            header("Location: " . base_url() . "provider/show/" . $providerId);
            exit();
        } else {
            header("Location: " . base_url() . "provider");
            exit();
        }
    }

    /**
     * Muestra el formulario para agregar un nuevo teléfono para un proveedor.
     * Se espera recibir el provider_id como parámetro.
     */
    public function addPhone(...$params)
    {
        $providerId = $params[0] ?? null;
        if (!$providerId) {
            header("Location: " . base_url() . "provider?error=Proveedor no especificado");
            exit();
        }

        $provider = Provider::find($providerId);
        if (!$provider) {
            header("Location: " . base_url() . "provider?error=Proveedor no encontrado");
            exit();
        }

        // Se muestra la vista new_phone y se pasa el objeto proveedor
        $this->view('new_phone', ['provider' => $provider]);
    }

    /**
     * Procesa el formulario para almacenar un nuevo teléfono para un proveedor.
     * Se espera que el formulario envíe: provider_id, number.
     */
    public function storePhone(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $providerId = trim($_POST['provider_id']);
            $number     = trim($_POST['number']);

            $provider = Provider::find($providerId);
            if (!$provider) {
                header("Location: " . base_url() . "provider?error=Proveedor no encontrado");
                exit();
            }

            // Se crea el teléfono asociado al proveedor
            $provider->phones()->create([
                'number' => $number,
            ]);

            // Redirige al detalle del proveedor
            header("Location: " . base_url() . "provider/show/" . $providerId);
            exit();
        } else {
            header("Location: " . base_url() . "provider");
            exit();
        }
    }
}

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

    // ---------------- Método para editar datos generales cliente ----------------
    public function updateCustomer(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger y sanitizar los datos del formulario
            $customer_id = trim($_POST['customer_id']);
            $name = trim($_POST['name']);

            // Actualiza los datos generales del cliente
            $customer = Customer::find($customer_id);
            if ($customer) {
                $customer->name = $name;
                $customer->save();
            }

            // Redirige al detalle del cliente
            header("Location: " . base_url() . "customer/show/" . $customer_id);
            exit();
        } else {
            header("Location: " . base_url() . "customer");
            exit();
        }
    }

    //-------- Método para editar una dirección de un cliente --------
    public function updateAddress(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger y sanitizar los datos del formulario de dirección
            $address_id = trim($_POST['address_id']);
            $customer_id = trim($_POST['customer_id']);
            $street   = trim($_POST['street']);
            $zip_code = trim($_POST['zip_code']);
            $city     = trim($_POST['city']);
            $country  = trim($_POST['country']);

            $address = Address::find($address_id);
            if ($address) {
                $address->street   = $street;
                $address->zip_code = $zip_code;
                $address->city     = $city;
                $address->country  = $country;
                $address->save();
            }

            // Redirige al detalle del cliente
            header("Location: " . base_url() . "customer/show/" . $customer_id);
            exit();
        } else {
            header("Location: " . base_url() . "customer");
            exit();
        }
    }

    //-------- Método para editar un teléfono de un cliente --------
    public function updatePhone(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger y sanitizar los datos del formulario de teléfono
            $phone_id = trim($_POST['phone_id']);
            $customer_id = trim($_POST['customer_id']);
            $number   = trim($_POST['number']);

            $phone = Phone::find($phone_id);
            if ($phone) {
                $phone->number = $number;
                $phone->save();
            }

            // Redirige al detalle del cliente
            header("Location: " . base_url() . "customer/show/" . $customer_id);
            exit();
        } else {
            header("Location: " . base_url() . "customer");
            exit();
        }
    }

    /**
     * Muestra el formulario para agregar una nueva dirección para un cliente.
     * Se espera recibir el customer_id como parámetro.
     */
    public function addAddress(...$params)
    {
        $customerId = $params[0] ?? null;
        if (!$customerId) {
            header("Location: " . base_url() . "customer?error=Cliente no especificado");
            exit();
        }

        $customer = Customer::find($customerId);
        if (!$customer) {
            header("Location: " . base_url() . "customer?error=Cliente no encontrado");
            exit();
        }

        // Se muestra la vista new_address y se pasa el objeto cliente
        $this->view('new_address', ['customer' => $customer]);
    }

    /**
     * Procesa el formulario para almacenar una nueva dirección para un cliente.
     * Se espera que el formulario envíe: customer_id, street, zip_code, city, country.
     */
    public function storeAddress(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $customerId = trim($_POST['customer_id']);
            $street     = trim($_POST['street']);
            $zip_code   = trim($_POST['zip_code']);
            $city       = trim($_POST['city']);
            $country    = trim($_POST['country']);

            $customer = Customer::find($customerId);
            if (!$customer) {
                header("Location: " . base_url() . "customer?error=Cliente no encontrado");
                exit();
            }

            // Se crea la dirección asociada al cliente
            $customer->addresses()->create([
                'street'   => $street,
                'zip_code' => $zip_code,
                'city'     => $city,
                'country'  => $country,
            ]);

            // Redirige al detalle del cliente
            header("Location: " . base_url() . "customer/show/" . $customerId);
            exit();
        } else {
            header("Location: " . base_url() . "customer");
            exit();
        }
    }

    /**
     * Muestra el formulario para agregar un nuevo teléfono para un cliente.
     * Se espera recibir el customer_id como parámetro.
     */
    public function addPhone(...$params)
    {
        $customerId = $params[0] ?? null;
        if (!$customerId) {
            header("Location: " . base_url() . "customer?error=Cliente no especificado");
            exit();
        }

        $customer = Customer::find($customerId);
        if (!$customer) {
            header("Location: " . base_url() . "customer?error=Cliente no encontrado");
            exit();
        }

        // Se muestra la vista new_phone y se pasa el objeto cliente
        $this->view('new_phone', ['customer' => $customer]);
    }

    /**
     * Procesa el formulario para almacenar un nuevo teléfono para un cliente.
     * Se espera que el formulario envíe: customer_id, number.
     */
    public function storePhone(...$params)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $customerId = trim($_POST['customer_id']);
            $number     = trim($_POST['number']);

            $customer = Customer::find($customerId);
            if (!$customer) {
                header("Location: " . base_url() . "customer?error=Cliente no encontrado");
                exit();
            }

            // Se crea el teléfono asociado al cliente
            $customer->phones()->create([
                'number' => $number,
            ]);

            // Redirige al detalle del cliente
            header("Location: " . base_url() . "customer/show/" . $customerId);
            exit();
        } else {
            header("Location: " . base_url() . "customer");
            exit();
        }
    }
}

<?php

namespace Formacom\Core;
// app/core/Controller.php
abstract class Controller
{
    abstract public function index(...$params);

    public function view($view, $data = [])
    {
        $controllerFullName = get_class($this);
        $parts = explode('\\', $controllerFullName);
        $className = end($parts);
        // Convertimos a minúsculas y removemos la palabra "Controller" para obtener el nombre de la carpeta
        $controllerName = strtolower(str_replace("Controller", "", $className));

        // Si $data no es un array, o es un array con claves numéricas (una colección)
        if (!is_array($data) || array_keys($data) === range(0, count($data) - 1)) {
            // Lo envolvemos en un array asociativo bajo la clave 'data'
            $data = ['data' => $data];
        }

        extract($data);

        require_once './app/views/' . $controllerName . '/' . $view . '.php';
    }
}

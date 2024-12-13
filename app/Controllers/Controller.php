<?php

namespace App\Controllers;

class Controller
{
    // Método para cargar vistas
    public function view($view, $data = [])
    {
        // Extraemos los datos y los convertimos en variables
        extract($data);

        // Incluimos el archivo de la vista
        include __DIR__ . "/../Views/{$view}.php";
    }
}

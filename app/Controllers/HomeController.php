<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home/index', [
            'title' => 'Inicio'
        ]);
    }
}

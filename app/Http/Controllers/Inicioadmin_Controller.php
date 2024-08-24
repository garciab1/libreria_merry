<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Inicioadmin_Controller extends Controller
{
    public function inicio_admin()
    {
        return view('inicio_admin');
    }
}

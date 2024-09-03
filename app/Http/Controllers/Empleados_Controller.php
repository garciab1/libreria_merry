<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Empleados_Controller extends Controller
{
    public function Empleados(){
        return view('Empleados');
    }
}

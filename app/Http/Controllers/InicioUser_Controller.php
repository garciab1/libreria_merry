<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioUser_Controller extends Controller
{
    public function inicio_user()
    {
        return view('inicio_user');
    }
}

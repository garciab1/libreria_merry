<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ContactController extends Controller
{
    protected $database;
    protected $tablename;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'productos';
    }

    public function index()
    {
        $productos = $this->database->getReference($this->tablename)->getValue();
        return view('firebase.contact.index', compact('productos'));
    }

    public function create()
    {
        return view('firebase.contact.create');
    }

    public function store(Request $request)
    {
        $postData = [
            'nombre_producto' => strtoupper($request->nombre_producto),
            'precio_unitario' => $request->precio_unitario,
            'stock' => $request->stock,
            'proveedor' => strtoupper($request->proveedor),
            'categoria' => $request->categoria,
            'descripcion' => strtoupper($request->descripcion),
        ];

        // Referencia a la base de datos Firebase corregida
        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if ($postRef) {
            return redirect('productos')->with('status', 'Producto añadido exitosamente');
        } else {
            return redirect('productos')->with('status', 'Producto no añadido');
        }
    }
}

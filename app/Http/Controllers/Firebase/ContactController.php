<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class ContactController extends Controller
{
    protected $database;
    protected $tablename;
    protected $tablenameUsuarios;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'productos';
        $this->tablenameUsuarios = 'usuarios';
        
    }

    public function index()
    {
        $productos = $this->database->getReference($this->tablename)->getValue();
        return view('firebase.contact.producto_stock', compact('productos'));
    }

    public function create()
    {
        return view('firebase.contact.agg_producto');
    }

    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'proveedor' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $postData = [
            'nombre_producto' => strtoupper($request->nombre_producto),
            'precio_unitario' => $request->precio_unitario,
            'stock' => $request->stock,
            'proveedor' => strtoupper($request->proveedor),
            'categoria' => $request->categoria,
            'descripcion' => strtoupper($request->descripcion),
        ];

        // Referencia a la base de datos Firebase
        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if ($request->ajax()) {
            // Respuesta JSON para solicitudes AJAX
            if ($postRef) {
                return response()->json([
                    'success' => true,
                    'message' => 'Producto añadido exitosamente'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Producto no añadido'
                ]);
            }
        } else {
            // Redirección para solicitudes normales
            if ($postRef) {
                return redirect('productos')->with('status', 'Producto añadido exitosamente');
            } else {
                return redirect('productos')->with('status', 'Producto no añadido');
            }
        }
    }



    //CONTROLADORES DE EMPLEADOS/USUARIO
    public function indexEmpleados(){
        $usuarios = $this->database->getReference($this->tablenameUsuarios)->getValue();
        return view('firebase.contact.empleados', compact('usuarios'));
    }

    public function createEmpleado(){
        return view('Firebase.contact.agg_usuarioPROV');
    }

    public function storeEmpleado(Request $request){
        $ref_tablename='usuarios';
        $postData = [
            'nombre_usuario' => strtoupper($request->nombre_usuario),
            'apellido_usuario' => strtoupper($request->apellido_usuario),
            'telefono' => $request->telefono,
            'fechaNacimiento' => $request->fechaNacimiento,
            'usuario' => $request->usuario,
            'password' => $request->password,

        ];
        $postRef = $this->database->getReference($ref_tablename)->push($postData);
        if($postRef){
            return redirect('empleados2')->with('status', 'Usuario añadido exitosamente');
        }
        else{
            return redirect('empleados2')->with('status', 'No se ha añadido el usuario');
        }
    }
    
}


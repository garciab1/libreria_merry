<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;

class ContactController extends Controller
{
    protected $database;
    protected $tablename;
    protected $tablenameUsuarios;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'productos';

        
    }

    public function index()
    {
        $productos = $this->database->getReference($this->tablename)->getValue();
        return view('firebase.Contact.producto_stock', compact('productos'));
    }

    //Llama la vista
    public function create()
    {
        return view('firebase.Contact.agg_producto');
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

    public function editProducto($id){
        $key = $id;
        $editData = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editData){
            return view('Firebase.Contact.edit_producto', compact('editData', 'key'));
        }
        else{
            return redirect('productos')->with('status', 'ID del Empleado no encontrado');
        }
    }

    public function updateProducto(Request $request, $id){
        $key = $id;
        $updateData = [
            'nombre_producto' => strtoupper($request->nombre_producto),
            'precio_unitario' => $request->precio_unitario,
            'stock' => $request->stock,
            'proveedor' => strtoupper($request->proveedor),
            'categoria' => strtoupper($request->categoria),
            'descripcion' => strtoupper($request->descripcion),

        ];
        $res_updated = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        if($res_updated){
            return redirect('productos')->with('status', 'Producto actualizado exitosamente.');
        }
        else{
            return redirect('productos')->with('status', 'Producto no actualizado.');
        }

    }


    public function destroyProducto($id){
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data){
            return redirect('productos')->with('status', 'Producto eliminado exitosamente.');
        }
        else{
            return redirect('productos')->with('status', 'Producto no eliminado.');
        }
    }


}


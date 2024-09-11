<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;

class EmpleadosController extends Controller
{
    protected $database;
    protected $tablename;
    

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'usuarios';
        
    }

    //CONTROLADORES DE EMPLEADOS/USUARIO
    public function indexEmpleados(){
        $usuarios = $this->database->getReference($this->tablename)->getValue();
        return view('firebase.Empleados-Usuarios.empleados', compact('usuarios'));
    }

    public function createEmpleado(){
        return view('Firebase.Empleados-Usuarios.agg_usuarioPROV');
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

    public function editEmpleado($id){
        $key = $id;
        $editData = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        if($editData){
            return view('Firebase.Empleados-Usuarios.edit_empleado', compact('editData', 'key'));
        }
        else{
            return redirect('empleados2')->with('status', 'ID del Empleado no encontrado');
        }
    }

    public function updateEmpleado(Request $request, $id){
        $key = $id;
        $updateData = [
            'nombre_usuario' => strtoupper($request->nombre_usuario),
            'apellido_usuario' => strtoupper($request->apellido_usuario),
            'telefono' => $request->telefono,
            'fechaNacimiento' => $request->fechaNacimiento,
            'usuario' => $request->usuario,
            'password' => $request->password,

        ];
        $res_updated = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        if($res_updated){
            return redirect('empleados2')->with('status', 'Empleado actualizado exitosamente.');
        }
        else{
            return redirect('empleados2')->with('status', 'Empleado no actualizado.');
        }

    }

    public function destroyEmpleado($id){
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();
        if($del_data){
            return redirect('empleados2')->with('status', 'Empleado eliminado exitosamente.');
        }
        else{
            return redirect('empleados2')->with('status', 'Empleado no eliminado.');
        }
    }
    
}


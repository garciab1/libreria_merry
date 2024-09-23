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
        $this->tablename = 'users';
        
    }

    //CONTROLADORES DE EMPLEADOS/USUARIO
    public function indexEmpleados(){
        $users = $this->database->getReference($this->tablename)->getValue();
        return view('firebase.Empleados-Usuarios.empleados', compact('users'));
    }
   

    public function createEmpleado(){
        return view('Firebase.Empleados-Usuarios.agg_empleado');
    }

    public function storeEmpleado(Request $request){
        $ref_tablename='users';
        $postData = [
            'name' => strtoupper($request->name),
            'email' => $request -> email,
            'password' => $request->password,
            'rol' => $request->rol,

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
    
        // Solo actualizamos el rol
        $updateData = [
            'rol' => $request->rol,
        ];
    
        $res_updated = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);
        if($res_updated){
            return redirect('empleados2')->with('status', 'Rol actualizado exitosamente.');
        }
        else{
            return redirect('empleados2')->with('status', 'Rol no actualizado.');
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


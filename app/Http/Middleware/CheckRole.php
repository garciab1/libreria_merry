<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */

    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/login'); // Redirigir al login si no está autenticado
        }

        $user = Auth::user();
        // Aquí se obtiene el rol del usuario desde Firebase
        $userRole = $this->getUserRoleFromFirebase($user->email); 

        // Verificar si el rol del usuario coincide
        if ($userRole !== $role) {
            return redirect('/'); // Redirigir si no tiene permiso
        }

        return $next($request);
    }

    // Método para obtener el rol del usuario desde Firebase
    private function getUserRoleFromFirebase($email)
    {
        

        // Obtener el rol:
        $firebaseUrl = 'https://sis-merry-default-rtdb.firebaseio.com/users.json';
        $usersInFirebase = file_get_contents($firebaseUrl);
        $usersData = json_decode($usersInFirebase, true);
        
        foreach ($usersData as $user) {
            if ($user['email'] === $email) {
                return $user['rol']; // Retornar el rol del usuario
            }
        }

        return null; // En caso de que no se encuentre el rol
    }
}


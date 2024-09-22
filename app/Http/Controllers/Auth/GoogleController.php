<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            // Verifica si el usuario ya existe en la base de datos de Laravel
            $findUser = User::where('email', $user->getEmail())->first();

            // Si el usuario no existe en la base de datos local, lo creamos
            if (!$findUser) {
                $plainPassword = uniqid(); // Generar una contraseña única

                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'password' => $plainPassword, // Guardar la contraseña generada
                ]);

                Auth::login($newUser); // Loguear al nuevo usuario
            } else {
                Auth::login($findUser); // Loguear al usuario existente
            }

            // Verificar si el usuario ya está en Firebase antes de guardarlo
            $this->checkAndSaveUserToFirebase($user, $user->getAvatar());

            // Redirigir según el rol del usuario
            $firebaseUser = $this->getUserFromFirebase($user->getEmail());
            if ($firebaseUser['rol'] === 'admin') {
                return redirect()->route('IniAdmin');
            } else {
                return redirect()->route('IniUser');
            }
            
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function checkAndSaveUserToFirebase($user, $avatar)
    {
        $firebaseUrl = 'https://sis-merry-default-rtdb.firebaseio.com/users.json';
        
        // Primero, obtener todos los usuarios de Firebase para verificar si ya existe
        $usersInFirebase = file_get_contents($firebaseUrl);
        $usersData = json_decode($usersInFirebase, true); // Decodificar el JSON recibido
        
        // Verificar si el correo del usuario ya está en la base de datos
        $userExists = false;
        if ($usersData) {
            foreach ($usersData as $existingUser) {
                if (isset($existingUser['email']) && $existingUser['email'] === $user->getEmail()) {
                    $userExists = true;
                    break;
                }
            }
        }

        // Si el usuario no existe, lo guardamos en Firebase con el rol de 'user'
        if (!$userExists) {
            $data = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => $avatar,
                'google_id' => $user->getId(),
                'password' => uniqid(), // Generar una contraseña para guardar
                'rol' => 'user', // Asignar rol por defecto 'user'
            ];

            $options = [
                'http' => [
                    'header' => "Content-Type: application/json\r\n",
                    'method' => 'POST', // Guardar nuevo usuario en Firebase
                    'content' => json_encode($data),
                ],
            ];

            $context = stream_context_create($options);
            $result = file_get_contents($firebaseUrl, false, $context);

            if ($result === false) {
                throw new \Exception('Error al guardar datos en Firebase.');
            }
        }
    }

    private function getUserFromFirebase($email)
    {
        $firebaseUrl = 'https://sis-merry-default-rtdb.firebaseio.com/users.json';
        $usersInFirebase = file_get_contents($firebaseUrl);
        $usersData = json_decode($usersInFirebase, true); // Decodificar el JSON recibido
        
        foreach ($usersData as $existingUser) {
            if (isset($existingUser['email']) && $existingUser['email'] === $email) {
                return $existingUser;
            }
        }
        return null;
    }
}


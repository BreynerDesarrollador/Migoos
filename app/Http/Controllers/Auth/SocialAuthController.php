<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;


class SocialAuthController extends Controller
{
    //
    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user();
        $token = $social_user->token;
        try {

            // Comprobamos si el usuario ya existe
            if ($user = User::where('email', $social_user->email)->first()) {
                $user->name = $social_user->name;
                $user->avatar = $social_user->avatar;
                $user->save();
                return $this->authAndRedirect($user); // Login y redirección
            } else {
                // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = User::create([
                    'name' => $social_user->name,
                    'email' => $social_user->email,
                    'password' => bcrypt('123456789migoos'),
                    'avatar' => $social_user->avatar,
                    'type' => 1,
                    'verification' => 0,
                ]);

                return $this->authAndRedirect($user); // Login y redirección
            }
        }catch (Excepcion $es){
            $user= Socialite::driver('github')->userFromToken($token);
        }
    }

    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);

        return redirect()->to('/home#');
    }
}

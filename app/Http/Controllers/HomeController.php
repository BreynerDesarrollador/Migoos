<?php

namespace App\Http\Controllers;

use App\Jobs\enviarverificacionemail;
use App\Mail\Prueba;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function migoos()
    {
        return view('migoos');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function mail()
    {
        $user = User::all()->toArray();
        Mail::to($user)->send(new Prueba());

        return response()->json('El correo se ha enviado con exiot!');
    }

    public function cargareventos(Request $request)
    {
        try {

            $latitud = Input::get('lat');
            $longitud = Input::get('long');
            $accuracy = $request->input('accuracy');
            $dato = DB::select('call sp_eventos(0);');

            return response()->json($dato);
        } catch (Exception $ex) {
            echo "Error::.." . $ex;
        }
    }

    public function cargarcombos()
    {
        $operacion = Input::get('operacion');
        $buscar = Input::get('buscar');
        try {
            $datos = DB::select("call sp_cargarcombos('$operacion','$buscar')");
            return response()->json($datos);
        } catch (Excepcion $es) {
            throw $es;
        }
    }

    public function cargarciudades(Request $request)
    {
        $buscar = $request->input('keyword');
        $datos = DB::select("call  sp_cargarciudad('$buscar')");
        return response()->json($datos);

    }

    public function buscareventociudad()
    {
        try {

        } catch (Excepcion $es) {
            throw new $es;
        }
    }

    public function pruebacola()
    {
        try {
            $user = User::find(1);
            dispatch(new enviarverificacionemail($user));
            return view('emails.verificacion')->with(["correo" => $user->email]);
        } catch (Excepcion $es) {
            throw new $es;
        }
    }

    public function eventoshoymanana(Request $request)
    {
        try {
            $datos = DB::select('call sp_eventoshoymanana();');
            return response()->json($datos);
        } catch (\Exception $es) {
            throw $es;
        }
    }

    public function datosusuario()
    {
        try {
// Comprobamos si ya tenemos la variable de sesión guardada, o
// más concretamente, le pedimos a nuestro script que sólo
// ejecute este bloque de código si NO está asignada.
            if (!session('country_code')) {
                // Cogemos la IP del usuario del array que nos pasa el servidor
                $user_ip = $_SERVER['REMOTE_ADDR'];
// Iniciamos el handler de CURL y le pasamos la URL de la API externa
                $ch = curl_init("http://api.ipstack.com/$user_ip?access_key=37ada1cf3258ff604438208b0c5091bd");

// Con este comando le pedimos a CURL que, en vez de mostrar
// el resultado en pantalla, nos lo devuelva como una variable
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Y simplemente hacemos la petición HTTP.
                $country_code = curl_exec($ch);

// Guardamos la variable en $_SESSION
                session(['country_code' => $country_code]);// = $country_code;
            }
            echo session('country_code');
        } catch (Excepcion $es) {
            throw $es;
        }
    }
}

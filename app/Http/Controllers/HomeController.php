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
        $this->datosusuario();
        return view('home');
    }

    public function migoos()
    {
        $this->datosusuario();
        return view('migoos');
    }

    public function welcome()
    {
        $this->datosusuario();
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
            $datos=json_decode(session('event_ubicacion'),true);
            $ciudad=!empty($datos['city'])?$datos['city']:'';
            //return response()->json(session()->all());
            $dato = DB::select("call sp_eventos(0,'$ciudad');");

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
            if (!session('event_ubicacion')) {
                $user_ip = $_SERVER['REMOTE_ADDR'];
                //http://api.ipstack.com/$user_ip?access_key=37ada1cf3258ff604438208b0c5091bd&output=json
                $ch = curl_init("http://ipapi.co/json");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $country_code = curl_exec($ch);
                session(['event_ubicacion' => $country_code]);// = $country_code;
            }
            return session('event_ubicacion');
        } catch (Excepcion $es) {
            throw $es;
        }
    }
}

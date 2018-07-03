<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.home');
    }

    public function guardarevento(Request $request)
    {
        try {
            //return $request->only('nombre');
            $request->validate(
                ["nombre" => "required", "descripcion" => "required", "fecha" => "required",
                    "direccion" => "required", "categoria" => "required",
                    "ciudad" => "required", "tipo" => "required", "costo" => "required_if:tipo,1",
                    "latitud" => "required",
                    "longitud" => "required",
                    'imagen' => 'required',
                    'imagen.*' => 'image|mimes:jpeg,png,jpg,gif,svg']
            );

            $nombre = $this->guardarimagen($request);

            //$guar=Evento::create($request->only('nombre','detalle','descripcion','fecha','direccion','tipo','costo','latitud','lon'));

            $guar = new Evento();
            $guar->nombre = $request->input('nombre');
            $guar->detalle = $request->input('detalle');
            $guar->descripcion = $request->input('descripcion');
            $guar->fecha = $request->input('fecha');
            $guar->direccion = $request->input('direccion');
            $guar->categoria = $request->input('categoria');
            $guar->ciudad = $request->input('ciudad');
            $guar->tipo = $request->input('tipo');
            #$guar->tipo_evento = $request->input('tipo_evento');
            $guar->costo = !empty($request->input('costo')) ? str_replace(",", "", $request->input('costo')) : 0;
            $guar->latitud = $request->input('latitud');
            $guar->longitud = $request->input('longitud');
            $guar->path = 'img/storage/thumbnail/';
            $guar->pathname = $nombre;
            $guar->favorito = 0;
            $guar->videourl = $request->input('videourl');
            $guar->usuario = Auth::user()->id;
            $guar->url = Str::slug($request->input('nombre'));
            $guar->save();


            return response()->json(['msj' => 'OK']);
        } catch (Excepcion $es) {
            throw $es;

        }
    }

    public function guardarimagen(Request $request)
    {
        try {
            $nombre = $this->generarimagen646($request);
            $this->generarimagen330($request, $nombre);

            return $nombre;
        } catch (Excepcion $es) {
            throw $es;
        }
    }

    public function generarimagen646($request)
    {
        try {
            $ruta1 = "img/storage/thumbnail/thumbnail646/";
            $path = $request->imagen->store($ruta1, 'local');
            $image = Image::make($path);
            $image->resize(646, 485);
            $image->save($path);
            $cont = count(explode('/', $path));
            return explode('/', $path)[$cont - 1];
        } catch (Excepcion $es) {
            throw $es;
        }
    }

    public function generarimagen330(Request $request, $nombre)
    {
        try {
            $ruta1 = "img/storage/thumbnail/thumbnail330/";
            $rutacompleta = $request->imagen->storeAs($ruta1, $nombre, 'local');
            //Creamos una instancia de la libreria instalada
            $image = \Image::make($rutacompleta);
            $image->resize(330, 250);
            $image->save($rutacompleta);
        } catch (Excepcion $es) {
            throw $es;
        }
    }

    public function eliminarevento($id)
    {
        try {
            $datos = Evento::find($id);
            Storage::disk('local')->delete($datos->path . 'thumbnail646/' . $datos->pathname);
            Storage::disk('local')->delete($datos->path . 'thumbnail330/' . $datos->pathname);
            $datos->delete();

            return response()->json($id);

        } catch (Excepcion $es) {
            throw $es;
        }
    }

    public function favorito($id, $favorito)
    {
        try {
            $eve = Evento::find($id);
            $eve->favorito = $favorito;
            $eve->save();

            return response()->json(["favorito" => $favorito, "id" => $id]);
        } catch (\Exception $es) {
            throw $es;
        }
    }

    public function obtenerdatosevento($id)
    {
        $datos = DB::select("call sp_eventos($id)");
        return response()->json($datos);
    }
}

<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:36 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Evento
 * 
 * @property int $id
 * @property string $nombre
 * @property string $detalle
 * @property string $descripcion
 * @property \Carbon\Carbon $fecha
 * @property string $direccion
 * @property int $categoria
 * @property int $ciudad
 * @property string $path
 * @property string $pathname
 * @property string $tipo
 * @property int $costo
 * @property string $latitud
 * @property string $longitud
 * @property int $favorito
 * @property string $videourl
 * @property int $usuario
 * @property \Carbon\Carbon $created_at
 *
 * @package App\Models
 */
class Evento extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'categoria' => 'int',
		'ciudad' => 'int',
		'costo' => 'int',
		'favorito' => 'int',
		'usuario' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'nombre',
		'detalle',
		'descripcion',
		'fecha',
		'direccion',
		'categoria',
		'ciudad',
		'path',
		'pathname',
		'tipo',
		'costo',
		'latitud',
		'longitud',
		'favorito',
		'videourl',
		'usuario',
        'url'
	];
}

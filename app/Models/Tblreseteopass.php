<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:37 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Tblreseteopass
 * 
 * @property int $id
 * @property int $idusuario
 * @property string $nombre
 * @property string $token
 * @property \Carbon\Carbon $fecha
 *
 * @package App\Models
 */
class Tblreseteopass extends Eloquent
{
	protected $table = 'tblreseteopass';
	public $timestamps = false;

	protected $casts = [
		'idusuario' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'idusuario',
		'nombre',
		'token',
		'fecha'
	];
}

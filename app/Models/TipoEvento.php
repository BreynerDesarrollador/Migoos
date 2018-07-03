<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:37 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TipoEvento
 * 
 * @property int $id
 * @property string $nombre
 *
 * @package App\Models
 */
class TipoEvento extends Eloquent
{
	protected $table = 'tipo_evento';
	public $timestamps = false;

	protected $fillable = [
		'nombre'
	];
}

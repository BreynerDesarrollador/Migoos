<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:36 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Municipio
 * 
 * @property int $id_municipio
 * @property int $id_departamento
 * @property string $descripcion
 *
 * @package App\Models
 */
class Municipio extends Eloquent
{
	protected $primaryKey = 'id_municipio';
	public $timestamps = false;

	protected $casts = [
		'id_departamento' => 'int'
	];

	protected $fillable = [
		'id_departamento',
		'descripcion'
	];
}

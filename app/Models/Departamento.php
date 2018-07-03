<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:36 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Departamento
 * 
 * @property int $id_departamento
 * @property string $descripcion
 *
 * @package App\Models
 */
class Departamento extends Eloquent
{
	protected $primaryKey = 'id_departamento';
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];
}

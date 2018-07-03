<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:36 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CategoriaEvento
 * 
 * @property int $id
 * @property string $descripcion
 *
 * @package App\Models
 */
class CategoriaEvento extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];
}

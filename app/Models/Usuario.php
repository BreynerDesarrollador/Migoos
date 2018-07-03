<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:37 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Usuario
 * 
 * @property int $usuarioid
 * @property string $nombres
 * @property string $apellidos
 * @property string $email
 * @property string $Clave
 * @property string $imagen
 * @property string $facebookid
 * @property string $twitterid
 * @property string $googleid
 *
 * @package App\Models
 */
class Usuario extends Eloquent
{
	protected $primaryKey = 'usuarioid';
	public $timestamps = false;

	protected $fillable = [
		'nombres',
		'apellidos',
		'email',
		'Clave',
		'imagen',
		'facebookid',
		'twitterid',
		'googleid'
	];
}

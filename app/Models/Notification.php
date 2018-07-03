<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 20 Jun 2018 11:43:37 -0500.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Notification
 * 
 * @property string $id
 * @property string $type
 * @property int $notifiable_id
 * @property string $notifiable_type
 * @property string $data
 * @property \Carbon\Carbon $read_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Notification extends Eloquent
{
	public $incrementing = false;

	protected $casts = [
		'notifiable_id' => 'int'
	];

	protected $dates = [
		'read_at'
	];

	protected $fillable = [
		'type',
		'notifiable_id',
		'notifiable_type',
		'data',
		'read_at'
	];
}

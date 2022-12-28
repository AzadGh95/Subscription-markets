<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\PlatformEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Statistic
 * 
 * @property int|null $id
 * @property int|null $app_id
 * @property string|null $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Devapp|null $devapp
 *
 * @package App\Models
 */
class Statistic extends Model
{
	public const APP_ID = 'devapp_id';

    public const STATUS = 'status';

	protected $casts = [
		'devapp_id' => 'int',
		'status'=> PlatformEnum::class
	];

	protected $fillable = [
		'devapp_id',
		'status'
	];

	public function devapp()
	{
		return $this->belongsTo(Devapp::class, 'devapp_id');
	}
}

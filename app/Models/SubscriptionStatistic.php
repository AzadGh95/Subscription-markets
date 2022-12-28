<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubscriptionStatistic
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
class SubscriptionStatistic extends Model
{
	protected $table = 'subscription_statistics';

	protected $casts = [
		'app_id' => 'int'
	];

	protected $fillable = [
		'app_id',
		'status'
	];

	public function devapp()
	{
		return $this->belongsTo(Devapp::class, 'app_id');
	}
}

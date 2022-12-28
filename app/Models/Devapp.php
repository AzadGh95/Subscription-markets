<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Devapp
 * 
 * @property int|null $id
 * @property string|null $name
 * @property string|null $platform
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App\Models
 */
class Devapp extends Model
{
	use  HasFactory;

	protected $table = 'devapps';

	protected $fillable = [
		'name',
		'platform'
	];
	/** @return HasMany  */
	public function statistics(): HasMany
	{
		return $this->hasMany(Statistic::class);
	}
}

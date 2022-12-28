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
 * @property int|null $devapp_id
 * @property string|null $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Devapp|null $devapp
 */
class Statistic extends Model
{
    public const APP_ID = 'devapp_id';

    public const STATUS = 'status';

    public const COUNT = 'count';

    protected $casts = [
        'devapp_id' => 'int',
        'count' => 'int',
        'status' => PlatformEnum::class,
    ];

    protected $fillable = [
        'devapp_id',
        'status',
        'count',
    ];

    public function devapp()
    {
        return $this->belongsTo(Devapp::class, 'devapp_id');
    }
}

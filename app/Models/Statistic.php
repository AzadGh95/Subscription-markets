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
 * @property int|null $expired_count
 * @property string|null $last_status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Devapp|null $devapp
 */
class Statistic extends Model
{
    public const APP_ID = 'devapp_id';

    public const LAST_STATUS = 'last_status';

    public const EXPIRED_COUNT = 'expired_count';

    protected $casts = [
        'devapp_id' => 'int',
        'count' => 'int',
        'last_status' => PlatformEnum::class,
    ];

    protected $fillable = [
        'devapp_id',
        'last_status',
        'expired_count',
    ];

    public function devapp()
    {
        return $this->belongsTo(Devapp::class, 'devapp_id');
    }
}

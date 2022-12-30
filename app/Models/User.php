<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property int|null $id
 * @property string|null $name
 * @property string|null $email
 * @property Carbon $email_verified_at
 * @property string|null $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Model
{
    use  HasFactory;

    public const ID = 'id';

    public const NAME = 'name';

    public const EMAIL = 'email';

    public const ACTIVE = 'active';

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeActive($query)
    {
        $query->where(self::ACTIVE, true);
    }

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'email',
    ];
}

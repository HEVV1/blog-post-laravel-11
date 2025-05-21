<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use App\Repository\UserRepository;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 *
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 * @property Carbon|string $email_verified_at
 *
 * @method static UserRepository repository
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'table_user';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    public static string $repositoryClass = UserRepository::class;

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        static::creating(static function ($model) {
            $model->uuid = Uuid::uuid4()
                ->toString();
        });
    }
}

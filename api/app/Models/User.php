<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use App\Repository\UserRepository;
use App\Traits\HasRepositoryTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property Post[] $posts
 * @property Comment[] $comments
 *
 * @method static UserRepository repository
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;
    use HasRepositoryTrait;

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

    protected static string $repositoryClass = UserRepository::class;

    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

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

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}

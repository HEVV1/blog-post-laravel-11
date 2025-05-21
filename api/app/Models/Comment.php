<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $uuid
 * @property string content
 *
 * @property int $user_id
 * @property int $post_id
 *
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 *
 * @property User $user
 * @property Post $post
 */
class Comment extends Model
{
    use HasFactory;

    protected $table = 'table_comment';

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
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
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}

<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $uuid
 * @property string $title
 *
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 *
 * @property Post[] $posts
 */
class Category extends Model
{
    use HasFactory;

    protected $table = 'table_category';

    protected $fillable = [
        'title',
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

    /**
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'table_category_post', 'category_id', 'post_id')
            ->withTimestamps();
    }
}

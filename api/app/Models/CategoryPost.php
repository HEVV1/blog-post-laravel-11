<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $uuid
 * @property string $title
 *
 * @property int $category_id
 * @property int $post_id
 *
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 * @property Carbon|string $deleted_at
 *
 * @property Post $post
 * @property Category $category
 */
class CategoryPost extends Pivot
{
    use HasFactory;

    protected $table = 'table_category_post';

    protected $fillable = [
        'title',
        'category_id',
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
     * @return HasOne
     */
    public function post(): HasOne
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

<?php

namespace App\Repository;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Interfaces\AbstractRepository;

/**
 * @package App\Repository
 *
 * @property Post $model
 */
class PostRepository extends AbstractRepository
{
    public function getPostList(): Collection
    {
        return $this->query()
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
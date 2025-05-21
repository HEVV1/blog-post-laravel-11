<?php

namespace App\Repository\Interfaces;

use Closure;
use RuntimeException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractRepository
{
    protected mixed $_model;

    /**
     * @throws RuntimeException
     */
    public function __construct(mixed $model)
    {
        $this->_model = new $model;

        if (!($this->_model instanceof Model)) {
            throw new RuntimeException($model . "must be instance of Illuminate\Database\Eloquent\Model class");
        }
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->_model;
    }

    /**
     * @param array|string|Closure $whereColumns
     * @return Collection
     */
    public function all(array|string|Closure $whereColumns = []): Collection
    {
        return $this->query()
            ->where($whereColumns)
            ->get();
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->_model->query();
    }

    /**
     * @param array $ids
     *
     * @return Collection
     */
    public function getByIds(array $ids): Collection
    {
        return $this->query()
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * @param array|string|Closure $whereColumns
     *
     * @return Model|static
     */
    public function firstOrFail(array|string|Closure $whereColumns = []): Model|static
    {
        return $this->query()
            ->where($whereColumns)
            ->firstOrFail();
    }

    /**
     * @param array|string|Closure $whereColumns
     *
     * @return Model|static
     */
    public function first(array|string|Closure $whereColumns = []): ?object
    {
        return $this->query()
            ->where($whereColumns)
            ->first();
    }

    /**
     * @param int $id
     *
     * @return null|object
     */
    public function firstById(int $id): ?object
    {
        return $this->query()
            ->where('id', '=', $id)
            ->first();
    }

    /**
     * @param string|null $uuid
     *
     * @return null|object
     */
    public function firstByUuid(string $uuid = null): ?object
    {
        return $this->query()
            ->where('uuid', '=', $uuid)
            ->first();
    }
}
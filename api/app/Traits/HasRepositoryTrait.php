<?php

namespace App\Traits;

use App\Repository\Interfaces\AbstractRepository;

/**
 * @package App\Traits
 */
trait HasRepositoryTrait
{
    /**
     * @return AbstractRepository
     */
    public static function repository(): AbstractRepository
    {
        return static::getRepository();
    }

    /**
     * @return AbstractRepository
     */
    public static function getRepository(): AbstractRepository
    {
        return new static::$repositoryClass(static::class);
    }
}
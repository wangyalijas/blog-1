<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BaseRepositoryInterface extends RepositoryInterface
{
    /**
     * Delete a entity in repository by id
     *
     * @param \Illuminate\Database\Eloquent\Collection|array $ids
     *
     * @return int
     */
    public function deleteMany($ids);
}

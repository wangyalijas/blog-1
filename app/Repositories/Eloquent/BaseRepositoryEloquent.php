<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\BaseRepositoryInterface;

abstract class BaseRepositoryEloquent extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Delete a entity in repository by id
     *
     * @param \Illuminate\Database\Eloquent\Collection|array $ids
     *
     * @return int
     */
    public function deleteMany($ids) {
        if ($ids instanceof \Illuminate\Database\Eloquent\Collection) {
            $ids = $ids->modelKeys();
        }
        return $this->model->whereKey($ids)->delete();
    }
}

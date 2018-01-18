<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Presenters\UserPresenter;
use App\Repositories\Interfaces\UserRepository;
use App\Validators\UserValidator;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return UserValidator::class;
    }


    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return UserPresenter::class;
    }
}

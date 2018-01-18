<?php

namespace App\Repositories\Eloquent;

use App\Presenters\ArticlePresenter;
use App\Repositories\Interfaces\ArticleRepository;
use App\Models\Article;
use App\Validators\ArticleValidator;

class ArticleRepositoryEloquent extends BaseRepositoryEloquent implements ArticleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Article::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return ArticleValidator::class;
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return ArticlePresenter::class;
    }


}

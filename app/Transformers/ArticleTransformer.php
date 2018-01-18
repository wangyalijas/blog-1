<?php

namespace App\Transformers;

use App\Models\Article;

class ArticleTransformer extends BaseTransformer
{
    protected $availableIncludes = [
        'deleted_at',
    ];

    /**
     * Transform the Article entity
     * @param Article $model
     *
     * @return array
     */
    public function transform(Article $model)
    {
        return [
            'id' => (int)$model->getKey(),

            'title' => $model->getTitle(),
            'summary' => $model->getSummary(),
            'content' => $model->getContent(),
            'views' => (int)$model->getViews(),
            'published_at' => $model->getPublishedAt(),

            'created_at' => (string)$model->getCreatedAt(),
            'updated_at' => (string)$model->getUpdatedAt()
        ];
    }
}

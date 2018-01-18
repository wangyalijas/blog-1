<?php

namespace App\Transformers;

use App\Models\User;

class UserTransformer extends BaseTransformer
{

    /**
     * Transform the User entity
     * @param User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => (int)$model->getKey(),
            'name' => $model->getName(),
            'email' => $model->getEmail(),
            'created_at' => (string)$model->getCreatedAt(),
            'updated_at' => (string)$model->getUpdatedAt(),
        ];
    }
}

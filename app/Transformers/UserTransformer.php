<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

/**
 * Class UserTransformer
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
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

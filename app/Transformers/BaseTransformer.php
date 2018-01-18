<?php

namespace App\Transformers;

use App\Models\Traits\SoftDeletesAttribute;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

abstract class BaseTransformer extends TransformerAbstract
{
    public function includeDeletedAt(Model $model)
    {
        return $model instanceof SoftDeletesAttribute
            ? $this->primitive((string)$model->getDeletedAt())
            : null;
    }
}

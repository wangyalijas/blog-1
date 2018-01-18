<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

abstract class BaseModel extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * Get the value of the model's created time.
     *
     * @return \Carbon\Carbon|null
     */
    public function getCreatedTime()
    {
        return $this->getAttribute($this->getCreatedAtColumn());
    }

    /**
     * Get the value of the model's updated time.
     *
     * @return \Carbon\Carbon|null
     */
    public function getUpdatedTime()
    {
        return $this->getAttribute($this->getUpdatedAtColumn());
    }
}

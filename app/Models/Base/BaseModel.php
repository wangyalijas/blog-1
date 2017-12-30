<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
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

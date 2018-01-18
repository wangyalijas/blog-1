<?php

namespace App\Models\Traits;


use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDeletesAttribute
{
    public static function bootSoftDeletesAttribute()
    {
        $className = static::class;
        $uses = class_uses($className);
        if (!in_array(SoftDeletes::class, $uses)) {
            $softDeletesClassName = SoftDeletes::class;
            throw new \Exception("The {$className} model must use {$softDeletesClassName} trait.");
        }
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getDeletedAt()
    {
        return $this->getAttribute($this->getDeletedAtColumn());
    }
}

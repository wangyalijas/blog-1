<?php

namespace App\Transformers;

class BasicTransformer extends BaseTransformer
{
    public function transform(array $data)
    {
        return $data;
    }
}

<?php

namespace App\Presenters;

use App\Transformers\BasicTransformer;
use League\Fractal\TransformerAbstract;

class BasicPresenter extends BasePresenter
{
    /**
     * Thr transformer
     *
     * @var TransformerAbstract|string|null
     */
    private $transformer;

    public function setTransformer($transformer = null)
    {
        $this->transformer = $transformer;
    }

    public function getTransformer()
    {
        if ($this->transformer instanceof TransformerAbstract) {
            return $this->transformer;
        } elseif (is_string($this->transformer) && class_exists($this->transformer)) {
            return new $this->transformer;
        } else {
            return new BasicTransformer();
        }
    }
}

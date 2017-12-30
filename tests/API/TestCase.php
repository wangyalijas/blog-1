<?php

namespace Tests\API;

use Tests\API\Concerns\AuthRequest;
use Tests\API\Concerns\DingoAPIHelper;
use Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use AuthRequest, DingoAPIHelper;

    public function setUpTraits()
    {
        $uses = parent::setUpTraits();

        foreach ($uses as $trait) {
            $method = 'boot' . class_basename($trait);
            if (method_exists($this, $method)) {
                forward_static_call([$this, $method]);
            }
        }

        return $uses;
    }
}

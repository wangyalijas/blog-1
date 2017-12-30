<?php

namespace Tests\API\Concerns;

trait DingoAPIHelper
{
    public function bootDingoAPIHelper()
    {
        if ($this->isAPIStrictMode()) {
            $this->setAPIHeaders();
        }
    }

    private function isAPIStrictMode(): bool
    {
        return (bool)config('api.strict');
    }

    /**
     * Get default headers
     *
     * @return array
     */
    public function getAPIHeaders(): array
    {
        $subtype = config('api.subtype');
        $standardsTree = config('api.standardsTree');
        $version = config('api.version');
        $headers = [
            'Accept' => "application/{$standardsTree}.{$subtype}.{$version}+json"
        ];
        return $headers;
    }

    private function setAPIHeaders()
    {
        return $this->withHeaders($this->getAPIHeaders());
    }
}

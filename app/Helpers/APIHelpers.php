<?php

if (! function_exists('api_route')) {
    /**
     * Generate the URL to a named API route.
     *
     * @param string|null $version
     * @param  string $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function api_route($name, $parameters = [], $absolute = true, $version = null)
    {
        $version = $version ?: config('api.version');
        return version($version)->route($name, $parameters, $absolute);
    }
}
<?php

namespace App\Http\Web\Controllers\Console;

use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string Guard name of console.
     */
    protected $guardName = 'console';

    /**
     * Guest middleware name of console
     * @return string
     */
    protected function getGuestMiddlewareName()
    {
        return "guest:{$this->guardName}";
    }

    protected function getAuthInstance()
    {
        return Auth::guard($this->guardName);
    }
}

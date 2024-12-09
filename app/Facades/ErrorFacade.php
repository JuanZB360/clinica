<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;


class ErrorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ErrorServices';
    }
}

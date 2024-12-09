<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SpecialityFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SpecialityServices';
    }
}

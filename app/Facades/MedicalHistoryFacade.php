<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;


class MedicalHistoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MedicalHistoryServices';
    }
}

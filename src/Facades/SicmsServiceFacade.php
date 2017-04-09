<?php

namespace Sitec\Siravel\Facades;

use Illuminate\Support\Facades\Facade;

class SiravelServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SiravelService';
    }
}

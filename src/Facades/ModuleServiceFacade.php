<?php

namespace Sitec\Siravel\Facades;

use Illuminate\Support\Facades\Facade;

class ModuleServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ModuleService';
    }
}

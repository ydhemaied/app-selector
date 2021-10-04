<?php

namespace Magnet\AppSelector\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Selector extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'selector';
    }
}
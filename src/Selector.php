<?php

namespace Magnet\AppSelector;

use Illuminate\Support\Facades\Facade;

class Selector extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'selector';
    }
}
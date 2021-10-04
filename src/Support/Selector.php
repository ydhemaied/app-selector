<?php

namespace Magnet\AppSelector\Support;

use Illuminate\Support\Facades\App;
use Magnet\AppSelector\Services\Contracts\AppProviderInterface;

class Selector
{
    public function apps()
    {
        $appsService = App::make(AppProviderInterface::class);
        return $appsService->getApps();
    }
}
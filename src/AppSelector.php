<?php

namespace Magnet\AppSelector;

use Illuminate\Support\Facades\App;
use Magnet\AppSelector\Services\Contracts\AppProviderInterface;

class AppSelector
{
    public function apps()
    {
        $appsService = App::make(AppProviderInterface::class);
        return $appsService->getApps();
    }
}
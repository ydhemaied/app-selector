<?php

namespace Magnet\AppSelector\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Magnet\AppSelector\Services\Contracts\AppProviderInterface;

class AppProvider implements AppProviderInterface
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getApps()
    {
        $response = $this->client->request('GET', sprintf('%s/api/v1/apps?current=%s', env('APPS_DOMAIN'), Str::slug(config('app.name'))));

        if ($response->getStatusCode() !== 200)
            throw new Exception($response->getReasonPhrase);
        
        $apps = (object) json_decode($response->getBody()->getContents());

        return collect($apps->content);
    }
}
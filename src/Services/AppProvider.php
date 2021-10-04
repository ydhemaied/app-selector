<?php

namespace Magnet\AppSelector\Services;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;
use Magnet\AppSelector\Services\Contracts\AppProviderInterface;

class AppProvider implements AppProviderInterface
{
    private $client;
    private $logger;

    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getApps()
    {
        $url = sprintf('%s/api/v1/apps?current=%s', config('apps.domain'), Str::slug(config('app.name')));

        $this->logger->info(sprintf('REQUEST: GET %s', $url));

        $response = $this->client->request('GET', $url);

        $content = $response->getBody()->getContents();

        $this->logger->info(sprintf('RESPONSE: %s %s', $response->getStatusCode(), $content));

        if ($response->getStatusCode() !== 200)
            throw new Exception($response->getReasonPhrase);
        
        $apps = (object) json_decode($content);

        return collect($apps->content);
    }
}
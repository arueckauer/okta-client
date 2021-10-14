<?php

declare(strict_types=1);

namespace OktaClient;

use GuzzleHttp\Client as HttpClient;
use Psr\Container\ContainerInterface;

use function assert;
use function is_array;

class ClientFactory
{
    public function __invoke(ContainerInterface $container): Client
    {
        $config = $container->get('config')[Client::class] ?? [];
        assert(is_array($config));

        $client = new HttpClient([
            'base_uri' => $this->getBaseUri($config),
        ]);

        return new Client(
            $client,
            $this->getApiKey($config)
        );
    }

    private function getBaseUri(array $config): string
    {
        return isset($config['base_uri']) ? (string) $config['base_uri'] : '';
    }

    private function getApiKey(array $config): string
    {
        return isset($config['api_key']) ? (string) $config['api_key'] : '';
    }
}

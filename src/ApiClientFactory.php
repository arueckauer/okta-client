<?php

declare(strict_types=1);

namespace OktaClient;

use GuzzleHttp\Client;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;
use function is_array;

final class ApiClientFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): Client
    {
        $options = $container->get('config')[ApiClientInterface::class] ?? [];
        assert(is_array($options));

        return new Client(
            $options,
        );
    }
}

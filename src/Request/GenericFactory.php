<?php

declare(strict_types=1);

namespace OktaClient\Request;

use Laminas\ServiceManager\Factory\FactoryInterface;
use OktaClient\Client;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

class GenericFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ): object {
        $client = $container->get(Client::class);
        assert($client instanceof Client);

        return new $requestedName($client);
    }
}

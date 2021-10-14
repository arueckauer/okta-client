<?php

declare(strict_types=1);

namespace OktaClient\Request;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use OktaClient\Client;

use function assert;

class GenericFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $client = $container->get(Client::class);
        assert($client instanceof Client);

        return new $requestedName($client);
    }
}

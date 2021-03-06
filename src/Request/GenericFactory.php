<?php

declare(strict_types=1);

namespace OktaClient\Request;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use OktaClient\Client;

use function assert;

class GenericFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): object
    {
        $client = $container->get(Client::class);
        assert($client instanceof Client);

        return new $requestedName($client);
    }
}

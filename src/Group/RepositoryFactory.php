<?php

declare(strict_types=1);

namespace OktaClient\Group;

use OktaClient\ApiClientInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientInterface;

use function assert;

class RepositoryFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): Repository
    {
        $client = $container->get(ApiClientInterface::class);
        assert($client instanceof ClientInterface);

        return new Repository(
            $client,
            new GetMembers\Hydrator(),
        );
    }
}

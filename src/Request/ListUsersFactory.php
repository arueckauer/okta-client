<?php

declare(strict_types=1);

namespace OktaClient\Request;

use OktaClient\Client;
use Psr\Container\ContainerInterface;

use function assert;

class ListUsersFactory
{
    public function __invoke(ContainerInterface $container): ListUsers
    {
        $client = $container->get(Client::class);
        assert($client instanceof Client);

        return new ListUsers(
            $client
        );
    }
}

<?php

declare(strict_types=1);

namespace OktaClient\User;

use Psr\Container\ContainerInterface;

use function assert;

class GroupsCommandFactory
{
    public function __invoke(ContainerInterface $container): GroupsCommand
    {
        $getGroups = $container->get(GetGroups::class);
        assert($getGroups instanceof GetGroups);

        return new GroupsCommand(
            $getGroups
        );
    }
}

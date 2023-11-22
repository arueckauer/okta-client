<?php

declare(strict_types=1);

namespace OktaClient\User;

use OktaClient\Request\ListGroupsOfUser;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

class GetGroupsFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): GetGroups
    {
        $getGroupsForUser = $container->get(ListGroupsOfUser::class);
        assert($getGroupsForUser instanceof ListGroupsOfUser);

        return new GetGroups(
            $getGroupsForUser
        );
    }
}

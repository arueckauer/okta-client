<?php

declare(strict_types=1);

namespace OktaClient\User;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

class MemberOfFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): MemberOf
    {
        $getGroups = $container->get(GetGroups::class);
        assert($getGroups instanceof GetGroups);

        return new MemberOf(
            $getGroups
        );
    }
}

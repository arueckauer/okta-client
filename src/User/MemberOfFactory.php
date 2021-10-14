<?php

declare(strict_types=1);

namespace OktaClient\User;

use Psr\Container\ContainerInterface;

use function assert;

class MemberOfFactory
{
    public function __invoke(ContainerInterface $container): MemberOf
    {
        $getGroups = $container->get(GetGroups::class);
        assert($getGroups instanceof GetGroups);

        return new MemberOf(
            $getGroups
        );
    }
}

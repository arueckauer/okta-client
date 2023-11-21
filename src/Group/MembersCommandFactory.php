<?php

declare(strict_types=1);

namespace OktaClient\Group;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

class MembersCommandFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): MembersCommand
    {
        $getMembers = $container->get(GetMembers::class);
        assert($getMembers instanceof GetMembers);

        return new MembersCommand(
            $getMembers
        );
    }
}

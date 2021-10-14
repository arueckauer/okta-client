<?php

declare(strict_types=1);

namespace OktaClient\Group;

use Psr\Container\ContainerInterface;

use function assert;

class MembersCommandFactory
{
    public function __invoke(ContainerInterface $container): MembersCommand
    {
        $getMembers = $container->get(GetMembers::class);
        assert($getMembers instanceof GetMembers);

        return new MembersCommand(
            $getMembers
        );
    }
}

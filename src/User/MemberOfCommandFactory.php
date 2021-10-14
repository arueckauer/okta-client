<?php

declare(strict_types=1);

namespace OktaClient\User;

use Psr\Container\ContainerInterface;

use function assert;

class MemberOfCommandFactory
{
    public function __invoke(ContainerInterface $container): MemberOfCommand
    {
        $memberOf = $container->get(MemberOf::class);
        assert($memberOf instanceof MemberOf);

        return new MemberOfCommand(
            $memberOf
        );
    }
}

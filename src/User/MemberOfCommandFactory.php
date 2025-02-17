<?php

declare(strict_types=1);

namespace OktaClient\User;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

final class MemberOfCommandFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): MemberOfCommand
    {
        $memberOf = $container->get(MemberOf::class);
        assert($memberOf instanceof MemberOf);

        return new MemberOfCommand(
            $memberOf
        );
    }
}

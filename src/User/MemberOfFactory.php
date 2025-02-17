<?php

declare(strict_types=1);

namespace OktaClient\User;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

final class MemberOfFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): MemberOf
    {
        $repository = $container->get(Repository::class);
        assert($repository instanceof Repository);

        return new MemberOf(
            $repository,
        );
    }
}

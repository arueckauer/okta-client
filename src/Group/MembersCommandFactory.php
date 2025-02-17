<?php

declare(strict_types=1);

namespace OktaClient\Group;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

final class MembersCommandFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): MembersCommand
    {
        $repository = $container->get(Repository::class);
        assert($repository instanceof Repository);

        return new MembersCommand(
            $repository
        );
    }
}

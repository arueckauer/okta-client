<?php

declare(strict_types=1);

namespace OktaClient\Group;

use OktaClient\Request\ListGroupMembers;
use Psr\Container\ContainerInterface;

use function assert;

class GetMembersFactory
{
    public function __invoke(ContainerInterface $container): GetMembers
    {
        $listGroupMembers = $container->get(ListGroupMembers::class);
        assert($listGroupMembers instanceof ListGroupMembers);

        return new GetMembers(
            $listGroupMembers
        );
    }
}

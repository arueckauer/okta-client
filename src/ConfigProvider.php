<?php

declare(strict_types=1);

namespace OktaClient;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    Request\ListGroupMembers::class => Request\GenericFactory::class,
                    Request\ListGroupsOfUser::class => Request\GenericFactory::class,
                    Request\ListUsers::class        => Request\GenericFactory::class,
                    Client::class                   => ClientFactory::class,
                ],
            ],
        ];
    }
}

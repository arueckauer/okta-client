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
                    Request\ListUsers::class => Request\GenericFactory::class,
                    Client::class            => ClientFactory::class,
                ],
            ],
        ];
    }
}

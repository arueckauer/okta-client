<?php

declare(strict_types=1);

namespace OktaClient;

/**
 * @psalm-type _Configuration = array{
 *     dependencies: array{
 *         factories: array<class-string, class-string>
 *     }
 * }
 */
final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    Group\MembersCommand::class => Group\MembersCommandFactory::class,
                    Group\Repository::class     => Group\RepositoryFactory::class,
                    User\GroupsCommand::class   => User\GroupsCommandFactory::class,
                    User\MemberOf::class        => User\MemberOfFactory::class,
                    User\MemberOfCommand::class => User\MemberOfCommandFactory::class,
                    User\Repository::class      => User\RepositoryFactory::class,
                    ApiClientInterface::class   => ApiClientFactory::class,
                ],
            ],
        ];
    }
}

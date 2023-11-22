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
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    Group\MembersCommand::class     => Group\MembersCommandFactory::class,
                    Group\GetMembers::class         => Group\GetMembersFactory::class,
                    Request\ListGroupMembers::class => Request\GenericFactory::class,
                    Request\ListGroupsOfUser::class => Request\GenericFactory::class,
                    Request\ListUsers::class        => Request\GenericFactory::class,
                    User\GetGroups::class           => User\GetGroupsFactory::class,
                    User\GroupsCommand::class       => User\GroupsCommandFactory::class,
                    User\MemberOf::class            => User\MemberOfFactory::class,
                    User\MemberOfCommand::class     => User\MemberOfCommandFactory::class,
                    Client::class                   => ClientFactory::class,
                ],
            ],
        ];
    }
}

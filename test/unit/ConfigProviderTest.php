<?php

declare(strict_types=1);

namespace OktaClientTest\unit;

use OktaClient\Client;
use OktaClient\ConfigProvider;
use OktaClient\Group\GetMembers;
use OktaClient\Group\MembersCommand;
use OktaClient\Request\ListGroupMembers;
use OktaClient\Request\ListGroupsOfUser;
use OktaClient\Request\ListUsers;
use OktaClient\User\GetGroups;
use OktaClient\User\GroupsCommand;
use OktaClient\User\MemberOf;
use OktaClient\User\MemberOfCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-import-type _Configuration from ConfigProvider
 */
#[CoversClass(ConfigProvider::class)]
class ConfigProviderTest extends TestCase
{
    public function test__invoke(): void
    {
        /** @psalm-var _Configuration $config */
        $config = (new ConfigProvider())();

        self::assertCount(10, $config['dependencies']['factories']);
        self::assertArrayHasKey(Client::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(GetGroups::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(GetMembers::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(GroupsCommand::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(ListGroupMembers::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(ListGroupsOfUser::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(ListUsers::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(MemberOf::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(MemberOfCommand::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(MembersCommand::class, $config['dependencies']['factories']);
    }
}

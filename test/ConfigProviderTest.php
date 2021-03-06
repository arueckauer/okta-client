<?php

declare(strict_types=1);

namespace OktaClientTest;

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
use PHPUnit\Framework\TestCase;

class ConfigProviderTest extends TestCase
{
    /**
     * @covers \OktaClient\ConfigProvider::__invoke
     */
    public function test__invoke(): void
    {
        $config = (new ConfigProvider())();

        self::assertArrayHasKey('dependencies', $config);

        self::assertIsArray($config['dependencies']);
        self::assertArrayHasKey('factories', $config['dependencies']);

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

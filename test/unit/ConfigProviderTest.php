<?php

declare(strict_types=1);

namespace OktaClientTest;

use OktaClient\ApiClientInterface;
use OktaClient\ConfigProvider;
use OktaClient\Group\MembersCommand;
use OktaClient\Group\Repository;
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

        $factories = $config['dependencies']['factories'];

        self::assertCount(9, $factories);
        self::assertArrayHasKey(MembersCommand::class, $factories);
        self::assertArrayHasKey(Repository::class, $factories);
        self::assertArrayHasKey(ListGroupsOfUser::class, $factories);
        self::assertArrayHasKey(ListUsers::class, $factories);
        self::assertArrayHasKey(GetGroups::class, $factories);
        self::assertArrayHasKey(GroupsCommand::class, $factories);
        self::assertArrayHasKey(MemberOf::class, $factories);
        self::assertArrayHasKey(MemberOfCommand::class, $factories);
        self::assertArrayHasKey(ApiClientInterface::class, $factories);
    }
}

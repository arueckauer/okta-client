<?php

declare(strict_types=1);

namespace OktaClientTest;

use OktaClient\ApiClientInterface;
use OktaClient\ConfigProvider;
use OktaClient\Group\MembersCommand;
use OktaClient\Group\Repository as GroupRepository;
use OktaClient\User\GroupsCommand;
use OktaClient\User\MemberOf;
use OktaClient\User\MemberOfCommand;
use OktaClient\User\Repository as UserRepository;
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

        self::assertCount(7, $factories);
        self::assertArrayHasKey(MembersCommand::class, $factories);
        self::assertArrayHasKey(GroupRepository::class, $factories);
        self::assertArrayHasKey(GroupsCommand::class, $factories);
        self::assertArrayHasKey(MemberOf::class, $factories);
        self::assertArrayHasKey(MemberOfCommand::class, $factories);
        self::assertArrayHasKey(UserRepository::class, $factories);
        self::assertArrayHasKey(ApiClientInterface::class, $factories);
    }
}

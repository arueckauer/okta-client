<?php

declare(strict_types=1);

namespace OktaClientTest;

use OktaClient\Client;
use OktaClient\ConfigProvider;
use OktaClient\Request\ListUsers;
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

        self::assertCount(2, $config['dependencies']['factories']);
        self::assertArrayHasKey(Client::class, $config['dependencies']['factories']);
        self::assertArrayHasKey(ListUsers::class, $config['dependencies']['factories']);
    }
}

<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use OktaClient\Dto\UserGroup;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-import-type _UserGroup from UserGroup
 */
class UserGroupTest extends TestCase
{
    public function test_fromArray(): void
    {
        $expected = new UserGroup(
            '00g5a84eu4ignaKwa357',
            'OKTA_GROUP',
            'US_Users',
        );

        /** @psalm-var _UserGroup $input */
        $input = [
            'id'      => '00g5a84eu4ignaKwa357',
            'type'    => 'OKTA_GROUP',
            'profile' => [
                'name' => 'US_Users',
            ],
        ];

        $actual = UserGroup::fromArray($input);

        self::assertEquals(
            $expected->id,
            $actual->id,
        );

        self::assertEquals(
            $expected->type,
            $actual->type,
        );

        self::assertEquals(
            $expected->profileName,
            $actual->profileName,
        );
    }
}

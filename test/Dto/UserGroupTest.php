<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use OktaClient\Dto\UserGroup;
use PHPUnit\Framework\TestCase;

class UserGroupTest extends TestCase
{
    /**
     * @covers \OktaClient\Dto\UserGroup::fromArray
     */
    public function test_fromArray(): void
    {
        $expected              = new UserGroup();
        $expected->id          = '00g5a84eu4ignaKwa357';
        $expected->type        = 'OKTA_GROUP';
        $expected->profileName = 'US_Users';

        $input = [
            'id'                    => '00g5a84eu4ignaKwa357',
            'created'               => '2018-12-27T23:22:01.000Z',
            'lastUpdated'           => '2018-12-27T23:22:01.000Z',
            'lastMembershipUpdated' => '2021-08-30T14:12:12.000Z',
            'objectClass'           => ['okta:user_group'],
            'type'                  => 'OKTA_GROUP',
            'profile'               => [
                'name'        => 'US_Users',
                'description' => null,
            ],
            '_links'                => [
                'logo'  => [
                    [
                        'name' => 'medium',
                        // phpcs:ignore
                        'href' => 'https://ok7static.oktacdn.com/assets/img/logos/groups/odyssey/okta-medium.1a5ebe44c4244fb796c235d86b47e3bb.png',
                        'type' => 'image/png',
                    ],
                    [
                        'name' => 'large',
                        // phpcs:ignore
                        'href' => 'https://ok7static.oktacdn.com/assets/img/logos/groups/odyssey/okta-large.d9cfbd8a00a4feac1aa5612ba02e99c0.png',
                        'type' => 'image/png',
                    ],
                ],
                'users' => [
                    'href' => 'https://acme.okta.com/api/v1/groups/00g6v9634OwS15jd8356/users',
                ],
                'apps'  => [
                    'href' => 'https://acme.okta.com/api/v1/groups/00g6v9634OwS15jd8356/apps',
                ],
            ],
        ];

        self::assertEquals(
            $expected,
            UserGroup::fromArray($input)
        );
    }
}

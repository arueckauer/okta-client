<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use OktaClient\GroupMember\Dto;
use PHPUnit\Framework\TestCase;

final class GroupMemberTest extends TestCase
{
    public function test_fromArray(): void
    {
        $expected = new Dto(
            '00u6v94romPIKvGDI356',
            'ACTIVE',
            'Clyde',
            'Boyle',
            'Clyde.Boyle@acme.com',
        );

        $input = [
            'id'              => '00u6v94romPIKvGDI356',
            'status'          => 'ACTIVE',
            'created'         => '2018-12-27T23:37:59.000Z',
            'activated'       => '2018-12-27T23:37:59.000Z',
            'statusChanged'   => '2021-09-15T08:55:17.000Z',
            'lastLogin'       => '2021-10-07T16:58:50.000Z',
            'lastUpdated'     => '2021-09-28T17:02:14.000Z',
            'passwordChanged' => null,
            'type'            => [
                'id' => 'oty6v963cpqqmM07Y356',
            ],
            'profile'         => [
                'country'               => 'United States',
                'lastName'              => 'Boyle',
                'zipCode'               => '92980',
                'ipPhone'               => '87450',
                'manager'               => 'Shan.Morgan@acme.com',
                'city'                  => 'Port Darlenechester',
                'displayName'           => 'Clyde Boyle',
                'secondEmail'           => null,
                'PreferredDataLocation' => 'PX7',
                'office'                => 'Port Darlenechester',
                'title'                 => 'Plating Operator OR Coating Machine Operator',
                'login'                 => 'Clyde.Boyle@acme.com',
                'otherTelephone'        => [],
                'firstName'             => 'Clyde',
                'primaryPhone'          => '16504580668',
                'mobilePhone'           => null,
                'streetAddress'         => '42407 E Casandra Oval',
                'countryCode'           => 'US',
                'state'                 => 'CA',
                'department'            => 'PO',
                'email'                 => 'Clyde.Boyle@acme.com',
            ],
            'credentials'     => [
                'recovery_question' => [
                    'question' => 'First pet name',
                ],
                'provider'          => [
                    'type' => 'ACTIVE_DIRECTORY',
                    'name' => 'acme.net',
                ],
            ],
            '_links'          => [
                'self' => [
                    'href' => 'https://acme.okta.com/api/v1/users/00u6v94romPIKvGDI356',
                ],
            ],
        ];

        $actual = Dto::fromArray($input);

        self::assertEquals(
            $expected->id,
            $actual->id,
        );

        self::assertEquals(
            $expected->status,
            $actual->status,
        );

        self::assertEquals(
            $expected->firstName,
            $actual->firstName,
        );

        self::assertEquals(
            $expected->lastName,
            $actual->lastName,
        );

        self::assertEquals(
            $expected->email,
            $actual->email,
        );
    }
}

<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use OktaClient\Dto\UserGroup;
use OktaClient\Dto\UserGroupCollection;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

use function dirname;
use function file_get_contents;

class UserGroupCollectionTest extends TestCase
{
    /**
     * @covers \OktaClient\Dto\UserGroupCollection::fromResponse
     */
    public function test_fromResponse(): void
    {
        $userGroupA              = new UserGroup();
        $userGroupA->id          = '00g5a84eu4ignaKwa357';
        $userGroupA->type        = 'OKTA_GROUP';
        $userGroupA->profileName = 'US_Users';

        $userGroupB              = new UserGroup();
        $userGroupB->id          = '00gb6o6h921aRyRDc356';
        $userGroupB->type        = 'OKTA_GROUP';
        $userGroupB->profileName = 'IT';

        $userGroupC              = new UserGroup();
        $userGroupC->id          = '00giaughr31bJgPPl356';
        $userGroupC->type        = 'OKTA_GROUP';
        $userGroupC->profileName = 'Okta Admins';

        $payload = file_get_contents(
            dirname(__DIR__) . '/TestAsset/Request/list-groups-of-users-response.json'
        );

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($payload);

        $collection = UserGroupCollection::fromResponse($response);

        $userGroups = $collection->all();

        self::assertCount(
            4,
            $userGroups
        );

        self::assertEquals(
            $userGroupA,
            $userGroups[0]
        );

        self::assertEquals(
            $userGroupB,
            $userGroups[1]
        );

        self::assertEquals(
            $userGroupC,
            $userGroups[3]
        );
    }
}

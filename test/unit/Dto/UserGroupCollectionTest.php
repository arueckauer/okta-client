<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use Exception;
use JsonException;
use OktaClient\UserGroup\Dto;
use OktaClient\UserGroup\DtoCollection;
use PHPUnit\Framework\MockObject\Exception as MockObjectException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

use function dirname;
use function file_get_contents;

class UserGroupCollectionTest extends TestCase
{
    /**
     * @throws JsonException
     * @throws Exception
     * @throws MockObjectException
     */
    public function test_fromResponse(): void
    {
        $userGroupA = new Dto(
            '00g5a84eu4ignaKwa357',
            'OKTA_GROUP',
            'US_Users',
        );

        $userGroupB = new Dto(
            '00gb6o6h921aRyRDc356',
            'OKTA_GROUP',
            'IT',
        );

        $userGroupC = new Dto(
            '00giaughr31bJgPPl356',
            'OKTA_GROUP',
            'Okta Admins',
        );

        $payload = file_get_contents(
            dirname(__DIR__, 2) . '/asset/request/list-groups-of-users-response.json'
        );

        $body = $this->createMock(StreamInterface::class);
        $body
            ->expects(self::once())
            ->method('getContents')
            ->willReturn($payload);

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($body);

        $collection = DtoCollection::fromResponse($response);

        self::assertCount(
            4,
            $collection,
        );

        self::assertEquals(
            $userGroupA,
            $collection[0],
        );

        self::assertEquals(
            $userGroupB,
            $collection[1],
        );

        self::assertEquals(
            $userGroupC,
            $collection[3],
        );
    }

    public function test_hasUserGroupWithId(): void
    {
        $userGroupA = new Dto(
            '00g5a84eu4ignaKwa357',
            'OKTA_GROUP',
            'US_Users',
        );

        $userGroupB = new Dto(
            '00gb6o6h921aRyRDc356',
            'OKTA_GROUP',
            'IT',
        );

        $userGroupC = new Dto(
            '00giaughr31bJgPPl356',
            'OKTA_GROUP',
            'Okta Admins',
        );

        $collection = new DtoCollection($userGroupA, $userGroupB, $userGroupC);

        self::assertTrue($collection->hasUserGroupWithId('00g5a84eu4ignaKwa357'));
        self::assertTrue($collection->hasUserGroupWithId('00gb6o6h921aRyRDc356'));
        self::assertTrue($collection->hasUserGroupWithId('00giaughr31bJgPPl356'));
        self::assertFalse($collection->hasUserGroupWithId('goggles'));
        self::assertFalse($collection->hasUserGroupWithId('waddle'));
        self::assertFalse($collection->hasUserGroupWithId('disco'));
    }

    public function test_hasUserGroupWithProfileName(): void
    {
        $userGroupA = new Dto(
            '00g5a84eu4ignaKwa357',
            'OKTA_GROUP',
            'US_Users',
        );

        $userGroupB = new Dto(
            '00gb6o6h921aRyRDc356',
            'OKTA_GROUP',
            'IT',
        );

        $userGroupC = new Dto(
            '00giaughr31bJgPPl356',
            'OKTA_GROUP',
            'Okta Admins',
        );

        $collection = new DtoCollection($userGroupA, $userGroupB, $userGroupC);

        self::assertTrue($collection->hasUserGroupWithProfileName('US_Users'));
        self::assertTrue($collection->hasUserGroupWithProfileName('IT'));
        self::assertTrue($collection->hasUserGroupWithProfileName('Okta Admins'));
        self::assertFalse($collection->hasUserGroupWithProfileName('goggles'));
        self::assertFalse($collection->hasUserGroupWithProfileName('waddle'));
        self::assertFalse($collection->hasUserGroupWithProfileName('disco'));
    }
}

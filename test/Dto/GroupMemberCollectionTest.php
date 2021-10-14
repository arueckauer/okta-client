<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use OktaClient\Dto\GroupMember;
use OktaClient\Dto\GroupMemberCollection;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

use function dirname;
use function file_get_contents;

class GroupMemberCollectionTest extends TestCase
{
    /**
     * @covers \OktaClient\Dto\GroupMemberCollection::fromResponse
     */
    public function test_fromResponse(): void
    {
        $groupMemberA            = new GroupMember();
        $groupMemberA->id        = '00u6v94romPIKvGDI356';
        $groupMemberA->status    = 'ACTIVE';
        $groupMemberA->firstName = 'Cyrus';
        $groupMemberA->lastName  = 'Boyle';
        $groupMemberA->email     = 'Cyrus.Boyle@acme.com';

        $groupMemberB            = new GroupMember();
        $groupMemberB->id        = '00u8rdmqbt1Rwlpig357';
        $groupMemberB->status    = 'ACTIVE';
        $groupMemberB->firstName = 'John';
        $groupMemberB->lastName  = 'Gibson';
        $groupMemberB->email     = 'John.Gibson@acme.com';

        $expected = new GroupMemberCollection($groupMemberA, $groupMemberB);

        $payload = file_get_contents(dirname(__DIR__) . '/TestAsset/Request/list-group-members-response.json');

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($payload);

        self::assertEquals(
            $expected,
            GroupMemberCollection::fromResponse($response)
        );
    }
}

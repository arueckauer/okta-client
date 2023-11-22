<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use JsonException;
use OktaClient\Dto\GroupMember;
use OktaClient\Dto\GroupMemberCollection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

use function dirname;
use function file_get_contents;

#[CoversClass(GroupMemberCollection::class)]
class GroupMemberCollectionTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function test_fromResponse(): void
    {
        $groupMemberA = new GroupMember(
            '00u6v94romPIKvGDI356',
            'ACTIVE',
            'Cyrus',
            'Boyle',
            'Cyrus.Boyle@acme.com',
        );

        $groupMemberB = new GroupMember(
            '00u8rdmqbt1Rwlpig357',
            'ACTIVE',
            'John',
            'Gibson',
            'John.Gibson@acme.com',
        );

        $expected = new GroupMemberCollection($groupMemberA, $groupMemberB);

        $payload = file_get_contents(dirname(__DIR__, 2) . '/asset/request/list-group-members-response.json');

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

        self::assertEquals(
            $expected,
            GroupMemberCollection::fromResponse($response)
        );
    }
}

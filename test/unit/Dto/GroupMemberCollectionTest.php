<?php

declare(strict_types=1);

namespace OktaClientTest\Dto;

use JsonException;
use OktaClient\GroupMember\Dto;
use OktaClient\GroupMember\DtoCollection;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

use function dirname;
use function file_get_contents;

#[CoversClass(DtoCollection::class)]
class GroupMemberCollectionTest extends TestCase
{
    private ResponseInterface $response;

    /**
     * @throws JsonException
     */
    public function test_fromResponse(): void
    {
        $groupMemberA = new Dto(
            '00u6v94romPIKvGDI356',
            'ACTIVE',
            'Cyrus',
            'Boyle',
            'Cyrus.Boyle@acme.com',
        );

        $groupMemberB = new Dto(
            '00u8rdmqbt1Rwlpig357',
            'ACTIVE',
            'John',
            'Gibson',
            'John.Gibson@acme.com',
        );

        $expected = new DtoCollection($groupMemberA, $groupMemberB);

        self::assertEquals(
            $expected,
            DtoCollection::fromResponse($this->response)
        );
    }

    public function test_toArray(): void
    {
        $expected                 = [
            [
                'id'        => '00u6v94romPIKvGDI356',
                'status'    => 'ACTIVE',
                'firstName' => 'Cyrus',
                'lastName'  => 'Boyle',
                'email'     => 'Cyrus.Boyle@acme.com',
            ],
            [
                'id'        => '00u8rdmqbt1Rwlpig357',
                'status'    => 'ACTIVE',
                'firstName' => 'John',
                'lastName'  => 'Gibson',
                'email'     => 'John.Gibson@acme.com',
            ],
        ];
        $groupMemberDtoCollection = DtoCollection::fromResponse($this->response);

        self::assertEquals(
            $expected,
            $groupMemberDtoCollection->toArray()
        );
    }

    public function test_count(): void
    {
        $groupMemberDtoCollection = DtoCollection::fromResponse($this->response);

        self::assertCount(
            2,
            $groupMemberDtoCollection,
        );
    }

    protected function setUp(): void
    {
        $payload = file_get_contents(dirname(__DIR__, 2) . '/asset/request/list-group-members-response.json');

        $body = $this->createMock(StreamInterface::class);
        $body
            ->expects(self::once())
            ->method('getContents')
            ->willReturn($payload);

        $this->response = $this->createMock(ResponseInterface::class);
        $this->response
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($body);
    }
}

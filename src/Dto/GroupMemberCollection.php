<?php

declare(strict_types=1);

namespace OktaClient\Dto;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Traversable;

use function count;
use function json_decode;

use const JSON_THROW_ON_ERROR;

/**
 * @template TKey of array-key
 * @template TValue
 * @implements ArrayAccess<int, GroupMember>
 * @implements IteratorAggregate<int, GroupMember>
 */
class GroupMemberCollection implements ArrayAccess, Countable, IteratorAggregate
{
    /** @var GroupMember[] */
    private array $data;

    public function __construct(GroupMember ...$data)
    {
        $this->data = $data;
    }

    /**
     * @throws JsonException
     */
    public static function fromResponse(ResponseInterface $response): self
    {
        /** @var array $payload */
        $payload = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $groupMembers = [];
        /** @var array $userGroup */
        foreach ($payload as $userGroup) {
            $groupMembers[] = GroupMember::fromArray($userGroup);
        }

        return new self(...$groupMembers);
    }

    /**
     * @return array<int, array>
     */
    public function toArray(): array
    {
        $array = [];

        foreach ($this->data as $groupMember) {
            $array[] = (array) $groupMember;
        }

        return $array;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): GroupMember
    {
        return $this->data[$offset];
    }

    /**
     * Does nothing since the collection is immutable.
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
    }

    /**
     * Does nothing since the collection is immutable.
     */
    public function offsetUnset(mixed $offset): void
    {
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }
}

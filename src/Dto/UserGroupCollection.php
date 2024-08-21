<?php

declare(strict_types=1);

namespace OktaClient\Dto;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonException;
use OktaClient\UserGroup\Dto;
use Psr\Http\Message\ResponseInterface;
use Traversable;

use function count;
use function json_decode;

use const JSON_THROW_ON_ERROR;

/**
 * @psalm-import-type _UserGroup from Dto
 * @template TKey of array-key
 * @template TValue
 * @implements ArrayAccess<int, Dto>
 * @implements IteratorAggregate<int, Dto>
 */
class UserGroupCollection implements ArrayAccess, Countable, IteratorAggregate
{
    /** @psalm-var array<array-key, Dto> */
    private readonly array $data;

    public function __construct(Dto ...$data)
    {
        $this->data = $data;
    }

    /**
     * @throws JsonException
     */
    public static function fromResponse(ResponseInterface $response): self
    {
        /** @psalm-var array<array-key, _UserGroup> $payload */
        $payload = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $userGroups = [];
        foreach ($payload as $userGroup) {
            $userGroups[] = Dto::fromArray($userGroup);
        }

        return new self(...$userGroups);
    }

    /**
     * @return array<int, array>
     */
    public function toArray(): array
    {
        $array = [];

        foreach ($this->data as $userGroup) {
            $array[] = (array) $userGroup;
        }

        return $array;
    }

    public function hasUserGroupWithId(string $id): bool
    {
        foreach ($this->data as $userGroup) {
            if ($userGroup->id === $id) {
                return true;
            }
        }

        return false;
    }

    public function hasUserGroupWithProfileName(string $profileName): bool
    {
        foreach ($this->data as $userGroup) {
            if ($userGroup->profileName === $profileName) {
                return true;
            }
        }

        return false;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet(mixed $offset): Dto
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

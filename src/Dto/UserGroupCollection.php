<?php

declare(strict_types=1);

namespace OktaClient\Dto;

use ArrayAccess;
use Countable;
use Iterator;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use ReturnTypeWillChange;

use function count;
use function current;
use function json_decode;
use function key;
use function next;
use function reset;

use const JSON_THROW_ON_ERROR;

/**
 * @template-implements ArrayAccess<int, UserGroup>
 * @template-implements Iterator<int, UserGroup>
 */
class UserGroupCollection implements ArrayAccess, Countable, Iterator
{
    /** @psalm-var array<array-key, UserGroup> */
    private readonly array $data;

    public function __construct(UserGroup ...$data)
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

        $userGroups = [];
        /** @var array $userGroup */
        foreach ($payload as $userGroup) {
            $userGroups[] = UserGroup::fromArray($userGroup);
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

    public function offsetGet(mixed $offset): UserGroup
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

    #[ReturnTypeWillChange]
    public function current(): mixed
    {
        return current($this->data);
    }

    public function next(): void
    {
        next($this->data);
    }

    #[ReturnTypeWillChange]
    public function key(): string|int|null
    {
        return key($this->data);
    }

    public function valid(): bool
    {
        return current($this->data) !== false;
    }

    public function rewind(): void
    {
        reset($this->data);
    }
}

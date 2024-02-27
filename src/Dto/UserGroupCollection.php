<?php

declare(strict_types=1);

namespace OktaClient\Dto;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Traversable;

use function count;
use function json_decode;

use const JSON_THROW_ON_ERROR;

class UserGroupCollection implements IteratorAggregate, Countable
{
    /** @var UserGroup[] */
    private array $data;

    public function __construct(UserGroup ...$data)
    {
        $this->data = $data;
    }

    /**
     * @throws JsonException
     */
    public static function fromResponse(ResponseInterface $response): self
    {
        $self = new self();

        /** @var array $payload */
        $payload = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        /** @var array $userGroup */
        foreach ($payload as $userGroup) {
            $self->add(UserGroup::fromArray($userGroup));
        }

        return $self;
    }

    public function add(UserGroup $userGroup): void
    {
        $this->data[] = $userGroup;
    }

    /**
     * @return array<int, array>
     */
    public function toArray(): array
    {
        $array = [];

        foreach ($this as $userGroup) {
            $array[] = (array) $userGroup;
        }

        return $array;
    }

    public function hasUserGroupWithId(string $id): bool
    {
        foreach ($this as $userGroup) {
            if ($userGroup->id === $id) {
                return true;
            }
        }

        return false;
    }

    public function hasUserGroupWithProfileName(string $profileName): bool
    {
        foreach ($this as $userGroup) {
            if ($userGroup->profileName === $profileName) {
                return true;
            }
        }

        return false;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }
}

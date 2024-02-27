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

class GroupMemberCollection implements IteratorAggregate, Countable
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

        $self = new self();
        /** @var array $userGroup */
        foreach ($payload as $userGroup) {
            $self->add(GroupMember::fromArray($userGroup));
        }

        return $self;
    }

    public function add(GroupMember $groupMember): void
    {
        $this->data[] = $groupMember;
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

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }
}

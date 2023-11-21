<?php

declare(strict_types=1);

namespace OktaClient\Dto;

use JsonException;
use Psr\Http\Message\ResponseInterface;

use function json_decode;

use const JSON_THROW_ON_ERROR;

class GroupMemberCollection
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
     * @return GroupMember[]
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * @return array<int, array>
     */
    public function allAsArray(): array
    {
        $array = [];

        foreach ($this->data as $groupMember) {
            $array[] = (array) $groupMember;
        }

        return $array;
    }
}

<?php

declare(strict_types=1);

namespace OktaClient\Group\GetMembers;

use JsonException;
use OktaClient\GroupMember\Dto;
use OktaClient\GroupMember\DtoCollection;
use Psr\Http\Message\ResponseInterface;

use function json_decode;

use const JSON_THROW_ON_ERROR;

class Hydrator
{
    /**
     * @throws JsonException
     */
    public function invoke(ResponseInterface $response): DtoCollection
    {
        /** @var array $payload */
        $payload = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $groupMembers = [];
        /** @var array $groupMember */
        foreach ($payload as $groupMember) {
            $groupMembers[] = Dto::fromArray($groupMember);
        }

        return new DtoCollection(...$groupMembers);
    }
}

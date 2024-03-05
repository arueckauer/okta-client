<?php

declare(strict_types=1);

namespace OktaClient\Group\GetMembers;

use JsonException;
use OktaClient\Dto\GroupMember;
use OktaClient\Dto\GroupMemberCollection;
use Psr\Http\Message\ResponseInterface;

use function json_decode;

use const JSON_THROW_ON_ERROR;

class Hydrator
{
    /**
     * @throws JsonException
     */
    public function invoke(ResponseInterface $response): GroupMemberCollection
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

        return new GroupMemberCollection(...$groupMembers);
    }
}

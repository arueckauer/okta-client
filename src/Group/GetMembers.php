<?php

declare(strict_types=1);

namespace OktaClient\Group;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use OktaClient\Dto\GroupMemberCollection;
use OktaClient\Request\ListGroupMembers;

class GetMembers
{
    public function __construct(
        private readonly ListGroupMembers $listGroupMembers,
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function invoke(string $groupId): GroupMemberCollection
    {
        $response = $this->listGroupMembers->invoke($groupId);

        return GroupMemberCollection::fromResponse($response);
    }
}

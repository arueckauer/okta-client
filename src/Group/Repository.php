<?php

declare(strict_types=1);

namespace OktaClient\Group;

use JsonException;
use OktaClient\Dto\GroupMemberCollection;
use OktaClient\Group\GetMembers\Hydrator as GetMembersHydrator;
use OktaClient\Group\GetMembers\RequestFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class Repository
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly GetMembersHydrator $getMembersHydrator,
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function getMembers(string $groupId): GroupMemberCollection
    {
        $response = $this->client->sendRequest(
            RequestFactory::invoke($groupId)
        );

        return $this->getMembersHydrator->invoke($response);
    }
}

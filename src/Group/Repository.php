<?php

declare(strict_types=1);

namespace OktaClient\Group;

use JsonException;
use OktaClient\Group\GetMembers\Hydrator as GetMembersHydrator;
use OktaClient\Group\GetMembers\RequestFactory;
use OktaClient\GroupMember\DtoCollection;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

final class Repository
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
    public function getMembers(string $groupId): DtoCollection
    {
        $response = $this->client->sendRequest(
            RequestFactory::invoke($groupId)
        );

        return $this->getMembersHydrator->invoke($response);
    }
}

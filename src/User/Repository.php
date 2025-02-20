<?php

declare(strict_types=1);

namespace OktaClient\User;

use GuzzleHttp\Psr7\Request;
use JsonException;
use OktaClient\User\GetGroups\Hydrator as GetGroupsHydrator;
use OktaClient\UserGroup\DtoCollection;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

use function sprintf;

final class Repository
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly GetGroupsHydrator $getGroupsHydrator,
    ) {
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    public function getGroups(string $userId): DtoCollection
    {
        $request  = new Request(
            'GET',
            sprintf('users/%s/groups', $userId)
        );
        $response = $this->client->sendRequest($request);

        return $this->getGroupsHydrator->invoke($response);
    }
}

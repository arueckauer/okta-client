<?php

declare(strict_types=1);

namespace OktaClient\Request;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

use function sprintf;

class GetGroupsForUser
{
    use ClientTrait;

    /**
     * @throws GuzzleException
     */
    public function invoke(string $userId): ResponseInterface
    {
        return $this->client->get(
            sprintf('users/%s/groups', $userId)
        );
    }
}

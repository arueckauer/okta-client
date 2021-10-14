<?php

declare(strict_types=1);

namespace OktaClient\Request;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

use function sprintf;

class ListGroupMembers
{
    use ClientTrait;

    /**
     * @throws GuzzleException
     */
    public function invoke(string $groupId): ResponseInterface
    {
        return $this->client->get(
            sprintf('groups/%s/users', $groupId)
        );
    }
}

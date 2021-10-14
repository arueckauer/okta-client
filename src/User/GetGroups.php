<?php

declare(strict_types=1);

namespace OktaClient\User;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use OktaClient\Dto\UserGroupCollection;
use OktaClient\Request\ListGroupsOfUser;

class GetGroups
{
    private ListGroupsOfUser $listGroupsOfUser;

    public function __construct(ListGroupsOfUser $listGroupsOfUser)
    {
        $this->listGroupsOfUser = $listGroupsOfUser;
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function invoke(string $userId): UserGroupCollection
    {
        $response = $this->listGroupsOfUser->invoke($userId);

        return UserGroupCollection::fromResponse($response);
    }
}

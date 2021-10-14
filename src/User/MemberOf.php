<?php

declare(strict_types=1);

namespace OktaClient\User;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;

use function strtolower;

class MemberOf
{
    private GetGroups $getGroups;

    public function __construct(GetGroups $getGroups)
    {
        $this->getGroups = $getGroups;
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function invoke(string $userId, string $userGroupName): bool
    {
        $userGroupCollection = $this->getGroups->invoke($userId);

        foreach ($userGroupCollection->all() as $userGroup) {
            if (strtolower($userGroup->profileName) === strtolower($userGroupName)) {
                return true;
            }
        }

        return false;
    }
}

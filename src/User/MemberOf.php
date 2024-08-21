<?php

declare(strict_types=1);

namespace OktaClient\User;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;

use function strtolower;

class MemberOf
{
    public function __construct(
        private readonly GetGroups $getGroups,
    ) {
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function invoke(string $userId, string $userGroupName): bool
    {
        $userGroupCollection = $this->getGroups->invoke($userId);

        foreach ($userGroupCollection as $userGroup) {
            if (strtolower($userGroup->profileName) === strtolower($userGroupName)) {
                return true;
            }
        }

        return false;
    }
}

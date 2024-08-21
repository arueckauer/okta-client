<?php

declare(strict_types=1);

namespace OktaClient\User;

use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

use function strtolower;

class MemberOf
{
    public function __construct(
        private readonly Repository $repository,
    ) {
    }

    /**
     * @throws JsonException
     * @throws ClientExceptionInterface
     */
    public function invoke(string $userId, string $userGroupName): bool
    {
        $userGroupCollection = $this->repository->getGroups($userId);

        foreach ($userGroupCollection as $userGroup) {
            if (strtolower($userGroup->profileName) === strtolower($userGroupName)) {
                return true;
            }
        }

        return false;
    }
}

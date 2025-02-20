<?php

declare(strict_types=1);

namespace OktaClient\User\GetGroups;

use JsonException;
use OktaClient\UserGroup\Dto;
use OktaClient\UserGroup\DtoCollection;
use Psr\Http\Message\ResponseInterface;

use function json_decode;

use const JSON_THROW_ON_ERROR;

/**
 * @psalm-import-type _UserGroup from Dto
 */
final class Hydrator
{
    /**
     * @throws JsonException
     */
    public function invoke(ResponseInterface $response): DtoCollection
    {
        /** @psalm-var array<array-key, _UserGroup> $payload */
        $payload = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $userGroups = [];
        foreach ($payload as $userGroup) {
            $userGroups[] = Dto::fromArray($userGroup);
        }

        return new DtoCollection(...$userGroups);
    }
}

<?php

declare(strict_types=1);

namespace OktaClient\UserGroup;

/**
 * @psalm-type _UserGroup = array{
 *     id: string,
 *     type: string,
 *     profile: array{
 *         name: string
 *     }
 * }
 */
final class Dto
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly string $profileName
    ) {
    }

    /**
     * @psalm-param _UserGroup $input
     */
    public static function fromArray(array $input): self
    {
        return new self(
            $input['id'],
            $input['type'],
            $input['profile']['name'],
        );
    }
}

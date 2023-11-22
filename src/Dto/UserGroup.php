<?php

declare(strict_types=1);

namespace OktaClient\Dto;

class UserGroup
{
    public function __construct(
        public readonly string $id,
        public readonly string $type,
        public readonly string $profileName
    ) {
    }

    public static function fromArray(array $input): self
    {
        return new self(
            isset($input['id']) ? (string) $input['id'] : '',
            isset($input['type']) ? (string) $input['type'] : '',
            isset($input['profile']['name']) ? (string) $input['profile']['name'] : '',
        );
    }
}

<?php

declare(strict_types=1);

namespace OktaClient\GroupMember;

class Dto
{
    public function __construct(
        public readonly string $id,
        public readonly string $status,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email
    ) {
    }

    public static function fromArray(array $input): self
    {
        return new self(
            (string) ($input['id'] ?? ''),
            (string) ($input['status'] ?? ''),
            (string) ($input['profile']['firstName'] ?? ''),
            (string) ($input['profile']['lastName'] ?? ''),
            (string) ($input['profile']['email'] ?? ''),
        );
    }
}

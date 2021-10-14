<?php

declare(strict_types=1);

namespace OktaClient\Dto;

class UserGroup
{
    public string $id          = '';
    public string $type        = '';
    public string $profileName = '';

    public static function fromArray(array $input): self
    {
        $self              = new self();
        $self->id          = isset($input['id']) ? (string) $input['id'] : '';
        $self->type        = isset($input['type']) ? (string) $input['type'] : '';
        $self->profileName = isset($input['profile']['name']) ? (string) $input['profile']['name'] : '';

        return $self;
    }
}

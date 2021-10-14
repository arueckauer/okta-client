<?php

declare(strict_types=1);

namespace OktaClient\Dto;

class GroupMember
{
    public string $id        = '';
    public string $status    = '';
    public string $firstName = '';
    public string $lastName  = '';
    public string $email     = '';

    public static function fromArray(array $input): self
    {
        $self            = new self();
        $self->id        = (string) ($input['id'] ?? '');
        $self->status    = (string) ($input['status'] ?? '');
        $self->firstName = (string) ($input['profile']['firstName'] ?? '');
        $self->lastName  = (string) ($input['profile']['lastName'] ?? '');
        $self->email     = (string) ($input['profile']['email'] ?? '');

        return $self;
    }
}

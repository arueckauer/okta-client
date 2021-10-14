<?php

declare(strict_types=1);

namespace OktaClient\Request;

use OktaClient\Client;

trait ClientTrait
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}

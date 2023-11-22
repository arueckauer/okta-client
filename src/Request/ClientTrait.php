<?php

declare(strict_types=1);

namespace OktaClient\Request;

use OktaClient\Client;

trait ClientTrait
{
    public function __construct(
        protected readonly Client $client,
    ) {
    }
}

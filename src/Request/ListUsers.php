<?php

declare(strict_types=1);

namespace OktaClient\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use OktaClient\Client;
use Psr\Http\Message\ResponseInterface;

class ListUsers
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function invoke(): ResponseInterface
    {
        return $this->client->get(
            'users',
            [
                RequestOptions::QUERY => [
                    'limit' => 25,
                ],
            ]
        );
    }
}

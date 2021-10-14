<?php

declare(strict_types=1);

namespace OktaClient\Request;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class ListUsers
{
    use ClientTrait;

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

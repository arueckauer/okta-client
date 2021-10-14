<?php

declare(strict_types=1);

namespace OktaClient;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use OktaClient\Http\HeaderOptions;
use Psr\Http\Message\ResponseInterface;

use function array_merge;

class Client
{
    private HttpClient $client;
    private string $apiKey;

    public function __construct(HttpClient $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $uri, array $options = []): ResponseInterface
    {
        return $this->client->get(
            $uri,
            array_merge(
                [
                    RequestOptions::HEADERS => [
                        HeaderOptions::ACCEPT        => 'application/json',
                        HeaderOptions::AUTHORIZATION => 'SSWS ' . $this->apiKey,
                        HeaderOptions::CONTENT_TYPE  => 'application/json',
                    ],
                ],
                $options
            )
        );
    }
}

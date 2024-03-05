<?php

declare(strict_types=1);

namespace OktaClient\Group\GetMembers;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;

use function sprintf;

class RequestFactory
{
    public static function invoke(string $groupId): RequestInterface
    {
        return new Request(
            'GET',
            new Uri(sprintf('groups/%s/users', $groupId))
        );
    }
}

<?php

namespace Blomstra\Flarum\Api;

use Saloon\Http\Connector as SaloonConnector;
use Saloon\Traits\Plugins\AcceptsJson;
use Blomstra\Flarum\Api\Requests;

class Connector extends SaloonConnector
{
    use AcceptsJson;

    protected array $requests = [
        'discussions' => Requests\Discussions::class,
        'posts' => Requests\Posts::class,
        'users' => Requests\Users::class,
    ];

    public function __construct(protected string $baseUrl)
    {}

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }


    public function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/vnd.api+json, application/json',
            'User-Agent' => 'blomstra/flarum-api-client <https://github.com/blomstra/flarum-api-client>'
        ];
    }

    public function defaultConfig(): array
    {
        return [];
    }
}

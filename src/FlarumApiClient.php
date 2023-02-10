<?php

namespace Blomstra\FlarumApiClient;

use Blomstra\FlarumApiClient\Responses\FlarumApiClientResponse;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Blomstra\FlarumApiClient\Requests;

/**
 * @method Requests\Discussions discussions
 */
class FlarumApiClient extends SaloonConnector
{
    use AcceptsJson;

    /**
     * The requests/services on the FlarumApiClient.
     *
     * @var array
     */
    protected array $requests = [
        'discussions' => Requests\Discussions::class,
    ];

    public function __construct(protected string $baseUrl)
    {}

    public function defineBaseUrl(): string
    {
        return $this->baseUrl;
    }


    public function defaultHeaders(): array
    {
        return [];
    }

    public function defaultConfig(): array
    {
        return [];
    }
}
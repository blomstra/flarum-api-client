<?php

namespace Blomstra\FlarumApiClient\Requests;

use Blomstra\FlarumApiClient\FlarumApiClient;
use Sammyjo20\Saloon\Http\SaloonRequest;

abstract class Request extends SaloonRequest
{
    protected ?string $connector = FlarumApiClient::class;
}

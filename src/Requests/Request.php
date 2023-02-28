<?php

namespace Blomstra\Flarum\Api\Requests;

use Blomstra\Flarum\Api\Connector;
use Saloon\Http\Request as SaloonRequest;

abstract class Request extends SaloonRequest
{
    protected ?string $connector = Connector::class;
}

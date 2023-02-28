<?php

namespace Blomstra\Flarum\Api\Requests;

use Blomstra\Flarum\Api\Client;
use Blomstra\Flarum\Api\Resources\RestResource;
use Saloon\Http\Response;

/**
 * @method Response index
 * @method Response filter(callable $filter)
 * @method Response show(RestResource|int $id)
 * @method Response create(RestResource $resource)
 * @method Response update(RestResource $resource)
 * @method Response delete(RestResource|int $resource)
 */
abstract class RestCollection
{
    protected string $resource;

    public function __construct(protected Client $connector)
    {}

    public function __call(string $name, array $arguments)
    {
        $request = (new RestRequest)->for(resource: $this->resource);

        return $this->connector->send($request->$name(...$arguments));
    }
}

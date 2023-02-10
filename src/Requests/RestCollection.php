<?php

namespace Blomstra\FlarumApiClient\Requests;

use Blomstra\FlarumApiClient\Resources\RestResource;
use Sammyjo20\Saloon\Http\RequestCollection;
use Sammyjo20\Saloon\Http\SaloonResponse;

/**
 * @method SaloonResponse index
 * @method SaloonResponse show(RestResource|int $id)
 * @method SaloonResponse create(RestResource $resource)
 * @method SaloonResponse update(RestResource $resource)
 * @method SaloonResponse delete(RestResource|int $resource)
 */
abstract class RestCollection extends RequestCollection
{
    protected string $resource;

    public function __call(string $name, array $arguments)
    {
        $request = (new RestRequest)->for(resource: $this->resource);

        return $this->connector
            ->request($request->$name(...$arguments))
            ->send();
    }
}

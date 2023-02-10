<?php

namespace Blomstra\FlarumApiClient\Requests;

use Blomstra\FlarumApiClient\Data\DataTransferObject;
use Sammyjo20\Saloon\Http\RequestCollection;
use Sammyjo20\Saloon\Http\SaloonResponse;

/**
 * @method SaloonResponse index
 * @method SaloonResponse show(int $id)
 * @method SaloonResponse create(DataTransferObject $dto)
 * @method SaloonResponse update(DataTransferObject $dto)
 * @method SaloonResponse delete(DataTransferObject|int $dto)
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

<?php

namespace Blomstra\FlarumApiClient\Requests;

use Blomstra\FlarumApiClient\Data\DataTransferObject;
use Blomstra\FlarumApiClient\Resources\Resource;
use Sammyjo20\Saloon\Constants\Saloon;

class RestRequest extends Request
{
    protected Resource|null $resource = null;
    protected string|null $endpoint = null;

    public function for(string|Resource $resource)
    {
        if (is_string($resource)) $resource = new $resource;

        $this->resource = $resource;

        return $this;
    }

    public function index()
    {
        $this->endpoint = "/{$this->resource->type}";
        $this->method = Saloon::GET;

        return $this;
    }

    public function show(int $id)
    {
        $this->endpoint = "/{$this->resource->type}/$id";
        $this->method = Saloon::GET;

        return $this;
    }

    public function create(DataTransferObject $dto)
    {
        $this->endpoint = "/{$this->resource->type}";
        $this->method = Saloon::POST;
        $this->setData($dto->toArray());

        return $this;
    }

    public function update(DataTransferObject $dto)
    {

    }

    public function delete(DataTransferObject|int $dto)
    {

    }

    public function defineEndpoint(): string
    {
        return $this->endpoint;
    }
}

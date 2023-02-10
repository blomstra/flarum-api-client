<?php

namespace Blomstra\FlarumApiClient\Requests;

use Blomstra\FlarumApiClient\Resources\RestResource;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

class RestRequest extends Request
{
    use HasJsonBody;

    protected RestResource|null $resource = null;
    protected string|null $endpoint = null;

    public function for(string|RestResource $resource)
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

    public function show(RestResource|int $resource)
    {
        $id = $resource instanceof RestResource ? $resource->toArray()['id'] : $resource;

        $this->endpoint = "/{$this->resource->type}/$id";
        $this->method = Saloon::GET;

        return $this;
    }

    public function create(RestResource $resource)
    {
        $this->endpoint = "/{$this->resource->type}";
        $this->method = Saloon::POST;
        $this->setData(['data' => $resource->toArray()]);

        return $this;
    }

    public function update(RestResource $resource)
    {
        $id = $resource->toArray()['id'];

        $this->endpoint = "/{$this->resource->type}/$id";
        $this->method = Saloon::PATCH;
        $this->setData(['data' => $resource->toArray()]);

        return $this;
    }

    public function delete(RestResource|int $resource)
    {
        $id = $resource instanceof RestResource ? $resource->toArray()['id'] : $resource;

        $this->endpoint = "/{$this->resource->type}/$id";
        $this->method = Saloon::DELETE;

        return $this;
    }

    public function defineEndpoint(): string
    {
        return $this->endpoint;
    }
}

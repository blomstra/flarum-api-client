<?php

namespace Blomstra\Flarum\Api\Requests;

use Blomstra\Flarum\Api\Exceptions\UnfilterableResourceException;
use Blomstra\Flarum\Api\Resources\Contracts\SupportsFiltering;
use Blomstra\Flarum\Api\Resources\RestResource;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;

class RestRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected RestResource|null $resource = null;
    protected string|null $endpoint = null;

    public function for(string|RestResource $resource): static
    {
        if (is_string($resource)) $resource = new $resource;

        $this->resource = $resource;

        return $this;
    }

    public function index(): static
    {
        $this->endpoint = "/{$this->resource->type}";
        $this->method = Method::GET;

        return $this;
    }

    public function show(RestResource|int $resource): static
    {
        $id = $resource instanceof RestResource ? $resource->toArray()['id'] : $resource;

        $this->endpoint = "/{$this->resource->type}/$id";
        $this->method = Method::GET;

        return $this;
    }

    public function create(RestResource $resource): static
    {
        $this->endpoint = "/{$this->resource->type}";
        $this->method = Method::POST;
        $this->body()->set(['data' => $resource->toArray()]);

        return $this;
    }

    public function update(RestResource $resource): static
    {
        $id = $resource->toArray()['id'];

        $this->endpoint = "/{$this->resource->type}/$id";
        $this->method = Method::PATCH;
        $this->body()->set(['data' => $resource->toArray()]);

        return $this;
    }

    public function delete(RestResource|int $resource): static
    {
        $id = $resource instanceof RestResource ? $resource->toArray()['id'] : $resource;

        $this->endpoint = "/{$this->resource->type}/$id";
        $this->method = Method::DELETE;

        return $this;
    }

    public function resolveEndpoint(): string
    {
        return $this->endpoint;
    }

    public function filter(callable $filter): static
    {
        if (! $this->resource instanceof SupportsFiltering) {
            throw new UnfilterableResourceException(get_class($this->resource)  . ' does not implement SupportsFiltering interface');
        }

        // Force using the index.
        $this->index();

        $filtering = new Rest\Filtering($this);

        $filter($filtering);

        return $this;
    }
}

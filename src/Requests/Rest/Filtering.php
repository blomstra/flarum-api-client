<?php

namespace Blomstra\Flarum\Api\Requests\Rest;

use Blomstra\Flarum\Api\Requests\RestRequest;

class Filtering
{
    public function __construct(protected RestRequest $request)
    {}

    public function search(string $term): static
    {
        $this->request->query()->add('filter[q]', $term);

        return $this;
    }

    public function sort(string $by): static
    {
        $this->request->query()->add('sort', $by);

        return $this;
    }
}

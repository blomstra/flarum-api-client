<?php

namespace Blomstra\Flarum\Api\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

abstract class RestResource implements Arrayable
{
    private static $resources = [
        Discussion::class,
        Post::class,
        User::class,
    ];

    public string $type;

    public array $attributes = [
//        'name' => 'required|string'
    ];

    public array $relations = [
//        'relation' => Resource::class
    ];

    protected array $values = [];
    protected array $included = [];

    public function toArray(): array
    {
        $payload = [
            'type' => $this->type,
            'attributes' => $this->values,
            'relationships' => $this->included,
        ];

        if ($id = Arr::pull($this->values, 'id')) {
            $payload['id'] = $id;
        }

        return $payload;
    }

    public static function with(array $values): static
    {
        if ($attributes = Arr::pull($values, 'attributes', $values)) {
            $included = Arr::pull($values, 'included', []);
        }

        $resource = new static;
        $resource->values = $attributes;
        $resource->included = $included ?? [];

        return $resource;
    }

    public function validate()
    {

    }

    public function __get(string $name)
    {
        return Arr::get($this->values, $name);
    }
}

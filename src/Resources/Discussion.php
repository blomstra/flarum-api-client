<?php

namespace Blomstra\FlarumApiClient\Resources;

class Discussion extends RestResource
{
    public string $type = 'discussions';

    public array $attributes = [
        'title' => 'required|string',
        'content' => 'required|string',
    ];

    public array $relations = [
        'firstPost' => Post::class,
        'comments' => Post::class,
        'user' => User::class,
    ];
}

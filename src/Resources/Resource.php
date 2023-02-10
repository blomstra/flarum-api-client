<?php

namespace Blomstra\FlarumApiClient\Resources;

abstract class Resource
{
    private static $resources = [
        Discussion::class,
        Post::class,
        User::class,
    ];

    public string $type;

    public array $relations = [
//        'relation' => Resource::class
    ];

    public string $dto;
}

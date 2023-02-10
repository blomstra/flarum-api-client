<?php

namespace Blomstra\FlarumApiClient\Resources;

use Blomstra\FlarumApiClient\Data\Discussion as Data;

class Discussion extends Resource
{
    public string $type = 'discussions';

    public array $relations = [
        'firstPost' => Post::class,
        'comments' => Post::class,
        'user' => User::class,
    ];

    public string $dto = Data::class;
}

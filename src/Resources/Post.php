<?php

namespace Blomstra\Flarum\Api\Resources;

class Post extends RestResource
{
    public string $type = 'posts';

    public array $relations = [
        'discussion' => Discussion::class,
        'user' => User::class,
    ];
}

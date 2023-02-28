<?php

namespace Blomstra\Flarum\Api\Resources;

use Blomstra\Flarum\Api\Resources\Contracts\SupportsFiltering;

class User extends RestResource implements SupportsFiltering
{
    public string $type = 'users';

    public array $relations = [
        'discussions' => Discussion::class,
        'posts' => Post::class,
    ];

    public static function new(
        string $username,
        string $emailAddress,
        string $password,
        array $attributes = []
    ): static
    {
        return static::with([
            'username' => $username,
            'email' => $emailAddress,
            'password' => $password,
            ...$attributes
        ]);
    }
}

<?php

namespace Blomstra\Flarum\Api\Resources;

use Blomstra\Flarum\Api\Resources\Contracts\SupportsFiltering;

class Discussion extends RestResource implements SupportsFiltering
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

    public static function new(
        string $title,
        string $content,
        User|int|null $user = null,
        array $attributes = []
    ): static
    {
        return static::with([
            'title' => $title,
            'content' => $content,
            'user' => $user?->id ?? $user ?? null,
            ...$attributes
        ]);
    }
}

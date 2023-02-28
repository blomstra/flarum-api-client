<?php

namespace Blomstra\Flarum\Api\Requests;

use Blomstra\Flarum\Api\Resources\Post;

class Posts extends RestCollection
{
    protected string $resource = Post::class;
}

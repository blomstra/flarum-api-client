<?php

namespace Blomstra\Flarum\Api\Requests;

use Blomstra\Flarum\Api\Resources\Discussion;

class Discussions extends RestCollection
{
    protected string $resource = Discussion::class;
}

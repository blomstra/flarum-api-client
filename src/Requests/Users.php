<?php

namespace Blomstra\Flarum\Api\Requests;

use Blomstra\Flarum\Api\Resources\User;

class Users extends RestCollection
{
    protected string $resource = User::class;
}

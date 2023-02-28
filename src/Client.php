<?php

namespace Blomstra\Flarum\Api;

use Blomstra\Flarum\Api\Requests;

class Client extends Connector
{
    public function discussions(): Requests\Discussions
    {
        return new Requests\Discussions($this);
    }

    public function users(): Requests\Users
    {
        return new Requests\Users($this);
    }

    public function posts(): Requests\Posts
    {
        return new Requests\Posts($this);
    }
}

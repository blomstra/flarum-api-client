<?php

namespace Blomstra\FlarumApiClient\Requests;

use Blomstra\FlarumApiClient\Resources\Discussion;

class Discussions extends RestCollection
{
    protected string $resource = Discussion::class;
}

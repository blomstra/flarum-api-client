<?php

namespace Blomstra\FlarumApiClient\Data;

class User extends DataTransferObject
{
    public string $type = 'users';

    public string $username;
}

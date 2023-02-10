<?php

namespace Blomstra\FlarumApiClient\Data;

class Discussion extends DataTransferObject
{
    public string $type = 'discussions';

    public string $title;

    public CommentPost|null $firstPost;

    public User|null $user;
}

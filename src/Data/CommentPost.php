<?php

namespace Blomstra\FlarumApiClient\Data;

class CommentPost extends DataTransferObject
{
    public string $type = 'posts';

    public Discussion $discussion;

    public User $user;

    public string $content;
}

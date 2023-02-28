<?php

namespace Blomstra\Flarum\Api\Auth;

use Saloon\Contracts\Authenticator as SaloonAuthenticator;
use Saloon\Contracts\PendingRequest;

class Authenticator implements SaloonAuthenticator
{
    public function __construct(protected ?string $token = null, protected ?int $actorId = null)
    {}

    public function set(PendingRequest $pendingRequest): void
    {
        if (! $this->token) return;

        $actorId = $this->actorId ?? 1;

        $header = "Token $this->token; userId=$actorId";

        $pendingRequest->headers()->add('Authorization', $header);
    }
}

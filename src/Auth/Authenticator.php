<?php

namespace Blomstra\FlarumApiClient\Auth;

use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Interfaces\AuthenticatorInterface;

class Authenticator implements AuthenticatorInterface
{
    public function __construct(protected ?string $token = null, protected ?int $actorId = null)
    {}

    public function set(SaloonRequest $request): void
    {
        if (! $this->token) return;

        $header = "Token $this->token";

        if ($this->actorId) {
            $header .= "; userId=$this->actorId";
        }

        $request->addHeader('Authorization', $header);
    }
}

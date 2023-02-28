<?php

use Blomstra\Flarum\Api\Auth\Authenticator;
use Blomstra\Flarum\Api\Client;
use Illuminate\Support\Arr;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv)->overload(__DIR__ . '/../.env');

function api(bool|int $authorized = false): Client {
    $client = new Client(baseUrl: $_ENV['API_URL']);

    if ($authorized && $_ENV['API_TOKEN']) {
        $auth = new Authenticator(
            token: $_ENV['API_TOKEN'],
            actorId: is_int($authorized) ? $authorized : Arr::get($_ENV, 'API_USER_ID')
        );

        $client->authenticate(authenticator: $auth);
    }

    return $client;
}

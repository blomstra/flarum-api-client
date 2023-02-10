<?php

use Blomstra\FlarumApiClient\Auth\Authenticator;
use Blomstra\FlarumApiClient\FlarumApiClient;
use Illuminate\Support\Arr;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv)->overload(__DIR__ . '/../.env');

function api(bool|int $authorized = false): FlarumApiClient {
    $client = new FlarumApiClient(baseUrl: $_ENV['API_URL']);

    if ($authorized && $_ENV['API_TOKEN']) {
        $auth = new Authenticator(
            token: $_ENV['API_TOKEN'],
            actorId: is_int($authorized) ? $authorized : Arr::get($_ENV, 'API_USER_ID')
        );

        $client->authenticate($auth);
    }

    return $client;
}

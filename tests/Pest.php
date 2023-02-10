<?php

use Blomstra\FlarumApiClient\FlarumApiClient;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv)->overload(__DIR__ . '/../.env');

function api(bool $authorized = false): FlarumApiClient {
    return new FlarumApiClient($_ENV['API_URL']);
}

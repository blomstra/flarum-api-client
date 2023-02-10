<?php

use Blomstra\FlarumApiClient\Data;


$data = null;

it('lists discussions', function () use (&$data) {
    $response = api()->discussions()->index();

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();

    $data = $response->collect('data');
});

it('cannot create a discussion without authentication', function () {
    $dto = new Data\Discussion([
        'title' => 'Api Client Test'
    ]);

    $response = api()->discussions()->create($dto);

    expect($response->json('errors.0.code'))->toBe('csrf_token_mismatch');
    expect($response->status())->toBe(400);
});

it('can create a discussion while authenticated', function () {
    $dto = new Data\Discussion([
        'title' => 'Api Client Test'
    ]);

    $response = api()->discussions()->create($dto);

    expect($response->json('errors.0.code'))->toBe('csrf_token_mismatch');
    expect($response->status())->toBe(400);
});


it('shows one discussion', function () use (&$data) {
    $discussion = $data->first();

    $response = api()->discussions()->show((int) $discussion['id']);

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();

    expect($response->json('data.id'))->toBe($discussion['id']);
});

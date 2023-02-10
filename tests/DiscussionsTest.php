<?php

use Blomstra\FlarumApiClient\Resources;


$previous = null;

it('lists discussions', function () use (&$previous) {
    $response = api()->discussions()->index();

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();

    $previous = $response->collect('data');
});

it('cannot create a discussion without authentication', function () {
    $discussion = Resources\Discussion::with(values: [
        'title' => 'blomstra/flarum-api-client - cannot create discussion without authentication',
        'content' => \Illuminate\Support\Str::random(),
    ]);

    $response = api()->discussions()->create($discussion);

    expect($response->json('errors.0.code'))->toBe('csrf_token_mismatch');
    expect($response->status())->toBe(400);
});

it('can create a discussion while authenticated', function () use (&$previous) {
    $discussion = Resources\Discussion::with(values: [
        'title' => 'blomstra/flarum-api-client - can create a discussion while authenticated',
        'content' => \Illuminate\Support\Str::random(),
    ]);

    $response = api(authorized: true)->discussions()->create($discussion);

    expect($response->status())->toBe(201);

    $previous = $response->json('data')['id'];
});

it('shows the discussion', function () use (&$previous) {
    $response = api()->discussions()->show((int) $previous);

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();

    expect($response->json('data.id'))->toBe($previous);
});

it('can update the discussion', function () use (&$previous) {
    $discussion = Resources\Discussion::with(values: [
        'id' => $previous,
        'title' => 'blomstra/flarum-api-client - can update the discussion',
        'content' => \Illuminate\Support\Str::random(),
    ]);

    $response = api(authorized: true)->discussions()->update($discussion);

    expect($response->status())->toBe(200);
    expect($response->json('data.attributes.title'))->toBe($discussion->title);

    $previous = $response->json('data')['id'];
});

it('can delete the discussion', function () use (&$previous) {
    $response = api(true)->discussions()->delete((int) $previous);

    expect($response->status())->toBe(204);
});

<?php

namespace Blomstra\Flarum\Api\Tests;

use Blomstra\Flarum\Api\Requests\Rest\Filtering;
use Blomstra\Flarum\Api\Resources;
use Illuminate\Support\Str;


it('lists discussions', function () {
    $response = api()->discussions()->index();

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();

    return $response->collect('data');
});

it('cannot create a discussion without authentication', function () {
    $discussion = Resources\Discussion::new(
        title: 'blomstra/flarum-api-client - cannot create discussion without authentication',
        content: Str::random()
    );

    $response = api()->discussions()->create($discussion);

    expect($response->json('errors.0.code'))->toBe('csrf_token_mismatch');
    expect($response->status())->toBe(400);
})->depends('it lists discussions');

it('can create a discussion while authenticated', function () {
    $discussion = Resources\Discussion::new(
        title: 'blomstra/flarum-api-client - can create a discussion while authenticated',
        content: Str::random()
    );

    $response = api(authorized: true)->discussions()->create($discussion);

    expect($response->status())->toBe(201);

    return $response->json('data.id');
})->depends('it lists discussions');

it('shows the discussion', function ($discussionId) {
    $response = api()->discussions()->show((int) $discussionId);

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();

    expect($response->json('data.id'))->toBe($discussionId);
})->depends('it can create a discussion while authenticated');

it('finds the discussion when filtering', function ($discussionId) {
    $response = api()->discussions()->filter(function (Filtering $filtering) {
        $filtering->search('blomstra/flarum-api-client authenticated');
    });

    expect($response->collect('data'))->toHaveCount(1);
    expect($response->json('data.0.id'))->toBe("$discussionId");
    expect($response->status())->toBe(200);

})->depends('it can create a discussion while authenticated');

it('can update the discussion', function ($discussionId) {
    $discussion = Resources\Discussion::with(values: [
        'id' => $discussionId,
        'title' => 'blomstra/flarum-api-client - can update the discussion',
        'content' => Str::random(),
    ]);

    $response = api(authorized: true)->discussions()->update($discussion);

    expect($response->status())->toBe(200);
    expect($response->json('data.attributes.title'))->toBe($discussion->title);

    return $response->json('data.id');
})->depends('it can create a discussion while authenticated');

it('can delete the discussion', function ($discussionId) {
    $response = api(true)->discussions()->delete((int) $discussionId);

    expect($response->status())->toBe(204);

    return $discussionId;
})->depends('it can update the discussion');

it('cannot find a deleted discussion', function ($discussionId) {
    $response = api()->discussions()->show($discussionId);

    expect($response->status())->toBe(404);
})->depends('it can delete the discussion');

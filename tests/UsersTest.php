<?php

namespace Blomstra\Flarum\Api\Tests;

use Blomstra\Flarum\Api\Resources;
use Illuminate\Support\Str;

it('shows the admin user', function () {
    $response = api()->users()->show(1);

    expect($response->status())->toBe(200);
    expect($response->body())->toBeJson();
    expect($response->json('data.id'))->toBe("1");
    expect($response->json('data.attributes.username'))->toBe('admin');
});

it('cannot create a user without authentication', function () {
    $user = Resources\User::with([
        'username' => 'api-client-test'
    ]);

    $response = api()->users()->create($user);

    expect($response->json('errors.0.code'))->toBe('csrf_token_mismatch');
    expect($response->status())->toBe(400);
});

it('can create a user while authenticated', function () {
    $unique = 'api-client-test-' . Str::random(6);

    $user = Resources\User::new(
        username: $unique,
        emailAddress: "$unique@local.test",
        password: Str::random(24)
    );

    $response = api(true)->users()->create($user);

    expect($response->status())->toBe(201);
    expect($response->json('data.attributes.username'))->toBe($user->username);

    return $response->json('data.id');
});

it('can delete a user', function ($userId) {
    $response = api(true)->users()->delete($userId);

    expect($response->status())->toBe(204);

    return $userId;
})->depends('it can create a user while authenticated');

it('cannot find a deleted user', function ($userId) {
    $response = api()->users()->show($userId);

    expect($response->status())->toBe(404);
})->depends('it can delete a user');

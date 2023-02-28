# Flarum API client

This library acts like a SDK to the Flarum API of any community.

## Install

```
composer require blomstra/flarum-api-client
```

## Use

Let's instantiate the client:

```php
$api = new \Blomstra\Flarum\Api\Connector(baseUrl: 'https://yourflarumdomain.com/api/');
```

Now read the latest discussions:

```php
$discussions = $api->discusions()->index();

var_dump($discussions); // A list of the recent discussions.
```

## Authentication

There are two modes of operation. You can use the client as a Guest or Authenticated user.

- For basic requests you can continue as a Guest.
- For creation, updates, deletion etc you will need an API token.

An API token needs to be stored inside the table `api_tokens` of your Flarum database. Once generated you can authenticate as follows:

```php
$auth = new \Blomstra\Flarum\Api\Auth\Authenticator(token: 'yourtoken');
$api->authenticate(authenticator: $auth);
```

In case you wish to authenticate on behalf of another user and your token in the `api_tokens` table has **no** user_id assigned, you can do that with the second argument:

```php
$auth = new \Blomstra\Flarum\Api\Auth\Authenticator(token: 'yourtoken', userId: 5);
$api->authenticate(authenticator: $auth);
```

You are now able to create discussions, see for instance this full example:

```php
$api = new \Blomstra\Flarum\Api\Connector(baseUrl: 'https://yourflarumdomain.com/api/');
$auth = new \Blomstra\Flarum\Api\Auth\Authenticator(token: 'this-token-does-not-exist');
$api->authenticate(authenticator: $auth);

$discussion = \Blomstra\Flarum\Api\Resources\Discussion::with(values: [
    'title' => 'Welcome to my automated discussions!',
    'content' => 'The Blomstra Api client rocks 🤘'
]);

$api->discussions->create(resource: $discussion)
```

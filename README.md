# ReCloud Turnstile for Laravel

Privacy-first bot protection for Laravel apps.

## Install

composer require bunowave/recloud-laravel


If the package is not available on Packagist yet, register the ReCloud registry first:


Add your keys to `.env`:

RECLOUD_SITE_KEY=your-site-key
RECLOUD_SECRET=your-secret-key



## Use

Render the widget inside a form:

```blade
<x-recloud theme="dark" size="flexible" />
```

Validate the token:

```php
use BunoWave\ReCloud\Rules\ReCloudRule;

$request->validate([
    'recloud-response' => ['required', new ReCloudRule()],
]);
```

Or use the string rule `'required|recloud'`, the `VerifyReCloud` middleware, or the `ReCloud` facade.

## Options

Publish the config with `php artisan vendor:publish --tag=recloud-config`.

Documentation: https://recloud-turnstile.bunowave.shop/docs/sdks

License: MIT

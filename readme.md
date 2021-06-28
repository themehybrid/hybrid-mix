# Hybrid\\Mix

Hybrid Mix is a class for working with [Lavarel Mix](https://laravel-mix.com/).  It adds helper methods for quickly grabbing asset files cached in the `mix-manifest.json` file.

## Requirements

* WordPress 5.7+.
* PHP 5.6+ (preferably 7+).
* [Composer](https://getcomposer.org/) for managing PHP dependencies.

## Documentation

Create a new instance of the `Hybrid\Mix\Mix` class, passing in a file path and file URI to your project's `public` folder.

```php
$mix = new \Hybrid\Mix\Mix(
	'public/folder/path',
	'public/folder/uri'
);
```

Return the cached asset file URI with an appended ID using the `asset()` method:

```php
// Stylesheet: public/folder/uri/css/style.css?id=xxx
$mix->asset( 'css/style.css' );

// JavaScript: public/folder/uri/js/app.js?id=xxx
$mix->asset( 'js/app.js' );
```

## Copyright and License

This project is licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.

2021 &copy; [Justin Tadlock](https://themehybrid.com).

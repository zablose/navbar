# Navbar

[![Build Status](https://travis-ci.org/zablose/navbar.svg?branch=master)](https://travis-ci.org/zablose/navbar)

Render an HTML from the navigation entities, stored in a database.

## Installation

### Composer

    composer require zablose/navbar

## Usage example with Laravel

Check [Laravel App](./laravel) folder for a usage example.

Main files and folders to look at:
* [Config](./laravel/config/navbar.php)
* [Migrations](./laravel/database/migrations)
* [Seeders](./laravel/database/seeders)
* [ComposerServiceProvider](./laravel/app/Providers/ComposerServiceProvider.php)
* [NavbarComposer](./laravel/app/Http/ViewComposers/NavbarComposer.php)
* [Navigation](./laravel/app/Http/Navigation)

## Development

> Check submodule [readme](https://github.com/zablose/docker-damp/blob/master/readme.md) for more details about
> development environment used.

### Hosts

Append to `/etc/hosts`.

```
127.0.0.1       navbar.zdev
127.0.0.1       www.navbar.zdev
```

## Demo

Visit [https://navbar.zdev:44305/](https://navbar.zdev:44305/) to play with navigation on your development environment.

### Index Page

![](./readme/pictures/demo/index.png)

### Home Page

![](./readme/pictures/demo/home.png)

## License

This package is free software distributed under the terms of the MIT license.

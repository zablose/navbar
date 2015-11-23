# Navbar

Dynamic navigation bars stored in the database as Navbar entities.
Rendered by this package inside your view.

- [Installation](#installation)
    - [Composer](#composer)
    - [Quick Tips](#quick-tips)
        - [Laravel Users](#laravel-users)
            - [Service Provider](#service-provider)
            - [Migrations and Models](#migrations-and-models)
            - [Navbar Demo](#navbar-demo)
- [Usage](#usage)
- [Config File](#config-file)
- [License](#license)

## Installation

### Composer

Pull this package in through Composer (file `composer.json`).

```js
{
    "require": {
        "zablose/navbar": "dev-master"
    }
}
```

> This package in development for now...

Run this command inside your terminal.

    composer update

### Quick Tips

#### Laravel Users

Quick tips for Laravel 5.1.* users.

##### Service Provider

Add service provider to your `config/app.php` file.

```php
...
'providers' => [
    ...
    /**
     * Third Party Service Providers...
     */
    Zablose\Navbar\NavbarServiceProvider::class,
],
...
```

##### Migrations and Models

Run commands to copy files and migrate database

    php artisan vendor:publish --provider='Zablose\Navbar\NavbarServiceProvider' --tag=migrations --tag=models
    php artisan migrate

##### Navbar Demo

Finally visit the Navbar Demo page: [http://localhost/zablose/navbar/demo](http://localhost/zablose/navbar/demo)

## Usage

```php
$navbar = new \Zablose\Navbar\NavbarBuilder(new App\Zablose\Navbar\NavbarData());
$navbar->prepare()->render('main');
```

Where `NavbarData` is a class that implements `NavbarDataContract` interface with one method and written by you.

## Config File

Write notes about config file.

## License

This package is free software distributed under the terms of the MIT license.

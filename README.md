# Navbar

Renders HTML from the navigation entities.

>Meant to be used with a database to store entities. This is optional, but recommended.

Key features:
* Bootstrap support
* Roles and Permissions
* Recursive
* Extendable
* Ajax in mind

## Readme Index
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

Finally visit the Navbar Demo page: [/zablose/navbar/demo](/zablose/navbar/demo)

![https://www.dropbox.com/s/4g7r0awf9f4ek04/navbar-demo.png?raw=1](https://www.dropbox.com/s/4g7r0awf9f4ek04/navbar-demo.png?raw=1)

>Please keep in mind that this package itself is not responsible for the CSS and JavaScript. This is only a demo that shows you how it may look like if you will use [Bootstrap](http://getbootstrap.com/), [jQuery](http://jquery.com/) and [Font Awesome](http://fortawesome.github.io/Font-Awesome/).

## Usage

```php
$navbar = new \Zablose\Navbar\NavbarBuilder(new App\Zablose\Navbar\NavbarData());

$navbar->render('main');

// Two Navbars but one database query.
$navbar->prepare(['main','dashboard'])->render('main');
$navbar->render('dashboard');

// Same as above but prepares all Navbars by their filters.
$navbar->prepare()->render('main');
$navbar->render('dashboard');

// If you are not sure about the order.
// Prepare runs only ones, that is why it is important in some cases.
$navbar->prepare()->render('main');
$navbar->prepare()->render('dashboard');

// Renders entities by parent ID.
// Prepare method will not work.
// The main idea is to use it with an Ajax, to render on request.
$navbar->render(1);
```

Where `NavbarData` is a class that implements `NavbarDataContract` interface with one method and written by you.

## Config File

| Key                    | Default Value | Examples | Description |
| :--------------------- | ------------- | -------- | ----------- |
| `app_url`              | `'/'` | `'http://domain.com'` | Application URL. |
| `order_by`             | `''` | `'id:desc'`, `'position:asc'` | Order by `'column:direction'`. Implemented by you. |
| `active_link_class`    | `'active'` |  | Tag's class attribute value for an active link. |
| `external_link_target` | `'_blank'` | `'_self'` | Tag's target attribute value for an external link. |
| `navbar_entity_class`  | `NavbarEntity::class` |  | Class to be used by `NavbarDataProcessor` to represent `NavbarEntity`. |

## License

This package is free software distributed under the terms of the MIT license.

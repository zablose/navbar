# Navbar

Renders navigation entities to an HTML to form navigation.

>Meant to be used with a database to store entities.

Key features:
* Bootstrap
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
            - [Real Use](#real-use)
        - [Rest of the World](#rest-of-the-world)
- [Usage](#usage)
- [License](#license)

## Installation

### Composer

Pull this package in through Composer (file `composer.json`).

```js
{
    "require": {
        "zablose/navbar": "1.*"
    }
}
```

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

Run commands to copy files and migrate database:

    php artisan vendor:publish --provider='Zablose\Navbar\NavbarServiceProvider' --tag=migrations --tag=models
    php artisan migrate

##### Navbar Demo

Finally visit the Navbar Demo page: http://yourmegaproject.com `/zablose/navbar/demo`.

![https://www.dropbox.com/s/4g7r0awf9f4ek04/navbar-demo.png?raw=1](https://www.dropbox.com/s/4g7r0awf9f4ek04/navbar-demo.png?raw=1)

>Please keep in mind that this package itself is not responsible for the CSS and JavaScript.
This is only a demo that shows you how it may look like if you will use [Bootstrap](http://getbootstrap.com/),
[jQuery](http://jquery.com/) and [Font Awesome](http://fortawesome.github.io/Font-Awesome/).

##### Real Use

Copy configuration file and view to your application for real use of the package.

For the configuration file run:

    php artisan vendor:publish --provider='Zablose\Navbar\NavbarServiceProvider' --tag=config

For view run:

    php artisan vendor:publish --provider='Zablose\Navbar\NavbarServiceProvider' --tag=views

Remove Navbar service provider.

>It was used to make setup easier for you and show a usage example.

Add to your `app/Http/routes.php` file:

```php
use App\Zablose\Navbar\NavbarData;
use Zablose\Navbar\NavbarBuilder;
use Zablose\Navbar\NavbarConfig;

Route::get('/zablose/navbar/demo', function ()
{
    $config = new NavbarConfig(config('navbar'));
    $navbar = new NavbarBuilder(new NavbarData(), $config);
    return view('vendor.zablose.navbar.sidebar', compact('navbar'));
});
```

### Rest of the World

Check `examples` folder.

There you will find:
* MySQL database structure and demo data
* Very simple straight forward NavbarData class example
* Simple usage in `index.php`
* `composer.json` file example

Check `src/views/sidebar.blade.php` file for Bootstrap beauties. File needs some tweaking.

## Usage

```php
$navbar = new \Zablose\Navbar\NavbarBuilder(new App\Zablose\Navbar\NavbarData());

$navbar->render('main', 'id:desc');

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
$navbar->render(2015);
```

Where `NavbarData` is a class that implements `NavbarDataContract` interface with one method and written by you.

## License

This package is free software distributed under the terms of the MIT license.

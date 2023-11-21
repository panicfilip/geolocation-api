<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Geolocation API

This is a Laravel application that uses Laravel Sail for easy Docker-based development.

## Prerequisites

Before you get started, ensure that you have the following software installed on your local machine:

Docker Desktop: You can download it from <a href="https://www.docker.com/products/docker-desktop/">Docker's official website</a>. Docker Desktop includes Docker Engine, Docker CLI client, Docker Compose, Notary, Kubernetes, and Credential Helper.

Composer: This is a tool for dependency management in PHP. You can download it from <a href="https://getcomposer.org/download/">Composer's official website</a>.

## Installation & Setup

Clone the repository:

git clone https://github.com/panicfilip/geolocation-api

Navigate to the project directory:

```cd geolocation-api```

Install dependencies with Composer:

```composer install```

Copy the .env.example file to create your own environment file:

```cp .env.example .env```

Generate an application key:

```php artisan key:generate```

Start Laravel Sail:

```./vendor/bin/sail up```

Or, if you have added the sail command to your system's PATH, https://laravel.com/docs/10.x/sail#configuring-a-shell-alias you can simply use:

```sail up```

You should now be able to access the application and see Swagger documentation at: http://localhost.

## Usage

With Laravel Sail, you can easily interact with your Laravel application within the Docker environment.

Here are some examples of how to use Laravel Sail:

To run Artisan commands:

```sail artisan migrate```

To run Composer commands:

```sail composer require laravel/sanctum```

To run tests:

```sail test```

## Stopping Sail

To stop all the Docker containers, you can use the down command:

```sail down```

## PHP Versions

Laravel Sail supports PHP 8.3, 8.2, 8.1, and 8.0. The default PHP version is 8.2. You can change the PHP version by updating the build definition of the laravel.test container in your application's docker-compose.yml file.

## Debugging with Xdebug

Laravel Sail's Docker configuration includes support for Xdebug. To enable Xdebug, you need to set the appropriate mode(s) in your application's .env file:

```SAIL_XDEBUG_MODE=develop,debug,coverage```

Then restart the Sail containers.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Please check the official Laravel Sail documentation for more information about Laravel Sail.

## Support

If you encounter any issues or require further assistance, please file an issue on the GitHub repository.

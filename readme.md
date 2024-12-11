![test workflow](https://github.com/berthott/laravel-hrworks/actions/workflows/test.yml/badge.svg)

# Laravel-HRWorks

An HrWorks API Integration for Laravel.

## Requirements

For a connection to HrWorks, it is necessary, to obtain an API token. More information can be found on the [HRWorks API Documentation](https://developers.hrworks.de/).

## Installation

```sh
$ composer require berthott/laravel-hrworks
```

## Usage

This package only provides a generic `HrWorksApiService` which an be used to conveniently interact with the HrWorks API. The package will take care of authentication and will store an auth token inside the database.

## Options

To change the default options use
```
$ php artisan vendor:publish --provider="berthott\HrWorks\HrWorksServiceProvider" --tag="config"
```
* `cache_enabled`: HrWorks will cache it's responses by default. This package disables this by default. Defaults to `false`.
* `auth`: Array to define `accessKey` and `secretAccessKey` which can be obtained from within the HrWorks application. Defaults to 
  ```
  'accessKey' => env('HRWORKS_ACCESS_KEY'),
  'secretAccessKey' => env('HRWORKS_SECRET_ACCESS_KEY'),
  ```
* `api`: Defines the endpoints to the HrWorks Api. Default see `config/config.php`.

## Compatibility

Tested with Laravel 10.x.

## License

See [License File](license.md). Copyright © 2024 Jan Bladt.
# Laravel-HRWorks

An HRWorks API Integration for Laravel.

## Requirements

For a connection between HRWorks, it is necessary, to obtain an API token. More information can be found on the [HRWorks API Documentation](https://developers.hrworks.de/).

## Installation

```sh
$ composer require berthott/laravel-hrworks
```

## Usage

## Options

To change the default options use
```
$ php artisan vendor:publish --provider="berthott\SX\SxServiceProvider" --tag="config"
```
* Inherited from [laravel-targetable](https://docs.syspons-dev.com/laravel-targetable)
  * `namespace`: String or array with one ore multiple namespaces that should be monitored for the configured trait. Defaults to `App\Models`.
  * `namespace_mode`: Defines the search mode for the namespaces. `ClassFinder::STANDARD_MODE` will only find the exact matching namespace, `ClassFinder::RECURSIVE_MODE` will find all subnamespaces. Defaults to `ClassFinder::STANDARD_MODE`.
  * `prefix`: Defines the route prefix. Defaults to `api`.

## Compatibility

Tested with Laravel 10.x.

## License

See [License File](license.md). Copyright © 2023 Jan Bladt.
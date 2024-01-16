# Filament Localizable Resources

[![Latest Version on Packagist](https://img.shields.io/packagist/v/apility/filament-localizable-resources.svg?style=flat-square)](https://packagist.org/packages/apility/filament-localizable-resources)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/apility/filament-localizable-resources/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/apility/filament-localizable-resources/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/apility/filament-localizable-resources/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/apility/filament-localizable-resources/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/apility/filament-localizable-resources.svg?style=flat-square)](https://packagist.org/packages/apility/filament-localizable-resources)

This package provides a re-usable trait for Filament Resources which adds support for localizing the resource labels.

## Installation

You can install the package via composer:

```bash
composer require apility/filament-localizable-resources
```

## Usage

```php
namespace App\Filament\Resources;

use Apility\Filament\Concerns\HasLocalizableResourceLabels;

use Filament\Resources\Resource;

class ArticleResource extends Resource
{
    use HasLocalizableResourceLabels;

    // ...
}

```

The trait modifies the default methods for retrieving the resource labels to use the `__()` helper function to translate the labels.

It will look for the translation key in the following format:

```php
return [
    // The resource slug is used as the translation key
    'articles' => [
        'model_label' => 'article|articles',
        'navigation_label' => 'Articles', // Optional, defaults to model_label
        'slug' => 'articles', // Optional, defaults to resource slug
    ],
];
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

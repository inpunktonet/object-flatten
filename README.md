# This package lets you convert an object with a passed separator into a flat object and back again

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inpunktonet/object-flatten.svg?style=flat-square)](https://packagist.org/packages/inpunktonet/object-flatten)
[![Tests](https://img.shields.io/github/actions/workflow/status/inpunktonet/object-flatten/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/inpunktonet/object-flatten/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/inpunktonet/object-flatten.svg?style=flat-square)](https://packagist.org/packages/inpunktonet/object-flatten)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require inpunktonet/object-flatten
```

## Usage

### Flatten an object

```php

$data = [
    'company' => [
        'name' => 'InPunktoNET',
        'depth' => [
            'level' => 1,
            'level2' => [
                'level3' => 3,
            ],
        ],
    ],
];

$skeleton = new InPunktoNET\ObjectFlatten();
$skeleton->setKeyValueSeparator(';');
$skeleton->setKeySeparator('.');
echo $skeleton->toFlattenString(data: $object);
```

Response:
```php
company.name;InPunktoNET
company.depth.level;1
company.depth.level2.level3;3
```

### Unflatten an object

```php
$flattenedStrings = [
    "company.name;InPunktoNET",
    "company.depth.level;1",
    "company.depth.level2.level3;3"
];
```

```php
$skeleton = new InPunktoNET\ObjectFlatten();
$skeleton->setKeyValueSeparator(';');
$skeleton->setKeySeparator('.');

echo $skeleton->toObject(data: $object);
```

Response:
```php
[
    'company' => [
        'name' => 'InPunktoNET',
        'depth' => [
            'level' => "1",
            'level2' => [
                'level3' => "3",
            ],
        ],
    ],
]
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jan Späth](https://github.com/inpunktonet)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

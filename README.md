# This package lets you convert an object with a passed separator into a flat object and back again

[![Latest Version on Packagist](https://img.shields.io/packagist/v/inpunktonet/object-flatten.svg?style=flat-square)](https://packagist.org/packages/inpunktonet/object-flatten)
[![Tests](https://img.shields.io/github/actions/workflow/status/inpunktonet/object-flatten/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/inpunktonet/object-flatten/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/inpunktonet/object-flatten.svg?style=flat-square)](https://packagist.org/packages/inpunktonet/object-flatten)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/object-flatten.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/object-flatten)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

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
echo $skeleton->toFlattenString(data: $object, separator: '.', delimiter: ';');
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
echo $skeleton->toObject(data: $object, separator: '.', delimiter: ';');
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

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jan Späth](https://github.com/inpunktonet)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

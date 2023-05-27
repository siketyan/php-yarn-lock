# php-yarn-lock
[![Latest Stable Version](https://poser.pugx.org/siketyan/yarn-lock/v)](https://packagist.org/packages/siketyan/yarn-lock)
[![Total Downloads](https://poser.pugx.org/siketyan/yarn-lock/downloads)](https://packagist.org/packages/siketyan/yarn-lock)
[![License](https://poser.pugx.org/siketyan/yarn-lock/license)](https://packagist.org/packages/siketyan/yarn-lock)
![PHP](https://github.com/siketyan/php-yarn-lock/workflows/PHP/badge.svg)
![LoXcan](https://github.com/siketyan/php-yarn-lock/workflows/LoXcan/badge.svg)

A Parser Library for yarn.lock in PHP.

## 📦 Installation
```console
$ composer require siketyan/yarn-lock
```

## ✨ Usage
```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Siketyan\YarnLock\YarnLock;

var_dump(
    YarnLock::toArray(
        file_get_contents('./yarn.lock'),
    ),
);
```

🌱 Example Output:

```
array(3) {
  ["@types/minimatch@*"]=>
  array(3) {
    ["version"]=>
    string(5) "3.0.3"
    ["resolved"]=>
    string(108) "https://registry.yarnpkg.com/@types/minimatch/-/minimatch-3.0.3.tgz#3dca0e3f33b200fc7d1139c0cd96c1268cadfd9d"
    ["integrity"]=>
    string(95) "sha512-tHq6qdbT9U1IRSGf14CL0pUlULksvY9OZ+5eEgl1N7t+OA3tGvNpxJCzuKQlsNgCVwbAs670L1vcVQi8j9HjnA=="
  }
  ["@types/node@*,@types/node@^14.6.0"]=>
  array(3) {
    ["version"]=>
    string(6) "14.6.0"
    ["resolved"]=>
    string(99) "https://registry.yarnpkg.com/@types/node/-/node-14.6.0.tgz#7d4411bf5157339337d7cff864d9ff45f177b499"
    ["integrity"]=>
    string(95) "sha512-mikldZQitV94akrc4sCcSjtJfsTKt4p+e/s0AGscVA6XArQ9kFclP+ZiYUMnq987rc6QlYxXv/EivqlfSLxpKA=="
  }
  ["@types/webpack-sources@*"]=>
  array(4) {
    ["version"]=>
    string(5) "1.4.2"
    ["resolved"]=>
    string(120) "https://registry.yarnpkg.com/@types/webpack-sources/-/webpack-sources-1.4.2.tgz#5d3d4dea04008a779a90135ff96fb5c0c9e6292c"
    ["integrity"]=>
    string(95) "sha512-77T++JyKow4BQB/m9O96n9d/UUHWLQHlcqXb9Vsf4F1+wKNrrlWNFPDLKNT92RJnCSL6CieTc+NDXtCVZswdTw=="
    ["dependencies"]=>
    array(3) {
      ["@types/node"]=>
      string(1) "*"
      ["@types/source-list-map"]=>
      string(1) "*"
      ["source-map"]=>
      string(6) "^0.7.3"
    }
  }
}
```

## 🔌 API
```php
<?php

namespace Siketyan\YarnLock;

class YarnLock
{
    public static function toArray(string $buffer): array;
    
    /**
     * @return list<PackageInterface>
     */
    public static function packages(string $buffer): array;
    
    /**
     * @return list<PackageInterface>
     */
    public static function packagesFromArray(array $yarnLock): array;
}
```

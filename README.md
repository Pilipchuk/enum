PHP ENUM
========

Enum gives the ability to emulate and create enumeration objects in PHP.

INSTALL
=====
```bash
composer require darkdevlab/enum
```

USAGE
=====
```php
use DarkDevLab\Enum\Tests\ExampleEnum;

// Usage with always object creation
$e = new ExampleEnum(ExampleEnum::ONE);
var_dump($e->getValue()); // (int) 1

// Usage with memory container (object will created only once)
$e = ExampleEnum::get(ExampleEnum::OTHER);
var_dump($e->getValue()); // (string) 'other'
```
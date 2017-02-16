# SfContextBundle

[![Package version](https://img.shields.io/packagist/vpre/theofidry/SfContextBundle.svg?style=flat-square)](https://packagist.org/packages/theofidry/sfcontext-bundle)
[![Build Status](https://img.shields.io/travis/theofidry/SfContextBundle.svg?branch=master&style=flat-square)](https://travis-ci.org/theofidry/SfContextBundle?branch=master)
[![License](https://img.shields.io/badge/license-MIT-red.svg?style=flat-square)](LICENSE)

A dead simple bundle to be able to access to the [Symfony][2] Container statically.


## Install

You can use [Composer][1] to install the bundle to your project:

```bash
composer require theofidry/sfcontext-bundle:^1.0@rc
```

Then, enable the bundle by updating your `app/AppKernel.php` file to enable the bundle:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Fidry\SfContextBundle\SfContextBundle(),
    );

    return $bundles;
}
```


## Usage

There is two cases where you might use this bundle:

1. If you don't like dependency injection
2. For quick & dirty debugging where you can't afford to do a dump

```php
class DummyService
{
    public function foo()
    {
        // Do something

        SfContext::get('logger')->debug('it worked');

        // Do something else
    }
}
```


## Credits

I got the original idea from [Laravel facades][3] although the idea is actually
not new and you can find it in the Symfony world as [sfContext][4] and which
has been ported in Symfony 2.x with [sfContextBundle][5].


[1]: https://getcomposer.org/
[2]: http://symfony.com/
[3]: https://laravel.com/docs/5.3/facades
[4]: http://www.symfony-project.org/api/1_4/sfContext
[5]: https://github.com/francisbesset/sfContextBundle

# SfContextBundle

[![Package version](http://img.shields.io/packagist/v/theofidry/sfcontext.svg?style=flat-square)](https://packagist.org/packages/theofidry/sfcontext-bundle)
[![Build Status](https://img.shields.io/travis/theofidry/SfContextBundle.svg?branch=master&style=flat-square)](https://travis-ci.org/theofidry/SfContextBundle?branch=master)
[![License](https://img.shields.io/badge/license-MIT-red.svg?style=flat-square)](LICENSE)

A dead simple bundle to be able to access to the [Symfony][2] Container statically.


## Install

You can use [Composer][1] to install the bundle to your project:

```bash
composer require theofidry/sfcontext-bundle
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
		
		SfContext::get('logger')->debug('it worked);
		
		// Do something else
	}
}
```

[1]: https://getcomposer.org/
[2]: http://symfony.com/

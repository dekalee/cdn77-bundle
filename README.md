Dekalee CDN77 Bundle
====================

| Service | Badge |
| -------- |:--------:|
| Code quality (scrutinizer) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dekalee/cdn77-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dekalee/cdn77-bundle/?branch=master) |

This symfony bundle wraps the usage of the library [Cdn77](https://github.com/dekalee/cdn77-bundle)

Installation
------------

Use composer to install this bundle :

```
    composer require dekalee/cdn77-bundle
```

Activate it in the `AppKernel.php` file:

```php
    new Dekalee\Cdn77Bundle\DekaleeCdn77Bundle(),
```

Configuration
-------------

In the `config.yml` file, you should set at least :

```yaml
    dekalee_cdn77:
        login: %dekalee_cnd77_login%
        password: %dekalee_cnd77_password%
```

If you want to override the api urls used, you can do it for each of them :

```yaml
    dekalee_cdn77:
        list: Your url
        create: Your url
        purge: Your url
        purge_all: Your url
```

Usage
-----

To use a query in your project, you can call (from a `ContainerAwareInterface` class) :

```php
    $this->container->get('dekalee_cdn77.query.purge_all')->execute();
```

Each action will have it's own service.

Debug
-----

In order to see some usefull debug information in the symfony profiler, you can install the
[eightpoints/guzzle-bundle](https://packagist.org/packages/eightpoints/guzzle-bundle).

# Nette Cookbook

[![Build Status](https://img.shields.io/travis/contributte/cookbook.svg?style=flat-square)](https://travis-ci.org/contributte/cookbook)

----

This repository is for education. The main goal is to show how to define services in cool Nette Dependency-Injection Container (nette/di).
The examples are written in NEON (take a look at [ne-on.org](https://ne-on.org)) and in PHP classes called `CompilerExtension`.

Related blogposts:
- https://f3l1x.io/blog/2015/10/17/nette-jak-zapisovat-sluzby/

## Versions

| Nette DI |  PHP |
|-------|------|
| [3.2](3.2) | >=8.1 |
| [3.1](3.1) | >=8.0 |
| [3.0](3.0) | >=7.1 |
| [2.4](2.4) | >=7.1 |
| [2.3](2.3) | >=5.6 <7.3 |

## Latest reference

* Configuration (https://doc.nette.org/en/configuring)
* Dependency injection (https://doc.nette.org/en/dependency-injection)
* Define extensions (https://doc.nette.org/en/di-extensions)
* Built-in extensions (https://doc.nette.org/cs/di-builtin-extensions)
* DI usage (https://doc.nette.org/en/di-usage)

## Example

### NEON

```yaml
services:
  facebookAuthorizator: 
    class: App\Model\Security\FacebookAuthorizators(@redisCache)
    
  redisCache: Predis\PredisClient
```

### PHP

```php
$builder->addDefinition('facebookAuthorizator')
    ->setClass('App\Model\Security\FacebookAuthorizators(@redisCache)');

$builder->addDefinition('redisCache')
    ->setClass('Predis\PredisClient');
```

## Roadmap

- [?] Create some online tool using now.sh ([@zeit](https://github.com/zeit)).

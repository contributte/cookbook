# Nette dependency injection cookbook

[![Build Status](https://img.shields.io/travis/planette/cookbook-dependency-injection.svg?style=flat-square)](https://travis-ci.org/planette/cookbook-dependency-injection)

----

This repository is for education. The main goal is to show how to define services in cool Nette Dependency-Injection Container (nette/di).
The examples are written in NEON (take a look at [ne-on.org](https://ne-on.org)) and in PHP classes called `CompilerExtension`.

Related blogposts:
- https://f3l1x.io/blog/2015/10/17/nette-jak-zapisovat-sluzby/

## Versions

| Nette DI |  PHP |
|-------|------|
| [3.0](3.0) | >7.1 |
| [2.4](2.4) | >7.1 |
| [2.3](2.3) | <7.2 |

## Latest reference

* Configuration (https://doc.nette.org/en/2.4/configuring)
* Dependency injection (https://doc.nette.org/en/2.4/dependency-injection)
* Define extensions (https://doc.nette.org/en/2.4/di-extensions)
* Built-in extensions (https://doc.nette.org/cs/2.4/di-builtin-extensions)
* DI usage (https://doc.nette.org/en/2.4/di-usage)

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

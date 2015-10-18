# Nette\DI Syntax Overview

[![Build Status](https://img.shields.io/travis/FriendsOfNette/DI-syntax.svg?style=flat-square)](https://travis-ci.org/FriendsOfNette/DI-syntax)

## Syntax

* Config (NEON)
* Extension (PHP)

## Overview

See more in codes [config](https://github.com/FriendsOfNette/DI-syntax/blob/master/src/syntax/neon/syntax.neon), [extension](https://github.com/FriendsOfNette/DI-syntax/blob/master/src/syntax/extension/SyntaxExtension.php).

### Simple

#### Config

```yaml
services:
    a1: TestClass

    a2:
        class: TestClass

    a3:
        create: TestClass
```

#### Extension

```php
$builder = $this->getContainerBuilder();

$builder->addDefinition('a1')
    ->setClass('TestClass');

$builder->addDefinition('a2')
    ->setClass('TestClass');

$builder->addDefinition('a3')
    ->setFactory('TestClass');
```

### Options

#### Config

```yaml
services:
    b1:
        class: TestClass
        autowired: off

    b2:
        class: TestClass
        inject: on
```

#### Extension

```php
$builder = $this->getContainerBuilder();

$builder->addDefinition('b1')
    ->setClass('TestClass')
    ->setAutowired(FALSE);

$builder->addDefinition('b2')
    ->setClass('TestClass')
    ->setInject(TRUE);
```

### Arguments

#### Config

```yaml
services:
    c1a: TestClass2(1, 2)

    c1b:
        class: TestClass2
        arguments: [1, 2]

    c2a: TestClass2(1)

    c2b:
        class: TestClass2
        arguments: [a: 1]

    c3a: TestClass2(b: 2)

    c3b:
        class: TestClass2
        arguments: [b: 2]
```

#### Extension

```php
$builder = $this->getContainerBuilder();

$builder->addDefinition('c1a')
    ->setClass('TestClass2')
    ->setArguments([1, 2]);

$builder->addDefinition('c1b')
    ->setClass('TestClass2', [1, 2]);

$builder->addDefinition('c2a')
    ->setClass('TestClass2')
    ->setArguments([1]);

$builder->addDefinition('c2b')
    ->setClass('TestClass2', [1]);

$builder->addDefinition('c3a')
    ->setClass('TestClass2')
    ->setArguments(['b' => 2]);

$builder->addDefinition('c3b')
    ->setClass('TestClass2', ['b' => 2]);
```

### Tags

#### Config

```yaml
services:
    d1:
        class: TestClass
        tags: [t1]
    d2:
        class: TestClass
        tags: [t1: foobar]
```

#### Extension

```php
$builder = $this->getContainerBuilder();

$builder->addDefinition('d1')
    ->setClass('TestClass')
    ->addTag('t1');

$builder->addDefinition('d2')
    ->setClass('TestClass')
    ->setTags(['t1' => 'foobar']);
```

### Arguments + parameters

#### Config

```yaml
services:
    e1:
        class: TestClass2
        parameters: [a]
        arguments: [%a%]

    e2:
        class: TestClass2
        parameters: [a: NULL, b: 1]
        arguments: [%a%, %b%]

    e3:
        class: TestClass2(%a%)
        parameters: [a]

    e4:
        class: TestClass2(b: %a%)
        parameters: [a]
```

#### Extension

```php
$builder = $this->getContainerBuilder();

// $->setClass()->setArguments() <==> $->setFactory()

$builder->addDefinition('e1')
    ->setClass('TestClass2')
    ->setArguments([$builder->literal('$a')])
    ->setParameters(['a']);

$builder->addDefinition('e2')
    ->setClass('TestClass2', [$builder->literal('$a'), $builder->literal('$b')])
    ->setParameters(['a' => NULL, 'b' => 1]);

$builder->addDefinition('e3')
    ->setClass('TestClass2')
    ->setArguments([$builder->literal('$a')])
    ->setParameters(['a']);

$builder->addDefinition('e4')
    ->setClass('TestClass2')
    ->setArguments([NULL, $builder->literal('$a')])
    ->setParameters(['a']);
```

### Implements (interfaces)

#### Config

```yaml
services:
    f1:
        implement: ITestInterface

    f2:
        class: stdClass
        implement: ITestInterface

    f3a:
        implement: ITestInterface2
        arguments: [1, 2]

    f3b:
        implement: ITestInterface2
        arguments: [b: 2]

    f4a:
        implement: ITestInterface3
        parameters: [c]
        arguments: [%c%]

    f4b:
        implement: ITestInterface3
        parameters: [c]
        arguments: [1]

    f5s: TestClass2
    f5:
        factory: @f5s
        implement: ITestInterfaceGet

    f6s:
        class: TestClass
    f6:
        factory: @f6s
        implement: ITestInterface

    f7s:
        class: TestClass2
    f7:
        factory: @f7s
        implement: ITestInterface3
        parameters: [c: 1]
        arguments: [%c%]
```

#### Extension

```php
$builder = $this->getContainerBuilder();

$builder->addDefinition('f1')
    ->setImplement('ITestInterface');

$builder->addDefinition('f2')
    ->setClass('stdClass')
    ->setImplement('ITestInterface');

$builder->addDefinition('f3a')
    ->setImplement('ITestInterface2')
    ->setArguments([1, 2]);

$builder->addDefinition('f3b')
    ->setImplement('ITestInterface2')
    ->setArguments(['b' => 2]);

$builder->addDefinition('f4a')
    ->setImplement('ITestInterface3')
    ->setArguments([$builder->literal('$c')])
    ->setParameters(['c']);

$builder->addDefinition('f4b')
    ->setImplement('ITestInterface3')
    ->setArguments([1])
    ->setParameters(['c']);

$builder->addDefinition('f5s')
    ->setClass('TestClass2');

$builder->addDefinition('f5')
    ->setFactory('@f5s')
    ->setImplement('ITestInterfaceGet');

$builder->addDefinition('f6s')
    ->setClass('TestClass');

$builder->addDefinition('f6')
    ->setFactory('@f6s')
    ->setImplement('ITestInterface');

$builder->addDefinition('f7s')
    ->setClass('TestClass2');

$builder->addDefinition('f7')
    ->setFactory('@f7s')
    ->setImplement('ITestInterface3')
    ->setArguments([$builder->literal('$c')])
    ->setParameters(['c' => 1]);
```

### References

#### Config

```yaml
services:
    g1:
        class: TestClass2
        parameters: [a: NULL, b: NULL]
        arguments: [%a%, %b%]

    g2: @g1

    g3:
        factory: @g1
        arguments: [1]

    g4:
        factory: @g1
        parameters: [b]
        arguments: [b: %b%]

    g5a:
        class: stdClass
        factory: @g1::foo()

    g5b:
        class: stdClass
        factory: @g1::foo
        parameters: [bar]
        arguments: [%bar%]

    g5c:
        class: stdClass
        factory: @g1::foo(%bar%)
        parameters: [bar]

    g5d:
        class: stdClass
        factory: @g1(%bar1%)::foo(%bar2%)
        parameters: [bar1, bar2]
```

#### Extension

```php
$builder = $this->getContainerBuilder();

$builder->addDefinition('g1')
    ->setClass('TestClass2')
    ->setArguments([$builder->literal('$a'), $builder->literal('$b')])
    ->setParameters(['a' => NULL, 'b' => NULL]);

$builder->addDefinition('g2')
    ->setFactory('@g1');

$builder->addDefinition('g3')
    ->setFactory('@g1')
    ->setArguments([1]);

$builder->addDefinition('g4')
    ->setFactory('@g1')
    ->setArguments(['b' => $builder->literal('$b')])
    ->setParameters(['b']);

$builder->addDefinition('g5a')
    ->setClass('stdClass')
    ->setFactory('@g1::foo');

$builder->addDefinition('g5b')
    ->setClass('stdClass')
    ->setFactory('@g1::foo')
    ->setArguments([$builder->literal('$bar')])
    ->setParameters(['bar']);

$builder->addDefinition('g5c')
    ->setClass('stdClass')
    ->setFactory('@g1::foo', [$builder->literal('$bar')])
    ->setParameters(['bar']);

$builder->addDefinition('g5d')
    ->setClass('stdClass')
    ->setFactory(new Statement([
            new Statement('@g1', [$builder->literal('$bar1')]),
            'foo'
        ], [$builder->literal('$bar2')])
    )->setParameters(['bar1', 'bar2']);
```

### Setup

#### Config

```yaml
services:
    h1:
        class: stdClass
        setup:
            - $a(1)
            - [@self, $a](1)
            - @self::$a(1)
            - foo(1)
            - [@self, foo](1)
            - @self::foo(1)

    h2:
        class: stdClass
        setup:
            - "$service->hello(?)"(@h1)
            - "$service->hi(?)"(@container)
            - "Tracy\\Bar::init(?)"(@self)
```

#### Extension

```php
$builder = $this->getContainerBuilder();

$builder->addDefinition('h1')
    ->setClass('stdClass')
    ->addSetup('$a', [1])
    ->addSetup(new Statement(['@self', '$a'], [1]))
    ->addSetup('@self::$a', [1])
    ->addSetup('foo', [1])
    ->addSetup(new Statement(['@self', 'foo'], [1]))
    ->addSetup('@self::foo', [1]);

$builder->addDefinition('h2')
    ->setClass('stdClass')
    ->addSetup(new Statement('$service->hello(?)', ['@h1']))
    ->addSetup(new Statement('$service->hi(?)', ['@container']))
    ->addSetup(new Statement('Tracy\\Bar::init(?)', ['@self']));
}
```

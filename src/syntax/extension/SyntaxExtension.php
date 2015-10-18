<?php

use Nette\DI\CompilerExtension;
use Nette\DI\Statement;

final class SyntaxExtension extends CompilerExtension
{

    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();

        // SIMPLE ================================

        $builder->addDefinition('a1')
            ->setClass('TestClass');

        $builder->addDefinition('a2')
            ->setClass('TestClass');

        $builder->addDefinition('a3')
            ->setFactory('TestClass');

        // OPTIONS ===============================

        $builder->addDefinition('b1')
            ->setClass('TestClass')
            ->setAutowired(FALSE);

        $builder->addDefinition('b2')
            ->setClass('TestClass')
            ->setInject(TRUE);

        // ARGUMENTS =============================

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

        // TAGS ==================================

        $builder->addDefinition('d1')
            ->setClass('TestClass')
            ->addTag('t1');

        $builder->addDefinition('d2')
            ->setClass('TestClass')
            ->setTags(['t1' => 'foobar']);

        // ARGUMENTS + PARAMETERS ================

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

        // IMPLEMENTS (INTERFACES) ===============

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

        // REFERENCES ============================

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

        // SETUP =================================

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

}
